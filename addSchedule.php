<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
		$message = "";

		$frm_no= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['frm_no']));
		$stud_no= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['stud_no']));
		$ay = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['ay']));
		$sem = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['sem']));
		$fac_no = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['checkid']));
		
		$fac_exp = explode(" ", $fac_no);
		$coutArray = count($fac_exp);
		
		$query = "";
		
		for($x = 0; $x < $coutArray; $x++){
			if($x == 0)
				$query = "('$frm_no','$stud_no','$ay','$sem','".$fac_exp[$x]."')";
			else
				$query = $query.",('$frm_no','$stud_no','$ay','$sem','".$fac_exp[$x]."')";
		}
		
		$addForm=("INSERT INTO `schedule`(frm_no,stud_no,ay,sem,fac_no) 
					 VALUES $query"); 
		
		$run_query = mysqli_query($mysqli,$addForm);
		if($run_query) {
			$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Schedule Successfully Added!</div>';
		}else{
			$message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong!</div>';
		}
		
	echo $message;
	mysqli_close($mysqli);
 ?>