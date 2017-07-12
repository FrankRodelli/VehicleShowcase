<?php
		if($_POST['carHash'] != ""){
			$carHash = $_POST['carHash'];
		}

		$connone = new mysqli('localhost', 'root', 'f44V3A0i4RYLv^xI$VI2@d4f' , 'Vehicles');
		$sql = "SELECT * FROM PhotoLink WHERE UNAME = '$carHash'";
		$result = $connone->query($sql);

		echo '<div class="form-style-2-heading">Photos</div>';

		if ($result->num_rows > 0) {
				
		    // output data of each row
				$photoCounter = 0;
		    while($row = $result->fetch_assoc()) {
		    	echo '<a href="#" onclick="photoSelected(';
		    	echo "'".$row['FNAME']."','photo".$photoCounter."'";
		    	echo ')"><div id="photo'.$photoCounter.'" class="photo-container"><img src="uploads/vehicles/'.$row['FNAME'].'"></div></a>';
		    	$photoCounter++;
		    }
		    echo '
		    <br>
			<button onclick="setDefault()">Set Default</button><button>Delete</button><br>
			<form method="POST" id="vepics" enctype="multipart/form-data">
			<input name="image[]" id="files" type="file" multiple>
			<input type="hidden" name="carID" value="'.$carHash.'">
			</form>
			<label for="files">Upload a Photo..</label>
			<output id="list"></output>

			<div id="upload-container">
			</div>

			<div id="croppie-container">
			<div id="demo-basic">
			<button class="basic-result">Save</button>
			</div>
			</div>';
		}else{
			echo '
			<a>You have no pictures uploaded!</a>
			<form method="POST" id="vepics" enctype="multipart/form-data">
			<input name="image[]" id="files" type="file" multiple>
			<input type="hidden" name="carID" value="'.$carHash.'">
			</form><label for="files">Upload a Photo..</label>
			<output id="list"></output>
			<div id="upload-container">
			</div>';
		}



?>