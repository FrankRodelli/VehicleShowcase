<?php include("php/auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/home.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/clappr/latest/clappr.min.js"></script>
<script type="text/javascript" src="js/instascan.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" media="print" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.print.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</head>

<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="menu">
		<img class="logo" src="images/logo.png" alt="Mycarlogo" height="40" width="40">
		<h1>FBMotors</h1>
			<ul class="nav">
				<li><a href="index.php" accesskey="1" title="">Home</a></li>
				<li><a href="discover.php" accesskey="2" title="">Discover</a></li>
				<li class="qrli">
					<div class="mask pseudo">
						<a href="#" onclick="openQRScanner()"><img class="qr" src="https://www.qrstuff.com/images/sample.png" height="40px"></a>
					</div>
				</li>
				<li><a href="events.php" accesskey="3" title="">Events</a></li>
				<li><a href="about.php" accesskey="4" title="">About</a></li>
				<li><img id="search-button" class="search" src="https://cdn0.iconfinder.com/data/icons/octicons/1024/search-128.png" height="20px"> </li>
			</ul>

			<div id="search-bar">
			<form method="post" action="/discover.php">
			<input name="a" class="searchinput" type="text">
		</form>
			</div>

<?php include("php/header.php"); ?>
		</div>
	</div>
</div>

<div id="page-wrapper">
<div id="page-container">


<form method="POST" name="search">
<input type="text" name="search_term" placeholder="search_term">
<input name="submit" type="submit" value="Submit" />
</form>

</div>
</div>

<?php
	$connUsers = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

	// Check connection
	if ($connUsers->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	// Check connection
	$connVehicles = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');
	if ($connVehicles->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}


	if(isset($_POST['submit']) || isset($_POST['a'])){

		//Ensure that if the submit button is pressed, the url is ignored
		if(isset($_POST['submit'])){
			$searchterm = $connUsers->real_escape_string($_POST['search_term']);
		}else{
			if($_POST['a'] != ''){
				$searchterm = $connUsers->real_escape_string($_POST['a']);
			}
		}

		$resultArray = array();

		//query users
		$sql = "SELECT * FROM `UserList` WHERE FIRSTNAME LIKE '%$searchterm%' OR  LASTNAME LIKE '%$searchterm%' OR USERNAME LIKE '%$searchterm%'";
		$result = $connUsers->query($sql);
		if($result->num_rows > 0){
			//Stores each row in array
			while($resultArray[] = $result->fetch_assoc());
			array_pop($resultArray);
		}

		//query events
		$sql = "SELECT * FROM `Events` WHERE title LIKE '%$searchterm%' OR description LIKE '%$searchterm%'";
		$result = $connUsers->query($sql);
		if($result->num_rows > 0){
			//Stores each row in array
			while($resultArray[] = $result->fetch_assoc());
			array_pop($resultArray);
		}

		//query vehicles
		$sql = "SELECT * FROM `Cars` WHERE MAKE LIKE '%$searchterm%' OR MODEL LIKE '%$searchterm%'";
		$result = $connVehicles->query($sql);
		if($result->num_rows > 0){
			//Stores each row in array
			while($resultArray[] = $result->fetch_assoc());
			array_pop($resultArray);
		}

		$resultCounter = sizeof($resultArray);

		//If there are results
		if($resultCounter > 0){

			//Loops through array and displays results formatted by type
			for($i = 0; $i < sizeof($resultArray);$i++){
				if($resultArray[$i]['USERNAME'] != ''){
					echo ($i+1).'. <a href="../user.php?u='.$resultArray[$i]['UUID'].'">'.$resultArray[$i]['FIRSTNAME'].' '.$resultArray[$i]['LASTNAME'].'</a><br>';
				}
				if($resultArray[$i]['MAKE'] != ''){
					echo ($i+1).'. <a href="../vehicle.php?c='.$resultArray[$i]['HASH'].'">'.$resultArray[$i]['DATE'].' '.$resultArray[$i]['MAKE'].' '.$resultArray[$i]['MODEL'].'</a><br>';
				}
				if($resultArray[$i]['title'] != ''){
					echo ($i+1).'. <a href="../event.php?e='.$resultArray[$i]['id'].'">'.$resultArray[$i]['title'].'</a><br>';
				}
			}
		}else{
			echo "No results found";
		}
	}
?>
</body>
</html>
