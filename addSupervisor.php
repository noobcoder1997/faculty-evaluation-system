<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
		$message = "";

		$user= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['user']));
		$pass = stripcslashes(mysqli_real_escape_string($mysqli, md5(trim($_POST['pass']))));
		$fac_no= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['fac']));
        $signature = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['signature']));
		$position = stripcslashes(mysqli_real_escape_string($mysqli, 'Supervisor'));
		$image = stripcslashes(mysqli_real_escape_string($mysqli, 'None'));
		$ay = stripcslashes(mysqli_real_escape_string($mysqli, date('Y')));
		$sem = stripcslashes(mysqli_real_escape_string($mysqli, 'All'));
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
							if(mysqli_stmt_prepare($stmt, "INSERT INTO `supervisor`(user,pass,fac_no,position,image,ay,sem,signature) VALUES (?,?,?,?,?,?,?,?)")) {
								mysqli_stmt_bind_param($stmt, 'ssssssss', $user,$pass,$fac_no,$position,$image,$ay,$sem,$signature);
								mysqli_stmt_execute($stmt);	 	
								$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Supervisor Successfully Created!</div>';
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