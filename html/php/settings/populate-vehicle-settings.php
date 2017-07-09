<?php include("php/auth.php"); //include auth.php file on all secure pages ?>
<!--Updates modified values-->


<?php
	$carHash = $_POST['hash'];
	$connone = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

	// Check connection
	if ($connone->connect_error) {
    die("Connection failed: " . $connone->connect_error);
	} 

	$sql = "SELECT * FROM Cars WHERE HASH = '$carHash'";
	$result = $connone->query($sql);

	if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {

    	echo '
    	<div class="form-style-2">
		<form method = "POST" enctype = "multipart/form-data">
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
		<label><span>&nbsp;</span><input name="update-car-settings" type="submit" value="Save Changes" /></label>
		<input type="hidden" name="carHash" value="'.$carHash.'"></form></div>';

		$sql = "SELECT * FROM PhotoLink WHERE UNAME = '$carHash'";
		$result = $connone->query($sql);

		if ($result->num_rows > 0) {
				echo '<div id="vehicle-photos"><div class="form-style-2-heading">Photos</div>';
		    // output data of each row
				$photoCounter = 0;
		    while($row = $result->fetch_assoc()) {
		    	echo '<a href="#" onclick="photoSelected(';
		    	echo "'".$row['FNAME']."','photo".$photoCounter."'";
		    	echo ')"><div id="photo'.$photoCounter.'" class="photo-container"><img src="uploads/vehicles/'.$row['FNAME'].'"></div></a>';
		    	$photoCounter++;
		    }
		    echo '<br><button onclick="setDefault()">Set Default</button></div><div id="croppie-container">
<div id="demo-basic">
</div>
<button class="basic-result">Save</button>
</div>';
		}

    }

}else {
    echo "Error: " . $sql . "<br>" . $connone->error;
$connone->close();
}
?>