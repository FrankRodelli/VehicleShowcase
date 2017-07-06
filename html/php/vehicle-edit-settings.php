<?php include("auth.php"); //include auth.php file on all secure pages ?>
<!--Updates modified values-->
<?php
$carHash = $_POST['hash'];

if($_POST && isset($_POST['update-car-settings'])){
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
	$username = $_SESSION['token'];
	// Create connection
	$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "UPDATE Cars SET MAKE='$make',MODEL='$model',DATE='$year',DISPLACEMENT='$displacement',
	HP='$horsepower',TORQUE='$torque',CYLINDERS='$cylinders',FUELTYPE='$fueltype',MODS='$mods',
	TRANS='$transmission',`060`='$zerosixty',`0100`='$zerohundred',14MILE='$quartermile',TOPSPEED='$topspeed',MPG='$mpg',WRITEUP='$writeup' WHERE HASH = '$carHash'";
	$result = $conn->query($sql);

	if ($conn->query($sql) === TRUE) {

	} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

	$conn->close();
}
?>
<link href="css/add.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<div class="form-style-2">
<form method = "POST" enctype = "multipart/form-data">
<!--Populates values from previous entry-->
<?php
	$uuid = $_GET['e'];
	$user = $_SESSION['token'];

	$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

	// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM Cars WHERE HASH = '$carHash'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {

    	echo '
    	<head>
    	</head>
    	<div class="form-style-2-heading">Basic Information</div>
		<label for="field1"><span>Make <span class="required">*</span></span><input type="text" class="input-field" name="field1" value="' . $row["MAKE"] . '" /></label>
		<label for="field2"><span>Model <span class="required">*</span></span><input type="text" class="input-field" name="field2" value="' . $row["MODEL"] . '" /></label>
		<label for="field3"><span>Year <span class="required">*</span></span><input type="number" class="input-field" name="field3" value="' . $row["DATE"] . '" /></label>
		<div class="form-style-2-heading">Additional Information</div>
		<label for="field16"><span>Displacement(L/CC) </span><input type="text" class="input-field" name="field16" value="' . $row["DISPLACEMENT"] . '" /></label>
		<label for="field4"><span>Horsepower </span><input type="number" class="input-field" name="field4" value="' . $row["HP"] . '" /></label>
		<label for="field5"><span>Torque </span><input type="number" class="input-field" name="field5" value="' . $row["TORQUE"] . '" /></label>
		<label for="field6"><span>Cylinders </span><input type="number" class="input-field" name="field6" value="' . $row["CYLINDERS"] . '" /></label>
		<label for="field7"><span>Fuel Type </span><input type="text" class="input-field" name="field7" value="' . $row["FUELTYPE"] . '" /></label>
		<label for="field8"><span>Modifications </span><input type="text" class="input-field" name="field8" value="' . $row["MODS"] . '" /></label>
		<label for="field9"><span>Transmission </span><input type="text" class="input-field" name="field9" value="' . $row["TRANS"] . '" /></label>
		<div class="form-style-2-heading">Performance</div>
		<label for="field10"><span>0-60 </span><input type="number" class="input-field" name="field10" value="' . $row["060"] . '" /></label>
		<label for="field11"><span>0-100 </span><input type="number" class="input-field" name="field11" value="' . $row["0100"] . '" /></label>
		<label for="field12"><span>1/4 Mile </span><input type="number" class="input-field" name="field12" value="' . $row["14MILE"] . '" /></label>
		<label for="field13"><span>Top Speed </span><input type="number" class="input-field" name="field13" value="' . $row["TOPSPEED"] . '" /></label>
		<label for="field14"><span>Fuel Economy </span><input type="number" class="input-field" name="field14" value="' . $row["MPG"] . '" /></label>
		<div class="form-style-2-heading"></div>
		<label for="field15"><span>Writeup </span><textarea name="field15" class="textarea-field" cols="750">' . $row["WRITEUP"] . '</textarea></label>
		<label><span>&nbsp;</span><input name="update-car-settings" type="submit" value="Save Changes" /></label>';

    	}
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
</form>
</div>