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
 * Admin Questions Dashboard
 * @file    tbziw_questions.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Display Admin form for adding and modifying questions
 * @return void
 */
function tbziw_admin_questions()
{
    tbziw_admin_menu_head('Info Wizard Admin - Questions');

    global $wpdb;
    if (isset($_POST['tbziwquestion'])) {

        if ($_POST['submit'] == 'Add') {

            $tbziw_question_html = tbziw_get_html($_POST['tbziw_question_html']);
            $tbziw_question_txt = tbziw_get_txt_or_html($_POST['tbziw_question_txt'], $_POST['tbziw_question_html']);

            $tbziw_question_section = $_POST['tbziw_question_section'];
            $tbziw_question_order = $_POST['tbziw_question_order'];

            $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "tbziw_questions" .
                    " (
                tbziw_question_html,    tbziw_question_txt,
                tbziw_question_section,
                tbziw_question_order
                )  VALUES (%s,%s, %d,%d) ",
                $tbziw_question_html, $tbziw_question_txt,
                $tbziw_question_section,
                $tbziw_question_order
            ));
        } else {

            if ($_POST['submit'] == 'Update') {

                $tbziw_question_html = tbziw_get_html($_POST['tbziw_question_html']);
                $tbziw_question_txt = tbziw_get_txt_or_html($_POST['tbziw_question_txt'], $_POST['tbziw_question_html']);

                $tbziw_question_section = $_POST['tbziw_question_section'];
                $tbziw_question_order = $_POST['tbziw_question_order'];

                $tbziw_question_fg = $_POST['tbziw_question_fg'];
                $tbziw_question_id = $_POST['tbziwquestion'];

                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "tbziw_questions" . " SET
                    tbziw_question_html     = %s, tbziw_question_txt = %s,
                    tbziw_question_section  = %d,
                    tbziw_question_order    = %d,
                    tbziw_question_fg       = %s
                    WHERE tbziw_question_id = %d ",
                    $tbziw_question_html, $tbziw_question_txt,
                    $tbziw_question_section,
                    $tbziw_question_order,
                    $tbziw_question_fg,
                    $tbziw_question_id
                ));

            } elseif ($_POST['submit'] == 'Delete') {

                $tbziw_question_id = $_POST['tbziwquestion'];
                $wpdb->query($wpdb->prepare("DELETE FROM " . $wpdb->prefix . "tbziw_questions" .
                        " WHERE tbziw_question_id = %d",
                    $tbziw_question_id
                ));
            }
        }

    }

    tbziw_admin_questions_new();
    tbziw_admin_split_sections();

    $tbziw_questions = $wpdb->get_results($wpdb->prepare("SELECT tbziw_question_id,tbziw_question_html,tbziw_question_txt,tbziw_question_section,tbziw_question_order,tbziw_question_fg FROM " . $wpdb->prefix . "tbziw_questions" . " ORDER BY tbziw_question_section, tbziw_question_order, tbziw_question_id"));
    if (count($tbziw_questions) < 1) {
        echo '<tr><td><h1>This wizard has not been setup</h1></td></tr>';

    } else {
        
        echo "\n<table> <tbody>\n";
        foreach ($tbziw_questions as $tbziw_question_row) {

            $tbziw_question_txt = substr(strip_tags($tbziw_question_row->tbziw_question_txt), 0, 50);

            $tbziw_question_fg = 'checked="checked"';
            if ($tbziw_question_row->tbziw_question_fg == 'DISABLED') {
                $tbziw_question_fg = '';
            }
            tbziw_admin_questions_existing_shortcut(
                $tbziw_question_row->tbziw_question_id,
                $tbziw_question_row->tbziw_question_section,
                $tbziw_question_row->tbziw_question_order,
                $tbziw_question_fg,
                $tbziw_question_txt,
                $tbziw_question_row->tbziw_question_html
            );

        }
        echo "\n</tbody></table>\n";
        tbziw_admin_split_sections();
        
        $tbziw_questions = $wpdb->get_results($wpdb->prepare("SELECT tbziw_question_id,tbziw_question_html,tbziw_question_txt,tbziw_question_section,tbziw_question_order,tbziw_question_fg FROM " . $wpdb->prefix . "tbziw_questions" . " ORDER BY tbziw_question_section, tbziw_question_order, tbziw_question_id"));
        foreach ($tbziw_questions as $tbziw_question_row) {

            $tbziw_question_txt = substr(strip_tags($tbziw_question_row->tbziw_question_txt), 0, 50);

            $tbziw_question_fg = 'checked="checked"';
            if ($tbziw_question_row->tbziw_question_fg == 'DISABLED') {
                $tbziw_question_fg = '';
            }
            tbziw_admin_questions_existing(
                $tbziw_question_row->tbziw_question_id,
                $tbziw_question_row->tbziw_question_section,
                $tbziw_question_row->tbziw_question_order,
                $tbziw_question_fg,
                $tbziw_question_txt,
                $tbziw_question_row->tbziw_question_html
            );

        }
    }

    tbziw_admin_menu_footer();

}

?>