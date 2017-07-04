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
    <a href="user.php/?u='.$row['UUID'].'"><img src="uploads/users/'.$row["PICTURE"].'"/></a>
</div>
<form method = "POST" enctype = "multipart/form-data" class="post-text">
 	<textarea name="post-text-content" placeholder="Update us on your ride!"></textarea><input name="add-post" type="submit" value="Submit" />
</div>
<div id="lower-column">
<input type="file" name="file" id="file" />
</form>
</div>
</div>';

}else{
	die($sql);
}

//Adds posts to database
if($_POST['add-post']){
  $postid = uniqid();
  $text = $_POST['post-text-content'];
  $contentType = '';
  $newfilename ='';

  if(empty($_FILES['file']['name'])){
    $contentType = 'text';
  }
  else{
    echo $_FILES["file"]["name"];
    $allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if ((($_FILES["file"]["type"] == "video/mp4")
    || ($_FILES["file"]["type"] == "audio/mp3")
    || ($_FILES["file"]["type"] == "audio/wma")
    || ($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg"))

    && in_array($extension, $allowedExts)){

      $filename = uniqid();
      $temp = explode(".", $_FILES["file"]["name"]);
      $newfilename = $filename . '.' . end($temp);

      if ($_FILES["file"]["error"] > 0)
        {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
      else
        {
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

        if (file_exists("uploads/posts/" . $newfilename))
          {
          echo $_FILES["file"]["name"] . " already exists. ";
          }
        else
          {
          move_uploaded_file($_FILES["file"]["tmp_name"],
          "uploads/posts/" . $newfilename);
          echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
          }
        }

      if(($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")){
        
        $contentType = 'picture';
      }
      elseif ($_FILES["file"]["type"] == "video/mp4") {
        $contentType = 'video';
      }

    }else
      {
      echo "Invalid file";
      }
  }

  //Adds file to database 
  if($contentType == 'picture'){
    $sql = "INSERT INTO `Posts` (`UUID`, `USER`, `TEXT`, `CONTENT`, `PHOTO`) VALUES ('$postid','$loggedinuser','$text','picture','$newfilename')";

    if ($conn->query($sql) === TRUE) {
        echo "Post saved!";

    } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }
  if($contentType == 'video'){
        $sql = "INSERT INTO `Posts` (`UUID`, `USER`, `TEXT`, `CONTENT`, `VIDEO`) VALUES ('$postid','$loggedinuser','$text','video','$newfilename')";

    if ($conn->query($sql) === TRUE) {
        echo "Post saved!";

    } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

    if($contentType == 'text'){
        $sql = "INSERT INTO `Posts` (`UUID`, `USER`, `TEXT`, `CONTENT`) VALUES ('$postid','$loggedinuser','$text','text')";

    if ($conn->query($sql) === TRUE) {
        echo "Post saved!";

    } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

//Adds comments to database
if($_POST['add-comment']){
  $id = $_POST['postID'];
  $text = $_POST['post-text-content'];
  $sql = "INSERT INTO `PostComments` (`UUID`, `USER`, `TEXT`) VALUES ('$id','$loggedinuser','$text')";

  if ($conn->query($sql) === TRUE) {

  } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

//Populates posts
$sql = "SELECT * FROM Posts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $playercounter = 0;
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
    		echo '<a href="user.php/?u='.$userrow['UUID'].'"><img class="post-pro-pic" src="uploads/users/'. $userrow['PICTURE'] .'"></a><div id="post-info"><a>'.$userrow['FIRSTNAME'] . ' ' . $userrow['LASTNAME'] .'</a><br><a>'. $newDate .'</a></div></div>';
    	}

		echo '
		<div id="bottom-post"><a>
		'.$row['TEXT'].'</a>';

        if($row["CONTENT"] == 'picture'){
          echo '<img class="post-image" src="uploads/posts/'.$row['PHOTO'].'">';
        }
        else{
          if($row["CONTENT"] == 'video'){
            echo '
              <div id="player'.$playercounter.'"></div>
              <script>
              var player = new Clappr.Player({source: "uploads/posts/'.$row['VIDEO'].'", parentId: "#player'.$playercounter.'"});
              </script>
            ';
            $playercounter++;
          }
        }
        echo '
		</div>

    <div id="comment-container">';

  //Gets post id for comment form reference
    $postID = $row['UUID'];

  //Populate comments for post
  $popcommentssql = "SELECT * FROM PostComments WHERE UUID = '$postID'";
  $popcommentsresult = $conn->query($popcommentssql);

  if ($popcommentsresult->num_rows > 0) {

      // output data of each row
      while($popcommentsrow = $popcommentsresult->fetch_assoc()) {

        //Get data from comment owner profile
        $commentowner = $popcommentsrow['USER'];
        $commentownersql = "SELECT * FROM UserList WHERE UUID = '$commentowner'";
        $commentownerresult = $conn->query($commentownersql);
        $commentownerrow = $commentownerresult->fetch_assoc();

        //Format date for comment
        $oldDate = $popcommentsrow['DATE'];
        $newDate = date("M-d", strtotime($oldDate));

        //Display all comment information
        echo '
        <div id="comment"><div id="post-info">
        <a href="user.php/?u='.$commentownerrow['UUID'].'"><img class="post-pro-pic" src="uploads/users/'.$commentownerrow['PICTURE'].'"></a>
        <a>'.$commentownerrow['FIRSTNAME'].' '.$commentownerrow['LASTNAME'].'
        </div>
        <div id="comment-text"><a>'.$popcommentsrow['TEXT'].'</a></div></div>';
      }

}else{

 
}

    //Check if credentials match database and login accordingly
    $wirtecommentsql = "SELECT * FROM UserList WHERE UUID = '$loggedinuser'";
    //set querry data to result variable
    $writecommentresult = $conn->query($wirtecommentsql);
    //If there are results, run
    if($writecommentresult->num_rows == 1){
    //Assigns row data to $row array
    $writecommentrow = $writecommentresult->fetch_assoc();

    echo '
    </div>
    <div id="post-comment-container">
    <img src="uploads/users/'.$writecommentrow["PICTURE"].'"/>
    <form method = "POST" enctype = "multipart/form-data" class="post-comment">
      <textarea name="post-text-content" placeholder="Comment!"></textarea>
      <input type="hidden" name="postID" value="'.$row['UUID'].'" />
      <input name="add-comment" type="submit" value="Submit" />
      </form>
    </div>';
    }
echo' 
    </div>';
    }

} else {
    echo '<br>There are no posts to show!';
}

?>