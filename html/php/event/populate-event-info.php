<?php

$user = $_SESSION['token'];
$eventID = $_GET['e'];

$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Events WHERE id = '$eventID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $eventDateStart = date_create($row['start']);
  $eventDateEnd = date_create($row['end']);
  $eventOwner = $row['owner'];
  $location = $row['location'];

  echo '
  <img class="eventImage" src="
  http://moxiefestival.com/wp-content/uploads/2013/01/CarShowField.jpg"
  width="100%">

  <h2>'.$row['title'].'</h2>';

  $usersql = "SELECT * FROM UserList WHERE UUID = '$eventOwner'";
  $userResult = $conn->query($usersql);

  if($userResult->num_rows > 0){
    $userrow = $userResult->fetch_assoc();
    echo '<a>Hosted by: </a><a href="../user.php?u='.$userrow['UUID'].'">'.$userrow['FIRSTNAME'].' '.$userrow['LASTNAME'].'</a>';
  }
  echo '
  <div id="eventDate">'.
  $eventDateStart->format("M d H:i a").
  '<br>To<br>'.
  $eventDateEnd->format("M d H:i a").
  '</div>

  <div id="eventDetails">
  <h2>Details</h2>'.
  $row['description'].

  '<div id="eventInstructions">
  <h2>Special Requests/Instructions</h2>'.
  $row['specialInstructions'].

  '<h2>Location</h2>
  <div id="map_div" style="height: 200px;"></div>';
}

 ?>
