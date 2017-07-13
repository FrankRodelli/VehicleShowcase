<?php
include("../auth.php");
if(isset($_POST['imagebase64'])){
    $data = $_POST['imagebase64'];

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);

    $data = base64_decode($data);
    $d=uniqid();
    file_put_contents('../../uploads/users/'.$d.'.png', $data);
    echo json_encode($d);

     //Add photo to user entry
    $username = $_SESSION['token'];
	// Create connection
	$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
    $sql = "UPDATE `UserList` SET `PICTURE`='$d.png' WHERE `UUID` = '$username'";

    $result = $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
        echo "Settings saved successfully";

    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


}
?>
