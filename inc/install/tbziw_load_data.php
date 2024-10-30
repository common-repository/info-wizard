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
 * Test/Debug Data, the example
 * @file    tbziw_data_RELOAD.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

function tbziw_RELOAD() {
   global $wpdb;

        $table = $wpdb->prefix."tbziw_choices";
        $wpdb->query("DROP TABLE IF EXISTS $table;");

        $table = $wpdb->prefix."tbziw_questions";
        $wpdb->query("DROP TABLE IF EXISTS $table;");

        $table = $wpdb->prefix."tbziw_responses";
        $wpdb->query("DROP TABLE IF EXISTS $table;");
        
    $table = $wpdb->prefix."tbziw_choices";
    $tbziw_choices = "CREATE TABLE $table (
        tbziw_choice_id       MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
        tbziw_question_id     MEDIUMINT(8) NOT NULL,
        tbziw_choice_txt      TEXT,
        tbziw_choice_html     TEXT,
        tbziw_choice_order    TINYINT NOT NULL DEFAULT '1',

        -- If the choice corresponds to a response, else just information
        tbziw_choice_response_fg ENUM('NO','YES') NOT NULL DEFAULT 'YES',
        tbziw_response_id MEDIUMINT(8) NOT NULL DEFAULT '0',

        -- If the choice corresponds to a response, else just information
        tbziw_choice_section_fg ENUM('NO','YES') NOT NULL DEFAULT 'NO',
        tbziw_choice_section_id TINYINT NOT NULL DEFAULT '0',

        KEY tbziw_question_id (tbziw_question_id,tbziw_response_id),
        PRIMARY KEY (tbziw_choice_id)
    );";
    $wpdb->query($tbziw_choices);

    $table = $wpdb->prefix."tbziw_questions";
    $tbziw_questions = "CREATE TABLE $table (
        tbziw_question_id       MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
        tbziw_question_txt      TEXT,
        tbziw_question_html     TEXT,
        tbziw_question_section  TINYINT NOT NULL DEFAULT '1',
        tbziw_question_order    TINYINT NOT NULL DEFAULT '1',

        tbziw_question_fg ENUM('ENABLED','DISABLED') NOT NULL DEFAULT 'ENABLED',
        PRIMARY KEY (tbziw_question_id)
    );";
    $wpdb->query($tbziw_questions);

    $table = $wpdb->prefix."tbziw_responses";
    $tbziw_responses = "CREATE TABLE $table (
        tbziw_response_id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
        tbziw_response_txt   TEXT,
        tbziw_response_html  TEXT,

        PRIMARY KEY (tbziw_response_id)
    );";
    $wpdb->query($tbziw_responses);
    
}

function tbziw_get_sql_tbziw_responses_LOAD($table) {
return  <<<EOD
EOD;

    }

function tbziw_get_sql_tbziw_questions_LOAD($table) {

return  <<<EOD

EOD;
}


function tbziw_get_sql_tbziw_choices_LOAD($table) {

return  <<<EOD

EOD;


}

?>




