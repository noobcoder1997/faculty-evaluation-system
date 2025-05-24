<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
		$message = "";

		$frm_name= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['frm_name']));
		$stmt = mysqli_stmt_init($mysqli);

		mysqli_stmt_prepare($stmt, "SELECT * from form where frm_name = ? ");
		mysqli_stmt_bind_param($stmt, 's', $frm_name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if($rFrm = mysqli_fetch_assoc($result)){
			$message = 'formError';
		}else{
			if(mysqli_stmt_prepare($stmt, "INSERT INTO form(frm_name) VALUES (?)")) {
				mysqli_stmt_bind_param($stmt, 's', $frm_name);
				mysqli_stmt_execute($stmt);
				$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Form Created!</div>';
			}else{
				$message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong!</div>';
			}
		}
		
		
	echo $message;
	mysqli_close($mysqli);
 ?>