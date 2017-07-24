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


	if(isset($_POST['submit']) || isset($_POST['a'])){

		//Ensure that if the submit button is pressed, the url is ignored
		if(isset($_POST['submit'])){
			$searchterm = $connUsers->real_escape_string($_POST['search_term']);
		}else{
			if($_POST['a'] != ''){
				$searchterm = $connUsers->real_escape_string($_POST['a']);
			}
		}

		$resultArray = array();

		//query users
		$sql = "SELECT * FROM `UserList` WHERE FIRSTNAME LIKE '%$searchterm%' OR  LASTNAME LIKE '%$searchterm%' OR USERNAME LIKE '%$searchterm%'";
		$result = $connUsers->query($sql);
		if($result->num_rows > 0){
			//Stores each row in array
			while($resultArray[] = $result->fetch_assoc());
			array_pop($resultArray);
		}

		//query events
		$sql = "SELECT * FROM `Events` WHERE title LIKE '%$searchterm%' OR description LIKE '%$searchterm%'";
		$result = $connUsers->query($sql);
		if($result->num_rows > 0){
			//Stores each row in array
			while($resultArray[] = $result->fetch_assoc());
			array_pop($resultArray);
		}

		//query vehicles
		$sql = "SELECT * FROM `Cars` WHERE MAKE LIKE '%$searchterm%' OR MODEL LIKE '%$searchterm%'";
		$result = $connVehicles->query($sql);
		if($result->num_rows > 0){
			//Stores each row in array
			while($resultArray[] = $result->fetch_assoc());
			array_pop($resultArray);
		}

		$resultCounter = sizeof($resultArray);

		//If there are results
		if($resultCounter > 0){

			//Loops through array and displays results formatted by type
			for($i = 0; $i < sizeof($resultArray);$i++){
				if($resultArray[$i]['USERNAME'] != ''){
					echo ($i+1).'. <a href="../user.php?u='.$resultArray[$i]['UUID'].'">'.$resultArray[$i]['FIRSTNAME'].' '.$resultArray[$i]['LASTNAME'].'</a><br>';
				}
				if($resultArray[$i]['MAKE'] != ''){
					echo ($i+1).'. <a href="../vehicle.php?c='.$resultArray[$i]['HASH'].'">'.$resultArray[$i]['DATE'].' '.$resultArray[$i]['MAKE'].' '.$resultArray[$i]['MODEL'].'</a><br>';
				}
				if($resultArray[$i]['title'] != ''){
					echo ($i+1).'. <a href="../event.php?e='.$resultArray[$i]['id'].'">'.$resultArray[$i]['title'].'</a><br>';
				}
			}
		}

	}else{
		echo "No results found";
	}
?>
