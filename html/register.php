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
<input type="password" name="password" placeholder="Password"><br>
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

		 }
			$row = $blockedresult->fetch_assoc();
			if($row[Blocked] == 1){
			header("Location: blocked.php");
		}
		}

		$username = $conn->real_escape_string($_POST['username']);
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
		$uuid = uniqid();
		$emailcode = uniqid();
		$email = $conn->real_escape_string($_POST['email']);
		$fname = $conn->real_escape_string($_POST['fname']);
		$lname = $conn->real_escape_string($_POST['lname']);
		$bio = $conn->real_escape_string($_POST['bio']);
		$occupation = $conn->real_escape_string($_POST['occupation']);
		$dob = $conn->real_escape_string($_POST['dob']);
	//Insert new user to database
	if(is_null($email) || is_null($username) || is_null($password) || is_null($fname) || is_null($lname) || is_null($bio) || is_null($occupation) || is_null($dob) ){
		echo "You will need to put all the information in.";
	}else{
	$fetchsql = "SELECT * FROM `UserList` WHERE `USERNAME`='$username' OR `EMAIL`='$email'";
	$samecredentialsresult = $conn->query($fetchsql);
	if($samecredentialsresult->num_rows == 1){
		echo "You will need to put unique information in.";
	}else {
	$sql = "INSERT INTO `UserList` (`EMAIL`, `USERNAME`, `PASSWORD`, `UUID`, `FIRSTNAME`, `LASTNAME`, `PICTURE`, `BIO`, `OCCUPATION`, `DOB`, `RATELIMITED`, `VERIFIEDEMAIL`, `VERIFICATIONLINKCODE`) VALUES ('$email', '$username', '$password', '$uuid', '$fname', '$lname', '', '$bio', '$occupation', '$dob', 0, 0, '$emailcode')";
	if ($conn->query($sql) === TRUE) {
		//$cookie = $uuid;
		//$_SESSION['token'] = $cookie;
		require("sendgrid-php/sendgrid-php.php");
		$from = new SendGrid\Email("Showmeyouraxels Support", "support@showmeyouraxels.me");
		$subject = "Email Verification for Showmeyouraxels";
		$to = new SendGrid\Email($fname . " " . $lname, $email);
		$content = new SendGrid\Content("text/html", '<html> <head></head> <body> Hello ' . $fname . ' ' . $lname . ', here is the verification link as requested. <a href="https://showmeyouraxels.me/emailverification.php?v=' . $emailcode . '"> https://showmeyouraxels.me/emailverification.php?v=' . $emailcode . '</a></body></html>');
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$apiKey = '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';
		$sg = new \SendGrid($apiKey);
		$response = $sg->client->mail()->send()->post($mail);
		echo "Please check your email for the link to verify your email.";


	} else {
	    echo "Error: please try again or contact the support for more information.";
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}
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
