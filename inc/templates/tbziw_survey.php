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
 * Wizard Display, This is meant to be customized
 * @file    tbziw_survey.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Wizard Display Header
 * @param $page_id
 * @return void
 */
function tbziw_survey_head($page_id)
{
    ?>
    <form method="post" action="?page_id=<?php echo $page_id; ?>">
        <table>
            <thead>
            <th>&nbsp;</th>
            </thead>
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                </tr>
    <?php
}

//#####################################################################//
/**
 * Wizard Display Block
 * @param $question_idx
 * @param $questionlist
 * @param $choiceselectlist
 * @return void
 */
function tbziw_block($question_idx, $questionlist, $choiceselectlist)
{

    ?>
<!-- Q <?php echo $questionlist[$question_idx][0]; ?>  -->
<tr>
    <td>
        <b><?php echo $questionlist[$question_idx][1]; ?>&nbsp;</b>
        <br><br>
    </td>
</tr>
<tr>
    <td>
        <table>
            <?php foreach ($choiceselectlist[$question_idx] as $tbziw_selectlist_choice) { ?>
            <tr>
                <th>
                    <input type="radio" name="<?php echo $tbziw_selectlist_choice[2]; ?>"
                           value="<?php echo $tbziw_selectlist_choice[0]; ?>"/>&nbsp;
                </th>
                <td>
                    <?php echo $tbziw_selectlist_choice[1]; ?>&nbsp;
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
        </table>
    </td>
</tr>
    <?php
}

//#####################################################################//
/**
 * Wizard Submit Button
 * @param $page_id
 * @return void
 */
function tbziw_submit_button($page_id)
{
    ?>
<tr>
    <td colspan="2" align="right">
        <input class="button" name="submit" type="submit" value="Next"/>
    </td>
</tr>
    <?php
}

//#####################################################################//
/**
 * Wizard Hidden Values
 * @param $choicelist
 * @return void
 */
function tbziw_add_hidden($choicelist)
{

    // Add previous results, ie.e cummulate
    foreach ($_POST as $pkey => $pval) {
        $answer_val = explode('tbziwqid_', $pkey);
        if (is_array($answer_val) && (count($answer_val) > 1)) {
            if (isset($choicelist[$pkey])) {
                echo '<input name="' . $pkey . '" value="' . $pval . '" type="hidden" />';
            } else {
                echo '<input name="tbziwqid_-' . $answer_val[1] . '" value="' . $pval . '" type="hidden" />';
            }
        }

    }
}

//#####################################################################//
/**
 * Wizard Hidden Section
 * @param $tbziw_step_next
 * @param $section_now
 * @return void
 */
function tbziw_add_hidden_section($tbziw_step_next, $section_now)
{
    ?>
<tr>
    <td>
        <input name="tbziw_step" value="<?php echo $tbziw_step_next; ?>" type="hidden"/>
        <input name="tbziw_section" value="<?php echo $section_now; ?>" type="hidden"/>
    </td>
</tr>
    <?php
}

//#####################################################################//
/**
 * Wizard Display Footer
 * @param $page_id
 * @return void
 */
function tbziw_survey_foot($page_id)
{
    ?>
<tr>
    <td>&nbsp;</td>
</tr>
            </tbody>
            <tfoot>
            <th>&nbsp;</th>
            </tfoot>
        </table>
    </form>
<?php
}

?>
