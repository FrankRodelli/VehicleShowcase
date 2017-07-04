<?php

// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Cars LIMIT 5";
$result = $conn->query($sql);

//Need to implement getting photo by using PHOTO in Cars table when default photo feature is added
//This will not be used until that is implemented in the settings/addcar
while($row= $result->fetch_assoc()){
	//This is where the slideshow will be built when above mentioned is complete
}

echo '

<div class="slideshow-container">
  <div class="mySlides fade">
    <div class="numbertext">1 / 3</div>
    <img src="uploads/vehicles/5959c54d54728.png">
    <div class="text">2017 Cheverolet Cruze</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img src="http://s.hswstatic.com/gif/1982-1983-1984-1985-1986-ford-mustang-27.jpg">
    <div class="text">1985 Ford Mustang</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img src="http://st.motortrend.com/uploads/sites/5/2017/04/2017-Honda-Civic-Si-Sedan-front-three-quarter-01-1-e1491492357846.jpg?interpolation=lanczos-none&fit=around%7C660%3A440">
    <div class="text">2017 Civic SI</div>
  </div>

  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>



';

?>