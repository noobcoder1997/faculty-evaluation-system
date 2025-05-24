<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
	$row = $_SESSION['row'];
	$position = $_SESSION['position'];
	
	$resultIDs = "SELECT * FROM superadmin WHERE row='$row' AND position='$position';";
	$resultIDs .= "SELECT * FROM admin WHERE row='$row' AND position='$position';";
	$resultIDs .= "SELECT * FROM student WHERE row='$row' AND position='$position';";
	$resultIDs .= "SELECT * FROM faculty JOIN supervisor ON supervisor.fac_no = faculty.row WHERE supervisor.row='$row' AND supervisor.position='$position';";

	if (mysqli_multi_query($mysqli, $resultIDs)) {
		do {
			if ($result = mysqli_store_result($mysqli)) {
				if ($rs = mysqli_fetch_array($result)){
					if($position == "Supervisor"){
						$deprt = $rs['dept'];
					}
					$ay1 = $rs['ay'];
					$sem1 = $rs['sem'];
					if($ay1 == "All")
						$sy = "All";
					else
						$sy = $rs['ay']."-".($rs['ay']+1);
					
					$se = $rs['sem'];
					if($se == "First Semester")
						$se = "1st";
					else if($se == "Second Semester")
						$se = "2nd";
					else if($se == "Summer")
						$se = "Sum";
					else
						$se = "All";
				}
				mysqli_free_result($result);
			}
		} while (mysqli_next_result($mysqli));
	}
?>
<div class="container">
	<div class="row" id="evalTable">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-9">
					<h3>Evaluation Report</h3>
				</div>
				<div class="col-md-3">
					<br/>
					<div class="col-md-12 label-warning preClass">
						School Year: <?php echo $sy;?><br/>
						Semester: <?php echo $se;?> &nbsp;&nbsp; <span data-toggle='modal' data-target='#pref' style='color: #5a8dee;'><span class='glyphicon glyphicon-edit'></span></span>
					</div>
				</div><br/>
			</div>
			<div class="table-responsive"><br/>
			<table id="datatableEvaluated" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>Faculty</th>
							<th>A.Y. & Semester</th>
							<th>Points</th>
							<th>Comment</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
							<th>Faculty</th>
							<th>A.Y. & Semester</th>
							<th>Points</th>
							<th>Comment</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
							
							if($position == "Administrator" || $position == "Super Administrator")
								$resReport = mysqli_query($mysqli, "SELECT * from evaluate");
							else if($position == "Supervisor" && ($deprt != "" || $deprt != " "))
								$resReport = mysqli_query($mysqli, "SELECT * from evaluate");
							while ($rRprt = mysqli_fetch_assoc($resReport)){
								$signature = "";
								$college = "";
								$department = "";
								$program = "";
								$signature = "";
								$evaluator = "";
								$dateEval = $rRprt['dateEval'];
								if($ay1 == "All" && $sem1 != "All")
									$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt['shed_no']."' and sem = '$sem1'");
								else if($ay1 != "All" && $sem1 == "All")
									$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt['shed_no']."' and ay = '$ay1'");
								else if($ay1 == "All" && $sem1 == "All")
									$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt['shed_no']."'");
								else
									$resReport123 = mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt['shed_no']."' and ay = '$ay1' and  sem = '$sem1'");
								if ($rRprt123 = mysqli_fetch_assoc($resReport123)){
									if($position == "Supervisor" && ($deprt != "" || $deprt != " "))
										$rs1Rprt =mysqli_query($mysqli, "SELECT * from faculty where dept = '$deprt' and row = '".$rRprt['fac_no']."'");
									else
										$rs1Rprt =mysqli_query($mysqli, "SELECT * from faculty where row = '".$rRprt['fac_no']."'");
									if ($rFac = mysqli_fetch_assoc($rs1Rprt)){
										echo "<tr>";
											echo "<td><center>
													<a class='btn btn-info btn-xs' onclick='downloadPDF".$rRprt['row']."();'>
														<span class='glyphicon glyphicon-download'></span>
													</a></center>
												</td>";
										$resFac =mysqli_query($mysqli, "SELECT * from faculty where row = '".$rRprt['fac_no']."'");
										if ($rFac = mysqli_fetch_assoc($resFac)){
											echo "<td> ".strtoupper($rFac['fn']." ".$rFac['ln'])." </td>";
										}
										$resAYS =mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt['shed_no']."'");
										if ($rAys = mysqli_fetch_assoc($resAYS)){
											echo "<td> ".$rAys['ay']."-".($rAys['ay']+1)." $rAys[sem] </td>";
										}else{
											echo "<td> </td>";
										}
										
										echo "	<td> ".$rRprt['points']."  </td>
												<td> ".$rRprt['lexicon']." </td>";
										echo "</tr>";
										
										$restud = mysqli_query($mysqli, "SELECT * from student where row = '".$rRprt['evaluator_no']."'");
										if ($rst = mysqli_fetch_assoc($restud)){
											$signature = $rst['signature'];
											$evaluator = strtoupper($rst['fn']." ".$rst['ln']);
										}else{
											$restud0 = mysqli_query($mysqli, "SELECT * from faculty where row = '".$rRprt['evaluator_no']."'");
											if ($rsts = mysqli_fetch_assoc($restud0)){
                                                $evaluator = strtoupper($rsts['fn']." ".$rsts['ln']);
                                                $restud1 = mysqli_query($mysqli, "SELECT * from supervisor where fac_no = '".$rRprt['evaluator_no']."'");
                                                if ($rsts0 = mysqli_fetch_assoc($restud1)){
                                                    $signature = $rsts0['signature'];
                                                }
											}
										}
							?>
							<script>
								function downloadPDF<?php echo $rRprt['row'];?>(){
									var logo = new Image();
									logo.src = "images/header-logo.png";
									var socotec = new Image();
									socotec.src = "images/socotec.png";
									var qs = new Image();
									qs.src = "images/qs.png";
									var circle = new Image();
									circle.src = "images/encircle.png";
									var doc = new jsPDF("p","mm",[343, 216]);
									
									doc.addImage(logo, "JPEG",18,10,65,20, "", "FAST");
									
									doc.setFont("cambria");
									
									doc.addImage(qs, "JPEG",110,321,40,16, "", "FAST");
									doc.addImage(socotec, "JPEG",152,323,25,12, "", "FAST");
									
									doc.setFontSize(10);
									doc.setFontType("normal");
									
									doc.text(120,15, "SAN JUAN CAMPUS");
									doc.text(120,19, "San Jose, San Juan, Southern Leyte");
									doc.text(120,27, "Website: www.southernleytestateu.edu.ph");
									
									doc.text(11,39, "Excellence | Service | Leadership and Good Governance | Innovation | Social Responsibility | Integrity | Professionalism | Spirituality");

									doc.setFontType("bold");
									doc.setFontSize(11);
									
									
									doc.setFontSize(10);
									doc.text(63,54.5, "Instrument for Instructors and Assistant Professors");
									
									doc.setFontSize(8);
									<?php
										$axis = 123;
										$countCategory = 0;
										$seqArray = ['A.','B.','C.','D.','E.','F.','G.','H.','I.','J.','K.','L.','M.','N.','O.','P.','Q.','R.','S.','T.','U.','V.','W.','X.','Y.','Z.'];
										$resFac =mysqli_query($mysqli, "SELECT * from faculty where row = '".$rRprt['fac_no']."'");
										if ($rFac = mysqli_fetch_assoc($resFac)){
											echo 'doc.setFontSize(10);';
											echo "doc.text(15,63.5, 'Name of Faculty: ".strtoupper($rFac['fn']." ".$rFac['ln'])."');";
											echo "doc.text(100,63.5, 'Academic Rank: ".$rFac['rank']."');";
                                            
                                            $restud = mysqli_query($mysqli, "SELECT * from student where row = '".$rRprt['evaluator_no']."'");
                                                if ($rst = mysqli_fetch_assoc($restud)){
											         echo "doc.text(15,76.5, 'Evaluator: ".$rst['position']."');";
                                                }else{
                                                    $restud0 = mysqli_query($mysqli, "SELECT * from supervisor where fac_no = '".$rRprt['evaluator_no']."'");
                                                    if ($rsts = mysqli_fetch_assoc($restud0)){
                                                        echo "doc.text(15,76.5, 'Evaluator: ".$rsts['position']."');";
                                                    }
                                                }
											
											$resDept =mysqli_query($mysqli, "SELECT * from department where row = '".$rFac['dept']."'");
											if ($rDept = mysqli_fetch_assoc($resDept)){
												$college = $rDept['dptno'];
												$department = $rDept['dscrpt'];
												echo 'doc.setFontSize(10);
													doc.setFontType("normal");';
												if($rDept['email'] != "")
													echo "doc.text(120,23, 'Email: ".$rDept['email']."');";
												else
													echo "doc.text(120,23, 'Email: slsu_sj@southernleytestateu.edu.ph');";
												if($rDept['contact'] != "")
													echo "doc.text(120,31, 'Contact Number: ".$rDept['contact']."');";
											}else{
												echo "doc.text(120,23, 'Email: slsu_sj@southernleytestateu.edu.ph');";
											}
											echo 'doc.setFontSize(8);
												doc.setFontType("bold");';
										}
										$resAYS =mysqli_query($mysqli, "SELECT * from schedule where row = '".$rRprt['shed_no']."'");
										if ($rAys = mysqli_fetch_assoc($resAYS)){
											echo 'doc.setFontSize(10);';
											echo "doc.text(15,67.5, 'Rating Period: ".$rAys['sem']."');";
											echo "doc.text(100,67.5, 'Academic Year: ".$rAys['ay']."-".($rAys['ay']+1)."');";
											
											$getFrm =mysqli_query($mysqli, "SELECT * from form where row = '".$rAys['frm_no']."'");
											if ($rFrms = mysqli_fetch_assoc($getFrm)){
												echo "doc.setFontSize(10);
												doc.text(81,50.5, '".$rFrms['frm_name']."');";
											}
											
											echo 'doc.setFontSize(8);';
												
											$getAns =mysqli_query($mysqli, "SELECT * from category where frm_no = '".$rAys['frm_no']."'");
											while ($rAns = mysqli_fetch_assoc($getAns)){
												if($countCategory == 0)
													echo "doc.line(15, ".($axis-3).", 195, ".($axis-3).");";
												
												echo "doc.setFontType('bold');";
												echo "doc.text(16,$axis, '".$seqArray[$countCategory]." ".$rAns['cat_name']."');";
												echo "doc.text(179.5,$axis, 'Scale');";
												echo "doc.line(15, ".($axis+1).", 195, ".($axis+1).");";
												
												$countCategory++;
												$axis = $axis +4;
												$Qaxis = $axis;
												$totalAns = 0;
												$countAns = 0;
												
												$getAnsr =mysqli_query($mysqli, "SELECT * from question where cat_no = '".$rAns['row']."' order by cat_no asc, arrngmnt asc");
												while ($rAnsr = mysqli_fetch_assoc($getAnsr)){
													echo "doc.setFontType('normal');";
													echo "doc.text(16,$axis, '".$rAnsr['arrngmnt'].".  ".$rAnsr['question']."', {maxWidth: 150, align: 'left'});";
													if(mb_strwidth($rAnsr['arrngmnt'].".  ".$rAnsr['question']) > 150){
														$axis = $axis + 4;
													}
													echo "doc.line(15, ".($axis+1).", 195, ".($axis+1).");";
													$getRate = $rRprt['rate'];
													$rateArray = explode(',', $getRate);
													$coutRate = count($rateArray);
													$tempRate = "";
													
													for($rX = 0;$rX < $coutRate;$rX++){
														$temp = explode(' ', $rateArray[$rX]);
														if($rAnsr['row'] == $temp[0]){
															$tempRate = $temp[1];
															if((int)$tempRate == 5)
																echo "doc.addImage(circle, 'JPEG',170.6,".($axis-2.9).",4,4, '', 'FAST');";
															else if((int)$tempRate == 4)
																echo "doc.addImage(circle, 'JPEG',175.6,".($axis-2.9).",4,4, '', 'FAST');";
															else if((int)$tempRate == 3)
																echo "doc.addImage(circle, 'JPEG',180.6,".($axis-2.9).",4,4, '', 'FAST');";
															else if((int)$tempRate == 2)
																echo "doc.addImage(circle, 'JPEG',185.6,".($axis-2.9).",4,4, '', 'FAST');";
															else if((int)$tempRate == 1)
																echo "doc.addImage(circle, 'JPEG',190.6,".($axis-2.9).",4,4, '', 'FAST');";
															$totalAns += (int)$tempRate;
															$countAns++;
														}
													}
													
													echo "doc.text(192,$axis, '1');";
													echo "doc.text(187,$axis, '2');";
													echo "doc.text(182,$axis, '3');";
													echo "doc.text(177,$axis, '4');";
													echo "doc.text(172,$axis, '5');";
													
													$axis = $axis +4;
												}
											
												echo "doc.line(190, ".($Qaxis-3).", 190, ".($axis-3).");";
												echo "doc.line(185, ".($Qaxis-3).", 185, ".($axis-3).");";
												echo "doc.line(180, ".($Qaxis-3).", 180, ".($axis-3).");";
												echo "doc.line(175, ".($Qaxis-3).", 175, ".($axis-3).");";
												
												echo "doc.setFontType('bold');";
												echo "doc.text(181,$axis, '$totalAns');";
												
												echo "doc.text(155,$axis, 'Total Score');";
												echo "doc.line(15, ".($axis+1).", 195, ".($axis+1).");";
												$axis = $axis +4;
											}
											
											echo "doc.line(170, 120, 170, ".($axis-3).");";
											echo "doc.line(15, 120, 15, ".($axis-3).");";
											echo "doc.line(195, 120, 195, ".($axis-3).");";
										}
										
									?>
									doc.setFontSize(10);
									
									doc.line(40.5, 64, 95, 64);
									doc.line(37, 68, 95, 68);
									doc.line(125, 64, 179, 64);
									doc.line(124, 68, 179, 68);
									
									doc.text(73,84.5, "INSTRUMENT OF EVALUATION");
									doc.text(82,88.5, "Area: INSTRUCTION");
									
									doc.setFontSize(9);
									doc.setFontType("normal");
									doc.text(15,93.5, "Instructions: Please evaluate the faculty using the scale below. Encircle the number that corresponds to your rating.");
									
									doc.setFontSize(8);
									doc.line(15, 95, 195, 95);
									doc.line(15, 99, 195, 99);
									doc.line(15, 103, 195, 103);
									doc.line(15, 107, 195, 107);
									doc.line(15, 111, 195, 111);
									doc.line(15, 115, 195, 115);
									doc.line(15, 119, 195, 119);
									doc.line(15, 95, 15, 119);
									doc.line(195, 95, 195, 119);
									doc.line(23, 95, 23, 119);
									doc.line(49, 95, 49, 119);
									
									doc.setFontType("bold");
									doc.text(16,98, "Scale");
									doc.text(24,98, "Descriptive Rating");
									doc.text(50,98, "Qualitative Description");
									
									doc.text(18,102, "5");
									doc.text(18,106, "4");
									doc.text(18,110, "3");
									doc.text(18,114, "2");
									doc.text(18,118, "1");
									
									doc.text(24,102, "Outstanding ");
									doc.text(24,106, "Very Satisfactory");
									doc.text(24,110, "Satisfactory");
									doc.text(24,114, "Fair");
									doc.text(24,118, "Poor");
									
									doc.setFontType("normal");
									doc.text(50,102, "The performance almost always exceeds the job requirements. The Faculty is an exceptional role model.");
									doc.text(50,106, "The performance meets and often exceeds the job requirements.");
									doc.text(50,110, "The performance meets job requirements.");
									doc.text(50,114, "The performance needs some development to meet job requirements.");
									doc.text(50,118, "The faculty fails to meet job requirements.");
									
									doc.addPage();
									
									if("<?php echo $signature;?>" != ""){
										doc.addImage("<?php echo str_replace(" ","+", $signature);?>", "JPEG",73,49,30,30, "", "FAST");
									}
									var logo = new Image();
									logo.src = "images/header-logo.png";
									var socotec = new Image();
									socotec.src = "images/socotec.png";
									var qs = new Image();
									qs.src = "images/qs.png";
									var circle = new Image();
									circle.src = "images/encircle.png";
									
									doc.addImage(logo, "JPEG",18,10,65,20, "", "FAST");
									
									doc.setFont("cambria");
									
									doc.addImage(qs, "JPEG",110,321,40,16, "", "FAST");
									doc.addImage(socotec, "JPEG",152,323,25,12, "", "FAST");
									
									doc.setFontSize(10);
									doc.setFontType("normal");
									
									doc.text(120,15, "SAN JUAN CAMPUS");
									doc.text(120,19, "San Jose, San Juan, Southern Leyte");
									doc.text(120,27, "Website: www.southernleytestateu.edu.ph");
									
									doc.text(11,39, "Excellence | Service | Leadership and Good Governance | Innovation | Social Responsibility | Integrity | Professionalism | Spirituality");
									
									doc.line(10, 40, 200, 40);
									
									doc.text(30,50, "College");
									doc.text(75,50, "<?php echo $college;?>");
									doc.text(30,55, "Department");
									doc.text(75,55, "<?php echo $department;?>");
									doc.text(30,60, "Program");
									doc.text(30,65, "Signature of Evaluator");
									doc.text(30,70, "Name of Evaluator");
									doc.text(75,70, "<?php echo $evaluator;?>");
									doc.text(30,75, "Date");
									doc.text(75,75, "<?php echo $dateEval;?>");
									
									doc.text(70,50, ": ______________________________________________ ");
									doc.text(70,55, ": ______________________________________________ ");
									doc.text(70,60, ": ______________________________________________ ");
									doc.text(70,65, ": ______________________________________________ ");
									doc.text(70,70, ": ______________________________________________ ");
									doc.text(70,75, ": ______________________________________________ ");
									
									
									doc.save("SLSU FES (Evaluation Form).pdf");
								}
							</script>
							<?php
									}
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>			
<div class="modal fade" id="pref" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Preference</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="aySched">School Year</label>
					<select class="form-control" id="aySched">
						<?php
							echo "<option value='".$ay1."' hidden>".$ay1."-".($ay1+1)."</option>";
							for($x = (int)date('Y'); $x >= 2009; $x--){
								echo "<option value='".$x."'>".$x."-".($x+1)."</option>";
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="semSched">Semester</label>
					<select class="form-control" id="semSched">
						<?php echo "<option value='".$sem1."' hidden>".$sem1."</option>";?>
						<option value="First Semester">First Semester</option>
						<option value="Second Semester">Second Semester</option>
						<option value="Summer">Summer</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<a type="button" class="btn btn-primary" onclick="prefes();"><span class="glyphicon glyphicon-floppy-disk"></span> Set</a>
				<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
			</div>
		</div>
	</div>
</div>
<script>
	function prefes(){
		var ay = $('#aySched').val();
		var sem = $('#semSched').val();
		var datas="ay="+ay+"&sem="+sem;
		$.ajax({
			type: "POST",
			url: "preference.php",
			data: datas
		}).done(function( data) {
			$('#pref').modal('hide');
			$('.modal-backdrop').hide();
			evaluatedTab();
		});
	}
	$(document).ready(function() {
		$('#datatableEvaluated').dataTable();
		$("[data-toggle=tooltip]").tooltip();
	});
</script>