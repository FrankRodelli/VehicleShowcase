<head>
</head>
<body>

<form method="POST" name="search">
<input type="text" name="search_term" placeholder="search_term">
<input name="submit" type="submit" value="Submit" />
</form>


</body>

<?php
	$resultCounter = 0;
	$resultArray = array();
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
		$sql = "SELECT * FROM `UserList` WHERE FIRSTNAME LIKE '%$searchterm%' OR  LASTNAME LIKE '%$searchterm%' OR USERNAME LIKE '%$searchterm%'";
		$result = $connUsers->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$resultArray[$resultCounter] = $row;
				$resultCounter++;
			}
			for($i = 0; $i > sizeof($resultArray);$i++){
				echo $resultArray[i];
			}
		}

	}else{
		echo "No results found";
	}
/*
// get the search term which was posted.
	$searchterm = $conn->real_escape_string($_POST['search_term']);
//if the someone searches something, check it via their first name.
$sql = "SELECT * FROM `UserList` WHERE FIRSTNAME LIKE '%$searchterm%' OR  LASTNAME LIKE '%$searchterm%' OR USERNAME LIKE '%$searchterm%'";
$event = "SELECT * FROM `Events` WHERE title LIKE '%$searchterm%' OR description LIKE '%$searchterm%'";
$sql2 = "SELECT * FROM `Cars` WHERE MAKE LIKE '%$searchterm%' OR MODEL LIKE '%$searchterm%'";
$result = $conn->query($sql);
$result2 = $conn2->query($sql2);
$result3 = $conn->query($event);
if($result->num_rows == 1){

$row = $result->fetch_assoc();
echo 'Result 1 of 1';
//link the users user page, so they can see any cars with this person
echo '<a href="../user.php/?u='. $row["UUID"] .'"> ';
echo $row["FIRSTNAME"];
echo "  ";
echo $row["LASTNAME"];
//echo first and last names
echo '</a>';
echo "<br>";
}elseif($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$i++;
		//if there's more than one name, while loop it
    		echo 'Result ' . $i . ' of ' . $result->num_rows . ' ';
    		echo '<a href="../user.php/?u='. $row["UUID"] .'"> ';
    		echo $row["FIRSTNAME"];
echo "  ";
echo $row["LASTNAME"];
// echo names, and link it.
echo '</a>';
echo "<br>";
    	}
}elseif($result2->num_rows == 1){
	$row = $result2->fetch_assoc();
echo 'Result 1 of 1';
//link the car page, so they can see said car
echo '<a href="../vehicle.php/?c='. $row["HASH"] .'"> ';
echo $row["MAKE"];
echo "  ";
echo $row["MODEL"];
//echo car make and model
echo '</a>';
echo "<br>";


}elseif($result2->num_rows > 0){

while($row = $result2->fetch_assoc()) {
		$i++;
		//if there's more than one car, while loop it
    		echo 'Result ' . $i . ' of ' . $result2->num_rows . ' ';
    		echo '<a href="../vehicle.php/?c='. $row["HASH"] .'"> ';
    		echo $row["MAKE"];
echo "  ";
echo $row["MODEL"];
// echo car make and model
echo '</a>';
echo "<br>";
    	}


}elseif($result3->num_rows == 1){
	$row = $result3->fetch_assoc();
echo 'Result 1 of 1';
//link the car page, so they can see said car
echo '<a href="../event.php/?e='. $row["id"] .'"> ';
echo $row["description"];
echo "  ";
echo $row["location"];
//echo car make and model
echo '</a>';
echo "<br>";


}elseif($result3->num_rows > 0){

while($row = $result3->fetch_assoc()) {
		$i++;
		//if there's more than one car, while loop it
    		echo 'Result ' . $i . ' of ' . $result3->num_rows . ' ';
    		echo '<a href="../event.php/?e='. $row["id"] .'"> ';
    		echo $row["description"];
echo "  ";
echo $row["location"];
// echo car make and model
echo '</a>';
echo "<br>";
    	}

*/
		?>
