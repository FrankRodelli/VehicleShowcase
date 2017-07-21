<?php

// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Cars LIMIT 5";
$result = $conn->query($sql);

echo '<div class="slideshow-container">';

//Need to implement getting photo by using PHOTO in Cars table when default photo feature is added
//This will not be used until that is implemented in the settings/addcar
while($row= $result->fetch_assoc()){
	//This is where the slideshow will be built when above mentioned is complete
	echo '
		<div class="mySlides fade">';
		if($row['PHOTO'] == '' ){
			echo '<img src="../../images/DEFAULT-CAR.png">';
		}else{
			echo '<img src="../../uploads/vehicles/'.$row['PHOTO'].'">';
		}

		echo '
	  <div class="text">'.$row['DATE'].' '.$row['MAKE'].' '.$row['MODEL'].'</div>
	  </div>';
}


echo '
</div>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
	<span class="dot" onclick="currentSlide(4)"></span>
	<span class="dot" onclick="currentSlide(5)"></span>
</div>';

?>
