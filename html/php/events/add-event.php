<?php

include('../auth.php');

// Create connection
$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

$eventID = uniqid();
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$description = $_POST['desc'];
$location = $_POST['location'];
$owner = $_SESSION['token'];
$specialInstructions = $_POST['specialin'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `Events` (`id`, `title`, `start`,`end`,`description`,
  `location`,`owner`,`specialInstructions`)
  VALUES ('$eventID',)";


 ?>
