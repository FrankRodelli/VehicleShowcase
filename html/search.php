<head>
</head>
<body>

<form method="post" name="search">
<input type="text" name="search_term" placeholder="search_term">
<input name="submit" type="submit" value="Submit" />
</form>


</body>

<?php

$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
if(isset($_POST['submit']{
echo 'is it working?';
}
		?>
