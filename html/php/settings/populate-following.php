<?php
include('../auth.php');

	$username = $_SESSION['token'];
	// Create connection for populating vehicles into user page
	$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }

	$sql = "SELECT * FROM IsFollowing WHERE USER = '$username'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo '<div class="form-style-2-heading">Edit Following</div>';
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$followedUser = $row['FOLLOWING'];
	    	$sqluser = "SELECT * FROM UserList WHERE UUID = '$followedUser'";
	    	$resultuser = $conn->query($sqluser);
	    	if ($resultuser->num_rows > 0){
	    		while($userrow = $resultuser->fetch_assoc()) {
	    			echo '<div class="user"><img src="uploads/users/'.$userrow['PICTURE'].'"><a>'.$userrow['FIRSTNAME'].' '.$userrow['LASTNAME'].'</a></div>';
	    		}
	    	}else{
	    		echo "You aren't following anyone yet!";
	    	}
	    	
	    }
	}else{
		echo "You aren't following anyone yet!";
	}
