<?php 
    include_once 'dbConfig.php';
		$message = "";

		$row= $_POST['row'];
		$frm_no = $_POST['frm_no'];
		$ay = $_POST['ay'];
		$sem = $_POST['sem'];
		
		$resFrm =mysqli_query($mysqli, "SELECT * from evaluation_form where frm_no = '$frm_no' and ay = '$ay' and  sem = '$sem'");
		if($rFrm = mysqli_fetch_assoc($resFrm)){
			$message = 'formError';
		}else{
			$updatequery = "UPDATE evaluation_form SET frm_no = '$frm_no', ay = '$ay', sem = '$sem' WHERE row = '$row'";
			mysqli_query($mysqli,$updatequery);
			$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Evaluation Form Successfully Updated!</div>';
		}
	echo $message;
	mysqli_close($mysqli);
 ?>