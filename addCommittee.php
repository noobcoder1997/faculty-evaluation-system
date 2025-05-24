<?php 
    include_once 'dbConfig.php';
    $message = "";
    error_reporting(0);
    $position = $_SESSION['position'];
    $row = $_SESSION['row'];
    
    $perNo = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['perNo']));
    $fn0 = stripcslashes(mysqli_real_escape_string($mysqli, strtoupper($_POST['fn'])));
    $mn0 = stripcslashes(mysqli_real_escape_string($mysqli, strtoupper($_POST['mn'])));
    $ln0 = stripcslashes(mysqli_real_escape_string($mysqli, strtoupper($_POST['ln'])));
    $ext = stripcslashes(mysqli_real_escape_string($mysqli, strtoupper($_POST['ext'])));
    $designation = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['designationCom']));
    $period = stripcslashes(mysqli_real_escape_string($mysqli, $_POST['periodCom']));
    // $stmt = mysqli_stmt_init($mysqli);

    $resFrm = mysqli_query($mysqli, "SELECT * from committee where designation = '$designation' and period = '$period' ");
    $resFrm1 = mysqli_query($mysqli, "SELECT * from committee");
    $r1 = mysqli_fetch_assoc($resFrm1);
    $r0 = $r1['fn'];
    $resF = mysqli_query($mysqli, "SELECT * from faculty where row = '$perNo' ");
    $r = mysqli_fetch_assoc($resF);
    $r1 = $r['fn'];
        
        if(($r1==$r0 || ($designation == 'Member' && mysqli_num_rows($resFrm) == 2)) || ($r1==$r0 || $designation <> 'Member' && mysqli_num_rows($resFrm) == 1)){
           
            $message = 'multiMemberError';
        }else{
            if(empty($perNo)) { // empty(perNo) manual add data
                if(empty($fn0) || empty($ln0) || empty($ext) && (empty($designation) || empty($period)) ){// way sud tanan fields

                    $message = 'isEmpty';
                }
                else{

                    $addForm =("INSERT INTO `committee`(`fn`, `mn`, `ln`, `ext`, `designation`, `period`) 
                     VALUE ('$fn0','$mn0','$ln0','$ext','$designation','$period')");                 

                    $run_query = mysqli_query($mysqli,$addForm);

                    if($run_query) {
                        $message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Committee Personnel Added!</div>';
                    }else{
                        $message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong!</div>';
                    }                        
                }
            }else{ // !empty(perNo) sa Select tag nag base sa data
                if(!empty($fn0) || empty($designation) || empty($period) ){

                    $message = 'isEmpty';
                }else{   

                    {
                        $resfac = mysqli_query($mysqli, "SELECT * from faculty where row = '$perNo' ");
                        $rowfac = mysqli_fetch_assoc($resfac);            
                        $fn1 = strtoupper($rowfac['fn']);
                        $mn1 = strtoupper($rowfac['mn']);
                        $ln1 = strtoupper($rowfac['ln']);
                        
                        $addForm=("INSERT INTO `committee`(`fn`, `mn`, `ln`, `ext`, `designation`, `period`) 
                         VALUE ('$fn1','$mn1','$ln1','$ext','$designation','$period')");                 

                        $run_query = mysqli_query($mysqli,$addForm);

                        if($run_query) {
                            $message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Committee Personnel Added!</div>';
                        }else{
                            $message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Something went wrong!</div>';
                        }
                    }
                }
            }
        }

	echo $message;
	mysqli_close($mysqli);
 ?>