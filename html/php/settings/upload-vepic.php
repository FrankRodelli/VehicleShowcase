<?php
include("../auth.php");

$data = $_POST['attachments'];
echo $data;
	$photonumber = 0;
	foreach($_FILES['attachments']['name'] as $key=>$val){
		$photonumber++;
		echo $photonumber;
		echo 'anything';
	}
	
?>