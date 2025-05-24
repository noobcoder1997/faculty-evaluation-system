<?php 
    include_once 'dbConfig.php';
		$message = "";

		$row= $_POST['row'];
		$id= $_POST['id'];
		$fn = $_POST['fn'];
		$mn = $_POST['mn'];
		$ln = $_POST['ln'];
		$dept = $_POST['dept'];
		$rank = $_POST['rank'];
		
		$resAdmn2 =mysqli_query($mysqli, "SELECT * from faculty where id = '$id' and row <> '$row'");
		if($rAdm2 = mysqli_fetch_assoc($resAdmn2)){
			$message = 'idError';
		}else{
			$updatequery = "UPDATE faculty SET id = '$id', fn = '$fn', mn = '$mn', ln = '$ln', dept = '$dept', rank = '$rank' WHERE row = '$row'";
		
			mysqli_query($mysqli,$updatequery);
			$message = '<div class="alert alert-success alert-block alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Account Successfully Updated!</div>';
		}
		
	echo $message;
	mysqli_close($mysqli);
 ?>