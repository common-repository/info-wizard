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
 * @file    tbziw_data.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Return initial responses SQL
 * @param $table
 * @return string
 */
function tbziw_get_sql_tbziw_responses($table)
{
    return "INSERT  INTO $table
(tbziw_response_id,tbziw_response_txt,tbziw_response_html)
values
('1','response 3','response 3'),
('1','response 4','response 4')
;
";

}

//#####################################################################//
/**
 * Return initial questions SQL
 * @param $table
 * @return string
 */
function tbziw_get_sql_tbziw_questions($table)
{
    return "INSERT  INTO $table
(tbziw_question_id,tbziw_question_txt,tbziw_question_html,tbziw_question_section,tbziw_question_order,tbziw_question_fg)
VALUES
('1','question?','question?','0','0','ENABLED'),
('2','question?','question?','1','1','ENABLED'),
('3','question?','question?','2','1','ENABLED'),
('4','question?','question?','3','1','ENABLED')
;
";
}

//#####################################################################//
/**
 * Return initial choices SQL
 * @param $table
 * @return string
 */
function tbziw_get_sql_tbziw_choices($table)
{

    return "INSERT  INTO $table
(tbziw_choice_id,tbziw_question_id,tbziw_choice_txt,tbziw_choice_html,tbziw_choice_order,tbziw_choice_response_fg,tbziw_response_id,tbziw_choice_section_id,tbziw_choice_section_fg)
values
('1','1','one.','one.','1','NO','0','1','YES'),
('2','1','two.','two.','2','NO','0','2','YES'),
('3','1','three.','three.','3','YES','1','3','YES'),
('4','1','four.','four.','4','YES','2','0','NO')
;
";

}

?>