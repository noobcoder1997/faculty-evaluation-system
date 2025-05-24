<?php 
    include_once 'dbConfig.php';
		$message = "";

		$row= $_POST['row'];
		$user= $_POST['user'];
		$pass = md5(trim($_POST['pass']));
        $signature = $_POST['signature'];
		$fac = $_POST['fac'];
		
		$resAdmn1 =mysqli_query($mysqli, "SELECT * from superadmin where user = '$user' and row <> '$row'");
		$resAdmn2 =mysqli_query($mysqli, "SELECT * from admin where user = '$user' and row <> '$row'");
		$resAdmn3 =mysqli_query($mysqli, "SELECT * from supervisor where user = '$user' and row <> '$row'");
		$resAdmn4 =mysqli_query($mysqli, "SELECT * from student where user = '$user' and row <> '$row'");
		if($rAdm = mysqli_fetch_assoc($resAdmn1)){
			$message = 'userError';
		}else if($rAdm = mysqli_fetch_assoc($resAdmn2)){
			$message = 'userError';
		}else if($rAdm = mysqli_fetch_assoc($resAdmn3)){
			$message = 'userError';
		}else if($rAdm = mysqli_fetch_assoc($resAdmn4)){
			$message = 'userError';
		}else{
			if($_POST['pass'] == "" || $_POST['pass'] == " "){
				$updatequery = "UPDATE supervisor SET user = '$user', fac_no = '$fac', signature = '$signature' WHERE row = '$row'";
			}else{
				$updatequery = "UPDATE supervisor SET user = '$user', pass = '$pass', fac_no = '$fac', signature = '$signature' WHERE row = '$row'";
			}
			mysqli_query($mysqli,$updatequery);
			$message = '<div class="alert alert-success alert-block alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Supervisor Successfully Updated!</div>';
		}
		
	echo $message;
	mysqli_close($mysqli);
 ?>