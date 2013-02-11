<?php

if( !class_exists('Azkabanner') ) {

	class Azkabanner {

		function __construct(){
			add_action('init', array(&$this,'parse_standalone_request'));
			add_action('wp_print_scripts', array(&$this,'add_scripts_frontend'),1000);    // load javascripts on front-end
			add_action('wp_print_styles', array(&$this,'add_styles_frontend'),1000);      // load CSS styles on front-end

		}

		/**
		 * load CSS in the front end
		 */
		function add_styles_frontend() {
			if (!is_admin()) {
				wp_enqueue_style( 'azkabanner-front', AZKBN_CSS_URL.'/css_azkabanner_front.css' );
				wp_enqueue_style( 'jquery_ui', AZKBN_CSS_URL.'/jquery-ui.css' );

			}
		}

		/**
		 * load JS in the front end
		 */
		public function add_scripts_frontend() {
			if (!is_admin()) {
				
				wp_enqueue_script( 'azkabanner-front', AZKBN_JS_URL . '/js_azkabanner_front.js', array( 'jquery' ) );
				wp_enqueue_script( 'jquery_ui', AZKBN_JS_URL . '/jquery-ui.js', array( 'jquery' ) );
				// embed the javascript file that makes the AJAX request
				//wp_enqueue_script( 'my-ajax-request', plugin_dir_url( __FILE__ ) . 'js/ajax.js', array( 'jquery' ) );

				// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
				wp_localize_script( 'azkabanner-front', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
			}
		}

		
		

		/**
		 * parse $_GET or $_POST requests
		 */
		function parse_standalone_request() {

			// if ajax is processing, don't do anything
			if( defined(DOING_AJAX) ){
				return;
			}

			// sample parameters
			$plugin     = $this->get_param('plugin');
			$action     = $this->get_param('action');
			$util_action     = $this->get_param('util_action');

		}


        // utility function to grab the $_GET or $_POST parameter
        function get_param($param, $default='') {
            return (isset($_POST[$param])?$_POST[$param]:(isset($_GET[$param])?$_GET[$param]:$default));
        }

        // initial activation functions
		function plugin_activate() {
			global $wpdb;
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

			// create the surveys table
			$table_name = $wpdb->prefix . 'azkbn_donuts';
			
			if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
				$sql = "CREATE TABLE " . $table_name . " (
				  `donut_id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
				  `donut_url` VARCHAR(200) NOT NULL ,
				  `donut_uuid` VARCHAR(200) NOT NULL ,				
				  `user_uuid` VARCHAR(200) NOT NULL ,
				  `region_name` VARCHAR(200) NOT NULL ,				    
				  PRIMARY KEY (`donut_id`) , 	
				  UNIQUE INDEX `idx_donut_uuid` (`donut_uuid` ASC) );";			
				dbDelta($sql);
			}
		}

	}

}

require_once(AZKBN_INCLUDE_URL."/azkbn_functions.php");
add_action('wp_ajax_dementor', 'dementor_callback');
add_action('wp_ajax_nopriv_dementor', 'dementor_callback');

function dementor_callback() {
    // get the submitted parameters
    $args = $_POST['postID'];   
    $args = explode(":", $args);
    if(count($args) != 3 ){
    	die("nope!");
    	exit;
    }
    $action = trim($args[0]);
    $key = trim($args[1]);
    $donut_uuid = trim($args[2]);

    //get donut url
    global $wpdb;
    $table_name = $wpdb->prefix . 'azkbn_donuts';
    $query = "
    SELECT donut_url 
    FROM ".$table_name."
    WHERE 
    user_uuid = '".$key."'    
    AND donut_uuid = '".$donut_uuid."'
    AND 1=1
    LIMIT 1";

    $donuts = $wpdb->get_col($query, 0);    

    $vars = "?action=".$action."&uuid=".$key;    

    $url = $donuts[0];
    $returned_message = disapparate($url."/".$vars);
    // generate the response
    $response = json_encode( array( 'reply' => $returned_message ) );

 
    // response output
    header( "Content-Type: application/json" );
    echo $response;
 
    // IMPORTANT: don't forget to "exit"
    exit;
}