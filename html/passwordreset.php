<body>
	<form method="POST" name="email">
<input type="text" name="email" placeholder="email">
<input name="submit" type="submit" value="Submit" />
</form>

</body>



<?php
require("sendgrid-php/sendgrid-php.php");
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

if(isset($_POST['submit'])){
	//checks passwordresetemail
$passwordresetemail = $conn->real_escape_string($_POST['email']);
if(is_null($passwordresetemail)){
	echo 'You will need to enter a email';
	}else{
		$sql = "SELECT * FROM `UserList` WHERE `EMAIL`='$passwordresetemail'";

		$result = $conn->query($sql);
 		$row = $result->fetch_assoc();
 		$fname = $row["FIRSTNAME"];
 		$lname = $row["LASTNAME"];
 		$passwordcode = uniqid();
	if($result->num_rows == 1){

	
		$from = new SendGrid\Email("Showmeyouraxels Support", "support@showmeyouraxels.me");
		$subject = "Password Reset for Showmeyouraxels";
		$to = new SendGrid\Email($fname . " " . $lname, $passwordresetemail);
		$content = new SendGrid\Content("text/html", '<html> <head></head> <body> Hello ' . $fname . ' ' . $lname . ', here is the password reset link as requested. <a href="https://showmeyouraxels.me/passwordreset.php?p=' . $passwordcode . '"> https://showmeyouraxels.me/passwordreset.php?p=' . $passwordcode . '</a></body></html>');
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$apiKey = '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';
		$sg = new \SendGrid($apiKey);
		$response = $sg->client->mail()->send()->post($mail);
		echo 'If the email specified exists, a email was sent.(email sent thru sendgrid)';
	}else{
		echo 'If the email specified exists, a email was sent.(NO EMAIL FOUND OR MULTIPLE DEBUG MESSAGE, LEAVE OUT)';
	}
}
}

?>