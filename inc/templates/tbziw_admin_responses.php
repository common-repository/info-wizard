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
 * Format for Questions on Admin
 * @file    tbziw_admin_responses.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * 
 * @param 
 * @return void
 */
function tbziw_admin_responses_head()
{

}

//#####################################################################//
/**
 * Body
 * @return void
 */
function tbziw_admin_responses_new()
{

    tbziw_form_head('tbziwresponse', 'NEW');
    ?>
<tr>
    <td><H3>New Response</H3></td>
</tr>
<tr>
    <td>Response ID: N/A, Question ID: N/A, Choice ID: N/A</td>
</tr>
<tr>
    <td>N/A - N/A</td>
</tr>
<tr>
    <td>Note: <input type="text" name="tbziw_response_txt" value=""/></td>
</tr>
<?php
    tbziw_form_textarea('tbziw_response_html', '', 'width:600px;height:400px;');

    tbziw_form_submit('tbziwresponse', 'Add');
    tbziw_form_foot('tbziwresponse', '');
}


//#####################################################################//
/**
 * Body
 * @return void
 */
function tbziw_admin_responses_existing($tbziw_response_id,
$tbziw_question_id,
$tbziw_choice_id,
$tbziw_question_html,
$tbziw_choice_html,
$tbziw_response_html)
{

            tbziw_form_head('tbziwresponse', $tbziw_response_id);
            $anchor='<a name="anc_' . $tbziw_question_id . '_' . $tbziw_choice_id . '"></a>';
            ?>
        <tr>
            <td>Response ID: <?php echo $tbziw_response_id;  ?>, Question ID: <?php echo $tbziw_question_id;  ?>, Choice
                ID: <?php echo $tbziw_choice_id;  ?></td>
        </tr>
        <tr>
            <td><?php echo $tbziw_question_html;  ?> - <?php echo $tbziw_choice_html;  ?></td>
        </tr>
        <tr>
            <td>Note: <input type="text" name="tbziw_response_txt" value="<?php echo $tbziw_response_txt; ?>"/></td>
        </tr>
        <?php

            tbziw_form_textarea('tbziw_response_html', $tbziw_response_html, 'width:600px;height:400px;');

            tbziw_form_submit_choose('Delete', 'Update');
            echo "$anchor\n";
            tbziw_form_foot('tbziwresponse', $tbziw_response_id);
                tbziw_admin_menu_top();
}


//#####################################################################//
/**
 * Body
 * @return void
 */
function tbziw_admin_responses_body()
{

}

//#####################################################################//
/**
 * Footer
 * @return void
 */
function tbziw_admin_responses_foot()
{

}

?>
