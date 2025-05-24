<?php
	include_once 'dbConfig.php';
	$row = $_POST['row'];
	$position = $_SESSION['position'];
	if(!empty($_FILES["image"]["tmp_name"])){
		$fileinfo=PATHINFO($_FILES["image"]["name"]);
		$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
		move_uploaded_file($_FILES["image"]["tmp_name"],"photo/" . $newFilename);
		$location="photo/" . $newFilename;
		
		if($position == "Super Administrator")
			$updatequery = "UPDATE superadmin SET image = '$location' WHERE row = '$row'";
		else if($position == "Administrator")
			$updatequery = "UPDATE admin SET image = '$location' WHERE row = '$row'";
		else if($position == "Supervisor")
			$updatequery = "UPDATE supervisor SET image = '$location' WHERE row = '$row'";
		else if($position == "Student")
			$updatequery = "UPDATE student SET image = '$location' WHERE row = '$row'";
		
		mysqli_query($mysqli,$updatequery);
	
		echo "<script>location.replace('home.php');</script>";
	}else{
		echo "<script>alert('No Photo selected.');</script>";
	}
?>