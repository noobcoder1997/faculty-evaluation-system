<?php 
    include_once 'dbConfig.php';
		$message = "";

		$row= $_POST['row'];
		$frm_name = $_POST['frm_name'];
		$resForm =mysqli_query($mysqli, "SELECT * from form where frm_name = '$frm_name'");
		if($rfrm = mysqli_fetch_assoc($resForm)){
			$message = 'formError';
		}else{
			$updatequery = "UPDATE form SET frm_name = '$frm_name' WHERE row = '$row'";
			mysqli_query($mysqli,$updatequery);
			$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Form Updated!</div>';
		}
	echo $message;
	mysqli_close($mysqli);
 ?>