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
		<div class="mySlides fade">
	  <img src="http://www.feslerbuilt.com/Site/images/gallery/1969%20Camaro%20Draco/Img0003.jpg">
	  <div class="text">1969 Cheverolet Camaro</div>
	  </div>'
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
