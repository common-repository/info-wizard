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
 * @file    tbziw_admin_choices.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * 
 * @param 
 * @return void
 */
function tbziw_admin_choices_head()
{

}

//#####################################################################//
/**
 * Body
 * @return void
 */
function tbziw_admin_choices_new()
{

    tbziw_form_head('tbziwchoices', 'NEW');
    ?>
<tr>
    <td><H3>New Choice</H3></td>
</tr>
<tr>
    <td>Question ID: N/A, Choice ID: N/A</td>
</tr>

<tr>
    <td>Question:     <?php tbziw_admin_question_dropdown(0); ?></td>
</tr>
<tr>
    <td>Order: <input type="text" name="tbziw_choice_order" value="0"/></td>
</tr>

<tr>
    <td>Sets Results: <input type="checkbox" name="tbziw_choice_response_fg" value="YES"/></td>
</tr>
<tr>
    <td>Result ID:    <?php tbziw_admin_response_dropdown(0); ?></td>
</tr>

<tr>
    <td>Sets Section: <input type="checkbox" name="tbziw_choice_section_fg" value="YES"/></td>
</tr>
<tr>
    <td>Section ID: <?php echo tbziw_admin_section_dropdown(0); ?></td>
</tr>
<tr>
    <td>Note: <input type="text" name="tbziw_choice_txt" value=""/></td>
</tr>
<?php
    tbziw_form_textarea('tbziw_choice_html', '', 'width:300px;height:50px;');

    tbziw_form_submit('tbziwchoices', 'Add');
    tbziw_form_foot('tbziwchoices', '');
}

//#####################################################################//
/**
 * Body
 * @return void
 */
function tbziw_admin_choices_existing(
$tbziw_choice_id,
$tbziw_question_id,
$tbziw_choice_order,
$tbziw_choice_response_fg,
$tbziw_response_id,
 $tbziw_choice_section_fg,
$tbziw_choice_section_id,
$tbziw_choice_txt,
$tbziw_choice_html

)
{
            tbziw_form_head('tbziwchoices', $tbziw_choice_id);
            
            $anchor='<a name="anc_' . $tbziw_choice_id . '_' . $tbziw_response_id . '"></a>';

            ?>
        <tr>
            <td>Question ID: <?php echo $tbziw_question_id;  ?>, Choice ID: <?php echo $tbziw_choice_id;  ?></td>
        </tr>

        <tr>
            <td>Question:     <?php tbziw_admin_question_dropdown($tbziw_question_id); ?></td>
        </tr>
        <tr>
            <td>Order: <input type="text" name="tbziw_choice_order"
                              value="<?php echo $tbziw_choice_order; ?>"/></td>
        </tr>

        <tr>
            <td>Sets Results: <input type="checkbox" name="tbziw_choice_response_fg"
                                     value="YES" <?php echo $tbziw_choice_response_fg;  ?>/></td>
        </tr>
        <tr>
            <td>Result ID:    <?php tbziw_admin_response_dropdown($tbziw_response_id); ?></td>
        </tr>

        <tr>
            <td>Sets Section: <input type="checkbox" name="tbziw_choice_section_fg"
                                     value="YES" <?php echo $tbziw_choice_section_fg;  ?>/></td>
        </tr>
        <tr>
            <td>Section ID: <?php echo tbziw_admin_section_dropdown($tbziw_choice_section_id); ?></td>
        </tr>
        <tr>
            <td>Note: <input type="text" name="tbziw_choice_txt" value="<?php echo $tbziw_choice_txt; ?>"/></td>
        </tr>
        <?php
            tbziw_form_textarea('tbziw_choice_html', $tbziw_choice_html, 'width:300px;height:50px;');

            tbziw_form_submit_choose('Delete', 'Update');
            echo "$anchor\n";
            tbziw_form_foot('tbziwchoices', $tbziw_choice_id);
}

//#####################################################################//
/**
 * Body
 * @return void
 */
function tbziw_admin_choices_body()
{

}

//#####################################################################//
/**
 * Footer
 * @return void
 */
function tbziw_admin_choices_foot()
{

}

?>
