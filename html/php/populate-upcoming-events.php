<?php

$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Events LIMIT 7";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo '<ul>';
  while($row = $result->fetch_assoc()){
    $eventDateStart = date_create($row['start']);

    echo '<li class="eventLI"><div id="eventDateList"><a id="monthDate">'.
    $eventDateStart->format("F").'</a><a id="dayDate">'.
    $eventDateStart->format("d").
    '</a></div><a id="eventListTitle" href="../event.php?e='.
    $row['id'].'">'.$row['title'].'</a></li>';
  }
  echo '</ul>';
}else{
}

 ?>
