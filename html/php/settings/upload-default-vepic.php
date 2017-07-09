<?php
include("../auth.php");
if(isset($_POST['imagebase64'])){
    $data = $_POST['imagebase64'];

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);

    $data = base64_decode($data);
    $d=uniqid();
    file_put_contents('../../uploads/vehicles/'.$d.'.png', $data);
    echo json_encode($d);

    $carHash = substr($_POST['vehicleID'], 0,strrpos($_POST['vehicleID'], "."));
	// Create connection
	$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
    $sql = "UPDATE `Cars` SET `PHOTO`='$d.png' WHERE `HASH` = '$carHash'";
    
    $result = $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
        echo "Settings saved successfully";
        echo "Error: " . $sql . "<br>" . $conn->error;

    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


}
?>