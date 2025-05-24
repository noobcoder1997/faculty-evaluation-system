<?php 
    include_once 'dbConfig.php';
		$message = "";

		$row= $_POST['row'];
		$signature= $_POST['signature'];
		
		$updatequery = "UPDATE student SET signature = '$signature' WHERE row = '$row'";
		
		mysqli_query($mysqli,$updatequery);
			
	mysqli_close($mysqli);
 ?>