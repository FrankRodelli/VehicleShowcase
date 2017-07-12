<?php
include("../auth.php");

if(isset($_FILES['image'])){

   $total = count($_FILES['image']['name']);
      $errors= array();
      for($i=0; $i<$total; $i++) {

      $file_name = $_FILES['image']['tmp_name'][$i];
      $file_size = $_FILES['image']['size'][$i];
      $file_tmp = $_FILES['image']['tmp_name'][$i];
      $file_type = $_FILES['image']['type'][$i];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'][$i])));
      $filename = uniqid();
      $temp = explode(".", $_FILES["image"]["name"][$i]);
	  $newfilename = $filename . '.' . end($temp);
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {

        //move_uploaded_file($file_tmp,"uploads/images/".$file_name);
        move_uploaded_file($_FILES['image']['tmp_name'][$i], "uploads/vehicles/" . $newfilename);

        // Create connection
		$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$date = date("Y/m/d");
		$sql = "INSERT INTO `Photos` (`NAME`, `DATE`) VALUES ('$newfilename','$date')";

		if ($conn->query($sql) === TRUE) {
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO `PhotoLink` (`UNAME`, `FNAME`) VALUES ('ofwg','$newfilename')";

		if ($conn->query($sql) === TRUE) {
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

      }else{
         print_r($errors);
      }
   }
}
	
?>

