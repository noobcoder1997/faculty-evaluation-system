<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
	
		$row = $_POST['checkid'];
		$row_exp = explode(" ", $row);
		$coutArray = count($row_exp);
		
		$query = "";
		
		for($x = 0; $x < $coutArray; $x++){
			if($x == 0)
				$query = "'".$row_exp[$x]."'";
			else
				$query = $query.",'".$row_exp[$x]."'";
		}
		
		$deletequery = "DELETE FROM schedule WHERE row in ($query)";
			mysqli_query($mysqli,$deletequery);
		
	mysqli_close($mysqli);
 ?>