<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
	$row = $_SESSION['row'];
	$position = $_SESSION['position'];
	
	$resultIDs = "SELECT * FROM superadmin WHERE row='$row' AND position='$position';";
	$resultIDs .= "SELECT * FROM admin WHERE row='$row' AND position='$position';";
	$resultIDs .= "SELECT * FROM faculty JOIN supervisor ON supervisor.fac_no = faculty.row WHERE supervisor.row='$row' AND supervisor.position='$position';";

	if (mysqli_multi_query($mysqli, $resultIDs)) {
		do {
			if ($result = mysqli_store_result($mysqli)) {
				if ($rs = mysqli_fetch_array($result)){
					if($position == "Supervisor")
						$depart1 = $rs['dept'];
					else
						$depart1 = $rs['department'];
					
					$retPer = (int)$rs['period'];
					if($retPer == 0)
						$retPer = 2020;
					$sy = $retPer."-".($retPer+3);
					$ay1 = $retPer;
					$ay2 = $retPer+1;
					$ay3 = $retPer+2;
				}
				mysqli_free_result($result);
			}
		} while (mysqli_next_result($mysqli));
	}
	
					
	if($depart1 == ""){
		$resDepdata = mysqli_query($mysqli, "SELECT * from department");
		if ($rddata = mysqli_fetch_assoc($resDepdata)){
			$depart1 = $rddata['row'];
		}
	}
	$depart = "";
	$resDep0s=mysqli_query($mysqli, "SELECT * from department where row = '$depart1'");
	if($rd0 = mysqli_fetch_assoc($resDep0s)){
		$depart = $rd0['dptno'];
	}else{
		$depart = "All";
	}
?>
<div class="container">
	<div class="row" id="evalTable">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-9">
					<h3>Summary</h3>
				</div>
				<div class="col-md-3">
					<br/>
					<div class="col-md-12 label-warning preClass">
						Department: <?php echo $depart;?><br/>
						Rating Period: <?php echo $sy;?>  <span data-toggle='modal' data-target='#prefSUM' style='color: #5a8dee;'><span class='glyphicon glyphicon-edit'></span></span>
					</div>
				</div><br/>
			</div>
			<div class="table-responsive"><br/>
				<table id="datatableSummary" class="table table-bordered table-striped">
					<thead>
						<th></th>
						<th>Name</th>
						<th>Academic Rank</th>
						<th>Department</th>
						<th>Rating period</th>
					</thead>
					<tfoot>
						<th></th>
						<th>Name</th>
						<th>Academic Rank</th>
						<th>Department</th>
						<th>Rating period</th>
					</tfoot>
					<tbody>
					<?php
						$fac_no = "";
						if($depart1 == "All")
							$resFaculty1 = mysqli_query($mysqli, "SELECT * from faculty");
						else
							$resFaculty1 = mysqli_query($mysqli, "SELECT * from faculty where dept = '$depart1'");
						while ($rf = mysqli_fetch_assoc($resFaculty1)){
							$resReport = mysqli_query($mysqli, "SELECT * from evaluate WHERE fac_no = '".$rf['row']."'");
							while ($rRprt = mysqli_fetch_assoc($resReport)){
								$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt['shed_no']."' and (ay = '$ay1' or ay = '$ay2' or ay = '$ay3')");
								if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
									$rs1Rprt =mysqli_query($mysqli, "SELECT * from faculty where row = '".$rRprt['fac_no']."'");
									if ($rFac = mysqli_fetch_assoc($rs1Rprt)){
										$fac_no = $rf['row'];
									}
								}
							}
							
							if($fac_no != ""){
								$rateTemp = "";
								$countTemp = 0;
								$resReport = mysqli_query($mysqli, "SELECT * from evaluate WHERE fac_no = '".$rf['row']."'");
								while ($rRprt = mysqli_fetch_assoc($resReport)){
									$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt['shed_no']."' and (ay = '$ay1' or ay = '$ay2' or ay = '$ay3')");
									if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
										$rs1Rprt =mysqli_query($mysqli, "SELECT * from faculty where row = '".$rRprt['fac_no']."'");
										if ($rFac = mysqli_fetch_assoc($rs1Rprt)){
											$resformSum = mysqli_query($mysqli, "SELECT * from category where frm_no = '".$rRprt123['frm_no']."'");
											if ($rfs = mysqli_fetch_assoc($resformSum)){
												if($countTemp == 0){
													$rateTemp = $rRprt['rate'];
												}else{
													$rateTemp = $rateTemp.",".$rRprt['rate'];
												}
												$countTemp++;
											}
										}
									}
								}
								$percentCount = 0;
								$aveCount = 0;
								$resReport = mysqli_query($mysqli, "SELECT * from evaluate WHERE fac_no = '".$rf['row']."'");
								if ($rRprt = mysqli_fetch_assoc($resReport)){
									$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt['shed_no']."' and (ay = '$ay1' or ay = '$ay2' or ay = '$ay3')");
									if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
										$rdc = mysqli_query($mysqli, "SELECT * from category where frm_no = '".$rRprt123['frm_no']."'");
										while ($rc = mysqli_fetch_assoc($rdc)){
											$percentCount++;
										}
									}
								}
							
								if($percentCount != 0)
									$aveCount = 100/$percentCount;
								$oc = "";
								$od = "";
								$hr = "";
								$fp = "";
								$m1 = "";
								$m2 = "";
								$fy = "";
								
								$resCom = mysqli_query($mysqli, "SELECT * from committee where period = '$ay1'");
								while ($rc = mysqli_fetch_assoc($resCom)){
									if($rc['designation'] == "1")
										$fp = $rc['name'];
									if($rc['designation'] == "2")
										$hr = $rc['name'];
									if($rc['designation'] == "3")
										$od = $rc['name'];
									if($rc['designation'] == "4")
										$oc = $rc['name'];
									if($rc['designation'] == "5")
										$fy = $rc['name'];
									if($rc['designation'] == "6")
										$m1 = $rc['name'];
									if($rc['designation'] == "7")
										$m2 = $rc['name'];
								}
								
								?>
								<script>
								function downloadSummary<?php echo $rf['row'];?>(){
									var doc = new jsPDF("p","mm",[343, 216]);
									var axis = 0;
									doc.setFontSize(9);
									doc.setFontType("bold");
									doc.text("SOUTHERN LEYTE STATE UNIVERSITY - SAN JUAN CAMPUS", 108,15,'center');
									doc.setFontType("normal");
									doc.text("San Jose, San Juan, Southern Leyte",108,20,'center');
									doc.setFontType("bold");
									doc.text("The QCE of the NBC No. 461",108,30,'center');
									
									doc.setFontType("italic");
									doc.setTextColor(56,138,220);
								    doc.text("SUMMARY COMPUTATION FOR INSTRUCTION PER AREA OF EVALUATION",108,35,'center');
									
									doc.setTextColor(0,0,0);
									doc.setFontSize(9);
									doc.setFontType("normal");
									doc.text(30,45, "Rating Period:");
									doc.text(30,50, "Name of Faculty:");
									doc.text(30,55, "Academic Rank:");
									
									doc.setFontType("bold");
									doc.text(90,45, "<?php echo $ay1." - ".$ay3+1;?>");
									if("<?php echo $rf['mn'];?>" == ""){
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']);?>");
									}else{
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']." ".substr($rf['mn'], 0, 1));?>.");
									}
									doc.text(90,55, "<?php echo $rf['rank'];?>");
									
									doc.text("SUMMARY COMPUTATION PER AREA OF EVALUATION",108,63.5,'center');
									doc.setFontType("normal");
									doc.line(30,60, 186, 60);
									doc.line(30,65, 186, 65);
									doc.text(51,73.5, "Areas of Evaluation");
									doc.text(110,73.5, "Ave. Score");
									doc.text(133,73.5, "% (Percentage)");
									doc.text(165,73.5, "QCE Point");
									doc.line(30,75, 186, 75);
									<?php
									$rateSplit = explode(",",$rateTemp);
									$countsplit = count($rateSplit);
									$sAxis = 78.5;
									$hAxis = 80;
									$totalAve1 = 0;
									$rdc = mysqli_query($mysqli, "SELECT * from category");
									while ($rc = mysqli_fetch_assoc($rdc)){
										$tempHolder = 0;
										$countFA = 0;
										$rdct = mysqli_query($mysqli, "SELECT * from question where cat_no = '".$rc['row']."'");
										while ($rct = mysqli_fetch_assoc($rdct)){
											for($x = 0; $x < $countsplit; $x++){
												$temp = explode(' ', $rateSplit[$x]);
												if($rct['row'] == $temp[0]){
													$tempHolder += $temp[1];
													$countFA=$countFA+1;
												}
											}
										}
										$tempAverage = (($tempHolder/$countFA)/5)*$aveCount;
										$totalAve1 += $tempAverage;
										echo "doc.text(31,$sAxis, '".$rc['cat_name']."');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverage, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '".number_format((float)$aveCount, 2, '.', '')."');";
										echo "doc.text(168,$sAxis, '".number_format((float)$tempAverage, 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
									echo "doc.text(168,$sAxis, '".number_format((float)$totalAve1, 2, '.', '')."');";
									echo "doc.text(100,$sAxis, 'Total QCE Point');";
									echo "doc.line(30,$hAxis, 186, $hAxis);";
									echo "doc.line(30, 60, 30, $hAxis);";
									echo "doc.line(186, 60, 186, $hAxis);";
									
									echo "doc.line(106, 65, 106, ".($hAxis-5).");";
									echo "doc.line(130, 65, 130, ".($hAxis-5).");";
									echo "doc.line(159, 65, 159, $hAxis);";
									?>
									axis = <?php echo $sAxis;?>;
									
									doc.text(30,axis+15, "Checked and Reviewed by:");
									
									doc.setFontType("bold");
									doc.text("Institutional QCE Committee", 108,axis+25,'center');
									axis += 5;
									doc.text("<?php echo $oc;?>", 90,axis+35,'right');
									doc.text("<?php echo $hr;?>", 90,axis+65,'right');
									doc.text("<?php echo $m1;?>", 90,axis+95,'right');
									
									doc.text(128,axis+35, "<?php echo $od;?>");
									doc.text(128,axis+65, "<?php echo $fp;?>");
									doc.text(128,axis+95, "<?php echo $m2;?>");
									
									doc.setFontType("normal");
									<?php
                                        
                                        $resCom0 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 163");
                                        $resCom1 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 167");
                                        $resCom2 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        $resCom3 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 166");
                                        $resCom4 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 164");
                                        $resCom5 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 165");
                                
                                        if($rowCom = mysqli_fetch_assoc($resCom0)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom1)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+70,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom2)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+100,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom3)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom4)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+70,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom5)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."',150,axis+100,'center');"; 
                                        }
                                
								    ?>
                                
									doc.text("Date:______________________", 90,axis+45,'right');
									doc.text("Date:______________________", 90,axis+75,'right');
									doc.text("Date:______________________", 90,axis+105,'right');
									doc.text(128,axis+45, "Date:______________________");
									doc.text(128,axis+75, "Date:______________________");
									doc.text(128,axis+105, "Date:______________________");
									
									doc.text("Conforme:", 108,axis+120,'center');
                                    <?php
                                        $resCom = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        if($rowCom = mysqli_fetch_assoc($resCom)){
                                            $name  = strtoupper($rf['fn'].", ".$rf['ln']);
                                            echo "doc.text('".$name."', 108,axis+130,'center');"; 
                                        }
                                    ?>
									doc.text("Faculty", 108,axis+135,'center');
									doc.text("Date:______________________", 108,axis+140,'center');
									
									doc.setFontType("bold");
									doc.text("<?php echo $fy;?>", 108,axis+130,'center');
									
									// PAGE 2 // PAGE 2 // PAGE 2 // PAGE 2 // PAGE 2 // PAGE 2 // PAGE 2 // PAGE 2 //
									
									doc.addPage();
									axis = 0;
									
									doc.setFontSize(9);
									doc.setFontType("bold");
									doc.text("SOUTHERN LEYTE STATE UNIVERSITY - SAN JUAN CAMPUS", 108,15,'center');
									doc.setFontType("normal");
									doc.text("San Jose, San Juan, Southern Leyte",108,20,'center');
									doc.setFontType("bold");
									doc.text("The QCE of the NBC No. 461",108,30,'center');
									
									doc.setFontType("italic");
									doc.setTextColor(56,138,220);
									doc.text("SUMMARY OF COMPUTATION OF TWO EVALUATORS",108,35,'center');
									
									doc.setTextColor(0,0,0);
									doc.setFontSize(9);
									doc.setFontType("normal");
									doc.text(30,45, "Rating Period:");
									doc.text(30,50, "Name of Faculty:");
									doc.text(30,55, "Academic Rank:");
									
									doc.setFontType("bold");
									doc.text(90,45, "<?php echo $ay1." - ".$ay3+1;?>");
									if("<?php echo $rf['mn'];?>" == ""){
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']);?>");
									}else{
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']." ".substr($rf['mn'], 0, 1));?>.");
									}
									doc.text(90,55, "<?php echo $rf['rank'];?>");
									
									doc.text("SUMMARY OF COMPUTATION OF TWO EVALUATORS",108,63.5,'center');
									doc.setFontType("normal");
									doc.line(30,60, 186, 60);
									doc.line(30,65, 186, 65);
									doc.text(51,73.5, "Areas of Evaluation");
									doc.text(110,73.5, "Ave. Score");
									doc.text(133,73.5, "% (Percentage)");
									doc.text(165,73.5, "QCE Point");
									doc.line(30,75, 186, 75);
									<?php
									$sAxis = 78.5;
									$hAxis = 80;
										
									$rateTempStudent = "";
									$rateTempFaculty = "";
									$countTemp2 = 0;
									$countTemp3 = 0;
									
									
									$rdsc = mysqli_query($mysqli, "SELECT * from student");
									while ($rsc = mysqli_fetch_assoc($rdsc)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and (ay = '$ay1' or ay = '$ay2' or ay = '$ay3')");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp2 == 0){
													$rateTempStudent = $rRprt1['rate'];
												}else{
													$rateTempStudent = $rateTempStudent.",".$rRprt1['rate'];
												}
												$countTemp2++;
											}
										}
									}
									
									$rdsc2 = mysqli_query($mysqli, "SELECT * from faculty");
									while ($rsc2 = mysqli_fetch_assoc($rdsc2)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc2['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and (ay = '$ay1' or ay = '$ay2' or ay = '$ay3')");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp3 == 0){
													$rateTempFaculty = $rRprt1['rate'];
												}else{
													$rateTempFaculty = $rateTempFaculty.",".$rRprt1['rate'];
												}
												$countTemp3++;
											}
										}
									}
									
									if($countTemp2 == 0){
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}else{
										
										$rateStudentSplit = explode(",",$rateTempStudent);
										$countstudsplit = count($rateStudentSplit);
										$countFS = 0;
										$tempSudent = 0;
										
										
										for($x = 0; $x < $countstudsplit; $x++){
											$temp = explode(' ', $rateStudentSplit[$x]);
											$tempSudent += $temp[1];
											$countFS++;
										}
										
										$tempAverageStudent = (($tempSudent/$countFS)/5)*100;
										
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageStudent, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
										
									if($countTemp3 == 0){
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										
										$sAxis += 5;
										$hAxis += 5;
									}else{
										$rateFacultySplit = explode(",",$rateTempFaculty);
										$countfactsplit = count($rateFacultySplit);
										$countFF = 0;
										$tempFaculty = 0;
										
										for($y = 0; $y < $countfactsplit; $y++){
											$temp2 = explode(' ', $rateFacultySplit[$y]);
											$tempFaculty += $temp2[1];
											$countFF++;
										}
									
										$tempAverageFaculty = (($tempFaculty/$countFF)/5)*100;
										
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageFaculty, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
									if($countTemp3 == 0 && $countTemp2 == 0)
										echo "doc.text(168,$sAxis, ' 0');";
									else if($countTemp3 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
									else if($countTemp2 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
									else
										echo "doc.text(168,$sAxis, '".number_format((float)(($tempAverageFaculty*0.4)+($tempAverageStudent*0.6)), 2, '.', '')."');";
									echo "doc.text(100,$sAxis, 'Total QCE Point');";
									echo "doc.line(30,$hAxis, 186, $hAxis);";
									echo "doc.line(30, 60, 30, $hAxis);";
									echo "doc.line(186, 60, 186, $hAxis);";
									
									echo "doc.line(106, 65, 106, ".($hAxis-5).");";
									echo "doc.line(130, 65, 130, ".($hAxis-5).");";
									echo "doc.line(159, 65, 159, $hAxis);";
									
									?>
									axis = <?php echo $sAxis;?>;
									
									doc.text(30,axis+15, "Checked and Reviewed by:");
									
									doc.setFontType("bold");
									doc.text("Institutional QCE Committee", 108,axis+25,'center');
									axis += 5;
									doc.text("<?php echo $oc;?>", 90,axis+35,'right');
									doc.text("<?php echo $hr;?>", 90,axis+65,'right');
									doc.text("<?php echo $m1;?>", 90,axis+95,'right');
									
									doc.text(128,axis+35, "<?php echo $od;?>");
									doc.text(128,axis+65, "<?php echo $fp;?>");
									doc.text(128,axis+95, "<?php echo $m2;?>");
									
									doc.setFontType("normal");
									<?php
                                        
                                        $resCom0 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 163");
                                        $resCom1 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 167");
                                        $resCom2 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        $resCom3 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 166");
                                        $resCom4 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 164");
                                        $resCom5 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 165");
                                
                                        if($rowCom = mysqli_fetch_assoc($resCom0)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom1)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+70,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom2)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+100,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom3)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom4)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+70,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom5)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."',150,axis+100,'center');"; 
                                        }
                                
								    ?>
                                
									doc.text("Date:______________________", 90,axis+45,'right');
									doc.text("Date:______________________", 90,axis+75,'right');
									doc.text("Date:______________________", 90,axis+105,'right');
									doc.text(128,axis+45, "Date:______________________");
									doc.text(128,axis+75, "Date:______________________");
									doc.text(128,axis+105, "Date:______________________");
									
									doc.text("Conforme:", 108,axis+120,'center');
                                    <?php
                                        $resCom = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        if($rowCom = mysqli_fetch_assoc($resCom)){
                                            $name  = strtoupper($rf['fn'].", ".$rf['ln']);
                                            echo "doc.text('".$name."', 108,axis+130,'center');";  
                                        }
                                    ?>
									doc.text("Faculty", 108,axis+135,'center');
									doc.text("Date:______________________", 108,axis+140,'center');;
									
									doc.setFontType("bold");
									doc.text("<?php echo $fy;?>", 108,axis+130,'center');
									
									// PAGE 3 // PAGE 3 // PAGE 3 // PAGE 3 // PAGE 3 // PAGE 3 // PAGE 3 // PAGE 3 //
									
									doc.addPage();
									axis = 0;
									
									doc.setFontSize(9);
									doc.setFontType("bold");
									doc.text("SOUTHERN LEYTE STATE UNIVERSITY - SAN JUAN CAMPUS", 108,15,'center');
									doc.setFontType("normal");
									doc.text("San Jose, San Juan, Southern Leyte",108,20,'center');
									doc.setFontType("bold");
									doc.text("The QCE of the NBC No. 461",108,30,'center');
									
									doc.setFontType("italic");
									doc.setTextColor(56,138,220);
									doc.text("SUMMARY OF COMPUTATION FOR INSTRUCTION ARE PER RATING PERIOD",108,35,'center');
									
									doc.setTextColor(0,0,0);
									doc.setFontSize(9);
									doc.setFontType("normal");
									doc.text(30,45, "Rating Period:");
									doc.text(30,50, "Name of Faculty:");
									doc.text(30,55, "Academic Rank:");
									
									doc.setFontType("bold");
									doc.text(90,45, "<?php echo "1ST SEMESTER, ".$ay1."-".$ay2;?>");
									if("<?php echo $rf['mn'];?>" == ""){
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']);?>");
									}else{
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']." ".substr($rf['mn'], 0, 1));?>.");
									}
									doc.text(90,55, "<?php echo $rf['rank'];?>");
									
									doc.text("SUMMARY OF COMPUTATION OF TWO EVALUATORS",108,63.5,'center');
									doc.setFontType("normal");
									doc.line(30,60, 186, 60);
									doc.line(30,65, 186, 65);
									doc.text(51,73.5, "Areas of Evaluation");
									doc.text(110,73.5, "Ave. Score");
									doc.text(133,73.5, "% (Percentage)");
									doc.text(165,73.5, "QCE Point");
									doc.line(30,75, 186, 75);
									<?php
									$sAxis = 78.5;
									$hAxis = 80;
										
									$rateTempStudent = "";
									$rateTempFaculty = "";
									$countTemp2 = 0;
									$countTemp3 = 0;
									
									
									$rdsc = mysqli_query($mysqli, "SELECT * from student");
									while ($rsc = mysqli_fetch_assoc($rdsc)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay1' and sem = 'First Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp2 == 0){
													$rateTempStudent = $rRprt1['rate'];
												}else{
													$rateTempStudent = $rateTempStudent.",".$rRprt1['rate'];
												}
												$countTemp2++;
											}
										}
									}
									
									$rdsc2 = mysqli_query($mysqli, "SELECT * from faculty");
									while ($rsc2 = mysqli_fetch_assoc($rdsc2)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc2['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay1' and sem = 'First Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp3 == 0){
													$rateTempFaculty = $rRprt1['rate'];
												}else{
													$rateTempFaculty = $rateTempFaculty.",".$rRprt1['rate'];
												}
												$countTemp3++;
											}
										}
									}
									
									if($countTemp2 == 0){
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}else{
										
										$rateStudentSplit = explode(",",$rateTempStudent);
										$countstudsplit = count($rateStudentSplit);
										$countFS = 0;
										$tempSudent = 0;
										
										
										for($x = 0; $x < $countstudsplit; $x++){
											$temp = explode(' ', $rateStudentSplit[$x]);
											$tempSudent += $temp[1];
											$countFS++;
										}
										
										$tempAverageStudent = (($tempSudent/$countFS)/5)*100;
										
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageStudent, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
										
									if($countTemp3 == 0){
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										
										$sAxis += 5;
										$hAxis += 5;
									}else{
										$rateFacultySplit = explode(",",$rateTempFaculty);
										$countfactsplit = count($rateFacultySplit);
										$countFF = 0;
										$tempFaculty = 0;
										
										for($y = 0; $y < $countfactsplit; $y++){
											$temp2 = explode(' ', $rateFacultySplit[$y]);
											$tempFaculty += $temp2[1];
											$countFF++;
										}
									
										$tempAverageFaculty = (($tempFaculty/$countFF)/5)*100;
										
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageFaculty, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
									if($countTemp3 == 0 && $countTemp2 == 0)
										echo "doc.text(168,$sAxis, ' 0');";
									else if($countTemp3 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
									else if($countTemp2 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
									else
										echo "doc.text(168,$sAxis, '".number_format((float)(($tempAverageFaculty*0.4)+($tempAverageStudent*0.6)), 2, '.', '')."');";
									echo "doc.text(100,$sAxis, 'Total QCE Point');";
									echo "doc.line(30,$hAxis, 186, $hAxis);";
									echo "doc.line(30, 60, 30, $hAxis);";
									echo "doc.line(186, 60, 186, $hAxis);";
									
									echo "doc.line(106, 65, 106, ".($hAxis-5).");";
									echo "doc.line(130, 65, 130, ".($hAxis-5).");";
									echo "doc.line(159, 65, 159, $hAxis);";
									
									?>
									axis = <?php echo $sAxis;?>;
									
									doc.text(30,axis+15, "Checked and Reviewed by:");
									
									doc.setFontType("bold");
									doc.text("Institutional QCE Committee", 108,axis+25,'center');
									axis += 5;
									doc.text("<?php echo $oc;?>", 90,axis+35,'right');
									doc.text("<?php echo $hr;?>", 90,axis+65,'right');
									doc.text("<?php echo $m1;?>", 90,axis+95,'right');
									
									doc.text(128,axis+35, "<?php echo $od;?>");
									doc.text(128,axis+65, "<?php echo $fp;?>");
									doc.text(128,axis+95, "<?php echo $m2;?>");
									
									doc.setFontType("normal");
									<?php
                                        
                                        $resCom0 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 163");
                                        $resCom1 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 167");
                                        $resCom2 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        $resCom3 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 166");
                                        $resCom4 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 164");
                                        $resCom5 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 165");
                                
                                        if($rowCom = mysqli_fetch_assoc($resCom0)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom1)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+70,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom2)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+100,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom3)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom4)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+70,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom5)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."',150,axis+100,'center');"; 
                                        }
                                
								    ?>
                                
									doc.text("Date:______________________", 90,axis+45,'right');
									doc.text("Date:______________________", 90,axis+75,'right');
									doc.text("Date:______________________", 90,axis+105,'right');
									doc.text(128,axis+45, "Date:______________________");
									doc.text(128,axis+75, "Date:______________________");
									doc.text(128,axis+105, "Date:______________________");
									
									doc.text("Conforme:", 108,axis+120,'center');
                                    <?php
                                        $resCom = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        if($rowCom = mysqli_fetch_assoc($resCom)){
                                            $name  = strtoupper($rf['fn'].", ".$rf['ln']);
                                            echo "doc.text('".$name."', 108,axis+130,'center');";  
                                        }
                                    ?>
									doc.text("Faculty", 108,axis+135,'center');
									doc.text("Date:______________________", 108,axis+140,'center');
									
									doc.setFontType("bold");
									doc.text("<?php echo $fy;?>", 108,axis+130,'center');
									
									// PAGE 4 // PAGE 4 // PAGE 4 // PAGE 4 // PAGE 4 // PAGE 4 // PAGE 4 // PAGE 4 //
									
									doc.addPage();
									axis = 0;
									
									doc.setFontSize(9);
									doc.setFontType("bold");
									doc.text("SOUTHERN LEYTE STATE UNIVERSITY - SAN JUAN CAMPUS", 108,15,'center');
									doc.setFontType("normal");
									doc.text("San Jose, San Juan, Southern Leyte",108,20,'center');
									doc.setFontType("bold");
									doc.text("The QCE of the NBC No. 461",108,30,'center');
									
									doc.setFontType("italic");
									doc.setTextColor(56,138,220);
									doc.text("SUMMARY OF COMPUTATION FOR INSTRUCTION ARE PER RATING PERIOD",108,35,'center');
									
									doc.setTextColor(0,0,0);
									doc.setFontSize(9);
									doc.setFontType("normal");
									doc.text(30,45, "Rating Period:");
									doc.text(30,50, "Name of Faculty:");
									doc.text(30,55, "Academic Rank:");
									
									doc.setFontType("bold");
									doc.text(90,45, "<?php echo "2ND SEMESTER, ".$ay1."-".$ay2;?>");
									if("<?php echo $rf['mn'];?>" == ""){
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']);?>");
									}else{
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']." ".substr($rf['mn'], 0, 1));?>.");
									}
									doc.text(90,55, "<?php echo $rf['rank'];?>");
									
									doc.text("SUMMARY OF COMPUTATION OF TWO EVALUATORS",108,63.5,'center');
									doc.setFontType("normal");
									doc.line(30,60, 186, 60);
									doc.line(30,65, 186, 65);
									doc.text(51,73.5, "Areas of Evaluation");
									doc.text(110,73.5, "Ave. Score");
									doc.text(133,73.5, "% (Percentage)");
									doc.text(165,73.5, "QCE Point");
									doc.line(30,75, 186, 75);
									<?php
									$sAxis = 78.5;
									$hAxis = 80;
										
									$rateTempStudent = "";
									$rateTempFaculty = "";
									$countTemp2 = 0;
									$countTemp3 = 0;
									
									
									$rdsc = mysqli_query($mysqli, "SELECT * from student");
									while ($rsc = mysqli_fetch_assoc($rdsc)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay1' and sem = 'Second Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp2 == 0){
													$rateTempStudent = $rRprt1['rate'];
												}else{
													$rateTempStudent = $rateTempStudent.",".$rRprt1['rate'];
												}
												$countTemp2++;
											}
										}
									}
									
									$rdsc2 = mysqli_query($mysqli, "SELECT * from faculty");
									while ($rsc2 = mysqli_fetch_assoc($rdsc2)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc2['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay1' and sem = 'Second Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp3 == 0){
													$rateTempFaculty = $rRprt1['rate'];
												}else{
													$rateTempFaculty = $rateTempFaculty.",".$rRprt1['rate'];
												}
												$countTemp3++;
											}
										}
									}
									
									if($countTemp2 == 0){
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}else{
										
										$rateStudentSplit = explode(",",$rateTempStudent);
										$countstudsplit = count($rateStudentSplit);
										$countFS = 0;
										$tempSudent = 0;
										
										
										for($x = 0; $x < $countstudsplit; $x++){
											$temp = explode(' ', $rateStudentSplit[$x]);
											$tempSudent += $temp[1];
											$countFS++;
										}
										
										$tempAverageStudent = (($tempSudent/$countFS)/5)*100;
										
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageStudent, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
										
									if($countTemp3 == 0){
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										
										$sAxis += 5;
										$hAxis += 5;
									}else{
										$rateFacultySplit = explode(",",$rateTempFaculty);
										$countfactsplit = count($rateFacultySplit);
										$countFF = 0;
										$tempFaculty = 0;
										
										for($y = 0; $y < $countfactsplit; $y++){
											$temp2 = explode(' ', $rateFacultySplit[$y]);
											$tempFaculty += $temp2[1];
											$countFF++;
										}
									
										$tempAverageFaculty = (($tempFaculty/$countFF)/5)*100;
										
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageFaculty, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
									if($countTemp3 == 0 && $countTemp2 == 0)
										echo "doc.text(168,$sAxis, ' 0');";
									else if($countTemp3 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
									else if($countTemp2 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
									else
										echo "doc.text(168,$sAxis, '".number_format((float)(($tempAverageFaculty*0.4)+($tempAverageStudent*0.6)), 2, '.', '')."');";
									echo "doc.text(100,$sAxis, 'Total QCE Point');";
									echo "doc.line(30,$hAxis, 186, $hAxis);";
									echo "doc.line(30, 60, 30, $hAxis);";
									echo "doc.line(186, 60, 186, $hAxis);";
									
									echo "doc.line(106, 65, 106, ".($hAxis-5).");";
									echo "doc.line(130, 65, 130, ".($hAxis-5).");";
									echo "doc.line(159, 65, 159, $hAxis);";
									
									?>
									axis = <?php echo $sAxis;?>;
									
									doc.text(30,axis+15, "Checked and Reviewed by:");
									
									doc.setFontType("bold");
									doc.text("Institutional QCE Committee", 108,axis+25,'center');
									axis += 5;
									doc.text("<?php echo $oc;?>", 90,axis+35,'right');
									doc.text("<?php echo $hr;?>", 90,axis+65,'right');
									doc.text("<?php echo $m1;?>", 90,axis+95,'right');
									
									doc.text(128,axis+35, "<?php echo $od;?>");
									doc.text(128,axis+65, "<?php echo $fp;?>");
									doc.text(128,axis+95, "<?php echo $m2;?>");
									
									doc.setFontType("normal");
									
									<?php
                                        
                                        $resCom0 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 163");
                                        $resCom1 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 167");
                                        $resCom2 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        $resCom3 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 166");
                                        $resCom4 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 164");
                                        $resCom5 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 165");
                                
                                        if($rowCom = mysqli_fetch_assoc($resCom0)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom1)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+70,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom2)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+100,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom3)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom4)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+70,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom5)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."',150,axis+100,'center');"; 
                                        }
                                
								    ?>
                                
									doc.text("Date:______________________", 90,axis+45,'right');
									doc.text("Date:______________________", 90,axis+75,'right');
									doc.text("Date:______________________", 90,axis+105,'right');
									doc.text(128,axis+45, "Date:______________________");
									doc.text(128,axis+75, "Date:______________________");
									doc.text(128,axis+105, "Date:______________________");
									
									doc.text("Conforme:", 108,axis+120,'center');
                                    <?php
                                        $resCom = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        if($rowCom = mysqli_fetch_assoc($resCom)){
                                            $name  = strtoupper($rf['fn'].", ".$rf['ln']);
                                            echo "doc.text('".$name."', 108,axis+130,'center');"; 
                                        }
                                    ?>
									doc.text("Faculty", 108,axis+135,'center');
									doc.text("Date:______________________", 108,axis+140,'center');
									
									doc.setFontType("bold");
									doc.text("<?php echo $fy;?>", 108,axis+130,'center');
									
									// PAGE 5 // PAGE 5 // PAGE 5 // PAGE 5 // PAGE 5 // PAGE 5 // PAGE 5 // PAGE 5 //
									
									doc.addPage();
									axis = 0;
									
									doc.setFontSize(9);
									doc.setFontType("bold");
									doc.text("SOUTHERN LEYTE STATE UNIVERSITY - SAN JUAN CAMPUS", 108,15,'center');
									doc.setFontType("normal");
									doc.text("San Jose, San Juan, Southern Leyte",108,20,'center');
									doc.setFontType("bold");
									doc.text("The QCE of the NBC No. 461",108,30,'center');
									
									doc.setFontType("italic");
									doc.setTextColor(56,138,220);
									doc.text("SUMMARY OF COMPUTATION FOR INSTRUCTION ARE PER RATING PERIOD",108,35,'center');
									
									doc.setTextColor(0,0,0);
									doc.setFontSize(9);
									doc.setFontType("normal");
									doc.text(30,45, "Rating Period:");
									doc.text(30,50, "Name of Faculty:");
									doc.text(30,55, "Academic Rank:");
									
									doc.setFontType("bold");
									doc.text(90,45, "<?php echo "1ST SEMESTER, ".$ay2."-".$ay3;?>");
									if("<?php echo $rf['mn'];?>" == ""){
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']);?>");
									}else{
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']." ".substr($rf['mn'], 0, 1));?>.");
									}
									doc.text(90,55, "<?php echo $rf['rank'];?>");
									
									doc.text("SUMMARY OF COMPUTATION OF TWO EVALUATORS",108,63.5,'center');
									doc.setFontType("normal");
									doc.line(30,60, 186, 60);
									doc.line(30,65, 186, 65);
									doc.text(51,73.5, "Areas of Evaluation");
									doc.text(110,73.5, "Ave. Score");
									doc.text(133,73.5, "% (Percentage)");
									doc.text(165,73.5, "QCE Point");
									doc.line(30,75, 186, 75);
									<?php
									$sAxis = 78.5;
									$hAxis = 80;
										
									$rateTempStudent = "";
									$rateTempFaculty = "";
									$countTemp2 = 0;
									$countTemp3 = 0;
									
									
									$rdsc = mysqli_query($mysqli, "SELECT * from student");
									while ($rsc = mysqli_fetch_assoc($rdsc)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay2' and sem = 'First Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp2 == 0){
													$rateTempStudent = $rRprt1['rate'];
												}else{
													$rateTempStudent = $rateTempStudent.",".$rRprt1['rate'];
												}
												$countTemp2++;
											}
										}
									}
									
									$rdsc2 = mysqli_query($mysqli, "SELECT * from faculty");
									while ($rsc2 = mysqli_fetch_assoc($rdsc2)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc2['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay2' and sem = 'First Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp3 == 0){
													$rateTempFaculty = $rRprt1['rate'];
												}else{
													$rateTempFaculty = $rateTempFaculty.",".$rRprt1['rate'];
												}
												$countTemp3++;
											}
										}
									}
									
									if($countTemp2 == 0){
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}else{
										
										$rateStudentSplit = explode(",",$rateTempStudent);
										$countstudsplit = count($rateStudentSplit);
										$countFS = 0;
										$tempSudent = 0;
										
										
										for($x = 0; $x < $countstudsplit; $x++){
											$temp = explode(' ', $rateStudentSplit[$x]);
											$tempSudent += $temp[1];
											$countFS++;
										}
										
										$tempAverageStudent = (($tempSudent/$countFS)/5)*100;
										
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageStudent, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
										
									if($countTemp3 == 0){
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										
										$sAxis += 5;
										$hAxis += 5;
									}else{
										$rateFacultySplit = explode(",",$rateTempFaculty);
										$countfactsplit = count($rateFacultySplit);
										$countFF = 0;
										$tempFaculty = 0;
										
										for($y = 0; $y < $countfactsplit; $y++){
											$temp2 = explode(' ', $rateFacultySplit[$y]);
											$tempFaculty += $temp2[1];
											$countFF++;
										}
									
										$tempAverageFaculty = (($tempFaculty/$countFF)/5)*100;
										
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageFaculty, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
									if($countTemp3 == 0 && $countTemp2 == 0)
										echo "doc.text(168,$sAxis, ' 0');";
									else if($countTemp3 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
									else if($countTemp2 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
									else
										echo "doc.text(168,$sAxis, '".number_format((float)(($tempAverageFaculty*0.4)+($tempAverageStudent*0.6)), 2, '.', '')."');";
									echo "doc.text(100,$sAxis, 'Total QCE Point');";
									echo "doc.line(30,$hAxis, 186, $hAxis);";
									echo "doc.line(30, 60, 30, $hAxis);";
									echo "doc.line(186, 60, 186, $hAxis);";
									
									echo "doc.line(106, 65, 106, ".($hAxis-5).");";
									echo "doc.line(130, 65, 130, ".($hAxis-5).");";
									echo "doc.line(159, 65, 159, $hAxis);";
									
									?>
									axis = <?php echo $sAxis;?>;
									
									doc.text(30,axis+15, "Checked and Reviewed by:");
									
									doc.setFontType("bold");
									doc.text("Institutional QCE Committee", 108,axis+25,'center');
									axis += 5;
									doc.text("<?php echo $oc;?>", 90,axis+35,'right');
									doc.text("<?php echo $hr;?>", 90,axis+65,'right');
									doc.text("<?php echo $m1;?>", 90,axis+95,'right');
									
									doc.text(128,axis+35, "<?php echo $od;?>");
									doc.text(128,axis+65, "<?php echo $fp;?>");
									doc.text(128,axis+95, "<?php echo $m2;?>");
									
									doc.setFontType("normal");
									
									<?php
                                        
                                        $resCom0 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 163");
                                        $resCom1 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 167");
                                        $resCom2 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        $resCom3 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 166");
                                        $resCom4 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 164");
                                        $resCom5 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 165");
                                
                                        if($rowCom = mysqli_fetch_assoc($resCom0)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom1)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+70,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom2)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+100,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom3)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom4)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+70,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom5)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."',150,axis+100,'center');"; 
                                        }
                                
								    ?>
                                
									doc.text("Date:______________________", 90,axis+45,'right');
									doc.text("Date:______________________", 90,axis+75,'right');
									doc.text("Date:______________________", 90,axis+105,'right');
									doc.text(128,axis+45, "Date:______________________");
									doc.text(128,axis+75, "Date:______________________");
									doc.text(128,axis+105, "Date:______________________");
									
									doc.text("Conforme:", 108,axis+120,'center');
                                    <?php
                                        $resCom = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        if($rowCom = mysqli_fetch_assoc($resCom)){
                                            $name  = strtoupper($rf['fn'].", ".$rf['ln']);
                                            echo "doc.text('".$name."', 108,axis+130,'center');"; 
                                        }
                                    ?>
									doc.text("Faculty", 108,axis+135,'center');
									doc.text("Date:______________________", 108,axis+140,'center');
									
									doc.setFontType("bold");
									doc.text("<?php echo $fy;?>", 108,axis+130,'center');
									
									// PAGE 5 // PAGE 5 // PAGE 5 // PAGE 5 // PAGE 5 // PAGE 5 // PAGE 5 // PAGE 5 //
									
									doc.addPage();
									axis = 0;
									
									doc.setFontSize(9);
									doc.setFontType("bold");
									doc.text("SOUTHERN LEYTE STATE UNIVERSITY - SAN JUAN CAMPUS", 108,15,'center');
									doc.setFontType("normal");
									doc.text("San Jose, San Juan, Southern Leyte",108,20,'center');
									doc.setFontType("bold");
									doc.text("The QCE of the NBC No. 461",108,30,'center');
									
									doc.setFontType("italic");
									doc.setTextColor(56,138,220);
									doc.text("SUMMARY OF COMPUTATION FOR INSTRUCTION ARE PER RATING PERIOD",108,35,'center');
									
									doc.setTextColor(0,0,0);
									doc.setFontSize(9);
									doc.setFontType("normal");
									doc.text(30,45, "Rating Period:");
									doc.text(30,50, "Name of Faculty:");
									doc.text(30,55, "Academic Rank:");
									
									doc.setFontType("bold");
									doc.text(90,45, "<?php echo "2ND SEMESTER, ".$ay2."-".$ay3;?>");
									if("<?php echo $rf['mn'];?>" == ""){
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']);?>");
									}else{
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']." ".substr($rf['mn'], 0, 1));?>.");
									}
									doc.text(90,55, "<?php echo $rf['rank'];?>");
									
									doc.text("SUMMARY OF COMPUTATION OF TWO EVALUATORS",108,63.5,'center');
									doc.setFontType("normal");
									doc.line(30,60, 186, 60);
									doc.line(30,65, 186, 65);
									doc.text(51,73.5, "Areas of Evaluation");
									doc.text(110,73.5, "Ave. Score");
									doc.text(133,73.5, "% (Percentage)");
									doc.text(165,73.5, "QCE Point");
									doc.line(30,75, 186, 75);
									<?php
									$sAxis = 78.5;
									$hAxis = 80;
										
									$rateTempStudent = "";
									$rateTempFaculty = "";
									$countTemp2 = 0;
									$countTemp3 = 0;
									
									
									$rdsc = mysqli_query($mysqli, "SELECT * from student");
									while ($rsc = mysqli_fetch_assoc($rdsc)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay2' and sem = 'Second Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp2 == 0){
													$rateTempStudent = $rRprt1['rate'];
												}else{
													$rateTempStudent = $rateTempStudent.",".$rRprt1['rate'];
												}
												$countTemp2++;
											}
										}
									}
									
									$rdsc2 = mysqli_query($mysqli, "SELECT * from faculty");
									while ($rsc2 = mysqli_fetch_assoc($rdsc2)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc2['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay2' and sem = 'Second Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp3 == 0){
													$rateTempFaculty = $rRprt1['rate'];
												}else{
													$rateTempFaculty = $rateTempFaculty.",".$rRprt1['rate'];
												}
												$countTemp3++;
											}
										}
									}
									
									if($countTemp2 == 0){
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}else{
										
										$rateStudentSplit = explode(",",$rateTempStudent);
										$countstudsplit = count($rateStudentSplit);
										$countFS = 0;
										$tempSudent = 0;
										
										
										for($x = 0; $x < $countstudsplit; $x++){
											$temp = explode(' ', $rateStudentSplit[$x]);
											$tempSudent += $temp[1];
											$countFS++;
										}
										
										$tempAverageStudent = (($tempSudent/$countFS)/5)*100;
										
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageStudent, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
										
									if($countTemp3 == 0){
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										
										$sAxis += 5;
										$hAxis += 5;
									}else{
										$rateFacultySplit = explode(",",$rateTempFaculty);
										$countfactsplit = count($rateFacultySplit);
										$countFF = 0;
										$tempFaculty = 0;
										
										for($y = 0; $y < $countfactsplit; $y++){
											$temp2 = explode(' ', $rateFacultySplit[$y]);
											$tempFaculty += $temp2[1];
											$countFF++;
										}
									
										$tempAverageFaculty = (($tempFaculty/$countFF)/5)*100;
										
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageFaculty, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
									if($countTemp3 == 0 && $countTemp2 == 0)
										echo "doc.text(168,$sAxis, ' 0');";
									else if($countTemp3 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
									else if($countTemp2 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
									else
										echo "doc.text(168,$sAxis, '".number_format((float)(($tempAverageFaculty*0.4)+($tempAverageStudent*0.6)), 2, '.', '')."');";
									echo "doc.text(100,$sAxis, 'Total QCE Point');";
									echo "doc.line(30,$hAxis, 186, $hAxis);";
									echo "doc.line(30, 60, 30, $hAxis);";
									echo "doc.line(186, 60, 186, $hAxis);";
									
									echo "doc.line(106, 65, 106, ".($hAxis-5).");";
									echo "doc.line(130, 65, 130, ".($hAxis-5).");";
									echo "doc.line(159, 65, 159, $hAxis);";
									
									?>
									axis = <?php echo $sAxis;?>;
									
									doc.text(30,axis+15, "Checked and Reviewed by: ");
									
									doc.setFontType("bold");
									doc.text("Institutional QCE Committee", 108,axis+25,'center');
									axis += 5;
									doc.text("ANNABELLE M. HUFALAR , DevEdD", 90,axis+35,'right');
									doc.text("HAZELLE VILLA-ASALDO, MDM", 90,axis+65,'right');
									doc.text("JOSHUA EDSON G. ORDIZ, MST", 90,axis+95,'right');
									
									doc.text(128,axis+35, "GWENDOLYN TATOY, DBM");
									doc.text(128,axis+65, "MARIE KHUL C. LANGUB, PhD");
									doc.text(128,axis+95, "VANGILIT G. RETOME, PhD");
									
									doc.setFontType("normal");
									
									<?php
                                        
                                        $resCom0 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 163");
                                        $resCom1 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 167");
                                        $resCom2 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        $resCom3 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 166");
                                        $resCom4 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 164");
                                        $resCom5 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 165");
                                
                                        if($rowCom = mysqli_fetch_assoc($resCom0)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom1)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+70,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom2)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+100,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom3)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom4)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+70,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom5)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."',150,axis+100,'center');"; 
                                        }
                                
								    ?>
                                
									doc.text("Date:______________________", 90,axis+45,'right');
									doc.text("Date:______________________", 90,axis+75,'right');
									doc.text("Date:______________________", 90,axis+105,'right');
									doc.text(128,axis+45, "Date:______________________");
									doc.text(128,axis+75, "Date:______________________");
									doc.text(128,axis+105, "Date:______________________");
									
									doc.text("Conforme:", 108,axis+120,'center');
                                    <?php
                                        $resCom = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        if($rowCom = mysqli_fetch_assoc($resCom)){
                                            $name  = strtoupper($rf['fn'].", ".$rf['ln']);
                                            echo "doc.text('".$name."', 108,axis+130,'center');"; 
                                        }
                                    ?>
									doc.text("Faculty", 108,axis+135,'center');
									doc.text("Date:______________________", 108,axis+140,'center');
									doc.setFontType("bold");
//									doc.text("JOSHUA EDSON G. ORDIZ, MST", 108,axis+130,'center');
									
									// PAGE 6 // PAGE 6 // PAGE 6 // PAGE 6 // PAGE 6 // PAGE 6 // PAGE 6 // PAGE 6 //
									
									doc.addPage();
									axis = 0;
									
									doc.setFontSize(9);
									doc.setFontType("bold");
									doc.text("SOUTHERN LEYTE STATE UNIVERSITY - SAN JUAN CAMPUS", 108,15,'center');
									doc.setFontType("normal");
									doc.text("San Jose, San Juan, Southern Leyte",108,20,'center');
									doc.setFontType("bold");
									doc.text("The QCE of the NBC No. 461",108,30,'center');
									
									doc.setFontType("italic");
									doc.setTextColor(56,138,220);
									doc.text("SUMMARY OF COMPUTATION FOR INSTRUCTION ARE PER RATING PERIOD",108,35,'center');
									
									doc.setTextColor(0,0,0);
									doc.setFontSize(9);
									doc.setFontType("normal");
									doc.text(30,45, "Rating Period:");
									doc.text(30,50, "Name of Faculty:");
									doc.text(30,55, "Academic Rank:");
									
									doc.setFontType("bold");
									doc.text(90,45, "<?php echo "1ST SEMESTER, ".$ay3."-".($ay3+1);?>");
									if("<?php echo $rf['mn'];?>" == ""){
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']);?>");
									}else{
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']." ".substr($rf['mn'], 0, 1));?>.");
									}
									doc.text(90,55, "<?php echo $rf['rank'];?>");
									
									doc.text("SUMMARY OF COMPUTATION OF TWO EVALUATORS",108,63.5,'center');
									doc.setFontType("normal");
									doc.line(30,60, 186, 60);
									doc.line(30,65, 186, 65);
									doc.text(51,73.5, "Areas of Evaluation");
									doc.text(110,73.5, "Ave. Score");
									doc.text(133,73.5, "% (Percentage)");
									doc.text(165,73.5, "QCE Point");
									doc.line(30,75, 186, 75);
									<?php
									$sAxis = 78.5;
									$hAxis = 80;
										
									$rateTempStudent = "";
									$rateTempFaculty = "";
									$countTemp2 = 0;
									$countTemp3 = 0;
									
									
									$rdsc = mysqli_query($mysqli, "SELECT * from student");
									while ($rsc = mysqli_fetch_assoc($rdsc)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay3' and sem = 'First Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp2 == 0){
													$rateTempStudent = $rRprt1['rate'];
												}else{
													$rateTempStudent = $rateTempStudent.",".$rRprt1['rate'];
												}
												$countTemp2++;
											}
										}
									}
									
									$rdsc2 = mysqli_query($mysqli, "SELECT * from faculty");
									while ($rsc2 = mysqli_fetch_assoc($rdsc2)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc2['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay3' and sem = 'First Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp3 == 0){
													$rateTempFaculty = $rRprt1['rate'];
												}else{
													$rateTempFaculty = $rateTempFaculty.",".$rRprt1['rate'];
												}
												$countTemp3++;
											}
										}
									}
									
									if($countTemp2 == 0){
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}else{
										
										$rateStudentSplit = explode(",",$rateTempStudent);
										$countstudsplit = count($rateStudentSplit);
										$countFS = 0;
										$tempSudent = 0;
										
										
										for($x = 0; $x < $countstudsplit; $x++){
											$temp = explode(' ', $rateStudentSplit[$x]);
											$tempSudent += $temp[1];
											$countFS++;
										}
										
										$tempAverageStudent = (($tempSudent/$countFS)/5)*100;
										
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageStudent, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
										
									if($countTemp3 == 0){
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										
										$sAxis += 5;
										$hAxis += 5;
									}else{
										$rateFacultySplit = explode(",",$rateTempFaculty);
										$countfactsplit = count($rateFacultySplit);
										$countFF = 0;
										$tempFaculty = 0;
										
										for($y = 0; $y < $countfactsplit; $y++){
											$temp2 = explode(' ', $rateFacultySplit[$y]);
											$tempFaculty += $temp2[1];
											$countFF++;
										}
									
										$tempAverageFaculty = (($tempFaculty/$countFF)/5)*100;
										
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageFaculty, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
									if($countTemp3 == 0 && $countTemp2 == 0)
										echo "doc.text(168,$sAxis, ' 0');";
									else if($countTemp3 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
									else if($countTemp2 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
									else
										echo "doc.text(168,$sAxis, '".number_format((float)(($tempAverageFaculty*0.4)+($tempAverageStudent*0.6)), 2, '.', '')."');";
									echo "doc.text(100,$sAxis, 'Total QCE Point');";
									echo "doc.line(30,$hAxis, 186, $hAxis);";
									echo "doc.line(30, 60, 30, $hAxis);";
									echo "doc.line(186, 60, 186, $hAxis);";
									
									echo "doc.line(106, 65, 106, ".($hAxis-5).");";
									echo "doc.line(130, 65, 130, ".($hAxis-5).");";
									echo "doc.line(159, 65, 159, $hAxis);";
									
									?>
									axis = <?php echo $sAxis;?>;
									
									doc.text(30,axis+15, "Checked and Reviewed by:");
									
									doc.setFontType("bold");
									doc.text("Institutional QCE Committee", 108,axis+25,'center');
									axis += 5;
									doc.text("<?php echo $oc;?>", 90,axis+35,'right');
									doc.text("<?php echo $hr;?>", 90,axis+65,'right');
									doc.text("<?php echo $m1;?>", 90,axis+95,'right');
									
									doc.text(128,axis+35, "<?php echo $od;?>");
									doc.text(128,axis+65, "<?php echo $fp;?>");
									doc.text(128,axis+95, "<?php echo $m2;?>");
									
									doc.setFontType("normal");
									<?php
                                        
                                        $resCom0 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 163");
                                        $resCom1 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 167");
                                        $resCom2 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        $resCom3 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 166");
                                        $resCom4 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 164");
                                        $resCom5 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 165");
                                
                                        if($rowCom = mysqli_fetch_assoc($resCom0)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom1)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+70,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom2)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+100,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom3)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom4)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+70,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom5)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."',150,axis+100,'center');"; 
                                        }
                                
								    ?>
                                
									doc.text("Date:______________________", 90,axis+45,'right');
									doc.text("Date:______________________", 90,axis+75,'right');
									doc.text("Date:______________________", 90,axis+105,'right');
									doc.text(128,axis+45, "Date:______________________");
									doc.text(128,axis+75, "Date:______________________");
									doc.text(128,axis+105, "Date:______________________");
									
									doc.text("Conforme:", 108,axis+120,'center');
                                    <?php
                                        $resCom = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        if($rowCom = mysqli_fetch_assoc($resCom)){
                                            $name  = strtoupper($rf['fn'].", ".$rf['ln']);
                                            echo "doc.text('".$name."', 108,axis+130,'center');"; 
                                        }
                                    ?>
									doc.text("Faculty", 108,axis+135,'center');
									doc.text("Date:______________________", 108,axis+140,'center');
									
									doc.setFontType("bold");
									doc.text("<?php echo $fy;?>", 108,axis+130,'center');
									
									// PAGE 7 // PAGE 7 // PAGE 7 // PAGE 7 // PAGE 7 // PAGE 7 // PAGE 7 // PAGE 7 //
									
									doc.addPage();
									axis = 0;
									
									doc.setFontSize(9);
									doc.setFontType("bold");
									doc.text("SOUTHERN LEYTE STATE UNIVERSITY - SAN JUAN CAMPUS", 108,15,'center');
									doc.setFontType("normal");
									doc.text("San Jose, San Juan, Southern Leyte",108,20,'center');
									doc.setFontType("bold");
									doc.text("The QCE of the NBC No. 461",108,30,'center');
									
									doc.setFontType("italic");
									doc.setTextColor(56,138,220);
									doc.text("SUMMARY OF COMPUTATION FOR INSTRUCTION ARE PER RATING PERIOD",108,35,'center');
									
									doc.setTextColor(0,0,0);
									doc.setFontSize(9);
									doc.setFontType("normal");
									doc.text(30,45, "Rating Period:");
									doc.text(30,50, "Name of Faculty:");
									doc.text(30,55, "Academic Rank:");
									
									doc.setFontType("bold");
									doc.text(90,45, "<?php echo "2ND SEMESTER, ".$ay3."-".($ay3+1);?>");
									if("<?php echo $rf['mn'];?>" == ""){
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']);?>");
									}else{
										doc.text(90,50, "<?php echo strtoupper($rf['ln'].", ".$rf['fn']." ".substr($rf['mn'], 0, 1));?>.");
									}
									doc.text(90,55, "<?php echo $rf['rank'];?>");
									
									doc.text("SUMMARY OF COMPUTATION OF TWO EVALUATORS",108,63.5,'center');
									doc.setFontType("normal");
									doc.line(30,60, 186, 60);
									doc.line(30,65, 186, 65);
									doc.text(51,73.5, "Areas of Evaluation");
									doc.text(110,73.5, "Ave. Score");
									doc.text(133,73.5, "% (Percentage)");
									doc.text(165,73.5, "QCE Point");
									doc.line(30,75, 186, 75);
									<?php
									$sAxis = 78.5;
									$hAxis = 80;
										
									$rateTempStudent = "";
									$rateTempFaculty = "";
									$countTemp2 = 0;
									$countTemp3 = 0;
									
									
									$rdsc = mysqli_query($mysqli, "SELECT * from student");
									while ($rsc = mysqli_fetch_assoc($rdsc)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay3' and sem = 'Second Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp2 == 0){
													$rateTempStudent = $rRprt1['rate'];
												}else{
													$rateTempStudent = $rateTempStudent.",".$rRprt1['rate'];
												}
												$countTemp2++;
											}
										}
									}
									
									$rdsc2 = mysqli_query($mysqli, "SELECT * from faculty");
									while ($rsc2 = mysqli_fetch_assoc($rdsc2)){
										$resReport1 = mysqli_query($mysqli, "SELECT * from evaluate WHERE evaluator_no = '".$rsc2['row']."' and fac_no = '".$rf['row']."'");
										while ($rRprt1 = mysqli_fetch_assoc($resReport1)){
											$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt1['shed_no']."' and ay = '$ay3' and sem = 'Second Semester'");
											if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
												if($countTemp3 == 0){
													$rateTempFaculty = $rRprt1['rate'];
												}else{
													$rateTempFaculty = $rateTempFaculty.",".$rRprt1['rate'];
												}
												$countTemp3++;
											}
										}
									}
									
									if($countTemp2 == 0){
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}else{
										
										$rateStudentSplit = explode(",",$rateTempStudent);
										$countstudsplit = count($rateStudentSplit);
										$countFS = 0;
										$tempSudent = 0;
										
										
										for($x = 0; $x < $countstudsplit; $x++){
											$temp = explode(' ', $rateStudentSplit[$x]);
											$tempSudent += $temp[1];
											$countFS++;
										}
										
										$tempAverageStudent = (($tempSudent/$countFS)/5)*100;
										
										echo "doc.text(31,$sAxis, 'A. Student');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageStudent, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.6');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
										
									if($countTemp3 == 0){
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, ' 0');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, ' 0');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										
										$sAxis += 5;
										$hAxis += 5;
									}else{
										$rateFacultySplit = explode(",",$rateTempFaculty);
										$countfactsplit = count($rateFacultySplit);
										$countFF = 0;
										$tempFaculty = 0;
										
										for($y = 0; $y < $countfactsplit; $y++){
											$temp2 = explode(' ', $rateFacultySplit[$y]);
											$tempFaculty += $temp2[1];
											$countFF++;
										}
									
										$tempAverageFaculty = (($tempFaculty/$countFF)/5)*100;
										
										echo "doc.text(31,$sAxis, 'B. Immediate Supervisor(s)');";
										echo "doc.text(114,$sAxis, '".number_format((float)$tempAverageFaculty, 2, '.', '')."');";
										echo "doc.text(140,$sAxis, '0.4');";
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
										echo "doc.line(30,$hAxis, 186, $hAxis);";
										$sAxis += 5;
										$hAxis += 5;
									}
									if($countTemp3 == 0 && $countTemp2 == 0)
										echo "doc.text(168,$sAxis, ' 0');";
									else if($countTemp3 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageStudent*0.6), 2, '.', '')."');";
									else if($countTemp2 == 0)
										echo "doc.text(168,$sAxis, '".number_format((float)($tempAverageFaculty*0.4), 2, '.', '')."');";
									else
										echo "doc.text(168,$sAxis, '".number_format((float)(($tempAverageFaculty*0.4)+($tempAverageStudent*0.6)), 2, '.', '')."');";
									echo "doc.text(100,$sAxis, 'Total QCE Point');";
									echo "doc.line(30,$hAxis, 186, $hAxis);";
									echo "doc.line(30, 60, 30, $hAxis);";
									echo "doc.line(186, 60, 186, $hAxis);";
									
									echo "doc.line(106, 65, 106, ".($hAxis-5).");";
									echo "doc.line(130, 65, 130, ".($hAxis-5).");";
									echo "doc.line(159, 65, 159, $hAxis);";
									
									?>
									axis = <?php echo $sAxis;?>;
									
									doc.text(30,axis+15, "Checked and Reviewed by:");
									
									doc.setFontType("bold");
									doc.text("Institutional QCE Committee", 108,axis+25,'center');
									axis += 5;
									doc.text("<?php echo $oc;?>", 90,axis+35,'right');
									doc.text("<?php echo $hr;?>", 90,axis+65,'right');
									doc.text("<?php echo $m1;?>", 90,axis+95,'right');
									
									doc.text(128,axis+35, "<?php echo $od;?>");
									doc.text(128,axis+65, "<?php echo $fp;?>");
									doc.text(128,axis+95, "<?php echo $m2;?>");
									
									doc.setFontType("normal");
									<?php
                                        
                                        $resCom0 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 163");
                                        $resCom1 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 167");
                                        $resCom2 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        $resCom3 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 166");
                                        $resCom4 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 164");
                                        $resCom5 = mysqli_query($mysqli, "SELECT * from committee WHERE row = 165");
                                
                                        if($rowCom = mysqli_fetch_assoc($resCom0)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom1)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+70,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom2)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 64,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 64,axis+100,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom3)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+35,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+40,'center');"; 
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom4)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+65,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."', 150,axis+70,'center');";
                                        }
                                        if($rowCom = mysqli_fetch_assoc($resCom5)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 150,axis+95,'center');"; 
                                            echo "doc.text('".$rowCom['designation']."',150,axis+100,'center');"; 
                                        }
                                
								    ?>
                                
									doc.text("Date:______________________", 90,axis+45,'right');
									doc.text("Date:______________________", 90,axis+75,'right');
									doc.text("Date:______________________", 90,axis+105,'right');
									doc.text(128,axis+45, "Date:______________________");
									doc.text(128,axis+75, "Date:______________________");
									doc.text(128,axis+105, "Date:______________________");
									
									doc.text("Conforme:", 108,axis+120,'center');
                                    <?php
                                        $resCom = mysqli_query($mysqli, "SELECT * from committee WHERE row = 161");
                                        if($rowCom = mysqli_fetch_assoc($resCom)){
                                            $name  = $rowCom['fn'].' '.$rowCom['mn'].' '.$rowCom['ln'].' '.$rowCom['ext'];
                                            echo "doc.text('".$name."', 108,axis+130,'center');"; 
                                        }
                                    ?>
									doc.text("Faculty", 108,axis+135,'center');
									doc.text("Date:______________________", 108,axis+140,'center');
									
									doc.setFontType("bold");
									doc.text("<?php echo $fy;?>", 108,axis+130,'center');
									
									doc.save("SLSU FES (Evaluation Summary <?php echo $ay1."-".$ay3;?>).pdf");
								}
								</script>
								<?php
								echo "<tr>";
								echo "<td> <center>
										<a class='btn btn-info btn-xs' onclick='downloadSummary".$rf['row']."();'>
											<span class='glyphicon glyphicon-list-alt'></span>
										</a>
									</center> </td>";
								echo "<td> ".strtoupper($rf['fn']." ".$rf['ln'])." </td>";
								echo "<td> ".$rf['rank']." </td>";
                                $dept = mysqli_query($mysqli, "select * from department where row = '".$rf['dept']."'");
                                if($rdpt = mysqli_fetch_assoc($dept)){
                                    echo "<td> ".$rdpt['dscrpt']." </td>";
								}
                                echo "<td> ".$sy." </td>";
								echo "</tr>";
							}
							$fac_no = "";
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="prefSUM" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Preference</h4>
			</div>
			<div class="modal-body">
				<?php
					if($position != "Supervisor"){
				?>
				<div class="form-group">
					<label for="deptSum">Department</label>
					<select class="form-control" id="deptSum">
						<?php
							$resDeps=mysqli_query($mysqli, "SELECT * from department where row = '$depart1'");
							if($rd = mysqli_fetch_assoc($resDeps)){
								echo "<option value='".$rd['row']."' hidden>".$rd['dscrpt']."</option>";
							}
							echo "<option value='All'>All</option>";
							$resDep1s=mysqli_query($mysqli, "SELECT * from department");
							while($rd1 = mysqli_fetch_assoc($resDep1s)){
								echo "<option value='".$rd1['row']."'>".$rd1['dscrpt']."</option>";
							}
							
						?>
					</select>
				</div>
				<?php
					}
				?>
				<div class="form-group">
					<label for="aySchedSum">Rating Period (3 School Year)</label>
					<select class="form-control" id="aySchedSum">
						<?php
							echo "<option value='".$ay1."' hidden>".$ay1."-".($ay1+3)."</option>";
							$start = 2020;
							$data = floor(((int)date('Y')-$start)/3);
							$calculate = (int)$data * 3;
							$y = $calculate + $start;
							for($x =  $y; $x >= $start; $x-=3){
								if(($x+3) <= (int)date('Y'))
									echo "<option value='".$x."'>".$x."-".($x+3)."</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<a type="button" class="btn btn-primary" onclick="prefeSum();"><span class="glyphicon glyphicon-floppy-disk"></span> Set</a>
				<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
			</div>
		</div>
	</div>
</div>
<script>
	function prefeSum(){
		var ay = $('#aySchedSum').val();
		var department = "";
		<?php 
		if($position == "Supervisor")
			echo 'department = "'.$depart1.'";';
		else
			echo 'department = $("#deptSum").val();';
		?>
		var datas="ay="+ay+"&department="+department;
		$.ajax({
			type: "POST",
			url: "preferenceDep.php",
			data: datas
		}).done(function( data) {
			$('#prefSUM').modal('hide');
			$('.modal-backdrop').hide();
			$('#summaryTab').html('<div class="preloaderBg" id="preloader" onload="preloader()"><div class="preloader"></div><div class="preloader2"></div></div>');
			summaryTab();
		});
	}
	$(document).ready(function() {
		$('#datatableSummary').dataTable();
		$("[data-toggle=tooltip]").tooltip();
	});
</script>