<?php 
	include_once 'dbConfig.php';
	require_once('loginSession.php');
	
	$row = $_POST['row'];
	$message = "";
	
	$resDelReport =mysqli_query($mysqli, "SELECT * from schedule where row ='".$_POST['row']."'");
	while ($rDR = mysqli_fetch_assoc($resDelReport)){
		$resDel =mysqli_query($mysqli, "SELECT * from evaluate where shed_no ='".(int)$rDR['row']."'");
		if ($rD = mysqli_fetch_assoc($resDel)){
			$message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Schedule already been rated!</div>';
		}else{
			$deletequery = "DELETE FROM schedule WHERE row='$row'";
			mysqli_query($mysqli,$deletequery);
			$message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Schedule Deleted!</div>';
		}
	}
	
	echo $message;
	mysqli_close($mysqli);
 ?>

