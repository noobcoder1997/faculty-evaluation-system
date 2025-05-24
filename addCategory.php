<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
		$message = "";

		$frm_no = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['frm_no']));
		$cat_name = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['cat_name']));
		$stmt = mysqli_stmt_init($mysqli);

		mysqli_stmt_prepare($stmt, "SELECT * from category where cat_name = ? and frm_no = ?");
		mysqli_stmt_bind_param($stmt, 'ss', $cat_name, $frm_no);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if($r = mysqli_fetch_assoc($result)){
			$message = 'catError';
		}else{
			if(mysqli_stmt_prepare($stmt, "INSERT INTO category (frm_no,cat_name) 
					 VALUES (?, ?)")) {
				mysqli_stmt_bind_param($stmt, 'ss',$frm_no, $cat_name);
				mysqli_stmt_execute($stmt);
				$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Form Created!</div>';
			}else{
				$message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong!</div>';
			}
		}
		
		
	echo $message;
	mysqli_close($mysqli);
 ?>