<?php 

//$xml = file_get_contents('http://www.weather.gov/xml/current_obs/KHOU.xml');
// Use cURL to get the RSS feed into a PHP string variable.
/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,
        'http://www.weather.gov/xml/current_obs/KHOU.xml');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$xml = curl_exec($ch);
curl_close($ch);*/ 

//..yeah, or not

// Include the handy XML data extraction functions.
include AZKBN_INCLUDE_URL.'xml_regex.php';//that is, if you need it 
// An RSS 2.0 feed must have a channel title, and it will
// come before the news items. So it's safe to grab the
// first title element and assume that it's the channel
// title.
//$weather = value_in('weather', $xml);
//$location = value_in('location', $xml);
// An RSS 2.0 feed must also have a link element that
// points to the site that the feed came from.
//$temp_f = value_in('temp_f', $xml);

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
	$avs = explode(":", $returned_message);
	echo "<ol>";
	foreach($avs as $av){		
		if(strlen($av) > 10){
			$av_details = explode("=>", $av);
			echo "<li>".$av_details[0].' <a href="javascript:void(0);" id="'.$av_details[1].'" class="eject">Eject</a></li>';
		}
	}
	echo "</ol>";
 
	/*function sendToHost($host,$method,$path,$data,$useragent=0)
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
	} */
?>