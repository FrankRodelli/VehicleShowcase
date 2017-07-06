<head>
</head>
<body>

<form method="POST" name="search">
<input type="text" name="search_term" placeholder="search_term">
<input name="submit" type="submit" value="Submit" />
</form>


</body>

<?php
$i == 0;
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');
$conn2 = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		if ($conn2->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
if(isset($_POST['submit'])){
// get the search term which was posted. 
	$searchterm = $conn->real_escape_string($_POST['search_term']);
//if the someone searches something, check it via their first name. 
$sql = "SELECT * FROM `UserList` WHERE FIRSTNAME='$searchterm' OR LASTNAME='$searchterm'";
$sql2 = "SELECT * FROM `Cars` WHERE MAKE='$searchterm' OR MODEL='$searchterm'";
$result = $conn->query($sql);
$result2 = $conn2->query($sql2);
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


}else{
	echo "No results found";
}

}
		?>
