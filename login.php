<?php
/*
Author: Javed Ur Rehman
Website: https://htmlcssphptutorial.wordpress.com
*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
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
<input type="text" name="username" placeholder="Username"><br>
<input type="password" name="password" placeholder="Password"><br>

<br />
<br />

<div id="button">
<center>
<input name="login" type="submit" value="Login" /><br>
<input name ="register" type="submit" value="Register" />
</center>

<?php
	//Creates session if one is not already active
	if (!isset($_SESSION)) {
    session_start();
	}
	$_SESSION['last_session_request'] = time();

if($_POST && isset($_POST['login'])){

	$username = $_POST['username'];
	$password = $_POST['password'];

	// Create connection
	$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	//Check if credentials match database annd login accordingly
	$sql = "SELECT * FROM UserList WHERE USERNAME = '$username' and PASSWORD = '$password'";
	$result = $conn->query($sql);

	if ($result->num_rows == 1){
		$cookie = $username;
		$_SESSION['token'] = $cookie;
		header("Location: index.php");
	}
	else{
		echo "<center>Username/Password incorrect</center>";
	}

	$conn->close();
}

if($_POST['register']){
	header("Location: register.php");
}
?>
			</div>
		</div>
	</div>
</div>
</body>
</html>
