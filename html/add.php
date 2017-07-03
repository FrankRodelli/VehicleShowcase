<?php include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add a Vehicle</title>
<link rel="shortcut icon" href="favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/add.css" rel="stylesheet" type="text/css" media="all" />

</head>

<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="menu">
		<img src="images/logo.png" alt="Mycarlogo" height="40" width="40">
		<h1>FBMotors</h1>
			<ul class="nav">
				<li><a href="index.php" accesskey="1" title="">Home</a></li>
				<li><a href="mycars.php" accesskey="2" title="">My Cars</a></li>
				<li class="active"><a href="add.php" accesskey="3" title="">Add Car</a></li>
				<li><a href="logout.php" accesskey="4" title="">Logout</a></li>
			</ul>
		</div>
	</div>
</div>

<div id="page-wrapper">

<div id="stream-container">
<div id="add-details">
<div class="form-style-2">
<div class="form-style-2-heading">Basic Information</div>
<form method = "POST" enctype = "multipart/form-data">
<label for="field1"><span>Make <span class="required">*</span></span><input type="text" class="input-field" name="field1" value="" /></label>
<label for="field2"><span>Model <span class="required">*</span></span><input type="text" class="input-field" name="field2" value="" /></label>
<label for="field3"><span>Year <span class="required">*</span></span><input type="number" class="input-field" name="field3" value="" /></label>
<div class="form-style-2-heading">Additional Information</div>
<label for="field16"><span>Displacement(L/CC) </span><input type="text" class="input-field" name="field16" value="" /></label>
<label for="field4"><span>Horsepower </span><input type="number" class="input-field" name="field4" value="" /></label>
<label for="field5"><span>Torque </span><input type="number" class="input-field" name="field5" value="" /></label>
<label for="field6"><span>Cylinders </span><input type="number" class="input-field" name="field6" value="" /></label>
<label for="field7"><span>Fuel Type </span><input type="text" class="input-field" name="field7" value="" /></label>
<label for="field8"><span>Modifications </span><input type="text" class="input-field" name="field8" value="" /></label>
<label for="field9"><span>Transmission </span><input type="text" class="input-field" name="field9" value="" /></label>
<div class="form-style-2-heading">Performance</div>
<label for="field10"><span>0-60 </span><input type="number" class="input-field" name="field10" value="" /></label>
<label for="field11"><span>0-100 </span><input type="number" class="input-field" name="field11" value="" /></label>
<label for="field12"><span>1/4 Mile </span><input type="number" class="input-field" name="field12" value="" /></label>
<label for="field13"><span>Top Speed </span><input type="number" class="input-field" name="field13" value="" /></label>
<label for="field14"><span>Fuel Economy </span><input type="number" class="input-field" name="field14" value="" /></label>
<div class="form-style-2-heading"></div>
<label for="field15"><span>Writeup </span><textarea name="field15" class="textarea-field" cols="750"></textarea></label>
<label><span>&nbsp;</span><input name="addcar" type="submit" value="Add Car" /></label>
</div>

<div id="photos">
<div class="form-style-2-heading">Upload Photos</div>

<input type="file" name="image" />

</div>

<div id="videos">
<div class="form-style-2-heading">Uplaod Videos</div>

<input type="file" name="video" />
</div>

<div id="notice">
<?php

$carhash = uniqid();

if($_POST && isset($_POST['addcar'])){
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

	$user = $_SESSION['token'];

	// Create connection
	$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO `Cars` (`HASH`, `DATE`, `MAKE`, `MODEL`, `UUID`, `PHOTO`, `DISPLACEMENT`, `HP`, `TORQUE`, `CYLINDERS`, `FUELTYPE`, `MODS`, `TRANS`, `060`, `0100`, `14MILE`, `TOPSPEED`, `MPG`, `WRITEUP`) VALUES ('$carhash', '$year', '$make', '$model', '$user', '', '$displacement', '$horsepower', '$torque', '$cylinders', '$fueltype', '$mods', '$transmission', '$zerosixty', '$zerohundred', '$quartermile', '$topspeed', '$mpg', '$writeup')";

	if ($conn->query($sql) === TRUE) {
	    echo "Car added!<br>";
	    echo 'Page can be found <a href="http://45.63.67.155/?a=' . $hash . '">here</a>';
	    echo '<br><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http%3A%2F%2F45.63.67.155/?a=' . $hash .'"%2F&choe=UTF-8" title="Link to Listing" />';
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}

   if(isset($_FILES['image'])){
   	echo "is it workin";
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      $filename = uniqid();
      $temp = explode(".", $_FILES["image"]["name"]);
	  $newfilename = $filename . '.' . end($temp);
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {

        //move_uploaded_file($file_tmp,"uploads/images/".$file_name);
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/images/" . $newfilename);

        // Create connection
		$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$date = date("Y/m/d");
		$sql = "INSERT INTO `Photos` (`NAME`, `DATE`) VALUES ('$newfilename','$date')";

		if ($conn->query($sql) === TRUE) {
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO `PhotoLink` (`UNAME`, `FNAME`) VALUES ('$carhash','$newfilename')";

		if ($conn->query($sql) === TRUE) {
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

      }else{
         print_r($errors);
      }
   }

?>
</div>

</form>

</div>
</div>
</div>

<div id="copyright">
<p>&copy; 2017 MyCar Inc. All Rights Reserved.</p>
</div>

</body>
</html>

