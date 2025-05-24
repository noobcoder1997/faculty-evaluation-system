<?php
	include_once 'dbConfig.php';
	
	$message = '<div class="alert alert-danger alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<span class="glyphicon glyphicon-warning-sign"></span>&nbsp;Incorrect Username or Password!
				</div>'; 
	
	$user = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['user']));
	$pass = stripcslashes(mysqli_real_escape_string($mysqli, md5(trim($_POST['pass']))));
	$stmt = mysqli_stmt_init($mysqli);
	
	try {
		if (mysqli_stmt_prepare($stmt, "SELECT * FROM superadmin WHERE user = ? AND pass = ? ")) {
			mysqli_stmt_bind_param($stmt, 'ss', $user, $pass);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($r = mysqli_fetch_array($result)){
				$_SESSION['row'] = $r['row'];
				$_SESSION['position'] = $r['position'];
				$_SESSION['userStatus'] = true;
				$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Successfully Login!</div>';
			}
			else if (mysqli_stmt_prepare($stmt, "SELECT * FROM admin WHERE user = ? AND pass = ? ")) {
				mysqli_stmt_bind_param($stmt, 'ss', $user, $pass);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if ($r = mysqli_fetch_array($result)){
					$_SESSION['row'] = $r['row'];
					$_SESSION['position'] = $r['position'];
					$_SESSION['userStatus'] = true;
					$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Successfully Login!</div>';
				}
				else if (mysqli_stmt_prepare($stmt, "SELECT * FROM supervisor WHERE user = ? AND pass = ? ")) {
					mysqli_stmt_bind_param($stmt, 'ss', $user, $pass);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if ($r = mysqli_fetch_array($result)){
						$_SESSION['row'] = $r['row'];
						$_SESSION['position'] = $r['position'];
						$_SESSION['userStatus'] = true;
						$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Successfully Login!</div>';
					}
					else if (mysqli_stmt_prepare($stmt, "SELECT * FROM student WHERE user = ? AND pass = ? ")) {
						mysqli_stmt_bind_param($stmt, 'ss', $user, $pass);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						if ($r = mysqli_fetch_array($result)){
							$_SESSION['row'] = $r['row'];
							$_SESSION['position'] = $r['position'];
							$_SESSION['userStatus'] = true;
							$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Successfully Login!</div>';
						}
						else{
							throw new Exception ($message);
						}
					}
				}
			}
		}
	}catch(Exception $e){
		$e->getMessage();
	}
		
	echo $message;
	mysqli_close($mysqli);	
?>