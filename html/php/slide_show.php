<?php

// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Cars LIMIT 5";
$result = $conn->query($sql);

while($row= $result->fetch_assoc()){
	echo $row['MAKE'];
}

?>