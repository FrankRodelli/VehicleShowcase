<?php

// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Cars LIMIT 5";
$result = $conn->query($sql);

echo '<h2>Featured Vehicles</h2><div class="slideshow-container">';

//Creates first slideshow
while($row= $result->fetch_assoc()){
	echo '
		<div class="mySlides fade"><a href="../../vehicle.php?c='.$row['HASH'].'">';
		if($row['PHOTO'] == '' ){
			echo '<img src="../../images/DEFAULT-CAR.png">';
		}else{
			echo '<img src="../../uploads/vehicles/'.$row['PHOTO'].'">';
		}

		echo '
		</a>
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

$sql = "SELECT * FROM Cars ORDER BY CREATED LIMIT 5";
$result = $conn->query($sql);

//Creates Second Slideshow
echo '<h2>Recently Added Vehicles</h2><div class="slideshow-container">';
while($row= $result->fetch_assoc()){
	echo '
		<div class="mySlides2 fade"><a href="../../vehicle.php?c='.$row['HASH'].'">';
		if($row['PHOTO'] == '' ){
			echo '<img src="../../images/DEFAULT-CAR.png">';
		}else{
			echo '<img src="../../uploads/vehicles/'.$row['PHOTO'].'">';
		}

		echo '
		</a>
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
