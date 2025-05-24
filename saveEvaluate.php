<?php 
    include_once 'dbConfig.php';
	require_once('loginSession.php');
	date_default_timezone_set('Asia/Manila');
	
	$position = $_SESSION['position'];
	$message = "";
	$shed_no = $_GET['id'];
	$evaluator_nosp = $_POST['evaluator_no'];
	$fac_no = $_POST['fac_no'];
	$evaluator_no = $_POST['evaluator_no'];
    $eval = $_POST['eval'];
	
	$comment = $_POST['comment'];
	$commentText = $comment;
	$dCount = 0;
	$temp = "";
	$rate = "";
	$key = "";
	$posData = 0;
	$neuData = 0;
	$negData = 0;
	$position = "";
	
	$resSchedRecord =mysqli_query($mysqli, "SELECT * from schedule where row = '$shed_no'");
	if ($rER = mysqli_fetch_assoc($resSchedRecord)){
		$resQuestdata =mysqli_query($mysqli, "SELECT * from question order by cat_no asc, arrngmnt asc");
		while ($quest = mysqli_fetch_assoc($resQuestdata)){
			$resCategorydata =mysqli_query($mysqli, "SELECT * from category where row = '".$quest['cat_no']."'	");
			if ($category = mysqli_fetch_assoc($resCategorydata)){
				$resFormdata =mysqli_query($mysqli, "SELECT * from form where row = '".$rER['frm_no']."'");
				if ($form = mysqli_fetch_assoc($resFormdata)){
					$resCateQuestdata =mysqli_query($mysqli, "SELECT * from question where cat_no = '".$category['row']."'");
					if ($getQ = mysqli_fetch_assoc($resCateQuestdata)){
						$dCount++;
						$temp = $quest['row'];
						if($dCount == 1)
							$rate = $_POST['quest'.$temp];
						else
							$rate = $rate.",".$_POST['quest'.$temp];
					}
				}
			}
		}
	}
	
	if($comment != ""){
		$compound = 0;
		$data = str_replace(' ', '_', $comment);
		$output = shell_exec("python lexicon.py"." ".$data);
		$output = str_replace('{', '', $output);
		$output = str_replace('}', '', $output);
		$outputArray = explode(', ', $output);
		$outputCount = count($outputArray);
		$neg = explode(' ', $outputArray[0]);
		$neu = explode(' ', $outputArray[1]);
		$pos = explode(' ', $outputArray[2]);
		$negative = $neg[1];
		$neutral = $neu[1];
		$positive = $pos[1];
		$posData = $neg[1]*100;
		$neuData = $neu[1]*100;
		$negData = $pos[1]*100;
		$setimentArray = array(""=>0,"Negative"=>$negative,"Neutral"=>$neutral,"Positive"=>$positive);
		$setimentPercent = array(0=>0,$negative=>$negative,$neutral=>$neutral,$positive=>$positive);
		
		$value = max($setimentArray);
		$key = array_search($value, $setimentArray);
		
		$valuePercent = max($setimentPercent);
		$keyPercent = array_search($valuePercent, $setimentPercent);
	}else{
		$keyPercent = 0;
		$key = "Neutral (Empty)";
	}
	
	$myRate = $rate;
	$myArray = explode(',', $myRate);
	$coutArray = count($myArray);
	$tempString = "";
	$averateRate = 0;
	for($x = 0; $x < $coutArray; $x++){
		$temp = explode(' ', $myArray [$x]);
		if($x == 0)
			$tempString = $temp[1];
		else
			$tempString = $tempString.",".$temp[1];
	}
	$arrayRate = explode(',', $tempString);
	for($x = 0; $x < $coutArray; $x++){
		$averateRate += (int)$arrayRate[$x];
	}
								
	$comment = ($keyPercent*100)."% $key";
	$rateComputation = ($averateRate/100*36);
	if($eval == 0){
        $position = "Student";
		$rateComputation = ($averateRate/100*36);
        
        $addForm=("INSERT INTO `evaluate` (evaluator_no,fac_no,shed_no,rate,points,comment,lexicon,dateEval) 
         VALUE('$evaluator_no','$fac_no','$shed_no','$rate','$rateComputation','$commentText','$comment','".date('Y-m-d')."' )");
        	$run_query = mysqli_query($mysqli,$addForm);
            if($run_query) {
                $message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Successfully Evaluated!</div>';
            }else{
                $message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$mysqli -> error.'</div>';
            }
	}else{
        $position = "Supervisor";
		$rateComputation = ($averateRate/100*24);
        
         $addForm=("INSERT INTO `evaluate` (evaluator_no,fac_no,shed_no,rate,points,comment,lexicon,dateEval) 
         VALUE('$evaluator_no','$fac_no','$shed_no','$rate','$rateComputation','$commentText','$comment','".date('Y-m-d')."' )");
        $run_query = mysqli_query($mysqli,$addForm);
        if($run_query) {
            $message = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Successfully Evaluated!</div>';
        }else{
            $message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$mysqli -> error.'</div>';
        }
	}
//	if($eval == 0){
//        $addForm=("INSERT INTO `evaluate` (evaluator_no,fac_no,shed_no,rate,points,comment,lexicon,dateEval) 
//         VALUE('$evaluator_no','$fac_no','$shed_no','$rate','$rateComputation','$commentText','$comment','".date('Y-m-d')."' )");
//    }if($eval == 1){
//        $addForm=("INSERT INTO `evaluate` (evaluator_no,fac_no,shed_no,rate,points,comment,lexicon,dateEval) 
//         VALUE('$evaluator_nosp','$fac_no','$shed_no','$rate','$rateComputation','$commentText','$comment','".date('Y-m-d')."' )");
//    }
	 


	echo $message;
	mysqli_close($mysqli);
 ?>