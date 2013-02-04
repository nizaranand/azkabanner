<?php 
/*
Plugin Name: Azkabanner
Plugin URI:
Description: A plugin for banning the shit out of people in SL
Version: 1.0
Author: V & D
Author URI: 
*/

// define some constants
define('AZKBN_URL', plugin_dir_url(__FILE__));
define('AZKBN_DIR', plugin_dir_path(__FILE__));
define('AZKBN_CSS_URL', AZKBN_URL . '/css');
define ('AZKBN_JS_URL', AZKBN_URL . '/js');
define ('AZKBN_INCLUDE_URL', AZKBN_URL . '/include');
define('AZKBN_TPL_DIR',AZKBN_DIR . 'tpl' );


/**
 * call supporter files
 */
require_once dirname( __FILE__ ) . '/class_azkabanner.php';


/**
 * instantiate the set up class
 */
$wp_user_survey = new Azkabanner();


/**
 * activate the plugin
 */
//register_activation_hook( __FILE__, array(&$wp_user_survey, 'plugin_activate') );
