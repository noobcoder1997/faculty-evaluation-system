<?php 
    include_once 'dbConfig.php';
		$message = "";

		$row= stripcslashes(mysqli_real_escape_string($mysqli, $_POST['row']));
		$img= stripcslashes(mysqli_real_escape_string($mysqli, ''));
		$position = $_SESSION['position'];
		$stmt = mysqli_stmt_init($mysqli);

		if($position == "Super Administrator"){
			mysqli_stmt_prepapre($stmt, "UPDATE superadmin SET image = ? WHERE row = ?");
			mysqli_stmt_bind_param($stmt, 'ss', $img, $row);
			mysqli_stmt_execute($stmt);
		}
		else if($position == "Administrator"){
			mysqli_stmt_prepapre($stmt, "UPDATE admin SET image = ? WHERE row = ?");
			mysqli_stmt_bind_param($stmt, 'ss', $img, $row);
			mysqli_stmt_execute($stmt);
		}
		else if($position == "Supervisor"){
			mysqli_stmt_prepapre($stmt, "UPDATE supervisor SET image = ? WHERE row = ?");
			mysqli_stmt_bind_param($stmt, 'ss', $img, $row);
			mysqli_stmt_execute($stmt);
		}
		else if($position == "Student"){
			$mysqli_stmt_prepapre($stmt, "UPDATE student SET image = ? WHERE row = ?");
			mysqli_stmt_bind_param($stmt, 'ss', $img, $row);
			mysqli_stmt_execute($stmt);
		}
		$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Photo Successfully Removed!</div>';
		
	echo $message;
	mysqli_close($mysqli);
 ?>