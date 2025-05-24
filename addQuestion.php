<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
		$message = "";

		$cat_no= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['cat_no']));
		$question= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['question']));
		$arrngmnt= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['arrngmnt']));
		$stmt = mysqli_stmt_init($mysqli);	
		
		if(mysqli_stmt_prepare($stmt, "SELECT * from question where question = ? and cat_no = ?")){
			mysqli_stmt_bind_param($stmt, 'ss', $question, $cat_no);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($r = mysqli_fetch_assoc($result)){
				$message = 'qstError';
			}
			else if(mysqli_stmt_prepare($stmt, "SELECT * from question where cat_no = ? and arrngmnt = ?")){
				mysqli_stmt_bind_param($stmt, 'ss', $cat_no, $arrngmnt);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if($r = mysqli_fetch_assoc($result)){
					$message = 'arrError';
				}
				else{
					if(mysqli_stmt_prepare($stmt, "INSERT INTO question (cat_no,question,arrngmnt) VALUES (?,?,?)")) {
						mysqli_stmt_bind_param($stmt, 'sss', $cat_no, $question, $arrngmnt);
						mysqli_stmt_execute($stmt);
						$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Question Created!</div>';
					}else{
						$message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong!</div>';
					}
				}
			}
		}
		
	echo $message;
	mysqli_close($mysqli);
 ?>