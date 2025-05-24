<?php 
    include_once 'dbConfig.php';
		$message = "";

		$position = $_SESSION['position'];
		$row = $_SESSION['row'];
		$ay= $_POST['ay'];
		$sem= $_POST['sem'];
		
		if($position == "Super Administrator")
			$updatequery = "UPDATE superadmin SET ay = '$ay', sem = '$sem' WHERE row = '$row'";
		else if($position == "Administrator")
			$updatequery = "UPDATE admin SET ay = '$ay', sem = '$sem' WHERE row = '$row'";
		else if($position == "Supervisor")
			$updatequery = "UPDATE supervisor SET ay = '$ay', sem = '$sem' WHERE row = '$row'";
		else if($position == "Student")
			$updatequery = "UPDATE student SET ay = '$ay', sem = '$sem' WHERE row = '$row'";
		
		mysqli_query($mysqli,$updatequery);
			
	mysqli_close($mysqli);
 ?>