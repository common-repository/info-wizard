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
 * Admin Responses Dashboard
 * @file    tbziw_responses.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Display Admin form for adding and modifying Responses
 * @return void
 */
function tbziw_admin_responses()
{
    tbziw_admin_menu_head('Info Wizard Admin - Responses');

    global $wpdb;
    if (isset($_POST['tbziwresponse'])) {

        if ($_POST['submit'] == 'Add') {


            $tbziw_response_html = tbziw_get_html($_POST['tbziw_response_html']);
            $tbziw_response_txt = tbziw_get_txt_or_html($_POST['tbziw_response_txt'], $_POST['tbziw_response_html']);

            $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "tbziw_responses" .
                    " (
                tbziw_response_html,  tbziw_response_txt
                ) VALUES (%s,%s) ",
                $tbziw_response_html, $tbziw_response_txt
            ));
        } else {

            if ($_POST['submit'] == 'Update') {

                $tbziw_response_html = tbziw_get_html($_POST['tbziw_response_html']);
                $tbziw_response_txt = tbziw_get_txt_or_html($_POST['tbziw_response_txt'], $_POST['tbziw_response_html']);
                $tbziw_response_id = $_POST['tbziwresponse'];

                $wpdb->query(
                    $wpdb->prepare("UPDATE " . $wpdb->prefix . "tbziw_responses" .
                            " SET
                    tbziw_response_html     = %s, tbziw_response_txt = %s 
                    WHERE tbziw_response_id = %d ",
                        $tbziw_response_html, $tbziw_response_txt,
                        $tbziw_response_id
                    ));

            } elseif ($_POST['submit'] == 'Delete') {
                $tbziw_response_id = $_POST['tbziwresponse'];
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "tbziw_responses" .
                        " WHERE tbziw_response_id = %d",
                    $tbziw_response_id
                ));

            }
        }

    }

    tbziw_admin_responses_new();
    tbziw_admin_split_sections();
    
    $tbziw_responses = $wpdb->get_results($wpdb->prepare("SELECT tbziw_response_id,tbziw_response_html,tbziw_response_txt FROM " . $wpdb->prefix . "tbziw_responses" . " ORDER BY tbziw_response_id"));
    if (count($tbziw_responses) < 1) {
        echo '<tr><td><h1>This wizard has not been setup</h1></td></tr>';

    } else {
        
        
        foreach ($tbziw_responses as $tbziw_response_row) {

            $tbl_choice_row = $wpdb->get_row($wpdb->prepare("SELECT tbziw_choice_id, tbziw_choice_html, tbziw_question_id FROM " . $wpdb->prefix . "tbziw_choices" . " WHERE tbziw_response_id = %d;", $tbziw_response_row->tbziw_response_id));
            $tbziw_question = $wpdb->get_row($wpdb->prepare("SELECT tbziw_question_html FROM " . $wpdb->prefix . "tbziw_questions" . " WHERE tbziw_question_id = %d ", $tbl_choice_row->tbziw_question_id));

            $tbziw_question_html = 'MISSING';
            $tbziw_question_id = 'N/A';
            $tbziw_choice_id = 'N/A';
            $tbziw_choice_html = 'MISSING';
            $tbziw_response_id = $tbziw_response_row->tbziw_response_id;
            $tbziw_response_txt = substr(strip_tags($tbziw_response_row->tbziw_response_txt), 0, 50);

            if ($tbziw_question != null) {
                $tbziw_question_html = $tbziw_question->tbziw_question_html;
                $tbziw_question_id = $tbl_choice_row->tbziw_question_id;
            }

            if ($tbl_choice_row != null) {
                $tbziw_choice_html = $tbl_choice_row->tbziw_choice_html;
                $tbziw_choice_id = $tbl_choice_row->tbziw_choice_id;
            }

tbziw_admin_responses_existing(
$tbziw_response_row->tbziw_response_id,
$tbziw_question_id,
$tbziw_choice_id,
$tbziw_question_html,
$tbziw_choice_html,
$tbziw_response_row->tbziw_response_html
);
        }
    }

    tbziw_admin_menu_footer();

}

?>