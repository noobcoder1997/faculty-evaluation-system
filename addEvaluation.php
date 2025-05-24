<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
		$message = "";

		$frm_no = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['frm_no']));
		$ay = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['ay']));
		$sem = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['sem']));
		$stmt = mysqli_stmt_init($mysqli);

		mysqli_stmt_prepare($stmt, "SELECT * from evaluation_form where frm_no = ? and ay = ? and  sem = ?");
		mysqli_stmt_bind_param($stmt, 'sss', $frm_no, $ay, $sem);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if($r = mysqli_fetch_assoc($result)){
			$message = 'formError';
		}else{
			if(mysqli_stmt_prepare($stmt, "INSERT INTO evaluation_form (frm_no,ay,sem) 
					 VALUES ('','$ay','$sem')")) {
				mysqli_stmt_bind_param($stmt, 'sss', $frm_no, $ay, $sem);
				mysqli_stmt_execute($stmt);
				$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Evaluation Form Successfully Added!</div>';
			}else{
				$message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong!</div>';
			}
		}
		
	echo $message;
	mysqli_close($mysqli);
 ?>