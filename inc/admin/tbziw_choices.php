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
 * Admin Choices Dashboard
 * @file    tbziw_choices.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Display Admin form for adding and modifying Choices
 * @return void
 */
function tbziw_admin_choices()
{
    tbziw_admin_menu_head('Info Wizard Admin - Choices');

    global $wpdb;
    if (isset($_POST['tbziwchoices'])) {

        if ($_POST['submit'] == 'Add') {

            $tbziw_question_id = $_POST['tbziw_question_id'];

            $tbziw_choice_html = tbziw_get_html($_POST['tbziw_choice_html']);
            $tbziw_choice_txt = tbziw_get_txt_or_html($_POST['tbziw_choice_txt'], $_POST['tbziw_choice_html']);

            $tbziw_response_id = $_POST['tbziw_response_id'];
            $tbziw_choice_response_fg = $_POST['tbziw_choice_response_fg'];

            $tbziw_choice_section_id = $_POST['tbziw_choice_section_id'];
            $tbziw_choice_section_fg = $_POST['tbziw_choice_section_fg'];

            $tbziw_choice_order = $_POST['tbziw_choice_order'];

            if ($tbziw_choice_section_id == 0) {
                $tbziw_choice_section_fg = 'NO';
            }
            if ($tbziw_choice_section_fg == 'NO') {
                $tbziw_choice_section_id = 0;
            }

            if ($tbziw_response_id == 0) {
                $tbziw_choice_response_fg = 'NO';
            }
            if ($tbziw_choice_response_fg == 'NO') {
                $tbziw_response_id = 0;
            }

            $wpdb->query($wpdb->prepare(
                "INSERT INTO " . $wpdb->prefix . "tbziw_choices" .
                    " (
                tbziw_question_id,
                tbziw_choice_html,       tbziw_choice_txt,
                tbziw_response_id,       tbziw_choice_response_fg,
                tbziw_choice_section_id, tbziw_choice_section_fg,
                tbziw_choice_order
                ) VALUES (%d, %s,%s, %d,%s, %d,%s, %d) ",
                $tbziw_question_id,
                $tbziw_choice_html, $tbziw_choice_txt,
                $tbziw_response_id, $tbziw_choice_response_fg,
                $tbziw_choice_section_id, $tbziw_choice_section_fg,
                $tbziw_choice_order
            ));
        } else {

            if ($_POST['submit'] == 'Update') {

                $tbziw_question_id = $_POST['tbziw_question_id'];

                $tbziw_choice_html = tbziw_get_html($_POST['tbziw_choice_html']);
                $tbziw_choice_txt = tbziw_get_txt_or_html($_POST['tbziw_choice_txt'], $_POST['tbziw_choice_html']);

                $tbziw_response_id = $_POST['tbziw_response_id'];
                $tbziw_choice_response_fg = $_POST['tbziw_choice_response_fg'];
                $tbziw_choice_section_id = $_POST['tbziw_choice_section_id'];
                $tbziw_choice_section_fg = $_POST['tbziw_choice_section_fg'];
                $tbziw_choice_order = $_POST['tbziw_choice_order'];
                $tbziw_choice_id = $_POST['tbziwchoices'];

                if ($tbziw_choice_section_id == 0) {
                    $tbziw_choice_section_fg = 'NO';
                }
                if ($tbziw_choice_section_fg == 'NO') {
                    $tbziw_choice_section_id = 0;
                }

                if ($tbziw_response_id == 0) {
                    $tbziw_choice_response_fg = 'NO';
                }
                if ($tbziw_choice_response_fg == 'NO') {
                    $tbziw_response_id = 0;
                }

                $wpdb->query($wpdb->prepare(
                    "UPDATE " . $wpdb->prefix . "tbziw_choices" . " SET
                     tbziw_question_id         = %d,
                     tbziw_choice_html         = %s, tbziw_choice_txt          = %s,
                     tbziw_response_id         = %d, tbziw_choice_response_fg  = %s,
                     tbziw_choice_section_id   = %d, tbziw_choice_section_fg   = %s,
                     tbziw_choice_order        = %d
                     WHERE tbziw_choice_id     = %d",
                    $tbziw_question_id,
                    $tbziw_choice_html, $tbziw_choice_txt,
                    $tbziw_response_id, $tbziw_choice_response_fg,
                    $tbziw_choice_section_id, $tbziw_choice_section_fg,
                    $tbziw_choice_order,
                    $tbziw_choice_id
                ));
            } elseif ($_POST['submit'] == 'Delete') {
                $tbziw_choice_id = $_POST['tbziwchoices'];

                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "tbziw_choices" .
                        " WHERE tbziw_choice_id = %d",
                    $tbziw_choice_id
                ));
            }

        }

    }

    tbziw_admin_choices_new();
    tbziw_admin_split_sections();
    
    $tbziw_choices = $wpdb->get_results($wpdb->prepare("SELECT tbziw_choice_id, tbziw_question_id, tbziw_choice_html, tbziw_choice_txt, tbziw_choice_order, tbziw_response_id, tbziw_choice_response_fg, tbziw_choice_section_id, tbziw_choice_section_fg
     FROM " . $wpdb->prefix . "tbziw_choices" . " ORDER BY tbziw_question_id, tbziw_choice_order, tbziw_choice_id"));
    if (count($tbziw_choices) < 1) {
        echo '<tr><td><h1>This wizard has not been setup</h1></td></tr>';

    } else {
        foreach ($tbziw_choices as $tbziw_choice_row) {
            $tbziw_choice_txt = substr(strip_tags($tbziw_choice_row->tbziw_choice_txt), 0, 50);

            $tbziw_choice_response_fg = 'checked="checked"';
            if ($tbziw_choice_row->tbziw_choice_response_fg == 'NO') {
                $tbziw_choice_response_fg = '';
            }
            $tbziw_choice_section_fg = 'checked="checked"';
            if ($tbziw_choice_row->tbziw_choice_section_fg == 'NO') {
                $tbziw_choice_section_fg = '';
            }

        tbziw_admin_choices_existing(
            $tbziw_choice_row->tbziw_choice_id,
            $tbziw_choice_row->tbziw_question_id,
            $tbziw_choice_row->tbziw_choice_order,
            $tbziw_choice_response_fg,
            $tbziw_choice_row->tbziw_response_id,
             $tbziw_choice_section_fg,
             $tbziw_choice_row->tbziw_choice_section_id,
             $tbziw_choice_txt,
             $tbziw_choice_row->tbziw_choice_html
             
        );

        }
    }


    tbziw_admin_menu_footer();
}

?>