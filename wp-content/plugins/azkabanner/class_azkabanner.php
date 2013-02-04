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

			}
		}

		/**
		 * load JS in the front end
		 */
		public function add_scripts_frontend() {
			if (!is_admin()) {
				
				wp_enqueue_script( 'azkabanner-front', AZKBN_JS_URL . '/js_azkabanner_front.js', array( 'jquery' ) );
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


	}

}


add_action('wp_ajax_dementor', 'dementor_callback');
add_action('wp_ajax_nopriv_my-action', 'dementor_callback');
function dementor_callback() {
	// get the submitted parameters
	$postID = $_POST['postID'];
 	$channel = "f0f73fef-4f97-6b03-b87f-fbb7920583ed"; //Fill in the channel you are using (key)
	$intvalue = "66"; //Fill in the intvalue you are using (integer)
	//$strvalue = "The weather condition at ".$location." is currently ".$weather." with a temperature of ".$temp_f." degrees farenheit."."@".$weather."@".$temp_f; //Fill in the strvalue you are using (string)
	$strvalue = "something not about dogs";
	$xmldata = "<?xml version=\"1.0\"?><methodCall><methodName>llRemoteData</methodName>
<params><param><value><struct>
<member><name>Channel</name><value><string>".$channel."</string></value></member>
<member><name>IntValue</name><value><int>".$intvalue."</int></value></member>
<member><name>StringValue</name><value><string>".$strvalue."</string></value></member>
</struct></value></param></params></methodCall>";
	$xml = sendToHost("xmlrpc.secondlife.com", "POST", "/cgi-bin/xmlrpc.cgi", $xmldata);
	$xml = explode("Content-Type: text/xml", $xml);

	$xml_obj = simplexml_load_string(trim($xml[1]));
	$returned_message = $xml_obj->params->param->value->struct->member[1]->value->string;
	
	// generate the response
	$response = json_encode( array( 'reply' => $returned_message ) );

 
	// response output
	header( "Content-Type: application/json" );
	echo $response;
 
	// IMPORTANT: don't forget to "exit"
	exit;
}

function sendToHost($host,$method,$path,$data,$useragent=0)
	{ 
		$buf="";
		// Supply a default method of GET if the one passed was empty 
		if (empty($method)) 
			$method = 'GET'; 
		$method = strtoupper($method); 
 
		$fp = fsockopen($host, 80, $errno, $errstr, 30);
 
		if( !$fp )
		{
			$buf = "$errstr ($errno)<br />\n";
		}else
		{
			if ($method == 'GET') 
			$path .= '?' . $data; 
			fputs($fp, "$method $path HTTP/1.1\r\n"); 
			fputs($fp, "Host: $host\r\n"); 
			fputs($fp, "Content-type: text/xml\r\n"); 
			fputs($fp, "Content-length: " . strlen($data) . "\r\n"); 
			if ($useragent) 
				fputs($fp, "User-Agent: MSIE\r\n"); 
			fputs($fp, "Connection: close\r\n\r\n"); 
			if ($method == 'POST') 
				fputs($fp, $data); 
			while (!feof($fp)) 
				$buf .= fgets($fp,128); 
			fclose($fp); 
		}
		return $buf; 
	}