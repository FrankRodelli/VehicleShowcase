<?php
// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

// Check connection
if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
		echo 'connected successfuly';
	}

$sql = "SELECT * UserList WHERE USERNAME = 'frank'";

if($conn->query($sql) === true){
	echo 'it worked';
}else{
	echo 'not working';
}
echo 'we here doe';
?>
