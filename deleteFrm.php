<?php 
	include_once 'dbConfig.php';
	require_once('loginSession.php');
	
	$message = "";
	$row = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['row']));
	$stmt = mysqli_stmt_init($mysqli);

	mysqli_stmt_prepare($stmt, "SELECT * FROM category WHERE frm_no = ?");
	mysqli_stmt_bind_param($stmt, 's', $row);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	if($r = mysqli_fetch_assoc($result)){
		$row_cat = $r['row'];
		if(mysqli_num_rows($result) > 0){

			mysqli_stmt_prepare($stmt, "DELETE FROM form WHERE row= ?");
			mysqli_stmt_bind_param($stmt, 's', $row);
			mysqli_stmt_execute($stmt);

			mysqli_stmt_prepare($stmt, "DELETE FROM question WHERE cat_no = ?");
			mysqli_stmt_bind_param($stmt, 's', $row_cat);
			mysqli_stmt_execute($stmt);

			mysqli_stmt_prepare($stmt, "DELETE FROM category WHERE frm_no= ?");
			mysqli_stmt_bind_param($stmt, 's', $row);
			mysqli_stmt_execute($stmt);			
		}
	}else{
		mysqli_stmt_prepare($stmt, "DELETE FROM form WHERE row= ?");
		mysqli_stmt_bind_param($stmt, 's', $row);
		mysqli_stmt_execute($stmt);

		mysqli_stmt_prepare($stmt, "DELETE FROM question WHERE cat_no = ?");
		mysqli_stmt_bind_param($stmt, 's', $row_cat);
		mysqli_stmt_execute($stmt);

		mysqli_stmt_prepare($stmt, "DELETE FROM category WHERE frm_no= ?");
		mysqli_stmt_bind_param($stmt, 's', $row);
		mysqli_stmt_execute($stmt);
	}
	$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Form Deleted!</div>';

	echo $message;
	mysqli_close($mysqli);
 ?>

