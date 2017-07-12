<?php

	$photonumber = 0;
	foreach($_FILES['attachments']['name'] as $key=>$val){
		$photonumber++;
		echo $photonumber;
		echo 'anything';
	}
	
?>