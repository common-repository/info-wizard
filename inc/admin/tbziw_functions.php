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
 * General functions
 * @file    tbziw_functions.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Read all data from a file and return the content
 * @param $filename
 * @return string
 */
function tbziw_slurp_file($filename)
{
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    fclose($handle);
    return $contents;
}

//#####################################################################//
/**
 * Write/Overwrite data to a file
 * @param $filename
 * @param $contents
 * @return int
 */
function tbziw_write_file($filename, $contents)
{
    // Validate
    if (is_writable($filename)) {
        if (!$handle = fopen($filename, 'w')) {
            return -1;
        }

        // Write
        if (fwrite($handle, $contents) === FALSE) {
            return -2;
        }

        fclose($handle);

    } else {
        return -3;
    }
}

//#####################################################################//
/**
 * Append data to a file
 * @param $filename
 * @param $contents
 * @return int
 */
function tbziw_append_file($filename, $contents)
{
    // Validate
    //if (is_writable($filename)) {
    if (!$handle = fopen($filename, 'a')) {
        return -1;
    }

    // Write
    if (fwrite($handle, $contents) === FALSE) {
        return -2;
    }

    fclose($handle);

    //} else {
    //    return -3;
    //}
}

//#####################################################################//
/**
 * Add one submit button
 * @param $submit_value Submit button value
 * @return void
 */
function tbziw_submit($submit_value)
{
    ?>
<tr>
    <td colspan="2" align="right">
        <input class="button" name="submit" type="submit" value="<?php echo $submit_value; ?>"/>
    </td>
</tr>
<?php
}

//#####################################################################//
/**
 * Add two submit buttons
 * @param $option_a Left-hand Submit button value
 * @param $option_b Right-hand Submit button value
 * @return void
 */
function tbziw_submit_choose($option_a, $option_b)
{
    ?>
<tr>
    <td colspan="2" align="right">
        <input class="button" name="submit" type="submit" value="<?php echo $option_a; ?>"/>
        <input class="button" name="submit" type="submit" value="<?php echo $option_b; ?>"/>
    </td>
</tr>
<?php
}

//#####################################################################//
/**
 * Generate Dropdown list of responses
 * @param $selected_id
 * @return void
 */
function tbziw_admin_response_dropdown($selected_id)
{
    global $wpdb;

    $tbziw_responses = $wpdb->get_results($wpdb->prepare("SELECT tbziw_response_id,tbziw_response_html,tbziw_response_txt FROM " .
        $wpdb->prefix . "tbziw_responses" . " ORDER BY tbziw_response_id"));

    if (count($tbziw_responses) < 1) {
        ?>
    <tr>
        <td>Result ID: <input type="text" name="tbziw_response_id" value="0"/></td>
    </tr>
    <?php
    } else {
        $selected_set = 0;
        $data_out = '';
        ?>
    <select name='tbziw_response_id'>
        <?php

        foreach ($tbziw_responses as $tbziw_response_row) {

            $tbziw_response_id = $tbziw_response_row->tbziw_response_id;
            $tbziw_response_txt = substr($tbziw_response_row->tbziw_response_txt, 0, 50);

            $is_selected = '';
            if ($tbziw_response_id == $selected_id) {
                $is_selected = 'selected="selected"';
                $selected_set = 1;
            }

            ?>
            <option value='<?php echo $tbziw_response_id; ?>' <?php echo $is_selected; ?>><?php echo $tbziw_response_txt; ?></option>
            <?php
        }

        if (1 != $selected_set) {
            ?>
            <option value="0" selected="selected">--</option>
            <?php
        } else {
            ?>
            <option value="0">--</option>
            <?php
        }

        ?>
    </select>
    <?php

    }
}

//#####################################################################//
/**
 * Generate Dropdown list of sections
 * @param $selected_id
 * @return void
 */
function tbziw_admin_section_dropdown($selected_id)
{
    global $wpdb;

    $tbziw_question_sections = $wpdb->get_results( $wpdb->prepare("SELECT DISTINCT tbziw_question_section FROM ".$wpdb->prefix."tbziw_questions" . " ORDER BY tbziw_question_section" ));

    if (count($tbziw_question_sections) < 1) {
        ?>
    <tr>
        <td>Section: <input type="text" name="tbziw_choice_section_id" value="0"/></td>
    </tr>
    <?php
    } else {
        $selected_set = 0;
        $has_zero     = 0;
        ?>
    <select name='tbziw_choice_section_id'>
        <?php

        foreach ($tbziw_question_sections as $tbziw_question_section) {

            $tbziw_choice_section_id = $tbziw_question_section->tbziw_question_section;
            if ($tbziw_choice_section_id == 0 ){
                $has_zero = 1;
            }

            $is_selected = '';
            if ($tbziw_choice_section_id == $selected_id) {
                $is_selected = 'selected="selected"';
                $selected_set = 1;
            }

            ?>
            <option value='<?php echo $tbziw_choice_section_id; ?>' <?php echo $is_selected; ?>><?php echo $tbziw_choice_section_id; ?></option>
            <?php
        }
        
        if (1 != $has_zero) {
            if (1 != $selected_set) {
                ?>
                <option value="0" selected="selected">Default</option>
                <?php
            } else {
                ?>
                <option value="0">--</option>
                <?php
            }
        
        } else {
            if (1 != $selected_set) {
                ?>
                <option value="0" selected="selected">Default</option>
                <?php
            }
        }
        
        ?>
    </select>
    <?php

    }
}

//#####################################################################//
/**
 * Generate Dropdown list of questions
 * @param $selected_id
 * @return void
 */
function tbziw_admin_question_dropdown($selected_id)
{
    global $wpdb;

    $tbziw_questions = $wpdb->get_results($wpdb->prepare("SELECT tbziw_question_id,tbziw_question_html,tbziw_question_txt FROM " . $wpdb->prefix . "tbziw_questions" .
        " ORDER BY tbziw_question_section, tbziw_question_order, tbziw_question_id"));

    if (count($tbziw_questions) < 1) {
        ?>
    <tr>
        <td>Question: <input type="text" name="tbziw_question_id" value="0"/></td>
    </tr>
    <?php
    } else {
        $selected_set = 0;
        ?>
    <select name='tbziw_question_id'>
        <?php

        foreach ($tbziw_questions as $tbziw_question_row) {

            $tbziw_question_id = $tbziw_question_row->tbziw_question_id;
            $tbziw_question_txt = substr($tbziw_question_row->tbziw_question_txt, 0, 50);

            $is_selected = '';
            if ($tbziw_question_id == $selected_id) {
                $is_selected = 'selected="selected"';
                $selected_set = 1;
            }

            ?>
            <option value='<?php echo $tbziw_question_id; ?>' <?php echo $is_selected; ?>><?php echo $tbziw_question_txt; ?></option>
            <?php
        }
        if (1 != $selected_set) {
            ?>
            <option value="0" selected="selected">--</option>
            <?php
        } else {
            ?>
            <option value="0">--</option>
            <?php
        }


        ?>
    </select>
    <?php

    }
}

//#####################################################################//
/**
 * Remove escapes from HTML
 * @param $tbziw_html HTML raw input
 * @return string
 */
function tbziw_get_html($tbziw_html)
{
    return str_replace("\\", "", $tbziw_html);
}

//#####################################################################//
/**
 * Clean-up Text input or used sanitized HTML, 50 char limit
 * @param $tbziw_txt  TXT raw input
 * @param $tbziw_html HTML raw input
 * @return string
 */
function tbziw_get_txt_or_html($tbziw_txt, $tbziw_html)
{
    $return_val = str_replace("\\", "", $tbziw_txt);
    $return_val = substr(strip_tags($return_val), 0, 50);
    if (($return_val == null) || (strlen($return_val) < 1)) {
        $return_val = substr(strip_tags(tbziw_get_html($tbziw_html)), 0, 50);
    }
    return $return_val;
}



//#####################################################################//
/**
 * Check to see if table is present
 * @param $tbl_name name of table to check
 * @return 0 == exists, 1 == DNE, -1 == error
 */
function tbziw_check_table($tbl_name)
{
    global $wpdb;
    $return_val = -1;
    
    $check_tables = $wpdb->get_row($wpdb->prepare("SHOW TABLES like %s;", $tbl_name));
    if (count($check_tables) < 1) {
        echo '<tr><td><h1>Table missing</h1></td></tr>';
    }
    else {
    foreach ($check_tables as $check_table) { 
        
        #echo "Table: $check_table == $tbl_name\n"; 
        if( $check_table == $tbl_name ) {
            $return_val = 0;
        }
    }
}
    return $return_val;
}

?>