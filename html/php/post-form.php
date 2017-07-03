<?php

// Get username
$loggedinuser = $_SESSION['token'];

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
    <img src="uploads/users/'.$row["PICTURE"].'"/>
</div>
<form method = "POST" enctype = "multipart/form-data" class="post-text">
 	<textarea name="post-text-content" placeholder="Update us on your ride!"></textarea><input name="add-post" type="submit" value="Submit" />
</div>
<div id="lower-column">
<input type="file" name="image" />
</form>
</div>
</div>';

}else{
	die($sql);
}

if($_POST['add-post']){
	$postid = uniqid();
	$text = $_POST['post-text-content'];

    if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      $filename = uniqid();
      $temp = explode(".", $_FILES["image"]["name"]);
      $newfilename = $filename . '.' . end($temp);
      
      $photoextensions= array("jpeg","jpg","png","avi","mp4","mov");

      if(in_array($file_ext,$photoextensions) === false){
         $errors[]="extension not allowed, please choose a JPEG, PNG, AVI, mp4, or MOV file.";
         $newfilename = null;
      }

      /*Not sure what I want the limits to be yet
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }*/
      
      if(empty($errors)==true) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/posts/" . $newfilename);
      }else{
         print_r($errors);
      }
   }

	$sql = "INSERT INTO `Posts` (`UUID`, `USER`, `TEXT`, `CONTENT`) VALUES ('$postid','$loggedinuser','$text','$newfilename')";

	if ($conn->query($sql) === TRUE) {
			echo "Post saved!";

	} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$sql = "SELECT * FROM Posts";
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
    		echo '<img class="post-pro-pic" src="uploads/users/'. $userrow['PICTURE'] .'"><div id="post-info"><a>'.$userrow['FIRSTNAME'] . ' ' . $userrow['LASTNAME'] .'</a><br><a>'. $newDate .'</a></div>';
    	}

		echo '
        </div>
		<div id="bottom-post"><a>
		'.$row['TEXT'].'</a>';

        if($row["CONTENT"] != null){
            echo '<img class="post-image" src="uploads/posts/'.$row['CONTENT'].'">';
        }
        echo '
		</div>

    <div id="comment">';
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
    <img src="uploads/users/'.$row["PICTURE"].'"/>
</div>
<form method = "POST" enctype = "multipart/form-data" class="post-text">
  <textarea name="post-text-content" placeholder="Update us on your ride!"></textarea><input name="add-post" type="submit" value="Submit" />
</div>
<div id="lower-column">
<input type="file" name="image" />
</form>
</div>
</div>';

}else{
  
}

echo' 
    </div>

    </div>';
    }

} else {
    echo '<br>There are no posts to show!';
}

?>