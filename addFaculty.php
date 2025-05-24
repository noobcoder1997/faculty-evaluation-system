<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
		$message = "";

		$id = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['id']));
		$fn = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['fn']));
		$mn = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['mn']));
		$ln = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['ln']));
		$dept = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['dept']));
		$rank = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['rank']));
		$position = stripcslashes(mysqli_real_escape_string($mysqli, 'Faculty'));
		$image = stripcslashes(mysqli_real_escape_string($mysqli, 'None'));
		$stmt = mysqli_stmt_init($mysqli);		
		
		mysqli_stmt_prepare($stmt, "SELECT * from faculty where id = ?");
		mysqli_stmt_bind_param($stmt, 's', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if($r = mysqli_fetch_assoc($result)){
			$message = 'idError';
		}else{
			if(mysqli_stmt_prepare($stmt, "INSERT INTO `faculty`(id,fn,mn,ln,dept,rank,position,image) 
					 VALUES (?,?,?,?,?,?,?,?)")) {
				mysqli_stmt_bind_param($stmt, 'ssssssss', $id, $fn, $mn, $ln, $dept, $rank, $position, $image);
				mysqli_stmt_execute($stmt);				
				$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Faculty Successfully Created!</div>';
			}else{
				$message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong!</div>';
			}
		}
		
		
	echo $message;
	mysqli_close($mysqli);
 ?>