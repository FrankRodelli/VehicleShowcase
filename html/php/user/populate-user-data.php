<?php
include("auth.php");
// Get username
$username = $_GET['u'];
$loggedinuser = $_SESSION['token'];


// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//Check if credentials match database and login accordingly
$sql = "SELECT * FROM UserList WHERE UUID = '$username'";

//set querry data to result variable
$result = $conn->query($sql);

//If there are results, run
if($result->num_rows == 1){
	//Assigns row data to $row array
	$row = $result->fetch_assoc();
	//calculates age based on dob
	$age = floor((time() - strtotime($row["DOB"])) / 31556926);

	echo '
	<img class="propic-page" src="../uploads/users/'.$row["PICTURE"].'" height="150px"></a>
	<div id="user-data">
	<a>'.$row["FIRSTNAME"].' ' .$row["LASTNAME"] .'</a><br>
	<a>'.$age.'</a><br>
	<a>'.$row["OCCUPATION"] .'</a><br>';
	
	$followers = 0; 
	$following = 0;

	//Gets number of people user is following
	$sql1 = "SELECT * FROM IsFollowing WHERE USER = '$username'";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
    	// output data of each row
    	while($row1 = $result1->fetch_assoc()) {
    		$following++;
    	}
    	echo '<a href="#">Following(' . $following . ')</a><br><title>'. $row['FIRSTNAME']. ' '.$row['LASTNAME'] .'</title>';
    }
    $sql1 = "SELECT * FROM IsFollowing WHERE FOLLOWING = '$username'";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
    	// output data of each row
    	while($row1 = $result1->fetch_assoc()) {
    		$followers++;
    	}
    	echo '<a href="#">Followers('.$followers.')</a>';
    }

    if($username != $loggedinuser){
		$isUserFollowing = false;
	    $sql = "SELECT * FROM IsFollowing WHERE FOLLOWING = '$username'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
	    	// output data of each row
	    	while($row1 = $result->fetch_assoc()) {
	    		if($row1['USER'] = $loggedinuser){
	    			$isUserFollowing = true;
	    		}
	    	}
	    }

	    if($isUserFollowing){
	    	echo '<br>
	    	<div id="button-container">
			<button class="follow-button" onclick="unFollowUser()" >You follow '.$row["FIRSTNAME"] .'</button></div></div></div>';

	    }else{
		    echo'<br>
		    <div id="button-container">
			<button class="follow-button" onclick="followUser()" >Follow '.$row["FIRSTNAME"] .'!</button>
			</div>
			</div>
			</div>';
	    }
    }else{
    	echo '</div></div>';
    }
}
?>