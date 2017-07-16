<?php include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
<link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/user.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
</head>

<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="menu">
		<img src="../images/logo.png" alt="Mycarlogo" height="40" width="40">
		<h1>FBMotors</h1>
			<ul class="nav">
				<li><a href="../index.php" accesskey="1" title="">Home</a></li>
				<li><a href="../browse.php" accesskey="2" title="">Browse</a></li>
				<li><a href="../events.php" accesskey="3" title="">Events</a></li>
				<li><a href="../about.php" accesskey="4" title="">About</a></li>
			</ul>

			<img id="search-button" class="search" src="https://cdn0.iconfinder.com/data/icons/octicons/1024/search-128.png" height="20px">

			<div id="search-bar" style="display: none;">
			Search here
			</div>

			<?php
			// Get username
			$username = $_GET['u'];
			$loggedinuser = $_SESSION['token'];


			// Create connection
			$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

			// Check connection
			if ($conn->connect_error) {
		    	die("Connection failed: " . $conn->connect_error);
		    }

		    //Check if credentials match database and login accordingly
			$sql = "SELECT * FROM UserList WHERE USERNAME = '$loggedinuser'";

			//set querry data to result variable
			$result = $conn->query($sql);

			//If there are results, run
			if($result->num_rows == 1){
				//Assigns row data to $row array
				$row = $result->fetch_assoc();

				echo '<div id="user-header">
				<a class="propic-click" href ="../user.php/?u='.$loggedinuser .'">
				<img class="propic-header" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSf2u0RWmYALKJ431XNoTKjzu77ERLBIvXKlOEA-Q3DPo2h2rCB" height="30px"></a>
				<a>Welcome '. $row["FIRSTNAME"] . '!</a>
				<img id="propic" class="menu-icon" src="../images/menu.png">
				</div>

			<div id="popout-menu" style="display: none;">
				<ul class="popout-menu-ul">
					<li><a href="../mycars.php" accesskey="1" title="">My Vehicles</a></li>
					<li><a href="../add.php" accesskey="2" title="">Add Vehicles</a></li>
					<li><a href="../user.php/?u='.$loggedinuser .'" accesskey="3" title="">Profile</a></li>
					<li><a href="" accesskey="4" title="">Settings</a></li>
					<li><a href="logout.php" accesskey="5" title="">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>';
}
?>

<?php

// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

// Check connection
if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	//Check if credentials match database and login accordingly
$sql = "SELECT * FROM UserLis";

//set querry data to result variable
$result = $conn->query($sql);

$emptyArray = array();

//If there are results, run
if($result->num_rows == 1){
	//Assigns row data to $row array
	while($row = $result->fetch_assoc($result)){
		$emptyArray[] = $row;
	}

	?>

<div id="copyright">
<p>&copy; 2017 FBMotors Inc. All Rights Reserved.</p>
</div>

</body>
</html>

<!--Popout menu script -->
<script type="text/javascript">
var div1 = document.getElementById('propic');
var data1 = document.getElementById('popout-menu');
div1.addEventListener("click", function() {
    		if(data1.style.display !== 'none'){
			data1.style.display = 'none';
		}
		else{
			data1.style.display = 'block';
		}
}, false);
</script>

<!--Search Bar Script -->
<script type="text/javascript">
var div2 = document.getElementById('search-button');
var data2 = document.getElementById('search-bar');
div2.addEventListener("click", function() {
    		if(data2.style.display !== 'none'){
			data2.style.display = 'none';
		}
		else{
			data2.style.display = 'block';
		}
}, false);
</script>
