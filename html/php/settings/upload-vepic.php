<?php
include("../auth.php");

echo 'start here';

foreach($_FILES['files'] as $key=>$value){
	echo $key;
	echo $value;
}

echo 'end here';
	
?>