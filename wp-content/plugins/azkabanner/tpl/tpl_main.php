<?php 

	require_once(AZKBN_INCLUDE_URL."/azkbn_functions.php");
	echo '<div id="sims">';
	foreach(get_donuts() as $key => $donut){
		$returned_message = disapparate($donut->donut_url);
	
		$avs = explode(":", $returned_message);				
		echo '<h3>'.$donut->region_name.'</h3><div><ol>';
		if(strpos($avs[0], 'cap not found') === false){
			foreach($avs as $av){		
				if(strlen($av) > 10){
					$av_details = explode("=>", $av);
					echo '<li>'.$av_details[0].' <a href="javascript:void(0);" id="'.$av_details[1].'" class="eject">Eject</a></li>';
				}
			}
		}
		else{
			echo "Could not find donut! Make sure a donut has been rezzed in this region.";
		}
		echo '</ol></div>';
	}
	echo '</div>';
 
?>