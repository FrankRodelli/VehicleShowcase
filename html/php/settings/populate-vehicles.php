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
	        <a href="#" onclick="carStuff('; 
	        echo "'".$rowcars['HASH']."'"; 
	        echo')">Edit</a>

	        </div></div>';

	        $numberofcars++;
	    }

	} else {
	    echo '<br>You do not have any cars added yet! Add one <a href="../add.php">here!</a>';
	}

	$conncars->close();

if(isset($_POST['update-car-settings'])){
	$carHash = $_POST['carHash'];
	$make = $_POST['field1'];
	$model = $_POST['field2'];
	$year = $_POST['field3'];
	$horsepower = $_POST['field4'];
	$torque = $_POST['field5'];
	$cylinders = $_POST['field6'];
	$fueltype = $_POST['field7'];
	$mods = $_POST['field8'];
	$transmission = $_POST['field9'];
	$zerosixty = $_POST['field10'];
	$zerohundred = $_POST['field11'];
	$quartermile = $_POST['field12'];
	$topspeed = $_POST['field13'];
	$mpg = $_POST['field14'];
	$writeup = $_POST['field15'];
	$displacement = $_POST['field16'];
	// Create connection
	$conntwo = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

	// Check connection
	if ($conntwo->connect_error) {
	    die("Connection failed: " . $conntwo->connect_error);
	} 

	$sql2 = "UPDATE Cars SET MAKE='$make',MODEL='$model',DATE='$year',DISPLACEMENT='$displacement',
	HP='$horsepower',TORQUE='$torque',CYLINDERS='$cylinders',FUELTYPE='$fueltype',MODS='$mods',
	TRANS='$transmission',`060`='$zerosixty',`0100`='$zerohundred',14MILE='$quartermile',TOPSPEED='$topspeed',MPG='$mpg',WRITEUP='$writeup' WHERE HASH = '$carHash'";
	$result2 = $conntwo->query($sql2);

	if ($conntwo->query($sql2) === TRUE) {
	} else {
    echo "Error: " . $sql2 . "<br>" . $conntwo->error;
}

	$conntwo->close();
}

?>