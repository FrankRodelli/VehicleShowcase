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
    		echo '<img class="post-pro-pic" src="../uploads/users/'. $userrow['PICTURE'] .'"><div id="post-info"><a>'.$userrow['FIRSTNAME'] . ' ' . $userrow['LASTNAME'] .'</a><br><a>'. $newDate .'</a></div>';
    	}

        echo '
        </div>
        <div id="bottom-post">
        '.$row['TEXT'];

        if($row["CONTENT"] != null){
            echo '<img class="post-image" src="../uploads/posts/'.$row['CONTENT'].'">';
        }
        echo '
        </div>
        </div>';
    }

} else {
    echo '<br>There are no posts to show!';
}

?>