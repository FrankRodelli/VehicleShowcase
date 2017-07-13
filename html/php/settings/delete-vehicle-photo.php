<?php

//Gets variables for carHash and photoName posted from ajax post request
$carHash = $_POST['carHash'];
$photoName = $_POST['photoName'];

//Sets directory for photo
$dir = '../../uploads/vehicles/'.$photoName;

//Deletes file from server
unlink($dir);

//Removes file from photolink database
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "DELETE * FROM PhotoLink WHERE UNAME = '$carHash' AND FNAME = '$photoName'";

if($conn->query($sql) === TRUE){
	echo 'Photo deleted';
}else{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

?>