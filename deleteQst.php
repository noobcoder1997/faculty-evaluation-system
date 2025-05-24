<?php 
	include_once 'dbConfig.php';
	require_once('loginSession.php');
	
	$message = "";
	$row = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['row']));
	$stmt = mysqli_stmt_init($mysqli);

	mysqli_stmt_prepare($stmt, "DELETE FROM question WHERE row= ?");
	mysqli_stmt_bind_param($stmt, 's', $row);
	mysqli_stmt_execute($stmt);	$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Question Deleted!</div>';
	
	echo $message;
	mysqli_close($mysqli);
 ?>

