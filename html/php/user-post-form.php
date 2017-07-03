<?php

// Get username
$loggedinuser = $_SESSION['token'];

// Get the username of the users page you are visiting 
$userpageuuid = $_GET['u'];

// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//Check if credentials match database and login accordingly
$sql = "SELECT * FROM UserList WHERE UUID = '$loggedinuser'";

//set querry data to result variable
$result = $conn->query($sql);

//If there are results, run
if($result->num_rows == 1){
	//Assigns row data to $row array
	$row = $result->fetch_assoc();

echo '
<div id="make-post-container">
<div id="upper-column">
<div class=frame>
    <span class="helper"></span>
    <img src="../uploads/images/'.$row["PICTURE"].'"/>
</div>
<form method = "POST" enctype = "multipart/form-data" class="post-text">
 	<textarea name="post-text-content" placeholder="Update us on your ride!"></textarea><input name="add-post" type="submit" value="Submit" />
</form>
</div>
<div id="lower-column">
<img src="../images/photo.png">
<img src="../images/video.png">
</div>
</div>';

}else{
	die($sql);
}

if($_POST['add-post']){
	$postid = uniqid();
	$text = $_POST['post-text-content'];
	$sql = "INSERT INTO `Posts` (`UUID`, `USER`, `TEXT`) VALUES ('$postid','$loggedinuser','$text')";

	if ($conn->query($sql) === TRUE) {
			echo "Post saved!";

	} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$sql = "SELECT * FROM Posts WHERE USER = '$userpageuuid' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {

    	echo '
    	<div id="post-item">
    	<div id="top-post">';

    	$oldDate = $row['DATE'];
    	$newDate = date("M-d", strtotime($oldDate));
    	$usernameforquerry = $row['USER'];
    	$usersql = "SELECT * FROM UserList WHERE UUID = '$usernameforquerry' LIMIT 1";
    	$userresult = $conn->query($usersql);

    	while($userrow = $userresult->fetch_assoc()){
    		echo '<img src="../uploads/images/'. $userrow['PICTURE'] .'"><div id="post-info"><a>'.$userrow['FIRSTNAME'] . ' ' . $userrow['LASTNAME'] .'</a><br><a>'. $newDate .'</a></div>';
    	}

		echo '
        </div>
		<div id="bottom-post">
		'.$row['TEXT'].'
		</div>
    	</div>';
    }

} else {
    echo '<br>There are no posts to show!';
}

?>