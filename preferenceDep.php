<?php 
    include_once 'dbConfig.php';
		$position = $_SESSION['position'];
		$row = $_SESSION['row'];
		
		$ay= $_POST['ay'];
		$department= $_POST['department'];
		
		if($position == "Super Administrator")
			$updatequery = "UPDATE superadmin SET period = '$ay', department = '$department' WHERE row = '$row'";
		else if($position == "Administrator")
			$updatequery = "UPDATE admin SET period = '$ay', department = '$department' WHERE row = '$row'";
		else if($position == "Supervisor")
			$updatequery = "UPDATE supervisor SET period = '$ay' WHERE row = '$row'";
		
		mysqli_query($mysqli,$updatequery);
			
	mysqli_close($mysqli);
 ?>