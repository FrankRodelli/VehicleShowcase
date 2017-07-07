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
$sql = "SELECT * FROM Posts WHERE USER = '$userpageuuid' ";
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
            echo '<a href="../user.php/?u='.$userrow['UUID'].'"><img class="post-pro-pic" src="../uploads/users/'. $userrow['PICTURE'] .'"></a><div id="post-info"><a>'.$userrow['FIRSTNAME'] . ' ' . $userrow['LASTNAME'] .'</a><br><a>'. $newDate .'</a></div></div>';
        }

        echo '
        <div id="bottom-post"><a>
        '.$row['TEXT'].'</a>';

        if($row["CONTENT"] == 'picture'){
          echo '<img class="post-image" src="../uploads/posts/'.$row['PHOTO'].'">';
        }
        else{
          if($row["CONTENT"] == 'video'){
            echo '
              <div id="player'.$playercounter.'"></div>
              <script>
              var player = new Clappr.Player({source: "../uploads/posts/'.$row['VIDEO'].'", parentId: "#player'.$playercounter.'"});
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
        <a href="../user.php/?u='.$commentownerrow['UUID'].'"><img class="post-pro-pic" src="../uploads/users/'.$commentownerrow['PICTURE'].'"></a>
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
    <img src="../uploads/users/'.$writecommentrow["PICTURE"].'"/>
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