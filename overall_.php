<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
	$row = $_SESSION['row'];
	$position = $_SESSION['position'];
	
	$resultIDs = "SELECT * FROM superadmin WHERE row='$row' AND position='$position';";
	$resultIDs .= "SELECT * FROM admin WHERE row='$row' AND position='$position';";
	$resultIDs .= "SELECT * FROM supervisor WHERE row='$row' AND position='$position';";
	$resultIDs .= "SELECT * FROM student WHERE row='$row' AND position='$position';";

	if (mysqli_multi_query($mysqli, $resultIDs)) {
		do {
			if ($result = mysqli_store_result($mysqli)) {
				if ($rs = mysqli_fetch_array($result)){
					if($rs['position'] == "Supervisor"){
						$resDes = mysqli_query($mysqli, "SELECT * from faculty where row = '".$rs['fac_no']."'");
						if ($rde = mysqli_fetch_assoc($resDes)){
							$deprt = $rde['dept'];
						}
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
					<h3>Overall Evaluation</h3>
				</div>
				<div class="col-md-3">
					<br/>
					<div class="col-md-12 label-warning preClass">
						School Year: <?php echo $sy;?><br/>
						Semester: <?php echo $se;?> &nbsp&nbsp <span data-toggle='modal' data-target='#prefOE' style='color: #5a8dee;'><span class='glyphicon glyphicon-edit'></span></span>
					</div>
				</div><br/>
			</div>
			<div class="table-responsive"><br/>
			<table id="datatableOverall" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Faculty</th>
						<th>Total Points</th>
						<th>No. of Evaluators</th>
						<th>Positive</br>Feedback</th>
						<th>Negative</br>Feedback</th>
						<th>Neutral</br>Feedback</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Faculty</th>
						<th>Total Points</th>
						<th>No. of Evaluators</th>
						<th>Positive</br>Feedback</th>
						<th>Negative</br>Feedback</th>
						<th>Neutral</br>Feedback</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
						$posData = 0;
						$neuData = 0;
						$negData = 0;
						$totalPoints = 0;
						$totalEvaluator = 0;
						$countPositive = 0;
						$countNegative = 0;
						$countNeutral = 0;
						$topPositive = "";
						$topNegative = "";
						$topNeutral = "";
						$totalPoints = 0;
						$fac_no = "";
						$resFaculty = mysqli_query($mysqli, "SELECT * from faculty");
						while ($rf = mysqli_fetch_assoc($resFaculty)){
							$resReport = mysqli_query($mysqli, "SELECT * from evaluate WHERE fac_no = '".$rf['row']."'");
							while ($rRprt = mysqli_fetch_assoc($resReport)){
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
										$fac_no = $rf['row'];
										$totalPoints = $totalPoints + (int)$rRprt['points'];
										if(strpos($rRprt['lexicon'], 'Positive')){ 
											if($countPositive == 0)
												$topPositive = strtoupper($rRprt['comment']);
											else
												$topPositive = $topPositive . " " . strtoupper($rRprt['comment']);
											$countPositive ++;
										}
										if(strpos($rRprt['lexicon'], 'Negative')){ 
											if($countNegative == 0)
												$topNegative = strtoupper($rRprt['comment']);
											else
												$topNegative = $topNegative . " " . strtoupper($rRprt['comment']);
											$countNegative ++;
										}
										if(strpos($rRprt['lexicon'], 'Neutral')){ 
											if($countNeutral == 0)
												$topNeutral = strtoupper($rRprt['comment']);
											else
												$topNeutral = $topNeutral . " " . strtoupper($rRprt['comment']);
											$countNeutral ++;
										}
										$totalEvaluator ++;
										
										$topPositive = str_replace(".","",$topPositive);
										$topPositive = str_replace("!","",$topPositive);
										$topPositive = str_replace(",","",$topPositive);
										$topPositive = str_replace("?","",$topPositive);
										$topPositive = str_replace(" AT","",$topPositive);
										$topPositive = str_replace(" TO","",$topPositive);
										$topPositive = str_replace(" IS","",$topPositive);
										$topPositive = str_replace(" BUT","",$topPositive);
										$topPositive = str_replace(" THE","",$topPositive);
										$topPositive = str_replace(" ARE","",$topPositive);
										$topPositive = str_replace(" SHE","",$topPositive);
										$topPositive = str_replace(" HIS","",$topPositive);
										$topPositive = str_replace(" HER","",$topPositive);
										$topPositive = str_replace(" HIS","",$topPositive);
										$topPositive = str_replace(" HERE","",$topPositive);
										$topPositive = str_replace(" THERE","",$topPositive);
										$topPositive = str_replace(" TEACHING","",$topPositive);
										$topPositive = str_replace(" TEACHER","",$topPositive);
										$topPositive = str_replace(" FACULTY","",$topPositive);
										$topPositive = str_replace(" INSTRUCTOR","",$topPositive);
										$topPositive = str_replace("  "," ",$topPositive);
										$topPositive = str_replace("  "," ",$topPositive);
										
										$topNegative = str_replace(".","",$topNegative);
										$topNegative = str_replace("!","",$topNegative);
										$topNegative = str_replace(",","",$topNegative);
										$topNegative = str_replace("?","",$topNegative);
										$topNegative = str_replace(" AT","",$topNegative);
										$topNegative = str_replace(" TO","",$topNegative);
										$topNegative = str_replace(" IS","",$topNegative);
										$topNegative = str_replace(" BUT","",$topNegative);
										$topNegative = str_replace(" THE","",$topNegative);
										$topNegative = str_replace(" ARE","",$topNegative);
										$topNegative = str_replace(" SHE","",$topNegative);
										$topNegative = str_replace(" HIS","",$topNegative);
										$topNegative = str_replace(" HER","",$topNegative);
										$topNegative = str_replace(" HIS","",$topNegative);
										$topNegative = str_replace(" HERE","",$topNegative);
										$topNegative = str_replace(" THERE","",$topNegative);
										$topNegative = str_replace(" TEACHING","",$topNegative);
										$topNegative = str_replace(" TEACHER","",$topNegative);
										$topNegative = str_replace(" FACULTY","",$topNegative);
										$topNegative = str_replace(" INSTRUCTOR","",$topNegative);
										$topNegative = str_replace("  "," ",$topNegative);
										$topNegative = str_replace("  "," ",$topNegative);
										
										$topNeutral = str_replace(".","",$topNeutral);
										$topNeutral = str_replace("!","",$topNeutral);
										$topNeutral = str_replace(",","",$topNeutral);
										$topNeutral = str_replace("?","",$topNeutral);
										$topNeutral = str_replace(" AT","",$topNeutral);
										$topNeutral = str_replace(" TO","",$topNeutral);
										$topNeutral = str_replace(" IS","",$topNeutral);
										$topNeutral = str_replace(" BUT","",$topNeutral);
										$topNeutral = str_replace(" THE","",$topNeutral);
										$topNeutral = str_replace(" ARE","",$topNeutral);
										$topNeutral = str_replace(" SHE","",$topNeutral);
										$topNeutral = str_replace(" HIS","",$topNeutral);
										$topNeutral = str_replace(" HER","",$topNeutral);
										$topNeutral = str_replace(" HIS","",$topNeutral);
										$topNeutral = str_replace(" HERE","",$topNeutral);
										$topNeutral = str_replace(" THERE","",$topNeutral);
										$topNeutral = str_replace(" TEACHER","",$topNeutral);
										$topNeutral = str_replace(" TEACHING","",$topNeutral);
										$topNeutral = str_replace(" FACULTY","",$topNeutral);
										$topNeutral = str_replace(" INSTRUCTOR","",$topNeutral);
										$topNeutral = str_replace("  "," ",$topNeutral);
										$topNeutral = str_replace("  "," ",$topNeutral);
									}
								}
							}
							if($fac_no != ""){
								echo "<tr>";
								echo "<td> ".strtoupper($rf['fn']." ".$rf['ln'])." </td>";
								echo "<td> $totalPoints  </td>";
								echo "<td> $totalEvaluator  </td>";
								if($countPositive > 0)
									echo "<td> <span data-toggle='modal' data-target='#cPos".$rf['row']."' style='color: #5a8dee;'><span class='glyphicon glyphicon-eye-open'></span></span>&nbsp $countPositive  </td>";
								else
									echo "<td> &nbsp&nbsp $countPositive  </td>";
								if($countNegative > 0)
									echo "<td> <span data-toggle='modal' data-target='#cNeg".$rf['row']."' style='color: #5a8dee;'><span class='glyphicon glyphicon-eye-open'></span></span>&nbsp $countNegative  </td>";
								else
									echo "<td> &nbsp&nbsp $countNegative  </td>";
								if($countNeutral > 0)
									echo "<td> <span data-toggle='modal' data-target='#cNeu".$rf['row']."' style='color: #5a8dee;'><span class='glyphicon glyphicon-eye-open'></span></span>&nbsp $countNeutral  </td>";
								else
									echo "<td> &nbsp&nbsp $countNeutral  </td>";
								echo "</tr>";
								?>
								<div class="modal fade" id="cNeg<?php echo $rf['row']?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title custom_align" id="Heading">Top Negative Feedback</h4>
											</div>
											<div class="modal-body">
												<?php
													$topNeg = explode(' ', $topNegative);
													$counts = array_count_values($topNeg);
													arsort($counts);
													$list = array_keys($counts);
													if(count($list) >= 1)
														if($list[0] != " ")
															if($list[0] != "")
																echo "<div class='alert alert-info'>".$list[0]."</div>";
													if(count($list) >= 2)
														if($list[1] != " ")
															if($list[1] != "")
																echo "<div class='alert alert-info'>".$list[1]."</div>";
													if(count($list) >= 3)
														if($list[2] != " ")
															if($list[2] != "")
																echo "<div class='alert alert-info'>".$list[2]."</div>";
													if(count($list) >= 1){
														if($list[0] == " " || $list[0] == ""){
															echo'
															<div class="alert alert-info">
																<span class="glyphicon glyphicon-info-sign"></span> 
																<strong>Information:</strong> No feedback results yet!
															</div>';
														}
													}
												?>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="cPos<?php echo $rf['row']?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title custom_align" id="Heading">Top Positive Feedback</h4>
											</div>
											<div class="modal-body">
												<?php
													$topPos = explode(' ', $topPositive);
													$counts = array_count_values($topPos);
													arsort($counts);
													$list = array_keys($counts);
													if(count($list) >= 1)
														if($list[0] != " ")
															if($list[0] != "")
																echo "<div class='alert alert-info'>".$list[0]."</div>";
													if(count($list) >= 2)
														if($list[1] != " ")
															if($list[1] != "")
																echo "<div class='alert alert-info'>".$list[1]."</div>";
													if(count($list) >= 3)
														if($list[2] != " ")
															if($list[2] != "")
																echo "<div class='alert alert-info'>".$list[2]."</div>";
													if(count($list) >= 1){
														if($list[0] == " " || $list[0] == ""){
															echo'
															<div class="alert alert-info">
																<span class="glyphicon glyphicon-info-sign"></span> 
																<strong>Information:</strong> No feedback results yet!
															</div>';
														}
													}
												?>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="cNeu<?php echo $rf['row']?>" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title custom_align" id="Heading">Top Neutral Feedback</h4>
											</div>
											<div class="modal-body">
												<?php
													$topNeu = explode(' ', $topNeutral);
													$counts = array_count_values($topNeu);
													arsort($counts);
													$list = array_keys($counts);
													if(count($list) >= 1)
														if($list[0] != " ")
															if($list[0] != "")
																echo "<div class='alert alert-info'>".$list[0]."</div>";
													if(count($list) >= 2)
														if($list[1] != " ")
															if($list[1] != "")
																echo "<div class='alert alert-info'>".$list[1]."</div>";
													if(count($list) >= 3)
														if($list[2] != " ")
															if($list[2] != "")
																echo "<div class='alert alert-info'>".$list[2]."</div>";
													if(count($list) >= 1){
														if($list[0] == " " || $list[0] == ""){
															echo'
															<div class="alert alert-info">
																<span class="glyphicon glyphicon-info-sign"></span> 
																<strong>Information:</strong> No feedback results yet!
															</div>';
														}
													}
												?>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
											</div>
										</div>
									</div>
								</div>
								<?php
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
<div class="modal fade" id="prefOE" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Preference</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="aySched1">School Year</label>
					<select class="form-control" id="aySched1">
						<?php
							echo "<option value='".$ay1."' hidden>".$ay1."-".($ay1+1)."</option>";
							for($x = (int)date('Y'); $x >= 2009; $x--){
								echo "<option value='".$x."'>".$x."-".($x+1)."</option>";
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="semSched1">Semester</label>
					<select class="form-control" id="semSched1">
						<?php echo "<option value='".$sem1."' hidden>".$sem1."</option>";?>
						<option value="First Semester">First Semester</option>
						<option value="Second Semester">Second Semester</option>
						<option value="Summer">Summer</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<a type="button" class="btn btn-primary" onclick="prefe();"><span class="glyphicon glyphicon-floppy-disk"></span> Set</a>
				<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
			</div>
		</div>
	</div>
</div>
<script>
	function prefe(){
		var ay = $('#aySched1').val();
		var sem = $('#semSched1').val();
		var datas="ay="+ay+"&sem="+sem;
		$.ajax({
			type: "POST",
			url: "preference.php",
			data: datas
		}).done(function( data) {
			$('#prefOE').modal('hide');
			$('.modal-backdrop').hide();
			overallTab();
		});
	}
	$(document).ready(function() {
		$('#datatableOverall').dataTable();
		$("[data-toggle=tooltip]").tooltip();
	});
</script>