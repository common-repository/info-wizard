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
 * @file    tbziw_admin_questions.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * 
 * @param 
 * @return void
 */
function tbziw_admin_questions_head()
{

}

//#####################################################################//
/**
 * New Question
 * @return void
 */
function tbziw_admin_questions_new()
{
    tbziw_form_head('tbziwquestion', 'NEW');
    ?>
<tr>
    <td><H3>New Question</H3></td>
</tr>
<tr>
    <td>Question ID: N/A</td>
</tr>
<tr>
    <td>Section: <input type="text" name="tbziw_question_section" value="0"/></td>
</tr>
<tr>
    <td>Order: <input type="text" name="tbziw_question_order" value="0"/></td>
</tr>
<tr>
    <td>Note: <input type="text" name="tbziw_question_txt" value=""/></td>
</tr>
<?php
    tbziw_form_textarea('tbziw_question_html', '', 'width:400px;height:50px;');

    tbziw_form_submit('tbziwquestion', 'Add');
    tbziw_form_foot('tbziwquestion', '');
}
//#####################################################################//
/**
 * New Question
 * @return void
 */
function tbziw_admin_questions_existing_shortcut($tbziw_question_id,$tbziw_question_section,$tbziw_question_order,$tbziw_question_fg,$tbziw_question_txt)
{

 echo '<tr><td><a href="#anc_'.$tbziw_question_id.'">'. $tbziw_question_section . '.' . $tbziw_question_order. '&nbsp;&nbsp;' . $tbziw_question_txt.'</a></td></tr>';
        
}

//#####################################################################//
/**
 * New Question
 * @return void
 */
function tbziw_admin_questions_existing($tbziw_question_id,$tbziw_question_section,$tbziw_question_order,$tbziw_question_fg,$tbziw_question_txt, $tbziw_question_html)
{

            tbziw_form_head('tbziwquestion', $tbziw_question_id);
            $anchor='<a name="anc_' . $tbziw_question_id . '"></a>';
            ?>
        <tr>
            <td>Question ID: <?php echo $tbziw_question_id;  ?></td>
        </tr>
        <tr>
            <td>Section: <input type="text" name="tbziw_question_section"
                                value="<?php echo $tbziw_question_section; ?>"/></td>
        </tr>
        <tr>
            <td>Order: <input type="text" name="tbziw_question_order"
                              value="<?php echo $tbziw_question_order; ?>"/></td>
        </tr>
        <tr>
            <td>Enabled: <input type="checkbox" name="tbziw_question_fg"
                                value="ENABLED" <?php echo $tbziw_question_fg  ?>/></td>
        </tr>
        <tr>
            <td>Note: <input type="text" name="tbziw_question_txt" size="75" value="<?php echo $tbziw_question_txt; ?>"/></td>
        </tr>
        <?php
            tbziw_form_textarea('tbziw_question_html', $tbziw_question_html, 'width:400px;height:50px;');

            tbziw_form_submit_choose('Delete', 'Update');
            echo "$anchor\n";
            tbziw_form_foot('tbziwquestion', $tbziw_question_id);
    tbziw_admin_menu_top();
}

//#####################################################################//
/**
 * Body
 * @return void
 */
function tbziw_admin_questions_body()
{

}

//#####################################################################//
/**
 * Footer
 * @return void
 */
function tbziw_admin_questions_foot()
{

}

?>
