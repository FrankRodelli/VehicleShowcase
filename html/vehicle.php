<?php include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vehicle</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/vehicle.css" rel="stylesheet" type="text/css" media="all" />

</head>

<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="menu">
		<img class="logo" src="../images/logo.png" alt="Mycarlogo" height="40" width="40">
		<h1>FBMotors</h1>
			<ul class="nav">
				<li><a href="../index.php" accesskey="1" title="">Home</a></li>
				<li><a href="../browse.php" accesskey="2" title="">Browse</a></li>
				<li><a href="../events.php" accesskey="3" title="">Events</a></li>
				<li><a href="../about.php" accesskey="4" title="">About</a></li>
								<li><img id="search-button" class="search" src="https://cdn0.iconfinder.com/data/icons/octicons/1024/search-128.png" height="20px"> </li>
			</ul>

<div id="search-bar" style="display: none;">
	Search here
</div>

<?php include("php/header.php"); ?>

<div id="page-wrapper">

<div id="container">

<div id="leftside">
<h2>The Driver</h2>
<img src="https://scontent.ftpa1-1.fna.fbcdn.net/v/t1.0-9/18485590_1936089463294580_4805858462704313859_n.jpg?oh=8c0c5150de3889c611df2dcf8f88a5e4&oe=59A0F889" width="75%">
<br>
Frank Rodelli<br>
23<br><br>
<h2>Other Cars</h2>
1974 Cheverolet Camaro<br>
2017 Cheverolet Cruze
</div>

<div id="rightside">
<center>

<?php
$user = $_SESSION['token'];
$uuid = $_GET['c'];

// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM Cars WHERE HASH = '$uuid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	echo "<br>" . $row["DATE"] . " " . $row["MAKE"] . " " . $row["MODEL"];

    	$photosql = "SELECT * FROM PhotoLink WHERE UNAME = '$uuid'";
    	$photoresult = $conn->query($photosql);

    	while($photorow = $photoresult->fetch_assoc()){
    		echo '<br><img src="../uploads/vehicles/'. $photorow["FNAME"] . '" width = "200" > <div class ="row" id="specs">
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

<div id="photo-data" class="data" style="display: none;">
<img class="photos-inrow" src="../uploads/vehicles/'. $photorow["FNAME"] . '">
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
    	}

    }
} else {
    echo "Vehicle does not exist";
}
$conn->close();
?>

</center>
</div>
</div>
</div>

<div id="copyright">
<p>&copy; 2017 MyCar Inc. All Rights Reserved.</p>
</div>

<script type="text/javascript">
var div = document.getElementById('specs-img');
var data = document.getElementById('spec-data');
div.addEventListener("click", function() {
    		if(data.style.display !== 'none'){
			data.style.display = 'none';
		}
		else{
			data.style.display = 'block';
		}
}, false);
</script>
<script type="text/javascript">
var div2 = document.getElementById('photos-img');
var data2 = document.getElementById('photo-data');
div2.addEventListener("click", function() {
    		if(data2.style.display !== 'none'){
			data2.style.display = 'none';
		}
		else{
			data2.style.display = 'block';
		}
}, false);
</script>
<script type="text/javascript">
var div3 = document.getElementById('videos-img');
var data3 = document.getElementById('video-data');
div3.addEventListener("click", function() {
    		if(data3.style.display !== 'none'){
			data3.style.display = 'none';
		}
		else{
			data3.style.display = 'block';
		}
}, false);
</script>
<script type="text/javascript">
var div4 = document.getElementById('writeup-img');
var data4 = document.getElementById('writeup-data');
div4.addEventListener("click", function() {
    		if(data4.style.display !== 'none'){
			data4.style.display = 'none';
		}
		else{
			data4.style.display = 'block';
		}
}, false);
</script>
</body>
</html>
<script type="text/javascript">
var div5 = document.getElementById('propic');
var data5 = document.getElementById('popout-menu');
div5.addEventListener("click", function() {
    		if(data5.style.display !== 'none'){
			data5.style.display = 'none';
		}
		else{
			data5.style.display = 'block';
		}
}, false);
</script>
<script type="text/javascript">
var div6 = document.getElementById('search-button');
var data6 = document.getElementById('search-bar');
div6.addEventListener("click", function() {
    		if(data6.style.display !== 'none'){
			data6.style.display = 'none';
		}
		else{
			data6.style.display = 'block';
		}
}, false);
</script>