<?php

if($_POST && isset($_POST['addcar'])){

	$username = $_SESSION['token'];
	// Create connection
	$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	//Password reset
	$currentpassword = $_POST['current-password'];
	$newpassword = $_POST['new-password'];
	$confirmpassword = $_POST['renew-password'];

	//User info
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$occupation = $_POST['occupation'];
	$dob = $_POST['dob'];
	$bio = $_POST['bio'];
	$newusername = $_POST['username'];

	//Check t 
	$sql = "SELECT * FROM UserList WHERE UUID = '$username'";
	$result = $conn->query($sql);
	if($result->num_rows == 1){
		
		$row = $result->fetch_assoc();
		if (password_verify($currentpassword, $row["PASSWORD"])){
			if($newpassword == $confirmpassword){
				$hashedpassword = password_hash($newpassword, PASSWORD_DEFAULT, ['cost' => 11]);
				$sql = "UPDATE `UserList` SET `PASSWORD`='$hashedpassword' WHERE `UUID`='$username'";
				$result = $conn->query($sql);
				if($result->num_rows == 1){
					// password was changed successfully!!!
				} else {
					// some error has occurered writing it, OH SHIT
				}
			} else {
				// the password doesn't match
			}
		} else {
			//The before password was incorrect, YELL AT THEM FOR ME FRANK
		}
	}

	$sql = "UPDATE `UserList` SET `EMAIL`='$email',`USERNAME`='$newusername',
	`FIRSTNAME`='$fname',`LASTNAME`='$lname',`BIO`='$bio',`OCCUPATION`='$occupation',`DOB`='$dob' WHERE `UUID` = '$username'";
	$result = $conn->query($sql);

	if ($conn->query($sql) === TRUE) {
		echo "Settings saved successfully";

	} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

	$conn->close();
}
?>