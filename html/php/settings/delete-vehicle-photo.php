<?php

$carHash = $_POST['carHash'];
$photoName = $_POST['photoName'];
echo $carHash.$photoName;

$dir = '../../uploads/vehicles/'.$photoName;

echo $dir;

unlink($dir);

?>