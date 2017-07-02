<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<html>
<head>

<link rel="stylesheet" href="css/main.css" />

<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">

</head>

<body>

<div id="center-wrapper">

<div id="inner-wrapper">

<img src="images/logo.png" alt="GrapeVine logo">

<br />
<br />

<div id="token" class="form">
<form action="" method="post" name="login">
<input type="text" name="fname" placeholder="First Name"><br>
<input type="text" name="lname" placeholder="Last Name"><br>
<input type="email" name="email" placeholder="Email"><br>
<input type="text" name="username" placeholder="Username"><br>
<input type="password" name="password" placeholder="Passowrd"><br>
<input type="text" name="occupation" placeholder="Occupation"><br>
<label for="dob"><span>Birth Date </span><input type="date" name="dob" placeholder="Last Name"><br></label>
<textarea name="bio" cols="30" rows="5" placeholder="Bio"></textarea>

<br />
<br />

<div id="button">
<center>
<input name ="register" type="submit" value="Register" />
<input name ="back" type="submit" value="Back" />
</center>

<?php
	//Creates session if one is not already active
	if (!isset($_SESSION)) {
    session_start();
	}
	$_SESSION['last_session_request'] = time();
	
if($_POST && isset($_POST['register'])){


	// Create connection
	$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
		$loginip = $conn->real_escape_string($_SERVER['REMOTE_ADDR']);
		$checkifblocked = "SELECT * FROM Blocked WHERE IP = '$loginip'";
		$blockedresult = $conn->query($checkifblocked);
		if($blockedresult->num_rows == 1){
			$row = $blockedresult->fetch_assoc();
			if($row[Blocked] == 1){
			header("Location: blocked.php");
		}
		}

	$username = $conn->real_escape_string($_POST['username']);
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
	$uuid = uniqid();
	$email = $conn->real_escape_string($_POST['email']);
	$fname = $conn->real_escape_string($_POST['fname']);
	$lname = $conn->real_escape_string($_POST['lname']);
	$bio = $conn->real_escape_string($_POST['bio']);
	$occupation = $conn->real_escape_string($_POST['occupation']);
	$dob = $conn->real_escape_string($_POST['dob']);
	//Insert new user to database
	$sql = "INSERT INTO `UserList` (`EMAIL`, `USERNAME`, `PASSWORD`, `UUID`, `FIRSTNAME`, `LASTNAME`, `PICTURE`, `BIO`, `OCCUPATION`, `DOB`, `RATELIMITED`) VALUES ('$email', '$username', '$password', '$uuid', '$fname', '$lname', '', '$bio', '$occupation', '$dob', 0)";

	if ($conn->query($sql) === TRUE) {
		$cookie = $uuid;
		$_SESSION['token'] = $cookie;
		header("Location: index.php");

	} else {
	    echo "Error: please try again or contact the support for more information.";
	}

	$conn->close();
}

if($_POST['back']){
	header("Location: index.php");
}
?>
			</div>
		</div>
	</div>
</div>
</body>
</html>
