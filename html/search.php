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
echo 'Result 1 of 1';
//link the users user page, so they can see any cars with this person
echo '<a href="../user.php/?u='. $row["UUID"] .'" title=""> ';
echo $row["FIRSTNAME"];
echo "  ";
echo $row["LASTNAME"];
//echo first and last names
echo '</a>';
echo "<br>";
}elseif($result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		$i++;
		//if there's more than one name, while loop it
    		echo 'Result ' . $i . ' of ' . $result->num_rows . ' ';
    		echo '<a href="../user.php/?u='. $row["UUID"] .'" title=""> ';
    		echo $row["FIRSTNAME"];
echo "  ";
echo $row["LASTNAME"];
// echo names, and link it.
echo '</a>';
echo "<br>";
    	}
}else{
	
echo "No results found";


}

}
		?>
