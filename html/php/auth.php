<?php
/*
Author: Javed Ur Rehman
Website: https://htmlcssphptutorial.wordpress.com
*/
?>

<?php
session_start();
if(!isset($_SESSION["token"])){
header("Location: ../login.php");
exit(); }
?>
