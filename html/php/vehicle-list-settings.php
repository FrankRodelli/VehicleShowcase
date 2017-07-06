<?php

if(isset($_POST['edit'])){
	echo $_POST[''];
}
	$username = $_SESSION['token'];
	// Create connection for populating vehicles into user page
	$conncars = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

	// Check connection
	if ($conncars->connect_error) {
    	die("Connection failed: " . $conncars->connect_error);
    }
	$sqlcars = "SELECT * FROM Cars WHERE UUID = '$username'";
	$resultcars = $conncars->query($sqlcars);
	$numberofcars = 0;
	if ($resultcars->num_rows > 0) {

	    // output data of each row
	    while($rowcars = $resultcars->fetch_assoc()) {
	    	$uuid = $rowcars ["HASH"];
	    	$photosql = "SELECT * FROM PhotoLink WHERE UNAME = '$uuid' LIMIT 1";
	    	$photoresult = $conncars->query($photosql);
	    	echo '<div id="vehicle-item">';
	    	while($photorow = $photoresult->fetch_assoc()){
	    		echo '<img src="../uploads/vehicles/'. $photorow["FNAME"] . '" height="100">';
	    	}
	        echo '<div id="title">' . $rowcars["DATE"] . " " . $rowcars["MAKE"] . " " . $rowcars["MODEL"] . '</div><div id="options">
	        <button onclick="loadDetails("'.$rowcars["HASH"].'")">Edit</button>

	        </div></div>';

	        $numberofcars++;
	    }

	} else {
	    echo '<br>You do not have any cars added yet! Add one <a href="../add.php">here!</a>';
	}

	$conncars->close();

?>