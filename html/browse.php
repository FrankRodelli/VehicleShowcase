<?php

// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

// Check connection
if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	//Check if credentials match database and login accordingly
$sql = "SELECT * FROM UserList ";

//set querry data to result variable
$result = $conn->query($sql);

$emptyArray = array();

//If there are results, run
if($result->num_rows == 1){
	//Assigns row data to $row array
	while($row = $result->fetch_assoc($result)){
		$emptyArray[] = $row;
	}

	echo json_encode($emptyArray);

}
echo 'anything';
echo mysqli_errno($sql);

?>
