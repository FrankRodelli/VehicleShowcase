<?php
$user = $_SESSION['token'];
$uuid = $_GET['c'];

// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Selects vehicle based on UUID in URL 
$sql = "SELECT * FROM Cars WHERE HASH = '$uuid' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    	echo "<br>" . $row["DATE"] . " " . $row["MAKE"] . " " . $row["MODEL"];

    	//Obtains main picture for header
    	echo '<br>'; echo '<img src="../uploads/vehicles/'. $row["PHOTO"] . '" width = "200" >';

    	echo '<div class ="row" id="specs">
		<img class="expand" id="specs-img" src="../images/plus.png">
		<h2>Specifications</h2>

		<div id="spec-data" class="data" style="display: block;">

		<div id="engine" class="side-data">
		<h2>Engine</h2>
		' . $row["DISPLACEMENT"] . ' ' . $row["CYLINDERS"] . ' Cylinder<br>' . $row["HP"] 
		. ' Horsepower<br>' . $row["TORQUE"] . ' lb/ft Torque<br>' . $row["FUELTYPE"] . '
		</div>

		<div id="transmission" class="side-data">
		<h2>Transmission</h2>
		' . $row["TRANS"] . '
		</div>

		<div id="performance" class="side-data">
		<h2>Performance</h2>
		0-60: ' . $row["060"] .'
		<br>0-100: ' . $row["0100"] .'
		<br>1/4 Mile: ' . $row["14MILE"] .'
		<br>Top Speed: ' . $row["TOPSPEED"] .'
		<br>Fuel Economy: ' . $row["MPG"] .'
		</div>

		<div id="mods" class="side-data">
		<h2>Modifications</h2>
		' . $row["MODS"] . '
		</div>
		</div>

		</div>

		<div class="row" id="photos">
		<img class="expand" id="photos-img" src="../images/plus.png"">
		<h2>Photos</h2>

		<div id="photo-data" class="data" style="display: none;">';

		$photosql = "SELECT * FROM PhotoLink WHERE UNAME = '$uuid'";
    	$photoresult = $conn->query($photosql);
		while($photorow = $photoresult->fetch_assoc()){
			echo '<img class="photos-inrow" src="../uploads/vehicles/'. $photorow["FNAME"] . '">';
		}
		echo '
		</div>
		</div>

		<div class="row" id="videos">
		<img class="expand" id="videos-img" src="../images/plus.png">
		<h2>Videos</h2>

		<div id="video-data" class="data" style="display: none;">
		This user has not added any videos yet!
		</div>

		</div>

		<div class="row" id="writeup">
		<img class="expand" id="writeup-img"src="../images/plus.png">
		<h2>Writeup</h2>

		<div id="writeup-data" class="data" style="display: none;">
		'. $row["WRITEUP"].'
		</div>
		</div>';
} else {
    echo "Vehicle does not exist";
}
$conn->close();
?>