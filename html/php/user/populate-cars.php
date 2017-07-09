<?php
include("auth.php");
$username = $_GET["u"];
$loggedinuser = $_SESSION["token"];
	// Create connection for populating vehicles into user page
	$conncars = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

	// Check connection
	if ($conncars->connect_error) {
    	die("Connection failed: " . $conncars->connect_error);
    }
	$sqlcars = "SELECT * FROM Cars WHERE UUID = '$username'";
	$resultcars = $conncars->query($sqlcars);

	if ($resultcars->num_rows > 0) {

	    // output data of each row
	    while($rowcars = $resultcars->fetch_assoc()) {
	    	$uuid = $rowcars ["HASH"];
	    	echo '<div id="vehicle-item">';
	    		echo '<img src="../uploads/vehicles/'. $rowcars["PHOTO"] . '">';
	        echo '<div id="title"><a href="https://showmeyouraxels.me/vehicle.php/?c=' . $rowcars["HASH"] . '">' . $rowcars["DATE"] . " " . $rowcars["MAKE"] . " " . $rowcars["MODEL"] . '</a></div></div>';
	    }

	} else {
	    echo '<br>You do not have any cars added yet! Add one <a href="../add.php">here!</a>';
	}
	$conncars->close();

if($_POST && isset($_POST['follow'])){
    $sql = "INSERT INTO `IsFollowing` (`USER`, `FOLLOWING`) VALUES ('$loggedinuser','$username')";
    $result = $conn->query($sql);
}
$conn->close();
?>