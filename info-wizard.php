<?php
/*
Plugin Name: Information Wizard
Plugin URI: URI: http://www.terabytz.com/information_wizard
Description: Displays questions and choices, which are logically tied to results or additional sections of questions and choices.
Version: 1.2.5
Author: Nigel Cruce
Author URI: http://www.terabytz.com
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
 * Base Plugin File
 * @file    info-wizard.php
 * @author  Nigel Cruce (nigelcruce@terabytz.com)
 *
 */

if ( ! defined('WP_PLUGIN_DIR')) {
    define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
}
if ( ! defined('WP_THEME_DIR')) {
    define( 'WP_THEME_DIR', WP_CONTENT_DIR . '/themes' );
}

require_once(WP_PLUGIN_DIR . "/info-wizard/info-wizard-settings.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/info-wizard-plugin.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/admin/tbziw_functions.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/admin/tbziw_base.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/templates/tbziw_admin_responses.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/admin/tbziw_responses.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/admin/tbziw_template.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/templates/tbziw_admin_questions.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/admin/tbziw_questions.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/templates/tbziw_admin_choices.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/admin/tbziw_choices.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/templates/tbziw_foot.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/templates/tbziw_head.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/templates/tbziw_form.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/install/tbziw_data.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/templates/tbziw_survey.php");
require_once(WP_PLUGIN_DIR . "/info-wizard/inc/templates/tbziw_report.php");

register_activation_hook( __FILE__, 'tbziw_install' );
register_deactivation_hook( __FILE__, 'tbziw_uninstall' );

//#####################################################################//
/**
 * Plugin Activation
 * @return void
 */
function tbziw_install() {
    global $wpdb;

    $table = $wpdb->prefix."tbziw_choices";
    $tbziw_choices = "CREATE TABLE $table (
        tbziw_choice_id         MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
        tbziw_question_id       MEDIUMINT(8) NOT NULL,
        tbziw_response_id       MEDIUMINT(8) NOT NULL DEFAULT '0',
        
        tbziw_choice_section_id TINYINT NOT NULL DEFAULT '0',
        tbziw_choice_order      TINYINT NOT NULL DEFAULT '1',

        -- If the choice corresponds to a response, else just information
        tbziw_choice_response_fg ENUM('NO','YES') NOT NULL DEFAULT 'YES',

        -- If the choice corresponds to a response, else just information
        tbziw_choice_section_fg ENUM('NO','YES') NOT NULL DEFAULT 'NO',

        tbziw_choice_txt      TEXT,
        tbziw_choice_html     TEXT,

        KEY tbziw_question_id (tbziw_question_id,tbziw_response_id),
        PRIMARY KEY (tbziw_choice_id)
    );";
    $wpdb->query($tbziw_choices);

    $table = $wpdb->prefix."tbziw_questions";
    $tbziw_questions = "CREATE TABLE $table (
        tbziw_question_id       MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
        tbziw_question_section  TINYINT NOT NULL DEFAULT '1',
        tbziw_question_order    TINYINT NOT NULL DEFAULT '1',

        tbziw_question_fg       ENUM('ENABLED','DISABLED') NOT NULL DEFAULT 'ENABLED',

        tbziw_question_txt      TEXT,
        tbziw_question_html     TEXT,

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
    

    $table = $wpdb->prefix."tbziw_settings";
    $tbziw_responses = "CREATE TABLE $table (
        tbziw_setting_id     MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
        tbziw_setting_nm     VARCHAR(50)  NOT NULL,
        tbziw_setting_nval   MEDIUMINT(8) NOT NULL DEFAULT '0',
        tbziw_setting_tval   TINYINT      NOT NULL DEFAULT '0',
        
        tbziw_setting_sval   VARCHAR(255) NOT NULL DEFAULT '',
        tbziw_setting_bval   TEXT,

        PRIMARY KEY (tbziw_setting_id),
        UNIQUE KEY (tbziw_setting_nm)
    );";
    $wpdb->query($tbziw_settings);

}

//#####################################################################//
/**
 * Plugin Deactivation/Uninstall
 * @return void
 */
function tbziw_uninstall() {
    global $wpdb;

    $DATAFILE_FLAG = tbziw_check_datafile_flag();
    if( ! file_exists ( $DATAFILE_FLAG ) ) {
        $table = $wpdb->prefix."tbziw_choices";
        $wpdb->query("DROP TABLE IF EXISTS $table;");

        $table = $wpdb->prefix."tbziw_questions";
        $wpdb->query("DROP TABLE IF EXISTS $table;");

        $table = $wpdb->prefix."tbziw_responses";
        $wpdb->query("DROP TABLE IF EXISTS $table;");
    }

}

// New Wizard Object
$oTBZ_Info_Wizard_Plugin = new TBZ_Info_Wizard_Plugin;
add_action( 'tbziwtemplate', 'tbziw_tbziwtemplate' );


//#####################################################################//
/**
 * Display Info Wizard
 * @param
 * @return void
 */
function tbziw_executetemplate($page_id) {
    //##################################
    // BEG: HTML
    //##################################
    global $oTBZ_Info_Wizard_Plugin;

    $oTBZ_Info_Wizard_Plugin->tbziw_getcontent($page_id);

    //##################################
    // END: HTML
    //##################################
}

?>