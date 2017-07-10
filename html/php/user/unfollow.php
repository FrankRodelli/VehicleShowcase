<?php
include('../auth.php');

$loggedinuser = $_SESSION["token"];
$username = $_POST['username'];
echo $username;

$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

$sql = "DELETE FROM `IsFollowing` WHERE 'USER' = '$loggedinuser' AND 'FOLLOWING' = '$username'";
$result = $conn->query($sql);
echo mysqli_error($conn);
?>