<?php
			// Get username
			$loggedinuser = $_SESSION['token'];

			// Create connection
			$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

			// Check connection
			if ($conn->connect_error) {
		    	die("Connection failed: " . $conn->connect_error);
		    }

		    //Check if credentials match database and login accordingly
			$sql = "SELECT * FROM UserList WHERE UUID = '$loggedinuser'";

			//set querry data to result variable
			$result = $conn->query($sql);

			//If there are results, run
			if($result->num_rows == 1){
				//Assigns row data to $row array
				$row = $result->fetch_assoc();

				echo '<div id="user-header">
				<a class="propic-click" href ="../user.php/?u='.$loggedinuser .'">
				<img class="propic-header" src="../uploads/users/'.$row["PICTURE"].'" height="30px"></a>
				<a>Welcome '. $row["FIRSTNAME"] . '!</a>
				<img id="propic" class="menu-icon" src="../images/menu.png">
				</div>

			<div id="popout-menu" style="display: none;">
				<ul class="popout-menu-ul">
					<li><a href="../mycars.php" accesskey="1" title="">My Vehicles</a></li>
					<li><a href="../add.php" accesskey="2" title="">Add Vehicles</a></li>
					<li><a href="../user.php/?u='.$loggedinuser .'" accesskey="3" title="">Profile</a></li>
					<li><a href="../settings.php" accesskey="4" title="">Settings</a></li>
					<li><a href="logout.php" accesskey="5" title="">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>';
}else{
	die($sql);
}
?>