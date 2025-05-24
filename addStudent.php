<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
		$message = "";

		$user= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['user']));
		$pass = stripcslashes(mysqli_real_escape_string($mysqli, md5(trim($_POST['pass']))));
		$id= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['id']));
		$fn = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['fn']));
		$mn = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['mn']));
		$ln = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['ln']));
		$dept = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['dept']));
		$signature = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['signature']));
		$position = stripcslashes(mysqli_real_escape_string($mysqli, 'Student'));
		$sem = stripcslashes(mysqli_real_escape_string($mysqli, 'All'));
		$image = stripcslashes(mysqli_real_escape_string($mysqli, 'None'));
		$yr = stripcslashes(mysqli_real_escape_string($mysqli, date('Y')));
		$stmt = mysqli_stmt_init($mysqli);

		if(mysqli_stmt_prepare($stmt, "SELECT * from superadmin where user = ?")){
			mysqli_stmt_bind_param($stmt, 's', $user);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($r = mysqli_fetch_assoc($result)){
				$message = 'userError';
			}
			else if(mysqli_stmt_prepare($stmt, "SELECT * from admin where user = ?")){
				mysqli_stmt_bind_param($stmt, 's', $user);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if($r = mysqli_fetch_assoc($result)){
					$message = 'userError';
				}
				else if(mysqli_stmt_prepare($stmt, "SELECT * from supervisor where user = ?")){
					mysqli_stmt_bind_param($stmt, 's', $user);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if($r = mysqli_fetch_assoc($result)){
						$message = 'userError';
					}
					else if(mysqli_stmt_prepare($stmt, "SELECT * from student where user = ?")){
						mysqli_stmt_bind_param($stmt, 's', $user);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						if($r = mysqli_fetch_assoc($result)){
							$message = 'userError';
						}
						else{
							mysqli_stmt_prepare($stmt, "SELECT * from student where id = ? ");
							mysqli_stmt_bind_param($stmt, 's', $id);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							if($r = mysqli_fetch_assoc($result)){
								$message = 'idError';
							}else{
								if(mysqli_stmt_prepare($stmt, "INSERT INTO student(user,pass,id,fn,mn,ln,dept,position,image,ay,sem,signature) 
										 VALUES (?,?,?,?,?,?,?,?,?,?,?,?)")) {
									mysqli_stmt_bind_param($stmt, 'ssssssssssss', $user, $pass, $id, $fn, $mn, $ln, $dept, $position, $image, $yr, $sem, $signature);
									mysqli_stmt_execute($stmt);
									$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Student Successfully Created!</div>';
								}else{
									$message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong, maybe the signature is too large!</div>';
								}
							}
						}
					}
				}
			}
		}
		
	echo $message;
	mysqli_close($mysqli);
 ?>