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

  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo $row['title'];

  }
}

 ?>
