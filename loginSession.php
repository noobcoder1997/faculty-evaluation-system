<?php 
	if(!isset($_SESSION['userStatus'])){
		header('location: index.php');
	}
	date_default_timezone_set('Asia/Manila');
 ?>