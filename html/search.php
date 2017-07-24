<head>
</head>
<body>

<form method="POST" name="search">
<input type="text" name="search_term" placeholder="search_term">
<input name="submit" type="submit" value="Submit" />
</form>


</body>

<?php
	$connUsers = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

	// Check connection
	if ($connUsers->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	// Check connection
	$connVehicles = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');
	if ($connVehicles->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}


	if(isset($_POST['submit'])){
		$searchterm = $connUsers->real_escape_string($_POST['search_term']);
		$resultArray = array();

		//First query
		$sql = "SELECT * FROM `UserList` WHERE FIRSTNAME LIKE '%$searchterm%' OR  LASTNAME LIKE '%$searchterm%' OR USERNAME LIKE '%$searchterm%'";
		$result = $connUsers->query($sql);
		if($result->num_rows > 0){
			//Stores each row in array
			while($resultArray[] = $result->fetch_assoc());
		}

		//Second query
		$sql = "SELECT * FROM `Events` WHERE title LIKE '%$searchterm%' OR description LIKE '%$searchterm%'";
		$result = $connUsers->query($sql);
		if($result->num_rows > 0){
			//Stores each row in array
			while($resultArray[] = $result->fetch_assoc());
		}

		//Third query
		$sql = "SELECT * FROM `Cars` WHERE MAKE LIKE '%$searchterm%' OR MODEL LIKE '%$searchterm%'";
		$result = $connVehiclesr->query($sql);
		if($result->num_rows > 0){
			//Stores each row in array
			while($resultArray[] = $result->fetch_assoc());
		}

		$resultCounter = sizeof($resultArray);

		//If there are results
		if($resultCounter > 0){
			//Loops through array and displays results
			for($i = 0; $i < sizeof($resultArray);$i++){
				echo $resultArray[$i];
				echo $resultCounter;
			}
		}

	}else{
		echo "No results found";
	}
?>
