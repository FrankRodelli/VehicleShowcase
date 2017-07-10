<?php
include('../auth.php');

$loggedinuser = $_SESSION["token"];

$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

$sql = "INSERT INTO `IsFollowing` (`USER`, `FOLLOWING`) VALUES ('$loggedinuser','$username')";
$result = $conn->query($sql);
}
?>