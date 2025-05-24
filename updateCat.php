<?php 
    include_once 'dbConfig.php';
		$message = "";

		$row= $_POST['row'];
		$frm_no= $_POST['frm_no'];
		$cat_name= $_POST['cat_name'];
		
		$resFrm =mysqli_query($mysqli, "SELECT * from category where cat_name = '$cat_name' and frm_no = '$frm_no' and row <> '$row'");
		if($rFrm = mysqli_fetch_assoc($resFrm)){
			$message = 'catError';
		}else{
			$updatequery = "UPDATE category SET frm_no = '$frm_no',cat_name = '$cat_name' WHERE row = '$row'";
			mysqli_query($mysqli,$updatequery);
			$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Category Updated!</div>';
		}
	echo $message;
	mysqli_close($mysqli);
 ?>