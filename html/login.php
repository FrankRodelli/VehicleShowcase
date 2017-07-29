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

<img src="images/logo.png" alt="Logo">

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
    $_SESSION['login_counter'] = 0 + $_SESSION['login_counter'];
	}

	$_SESSION['last_session_request'] = time();


	if($_POST && isset($_POST['login'])){

		// Create connection
		$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		//checking if blocked first, before we are able to check user information
		$loginip = $conn->real_escape_string($_SERVER['REMOTE_ADDR']);
		$checkifblocked = "SELECT * FROM Blocked WHERE IP = '$loginip'";
		$blockedresult = $conn->query($checkifblocked);
		if($blockedresult->num_rows == 1){
			$row = $blockedresult->fetch_assoc();
			if($row[Blocked] == 1){
			header("Location: blocked.php");
		}
		}
		//Especaped strings for login information
		$username = $conn->real_escape_string($_POST['username']);

		//Check if credentials match database and login accordingly
		$sql = "SELECT * FROM UserList WHERE USERNAME = '$username'";

		//set querry data to result variable
		$result = $conn->query($sql);

		//If there are results, run
		if($result->num_rows == 1){
			//Assigns row data to $row array
			$row = $result->fetch_assoc();

			//Once the row is fetched it adds to the login counter.
			$_SESSION['login_counter']++;

		    //If user is rate limited, alert user
			if($row["RATELIMITED"] == 1){
				echo "<center>Your account has been ratelimited, please contact our support for more information on this issue.</center>";
			}elseif($row["VERIFIEDEMAIL"] == 0){
					echo "You will need to verify your email before you can move on.";
				}else{
			//If passwords match, log user in
			if (password_verify($_POST['password'], $row["PASSWORD"])){
				$cookie = $row["UUID"];
				$_SESSION['token'] = $cookie;
				$ip = $_SERVER['REMOTE_ADDR'];
				$username = $row['USERNAME'];
				$uuid = $row['UUID'];
				$sql = "INSERT INTO `ActivityLog` (`Username`,`UUID`,`IP`) VALUES ('$username','$uuid','$ip')";
				$result = $conn->query($sql);
				$sql = "UPDATE UserList SET POINTS = 1 WHERE UUID = $uuid ";
				$result = $conn->query($sql);
				header("Location: index.php");
				// this should make it so every time someone logs in, it clears it OR after 4 logins, it would ban them and suspend the account they are logging in with, however, this could cause a hacker to be able to
				// crack a account 4 times, login to a fake working on, then crack a account 4 more times, working on a solution to fix that.
				$_SESSION['login_counter'] = 0;

			}else{


					if($_SESSION['login_counter'] == 5){
						$block = "UPDATE UserList SET ratelimited='1' WHERE USERNAME = '$username'";
						$result = $conn->query($block);
						if ($result->num_rows == 1){
							echo "<center>The account in use has now been deactivated until the account owner reactivates over email.</center>";
							$_SESSION['ratelimited'] == 1;
						} else {
							// oh shit error hope not!
						}
					}elseif($_SESSION['login_counter'] == 10){
						//we are going to want to block them from logging in, ie redirect them every time they attempt to login or register, however all other pages are fine.
						$sql = "INSERT INTO `Blocked` (`IP`, `Blocked`) VALUES ('$loginip', '1')";
						$result = $conn->query($sql);
						echo "<center>Your IP Address has been blocked from registering or logging in, please contact support if you have any further questions. </center>";
					}

					echo "<center>Username/Password incorrect</center>";
			}
		}
	}else{
		//a else needed to put here, or if there is no username, which would expose essentially our entire database.
		echo "<center>Username/Password incorrect</center>";
		//login counter plus plus because its trying to bruteforce.
		$_SESSION['login_counter']++;
		//however, you can spam with this, because it is not going through our little login counter. I think this can be avoided by putting the RATELIMITED check
		//then put the login
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
