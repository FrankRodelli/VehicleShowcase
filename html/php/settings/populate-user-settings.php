<?php
	$user = $_SESSION['token'];

	$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

	// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM UserList WHERE UUID = '$user'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {

    	echo '
			<div class="form-style-2">
			<div class="form-style-2-heading">Edit Profile</div>
			<form method = "POST" enctype = "multipart/form-data">
		<label for="fname">
		<span>First Name </span>
		<input type="text" class="input-field" name="fname" value="' .
		$row["FIRSTNAME"] . '" /></label>

		<label for="lname">
		<span>Last Name </span>
		<input type="text" class="input-field" name="lname" value="' .
		$row["LASTNAME"] . '" /></label>

		<label for="email">
		<span>Email </span>
		<input type="email" class="input-field" name="email" value="' .
		$row["EMAIL"] . '" /></label>

		<label for="username">
		<span>Username <span class="required">*</span></span>
		<input type="text" class="input-field" name="username" value="' .
		$row["USERNAME"] . '" /></label>

		<label for="current-password">
		<span>Current Password <span class="required">*</span></span>
		<input type="password" class="input-field"
		name="current-password" value="" /></label>

		<label for="new-password">
		<span>New Password <span class="required">*</span></span>
		<input type="password" class="input-field" name="new-password"
		value="" /></label>

		<label for="renew-password">
		<span>Re-type New Password <span class="required">*</span></span>
		<input type="password" class="input-field" name="renew-password"
		value="" /></label>

		<label for="occupation">
		<span>Occupation </span>
		<input type="text" class="input-field" name="occupation" value="' .
		$row["OCCUPATION"] . '" /></label>

		<label for="dob">
		<span>DOB </span>
		<input type="date" class="input-field" name="dob" value="' .
		$row["DOB"] . '" /></label>

		<label for="bio">
		<span>Bio </span>
		<textarea name="bio" class="textarea-field" cols="750">' .
		$row["BIO"] . '</textarea></label>
		<label><span>&nbsp;</span>
		<input name="addcar" type="submit" value="Save Changes" /></label>
		</form>
		</div>';

    }
}
$conn->close();
?>
