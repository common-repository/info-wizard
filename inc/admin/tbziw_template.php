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
 * Admin Template Dashboard
 * @file    tbziw_template.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Display form to add template
 */
function tbziw_admin_template_form_missing()
{

    tbziw_admin_menu_head('Info Wizard Admin - Template');
    tbziw_form_head('tbziwtemplate', 'new');

    tbziw_form_text('There is no Info Wizard Template currently.  How do you wish to proceed?');

    tbziw_form_submit_choose('Copy Theme Template', 'Create Generic Template');
    tbziw_form_foot('tbziwtemplate', 'new');

    tbziw_admin_menu_footer();
}

//#####################################################################//
/**
 * Display template editor form
 * @param $filename Info_Wizard template
 */
function tbziw_admin_template_form($filename)
{
    tbziw_admin_menu_head('Info Wizard Admin - Template');

    $contents = tbziw_slurp_file($filename);
    $contents = str_replace("\\", "", $contents);

    tbziw_form_head('tbziwtemplate', 'upd');
    tbziw_form_text('Ensure that the following tag is in the correct spot: &lt;?php tbziw_executetemplate($page_id) ?&gt; ');
    tbziw_form_textarea('theme_template', $contents, 'width:400px;height:400px;');
    tbziw_form_submit('tbziwtemplate', 'Save');
    tbziw_form_foot('tbziwtemplate', 'upd');

    tbziw_admin_split_sections();

    tbziw_form_head('tbziwtemplate', 'reset');
    tbziw_form_submit_choose('Reset to Theme Template', 'Reset to Generic Template');
    tbziw_form_foot('tbziwtemplate', 'new');

    $DATAFILE_FLAG = tbziw_check_datafile_flag();
    if (!file_exists($DATAFILE_FLAG)) {
        $DATAFILE = tbziw_check_datafile();
        if (file_exists($DATAFILE)) {
            tbziw_admin_split_sections();
            tbziw_form_head('tbziwdatafile', 'load');
            tbziw_form_submit('tbziwdatafile', 'Load Datafile');
            tbziw_form_foot('tbziwdatafile', 'load');
        }

    }
    
    if( !tbziw_check_debug_disabled() ) {
        tbziw_admin_split_sections();
        tbziw_admin_DEBUG();
        
        
        tbziw_admin_split_sections();
        tbziw_admin_TEST();
    }

    tbziw_admin_menu_footer();
}

    
//#####################################################################//
/**
 * Debugging Info
 */
function tbziw_admin_DEBUG()
{

    tbziw_form_text('BEG ... DEBUG DEBUG DEBUG DEBUG DEBUG DEBUG DEBUG DEBUG DEBUG ... BEG');
    echo "\n<pre>\n";

    
    #echo "Table: ".$check_question_tables[0]."\n";

    echo "\n</pre>\n";
    tbziw_form_text('END ... DEBUG DEBUG DEBUG DEBUG DEBUG DEBUG DEBUG DEBUG DEBUG ... END');

}


//#####################################################################//
/**
 * Test Validations Info
 */
function tbziw_admin_TEST()
{
    tbziw_form_text('BEG ... TEST TEST TEST TEST TEST TEST TEST TEST TEST ... BEG');
    echo "\n<pre>\n";

    global $wpdb;
    $tbl_name = $wpdb->prefix."tbziw_choices";
    if( tbziw_check_table($tbl_name) ) {
        echo "ERROR: $tbl_name (Missing)\n";
    }
    else {
        echo "GOOD : $tbl_name \n";
    }

    $tbl_name = $wpdb->prefix."tbziw_questions";
    if( tbziw_check_table($tbl_name) ) {
        echo "ERROR: $tbl_name (Missing)\n";
    }
    else {
        echo "GOOD : $tbl_name \n";
    }
    
    $tbl_name = $wpdb->prefix."tbziw_responses";
    if( tbziw_check_table($tbl_name) ) {
        echo "ERROR: $tbl_name (Missing)\n";
    }
    else {
        echo "GOOD : $tbl_name \n";
    }
    
    
    $tbl_name = $wpdb->prefix."tbziw_settings";
    if( tbziw_check_table($tbl_name) ) {
        echo "ERROR: $tbl_name (Missing)\n";
    }
    else {
        echo "GOOD : $tbl_name \n";
    }
    
    #echo "Table: ".$check_question_tables[0]."\n";

    echo "\n</pre>\n";
    tbziw_form_text('END ... TEST TEST TEST TEST TEST TEST TEST TEST TEST ... END');

}



//#####################################################################//
/**
 * Check and handle template edit logic
 */
function tbziw_admin_template()
{

    $filename = tbziw_get_infowizard_template();
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == 'Load Datafile') {
            $DATAFILE_FLAG = tbziw_check_datafile_flag();
            if (!file_exists($DATAFILE_FLAG)) {
                $DATAFILE = tbziw_check_datafile();
                if (file_exists($DATAFILE)) {
                    tbziw_load_datafile();
                }
            }
        }
    }

    if (file_exists($filename)) {
        if (isset($_POST['tbziwtemplate'])) {

            if ($_POST['submit'] == 'Reset to Theme Template') {
                $filename_template = tbziw_check_template_file_theme();
                $contents = tbziw_slurp_file($filename_template);
                $contents = str_replace("\\", "", $contents);
                $filename = tbziw_reset_infowizard_template();


                tbziw_append_file($filename, $contents);
                tbziw_admin_template_form($filename);
            } elseif ($_POST['submit'] == 'Reset to Generic Template') {
                $filename_template = tbziw_check_template_file_default();
                $contents = tbziw_slurp_file($filename_template);
                $contents = str_replace("\\", "", $contents);
                $filename = tbziw_reset_infowizard_template();

                tbziw_append_file($filename, $contents);
                tbziw_admin_template_form($filename);
            } else {
                $new_template_data = $_POST['theme_template'];
                tbziw_admin_template_save($new_template_data);
            }

        } else {
            tbziw_admin_template_form($filename);
        }
    } else {
        if (isset($_POST['tbziwtemplate'])) {
            if ($_POST['submit'] == 'Copy Theme Template') {
                $filename_template = tbziw_check_template_file_theme();
                $contents = tbziw_slurp_file($filename_template);
                $contents = str_replace("\\", "", $contents);
                $filename = tbziw_reset_infowizard_template();


                tbziw_append_file($filename, $contents);
            } else {
                $filename_template = tbziw_check_template_file_default();
                $contents = tbziw_slurp_file($filename_template);
                $contents = str_replace("\\", "", $contents);
                $filename = tbziw_reset_infowizard_template();

                tbziw_append_file($filename, $contents);
            }
            tbziw_admin_template_form($filename);
        } else {
            tbziw_admin_template_form_missing();
        }
    }

}

//#####################################################################//
/**
 * Write template to file
 * @param $new_template_data
 */
function tbziw_admin_template_save($new_template_data)
{

    $filename = tbziw_get_template();
    $new_template_data = str_replace("\\", "", $new_template_data);
    tbziw_write_file($filename, $new_template_data);

    tbziw_admin_template_form($filename);
}

?>
