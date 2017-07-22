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
  echo '<img src="
  http://moxiefestival.com/wp-content/uploads/2013/01/CarShowField.jpg"
  width="100%"><h2>'
  .$row['title'].'</h2>'
  .$row['start'];

}

 ?>
