<?php include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/mycars.css" rel="stylesheet" type="text/css" media="all" />

</head>

<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="menu">
		<img src="images/logo.png" alt="Mycarlogo" height="40" width="40">
		<h1>FBMotors</h1>
			<ul class="nav">
				<li><a href="index.php" accesskey="1" title="">Home</a></li>
				<li class="active"><a href="mycars.php" accesskey="2" title="">My Cars</a></li>
				<li><a href="add.php" accesskey="3" title="">Add Car</a></li>
				<li><a href="logout.php" accesskey="4" title="">Logout</a></li>
			</ul>
		</div>
	</div>
</div>

<div id="page-wrapper">

<div id="stream-container">
<?php
$user = $_SESSION['token'];

// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$uuidDELETE = $_GET['d'];

$checkuser = "SELECT * FROM Cars WHERE HASH = '$uuidDELETE'";
$checkuserresult = $conn->query($checkuser);

if($uuidDELETE != ""){
	if ($checkuserresult->num_rows > 0) {
   // output data of each row
	    while($checkrow = $checkuserresult->fetch_assoc()) {
	    	if($uuidDELETE = $checkrow["HASH"]){
	    		$deletesql = "DELETE FROM Cars WHERE HASH = '$uuidDELETE'";
				$deleteresult = $conn->query($deletesql);
	    	}
    	}
    }
}


$sql = "SELECT * FROM Cars WHERE USER = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$uuid = $row ["HASH"];
    	$photosql = "SELECT * FROM PhotoLink WHERE UNAME = '$uuid' LIMIT 1";
    	$photoresult = $conn->query($photosql);
    	echo '<div id="vehicle-item">';
    	while($photorow = $photoresult->fetch_assoc()){
    		echo '<img src="../uploads/images/'. $photorow["FNAME"] . '" height="100">';
    	}
        echo '<div id="title"><a href="http://45.63.67.155/vehicle.php/?c=' . $row["HASH"] . '">' . $row["DATE"] . " " . $row["MAKE"] . " " . $row["MODEL"] . '</a></div><div id="options"><a href="http://45.63.67.155/edit.php?e=' . $row["HASH"] . '">Edit</a><br><a class ="delete" href="http://45.63.67.155/mycars.php?d=' . $row["HASH"] . '">Delete</a></div></div>';
    }


} else {
    echo '<br>You do not have any cars added yet! Add one <a href="../add.php">here!</a>';
}

$conn->close();

?>
</div>
</div>

<div id="copyright">
<p>&copy; 2017 MyCar Inc. All Rights Reserved.</p>
</div>

</body>
</html>
