<head>
</head>
<body>

<form method="POST" name="search">
<input type="text" name="search_term" placeholder="search_term">
<input name="submit" type="submit" value="Submit" />
</form>


</body>

<?php

$conn = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Users');
$i == 0;
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
if(isset($_POST['submit'])){
// get the search term which was posted. 
	$searchterm = $conn->real_escape_string($_POST['search_term']);
//if the someone searches something, check it via their first name. 
$sql = "SELECT * FROM `UserList` WHERE FIRSTNAME='$searchterm' OR LASTNAME='$searchterm'";
$result = $conn->query($sql);
if($result->num_rows == 1){

$row = $result->fetch_assoc();
echo $row["FIRSTNAME"];
echo "  ";
echo $row["LASTNAME"];
}elseif($result->num_rows > 0){
	echo 'two people, thanks frank';
	while($row = $result->fetch_assoc()) {
    		echo "Result " + i + "of " + $result->num_rows;

    		echo $row["FIRSTNAME"];
echo "  ";
echo $row["LASTNAME"];
$i++;
    	}
}else{
	echo 'no results found';
}

}
		?>
