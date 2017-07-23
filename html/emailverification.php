<?php

    $conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //check if blocked
        $loginip = $conn->real_escape_string($_SERVER['REMOTE_ADDR']);
        $checkifblocked = "SELECT * FROM Blocked WHERE IP = '$loginip'";
        $blockedresult = $conn->query($checkifblocked);
        if($blockedresult->num_rows == 1){
            $row = $blockedresult->fetch_assoc();
            if($row[Blocked] == 1){
            header("Location: blocked.php");
            }
        }

    $emailcode = $conn->real_escape_string($_GET['v']);

    $sql = "SELECT * FROM UserList WHERE VERIFICATIONLINKCODE = '$emailcode'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $uuid = $row['UUID'];

    $sql = "UPDATE `UserList` SET VERIFIEDEMAIL = 1 WHERE VERIFICATIONLINKCODE = '$emailcode'";
    if($conn->query($sql) === TRUE){
        header("Location: index.php#welcome");

    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>
