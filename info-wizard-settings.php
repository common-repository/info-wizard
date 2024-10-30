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
 * Info Wizard config functions
 * @file    info-wizard-settings.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

//#####################################################################//
/**
 * Get debug template
 * @return string
 */
function tbziw_get_template() {
    $theme = wp_get_theme();
    $filename = WP_THEME_DIR .'/'. $theme->Template . '/tbziw_template.php';
    return $filename;
}

//#####################################################################//
/**
 * Get default template
 * @return string
 */
function tbziw_get_infowizard_template() {
    $theme = wp_get_theme();
    $filename = WP_THEME_DIR .'/'. $theme->Template . '/tbziw_template.php';
    return $filename;
}

//#####################################################################//
/**
 * touch Info Wizard template
 * @return string
 */
function tbziw_touch_infowizard_template() {
    $theme = wp_get_theme();
    $filename = tbziw_get_infowizard_template();
    tbziw_append_file($filename,'');
    return $filename;
}

//#####################################################################//
/**
 * reset Info Wizard template
 * @return string
 */
function tbziw_reset_infowizard_template() {
    $theme = wp_get_theme();
    $filename = tbziw_touch_infowizard_template();
    tbziw_write_file($filename,'&lt;?php
/**
 * Template Name: Info_Wizard
 */
 ?&gt;
');
    return $filename;
}

//#####################################################################//
/**
 * reset Info Wizard template
 * @return string
 */
function tbziw_set_infowizard_template() {
    $theme = wp_get_theme();
    $filename = tbziw_touch_infowizard_template();
    tbziw_append_file($filename,'');
    return $filename;
}

//#####################################################################//
/**
 * get Info Wizard generic template
 * @return string
 */
function tbziw_check_template_file_default() {
    $filename = WP_PLUGIN_DIR . "/info-wizard/inc/templates/tbziw_theme_generic.php";
    return $filename;
}
//#####################################################################//
/**
 * get theme template
 * @return string
 */
function tbziw_check_template_file_theme() {
    $theme = wp_get_theme();
    $filename = WP_THEME_DIR .'/'. $theme->Template . '/page-templates/full-width.php';
    return $filename;
}

//#####################################################################//
/**
 * Check for proprietary datafile sentinel
 * @return string
 */
function tbziw_check_datafile_flag() {
    $DATAFILE_FLAG = WP_PLUGIN_DIR . "/info-wizard/inc/install/tbziw_load_data.sent";
    return $DATAFILE_FLAG;
}

//#####################################################################//
/**
 * Check for proprietary datafile, and load if no sentinel file
 * @return string
 */
function tbziw_check_datafile() {
    $DATAFILE = WP_PLUGIN_DIR . "/info-wizard/inc/install/tbziw_load_data.php";
    $DATAFILE_FLAG = tbziw_check_datafile_flag();
    if( ! file_exists ( $DATAFILE_FLAG ) ) {
        if( file_exists ( $DATAFILE ) ) {
            require_once($DATAFILE);
        }
    }
    return $DATAFILE;
}

//#####################################################################//
/**
 * Set for proprietary datafile sentinel
 * @return void
 */
function tbziw_set_datafile_flag() {
    $DATAFILE_FLAG = tbziw_check_datafile_flag();
    tbziw_append_file($DATAFILE_FLAG,'');

}

//#####################################################################//
/**
 * Execute statements in proprietary datafile, set sentinel file
 * @return void
 */
function tbziw_load_datafile() {
    global $wpdb;
    $DATAFILE_FLAG = tbziw_check_datafile_flag();
    if( ! file_exists ( $DATAFILE_FLAG ) ) {
       tbziw_RELOAD();
        $table = $wpdb->prefix."tbziw_responses";
        $tbziw_responses = tbziw_get_sql_tbziw_responses_LOAD($table);
        $wpdb->query($tbziw_responses);

        $table = $wpdb->prefix."tbziw_questions";
        $tbziw_questions = tbziw_get_sql_tbziw_questions_LOAD($table);
        $wpdb->query($tbziw_questions);

        $table = $wpdb->prefix."tbziw_choices";
        $tbziw_choices = tbziw_get_sql_tbziw_choices_LOAD($table);
        $wpdb->query($tbziw_choices);
        tbziw_set_datafile_flag();
    }
}


//#####################################################################//
/**
 * Check for system debug sentinel
 * @return string
 */
function tbziw_check_debug_flag() {
    $DEBUG_FLAG = WP_PLUGIN_DIR . "/info-wizard/inc/install/DEBUG.sent";
    return $DEBUG_FLAG;
}

//#####################################################################//
/**
 * Check for system debug sentinel
 * @return 0 == DEBUG
 */
function tbziw_check_debug_disabled() {
    global $wpdb;
    $return_val = -1;
    $DEBUG_FLAG = tbziw_check_debug_flag();
    if( file_exists ( $DEBUG_FLAG ) ) {
        $return_val = 0;
    }
    return $return_val;
}


?>
