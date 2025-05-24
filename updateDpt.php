<?php 
    include_once 'dbConfig.php';
		$message = "";

		$row= $_POST['row'];
		$dptno = $_POST['dptno'];
		$dscrpt = $_POST['dscrpt'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		
		$updatequery = "UPDATE department SET dptno = '$dptno', dscrpt = '$dscrpt', email = '$email', contact = '$contact' WHERE row = '$row'";
		mysqli_query($mysqli,$updatequery);
		$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Department Successfully Updated!</div>';
		
	echo $message;
	mysqli_close($mysqli);
 ?>