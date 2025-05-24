<?php 
    include_once 'dbConfig.php';
		$message = "";

        $row= $_POST['row'];
        $fn= $_POST['fn'];
		$mn= $_POST['mn'];
		$ln= $_POST['ln'];
		$ext= $_POST['ext'];
		$designation= $_POST['designationCom'];
		$period= $_POST['periodCom'];
//		$rank= $_POST['rank'];

//        $resFrm = mysqli_query($mysqli, "SELECT * from committee where row = '$row' and designation = 'Member' and period = '$period'");
//        $rowFrm = mysqli_fetch_assoc($resFrm);
//        
//        $resF = mysqli_query($mysqli, "SELECT * from faculty where row = '$row' ");
//        $r = mysqli_fetch_assoc($resF);
//        $r1 = $r['fn'];    
        
//        if(($fn == $rowFrm['fn'] || $designation == 'Member' && mysqli_num_rows($resFrm) == 2) || ($fn == $rowFrm['fn'] || ($designation <> 'Member' && mysqli_num_rows($resFrm) == 1))){
//            
//            $message = 'multiMemberError';
//        }else
        if(empty($fn) || empty($ln) || empty($mn)  || empty($ext) /*||  empty($rank)*/ && (empty($designation) || empty($period)) ){
           
            $message = 'isEmpty';
        }else{
            
            $updatequery = "UPDATE `committee` SET `fn`='$fn',`mn`='$mn',`ln`='$ln',`ext`='$ext',`period`='$period' WHERE row = '$row'";
            
            mysqli_query($mysqli,$updatequery);
            $message = '<div class="alert alert-success alert-block alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Committee Personnel Successfully Updated!</div>';
        }
//    }
		
	echo $message;
	mysqli_close($mysqli);
 ?>