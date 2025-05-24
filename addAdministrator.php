<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
		$message = "";

		$user = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['user']));
		$pass = stripcslashes(mysqli_real_escape_string($mysqli, md5(trim($_POST['pass']))));
		$fn = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['fn']));
		$mn = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['mn']));
		$ln = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['ln']));
		$position = stripcslashes(mysqli_real_escape_string($mysqli, 'Administrator'));
		$image = stripcslashes(mysqli_real_escape_string($mysqli, 'None'));
		$yr = stripcslashes(mysqli_real_escape_string($mysqli, date('Y')));
		$sem = stripcslashes(mysqli_real_escape_string($mysqli, 'First Semester'));
		$stmt =mysqli_stmt_init($mysqli);
		
		if(mysqli_stmt_prepare($stmt, "SELECT * from superadmin where user = ? ")){ 
			mysqli_stmt_bind_param($stmt, 's', $user);
			mysqli_stmt_execute($stmt); 
			$result = mysqli_stmt_get_result($stmt);
			if($r = mysqli_fetch_assoc($result)){
				$message = 'userError';
			}
			else if(mysqli_stmt_prepare($stmt, "SELECT * from admin where user = ? ")){
				mysqli_stmt_bind_param($stmt, 's', $user);
				mysqli_stmt_execute($stmt); 
				$result = mysqli_stmt_get_result($stmt);
				if($r = mysqli_fetch_assoc($result)){
					$message = 'userError';
				}
				else if(mysqli_stmt_prepare($stmt, "SELECT * from supervisor where user = ? ")){
					mysqli_stmt_bind_param($stmt, 's', $user);
					mysqli_stmt_execute($stmt); 
					$result = mysqli_stmt_get_result($stmt);
					if($r = mysqli_fetch_assoc($result)){
						$message = 'userError';
					}
					else if(mysqli_stmt_prepare($stmt, "SELECT * from student where user = ? ")){
						mysqli_stmt_bind_param($stmt, 's', $user);
						mysqli_stmt_execute($stmt); 
						$result = mysqli_stmt_get_result($stmt);
						if($r = mysqli_fetch_assoc($result)){
							$message = 'userError';
						}
						else{ 
							if(mysqli_stmt_prepare($stmt, "INSERT INTO admin(user,pass,fn,mn,ln,position,image,ay,sem) 
									 VALUES (?,?,?,?,?,?,?,?,?)")) {
								mysqli_stmt_bind_param($stmt, 'sssssssss', $user, $pass, $fn, $mn, $ln, $position, $image, $ay, $sem);
								mysqli_stmt_execute($stmt);
								$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Administrator Successfully Created!</div>';
							}else{
								$message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong!</div>';
							}
						}
					}
				}
			}
		}
		
	echo $message;
	mysqli_close($mysqli);
 ?>