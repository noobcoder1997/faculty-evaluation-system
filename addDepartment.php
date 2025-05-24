<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
		$message = "";

		$dptno = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['dptno']));
		$dscrpt = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['dscrpt']));
		$email = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['email']));
		$contact = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['contact']));
		$stmt = mysqli_stmt_init($mysqli);

		mysqli_stmt_prepare($stmt, "SELECT * from department where dptno = ? ");
		mysqli_stmt_bind_param($stmt, 's', $dptno);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if($r = mysqli_fetch_assoc($result)){
			$message = 'dptnoError';
		}else if(mysqli_stmt_prepare($stmt, "SELECT * from department where dscrpt = ? ")){
			mysqli_stmt_bind_param($stmt, 's', $dscrpt);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($r = mysqli_fetch_assoc($result)){
				$message = 'dscrptError';
			}else{
				if(mysqli_stmt_prepare($stmt, "INSERT INTO department(dptno,dscrpt,email,contact) 
						 VALUES (?,?,?,?)")) {
					mysqli_stmt_bind_param($stmt, 'ssss', $dptno, $dscrpt, $email, $contact);
					mysqli_stmt_execute($stmt);
					$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Department Successfully Created!</div>';
				}else{
					$message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong!</div>';
				}
			}
		}
		
		
	echo $message;
	mysqli_close($mysqli);
 ?>