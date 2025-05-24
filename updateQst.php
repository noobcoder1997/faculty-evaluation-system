<?php 
    include_once 'dbConfig.php';
		$message = "";

		$row= $_POST['row'];
		$cat_no= $_POST['cat_no'];
		$question= $_POST['question'];
		$arrngmnt= $_POST['arrngmnt'];
		
		$resFrm =mysqli_query($mysqli, "SELECT * from question where cat_no = '$cat_no' and question = '$question' and row <> '$row'");
		$resFrm2 =mysqli_query($mysqli, "SELECT * from question where cat_no = '$cat_no' and arrngmnt = '$arrngmnt'");
		if($rFrm = mysqli_fetch_assoc($resFrm)){
			$message = 'qstError';
		}else if($rFrm2 = mysqli_fetch_assoc($resFrm2)){
			$message = 'arrError';
		}else{
			$updatequery = "UPDATE question SET cat_no = '$cat_no', question = '$question', arrngmnt = '$arrngmnt' WHERE row = '$row'";
			mysqli_query($mysqli,$updatequery);
			$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Question Updated!</div>';
		}
	echo $message;
	mysqli_close($mysqli);
 ?>