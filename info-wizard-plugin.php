<?php
/*
Author: Nigel Cruce
Author URI: http://www.terabytz.com
Project: Info Wizard
License: GPL v3

Copyright 2013 Nigel Cruce, Terabytz  (email : nigelcruce@terabytz.com)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
//#####################################################################//
/**
 * Base class for Info Wizard
 * @file    info-wizard-plugin.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

class TBZ_Info_Wizard_Plugin {

    // Version
    private $version = "1.2.1";
    private $plugin_title = "Info Wizard";
    private $plugin_name = "info-wizard";
    private $setting_name = "info-wizard-settings";

    //holds plugin options
    private $opt = array();

    //initialize the plugin class
    public function __construct() {
        $this->opt = get_option($this->setting_name);
        add_action( 'admin_menu', array(&$this, 'tbziw_add_admin') );
    }

    //#####################################################################//
    /**
    * Admin Menu
    */
    public function tbziw_add_admin() {

        if (!current_user_can('administrator')){return false;}

        if (function_exists('add_menu_page')) {
            add_menu_page('Info Wizard', 'Info Wizard', 'edit_pages', __FILE__, 'tbziw_admin_base');
                add_submenu_page(__FILE__, 'Questions', 'Questions', 'edit_pages', 'questions', 'tbziw_admin_questions');
                add_submenu_page(__FILE__, 'Responses', 'Responses', 'edit_pages', 'responses', 'tbziw_admin_responses');
                add_submenu_page(__FILE__, 'Choices', 'Choices', 'edit_pages', 'choices', 'tbziw_admin_choices');
                add_submenu_page(__FILE__, 'Template', 'Template', 'edit_pages', 'template', 'tbziw_admin_template');
        }
    }

    //#####################################################################//
    /**
    * load section info
    */
    public function tbziw_getsections($choicelist) {
        if( !is_array($choicelist) || (count($choicelist) < 1) ) {
            return 0;
        }
        global $wpdb;

        $tbl_sections = $wpdb->get_results( "SELECT tbziw_choice_id,tbziw_choice_section_id FROM ".$wpdb->prefix."tbziw_choices" . " WHERE tbziw_choice_section_fg = 'YES';");
        foreach($tbl_sections as $tbl_section_row) {

            if( in_array( $tbl_section_row->tbziw_choice_id, $choicelist ) ) {
                $index = array_search($tbl_section_row->tbziw_choice_id, $choicelist);
                if( $index > 0 ) {
                    unset($choicelist[$index]);
                    $idxsection = 0 - $index;
                    // Flip sections negative incase they also have respons
                    $choicelist[$idxsection] = $tbl_section_row->tbziw_choice_id;

                    //array_push($tbl_section_row->tbziw_choice_section_id, $sections);
                    return $tbl_section_row->tbziw_choice_section_id;
                }
            }

        }
        return 0;
    }

    //#####################################################################//
    /**
    * load results
    */
    public function tbziw_getanswers($choicelist) {
        $response_lookup = array();
        if( !is_array($choicelist) || (count($choicelist) < 1) ) {
            return $response_lookup;
        }
        global $wpdb;

        $tbl_responses = $wpdb->get_results( "SELECT tbziw_choice_id  FROM ".$wpdb->prefix."tbziw_choices" . " WHERE tbziw_choice_response_fg = 'YES';");

            # var_dump($choicelist);

        foreach($tbl_responses as $tbl_response_row) {
            if( in_array( $tbl_response_row->tbziw_choice_id, $choicelist ) ) {

                $tbl_choice_row = $wpdb->get_row( $wpdb->prepare("SELECT tbziw_choice_id,tbziw_choice_html,tbziw_response_id,tbziw_choice_section_id,tbziw_question_id FROM ".$wpdb->prefix."tbziw_choices" . " WHERE tbziw_choice_id = %d;", $tbl_response_row->tbziw_choice_id));

                $tbl_response = $wpdb->get_row( $wpdb->prepare("SELECT tbziw_response_html FROM ".$wpdb->prefix."tbziw_responses" . " WHERE tbziw_response_id = %d;", $tbl_choice_row->tbziw_response_id));
                $tbziw_question = $wpdb->get_row( $wpdb->prepare("SELECT tbziw_question_html FROM ".$wpdb->prefix."tbziw_questions" . " WHERE tbziw_question_id = %d ",$tbl_choice_row->tbziw_question_id));

                $response_lookup[$tbl_choice_row->tbziw_response_id][0] = $tbl_choice_row->tbziw_choice_html;
                $response_lookup[$tbl_choice_row->tbziw_response_id][1] = $tbl_response->tbziw_response_html;
                $response_lookup[$tbl_choice_row->tbziw_response_id][2] = $tbziw_question->tbziw_question_html;

                #echo '<tr><th><div>'.$response_lookup[$tbl_choice_row->tbziw_response_id][1].'&nbsp;'.$response_lookup[$tbl_choice_row->tbziw_response_id][0].'<br></div></th></tr>';
                #echo '<tr><td><div>'.$response_lookup[$tbl_choice_row->tbziw_response_id][2].'&nbsp;<br></div></td></tr>';
            }
        }

        return $response_lookup;
    }

    //#####################################################################//
    /**
    * parse choices
    */
    public function tbziw_checkanswers() {
        global $wpdb;
        $choicelist = array();
        foreach($_POST as $pkey => $pval) {
            $answer_val = explode('tbziwqid_',$pkey);
            if( is_array($answer_val) && (count($answer_val) > 1) ) {
                $choicelist[ $answer_val[1] ] = $pval;
            }

        }
        return $choicelist;
    }

    //#####################################################################//
    /**
    * print questions and choices
    */
    public function tbziw_listquestions($section,&$choiceselectlist,&$questionlist) {
        global $wpdb;
        $question_count = 0;

        $tbziw_questions = $wpdb->get_results( $wpdb->prepare("SELECT tbziw_question_id,tbziw_question_html,tbziw_question_section,tbziw_question_order FROM ".$wpdb->prefix."tbziw_questions" . " WHERE tbziw_question_section = %d ORDER BY tbziw_question_section, tbziw_question_order",$section));
        if (count($tbziw_questions)<1) {
            echo '<tr><td><h1>This wizard has not been setup</h1></td></tr>';
        }
        else {
            foreach($tbziw_questions as $tbziw_question_row) {

               $questionlist[$question_count][0] = $tbziw_question_row->tbziw_question_id;
               $questionlist[$question_count][1] = $tbziw_question_row->tbziw_question_html;

                $tbziw_choices = $wpdb->get_results( $wpdb->prepare("SELECT tbziw_choice_id,tbziw_choice_html FROM ".$wpdb->prefix."tbziw_choices" . " WHERE tbziw_question_id = %d ORDER BY tbziw_choice_order",$tbziw_question_row->tbziw_question_id));
                foreach($tbziw_choices as $tbziw_choices_row) {

                    $choiceselectlist[$question_count][$tbziw_choices_row->tbziw_choice_id][0] = $tbziw_choices_row->tbziw_choice_id;
                    $choiceselectlist[$question_count][$tbziw_choices_row->tbziw_choice_id][1] = $tbziw_choices_row->tbziw_choice_html;
                    $choiceselectlist[$question_count][$tbziw_choices_row->tbziw_choice_id][2] = 'tbziwqid_' . $tbziw_question_row->tbziw_question_id;

                }
                $question_count++;
            }
        }

        return $question_count;
    }

    //#####################################################################//
    /**
    * Get/print content to be displayed
    */
    public function tbziw_getcontent($page_id) {

        $section_now = 0;
        $tbziw_step = 0;
        $tbziw_step_next = 0;
        $response_lookup = array();
        $choiceselectlist = array();
        $questionlist = array();

        $question_count = 0;

        if ( $_POST['tbziw_section'] ) {
            $section_now = $_POST['tbziw_section'];
        }
        if ( $_POST['tbziw_step'] ) {
            $tbziw_step = $_POST['tbziw_step'];
        }

        if( ($tbziw_step == 0) && ($section_now ==  0) ) {

            $tbziw_step_next = 1;

            $question_count = $this->tbziw_listquestions(0,$choiceselectlist,$questionlist);

            // print submit button
            if( $question_count > 0 ) {

                tbziw_survey_head($page_id);

                for($n = 0; $n < $question_count; $n++) {
                    tbziw_block($n,$questionlist,$choiceselectlist);
                }

                tbziw_add_hidden_section($tbziw_step_next, $section_now);
                tbziw_submit_button($page_id);
                tbziw_survey_foot($page_id);
            }

        }
        else {
            $tbziw_step_next = 2;

            $choicelist = $this->tbziw_checkanswers();
            $section_now = $this->tbziw_getsections($choicelist);
            $response_lookup = $this->tbziw_getanswers($choicelist);

            if( $section_now > 0 ) {
                $question_count = $this->tbziw_listquestions($section_now,$choiceselectlist,$questionlist);
            }
            // print submit button
            if( $question_count > 0 ) {
                tbziw_survey_head($page_id);

                for($n = 0; $n < $question_count; $n++) {
                    tbziw_block($n,$questionlist,$choiceselectlist);
                }
                tbziw_add_hidden($choicelist);

                tbziw_add_hidden_section($tbziw_step_next,$section_now);
                tbziw_submit_button($page_id);
                tbziw_survey_foot($page_id);
            }

        }
        if( $question_count > 0 ) {

        }

        // Print Report
        if( is_array($response_lookup) && (count($response_lookup) > 0) ) {
            tbziw_report($page_id,$response_lookup);
        }

    }

    //#####################################################################//
    /**
    * Display content
    */
    public function tbziw_executetemplate($page_id) {
        $this->tbziw_getcontent($page_id);
    }
    
}
?>
