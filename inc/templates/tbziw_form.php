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
 * Info Wizard Display Form Functions
 * @file    tbziw_form.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Form Header
 * @param $action_name
 * @param $action_value
 * @return void
 */
function tbziw_form_head($action_name, $action_value)
{
    ?>
    <form method="post" action="">
        <input type="hidden" name="<?php echo $action_name; ?>" value="<?php echo $action_value; ?>"/>
        <table>
            <tbody>
<?php
}

//#####################################################################//
/**
 * Form Textarea
 * @param $data_id
 * @param $data_content
 * @param $area_size
 * @return void
 */
function tbziw_form_textarea($data_id, $data_content, $area_size)
{
    ?>
<tr>
    <td>
        <textarea name="<?php echo $data_id; ?>"
                  style="<?php echo $area_size; ?>"><?php echo $data_content; ?></textarea>
    </td>
</tr>
    <?php
}

//#####################################################################//
/**
 * Form Text line
 * @param $data_content
 * @return void
 */
function tbziw_form_text($data_content)
{
    ?>
<tr>
    <td>
        <p><?php echo $data_content; ?></p>
    </td>
</tr>
    <?php
}

//#####################################################################//
/**
 * Form Body
 * @return void
 */
function tbziw_form()
{
    echo '';
}

//#####################################################################//
/**
 * Form Submit two buttons
 * @param $option_a
 * @param $option_b
 * @return void
 */
function tbziw_form_submit_choose($option_a, $option_b)
{
    tbziw_submit_choose($option_a, $option_b);
}

//#####################################################################//
/**
 * Form Submit one button
 * @param $action_name
 * @param $action_value
 * @return void
 */
function tbziw_form_submit($action_name, $action_value)
{
    tbziw_submit($action_value);
}

//#####################################################################//
/**
 * Form Footer
 * @param $action_name
 * @param $action_value
 * @return void
 */
function tbziw_form_foot($action_name, $action_value)
{
    ?>
            </tbody>
        </table>
    </form>
<?php
}

?>
