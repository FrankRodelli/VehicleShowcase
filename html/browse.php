<?php
// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

// Check connection
if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else{
	}

	$sql = "SELECT * FROM event";
	$result = $conn->query($sql);

$emptyArray = array();
//If there are results, run
if($result->num_rows > 0){
	//Assigns row data to $row array
	while($row = $result->fetch_assoc()) {
		$emptyArray[] = $row;
	}
	$json = json_encode($emptyArray);

  return $json;
}
?>
