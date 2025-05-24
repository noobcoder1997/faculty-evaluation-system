<?php 
    include_once 'dbConfig.php';
		$message = "";

		$row= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['row']));
		$position = $_SESSION['position'];
		$pass = stripcslashes(mysqli_real_escape_string($mysqli, md5(trim($_POST['pass']))));
		$stmt = mysqli_stmt_init($mysqli);

		if($position == "Super Administrator"){
			mysqli_stmt_prepare($stmt, "UPDATE superadmin SET pass = ? WHERE row = ?");
			mysqli_stmt_bind_param($stmt, 'ss', $pass, $row);
			mysqli_stmt_execute($stmt);
		}
		else if($position == "Administrator"){
			mysqli_stmt_prepare($stmt, "UPDATE admin SET pass = ? WHERE row = ?");
			mysqli_stmt_bind_param($stmt, 'ss', $pass, $row);
			mysqli_stmt_execute($stmt);
		}
		else if($position == "Supervisor"){
			mysqli_stmt_prepare($stmt, "UPDATE supervisor SET pass = ? WHERE row = ?");
			mysqli_stmt_bind_param($stmt, 'ss', $pass, $row);
			mysqli_stmt_execute($stmt);
		}
		else if($position == "Student"){
			mysqli_stmt_prepare($stmt, "UPDATE supervisor SET pass = ? WHERE row = ?");
			mysqli_stmt_bind_param($stmt, 'ss', $pass, $row);
			mysqli_stmt_execute($stmt);
		}
		$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password Successfully Changed!</div>';
		
	echo $message;
	mysqli_close($mysqli);
 ?>