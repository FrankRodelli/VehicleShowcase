<?php

$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Events WHERE title != ''";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc() === TRUE){
    echo $row['title'];
    echo 'anything';
  }
}else{
  echo 'no events';
}

echo 'at the end';

 ?>
