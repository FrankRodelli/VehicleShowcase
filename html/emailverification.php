<?php

    $conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
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
        //Check if credentials match database and login accordingly
        $sql = "SELECT * FROM UserList WHERE VERIFICATIONLINKCODE = '$emailcode'";

        //set querry data to result variable
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
                    $cookie = $row['UUID'];
                    $_SESSION['token'] = $cookie;
                    $sql = "UPDATE UserList SET VERIFICATIONLINKCODE='NULL' WHERE VERIFICATIONLINKCODE = '$emailcode'";
                    $result = $conn->query($sql);
                    if($result->num_rows == 1){
                        echo 'You are logged in, you will be redirected to our home page in 5 seconds, if not, click <a href="../index.php"> this link</a>';
                        header( "refresh:5;url=index.php" );
                    }else{
                        echo 'A error has occured, please contact support for more information';
                        echo "Error: " . $sql . "<br>" . $conn->error;

                    }
        }else{
            echo 'A problem has occured, please contact our support.';
        }

        ?>
