<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
	date_default_timezone_set('Asia/Manila');
	$row = $_SESSION['row'];
	$position = $_SESSION['position'];
	
	$position = $_SESSION['position'];
	$resultIDs =mysqli_query($mysqli, "SELECT * from student WHERE row='$row'");
	if ($rs = mysqli_fetch_assoc($resultIDs)){
		$department = $rs['dept'];
		$fn = $rs['fn'];
		$ln = $rs['ln'];
		$deprt = $rs['dept'];
		$image = $rs['image'];
		
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
?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<h3>Evaluate</h3>
		</div>
		<div class="col-md-3">
			<br/>
			<div class="col-md-12 label-warning preClass">
				School Year: <?php echo $sy;?><br/>
				Semester: <?php echo $se;?> &nbsp;&nbsp; <span data-toggle='modal' data-target='#pref200' style='color: #5a8dee;'><span class='glyphicon glyphicon-edit'></span></span>
			</div>
		</div><br/>
	</div>
	<br/>
	<div class="row">
		<?php
            if('All' == $ay1 && 'All' == $sem1)
               $resEvaluateRecord =mysqli_query($mysqli, "SELECT * from schedule where stud_no = '$row' order by ay desc, sem desc"); 
            elseif('All' == $ay1)
                $resEvaluateRecord =mysqli_query($mysqli, "SELECT * from schedule where stud_no = '$row' and sem = '$sem1' order by ay desc, sem desc");
            elseif('All' == $sem1)
                $resEvaluateRecord =mysqli_query($mysqli, "SELECT * from schedule where stud_no = '$row' and  ay = '$ay1' order by ay desc, sem desc");
            else
			 $resEvaluateRecord =mysqli_query($mysqli, "SELECT * from schedule where stud_no = '$row' and  ay = '$ay1' and  sem = '$sem1' order by ay desc, sem desc");
			while ($rER = mysqli_fetch_assoc($resEvaluateRecord)){
				$searchEvaluateRecord =mysqli_query($mysqli, "SELECT * from evaluate where shed_no = '".$rER['row']."' and evaluator_no = '$row'");
				if ($sERs = mysqli_fetch_assoc($searchEvaluateRecord)){
					print("<div class='col-md-4'>");
						print("<a type='button' class='btn btn-success btn-block' style='text-align: left;' data-toggle='modal' data-target='#evaluatePage".$rER['row']."'>");
									$resEvRecord =mysqli_query($mysqli, "SELECT * from faculty where row = '".$rER['fac_no']."'");
									if ($rERs = mysqli_fetch_assoc($resEvRecord)){
										print("&nbsp&nbsp<strong>".strtoupper($rERs['fn']." ".$rERs['ln']));
										print("<center><h2><span class='glyphicon glyphicon-check'></span> Evaluated</strong></h2> ".$rER['ay']."-".($rER['ay']+1)." $rER[sem] </center>");
									}
						print("</a><br/>");
					print("</div>");
				}else{
					print("<div class='col-md-4'>");
						print("<a type='button' class='btn btn-primary btn-block' style='text-align: left;' data-toggle='modal' data-target='#evaluatemodal".$rER['row']."' onclick='warning();'>");
									$resEvRecord =mysqli_query($mysqli, "SELECT * from faculty where row = '".$rER['fac_no']."'");
									if ($rERs = mysqli_fetch_assoc($resEvRecord)){
										print("&nbsp&nbsp<strong>".strtoupper($rERs['fn']." ".$rERs['ln']));
										print("<center><h2><span class='glyphicon glyphicon-edit'></span> Evaluate</strong></h2> ".$rER['ay']."-".($rER['ay']+1)." $rER[sem] </center>");
									}
						print("</a><br/>");
					print("</div>");
				}
			?>
			<div class="modal fade" id="evaluatePage<?php echo $rER['row']?>" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title custom_align" id="Heading">Evaluation Form</h4>
						</div>
						<div class="modal-body">
							<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<?php
									$commentF = "";
									$seqArray = ['A.','B.','C.','D.','E.','F.','G.','H.','I.','J.','K.','L.','M.','N.','O.','P.','Q.','R.','S.','T.','U.','V.','W.','X.','Y.','Z.'];
									$countCategory = 0;
									$resAYS =mysqli_query($mysqli, "SELECT * from schedule where row = '".$rER['row']."'");
									if ($rAys = mysqli_fetch_assoc($resAYS)){
										$getFrm =mysqli_query($mysqli, "SELECT * from form where row = '".$rAys['frm_no']."'");
										if ($rFrms = mysqli_fetch_assoc($getFrm)){
											echo "<tr><th colspan='2'><center>".$rFrms['frm_name']."</center></th></tr>";
										}
										$getAns =mysqli_query($mysqli, "SELECT * from category where frm_no = '".$rAys['frm_no']."'");
										while ($rAns = mysqli_fetch_assoc($getAns)){
											echo "<tr><th> ".$seqArray[$countCategory]." ".$rAns['cat_name']." </th><th><center>RATE</center></th></tr>";
											$countCategory++;
											$totalAns = 0;
											$countAns = 0;
											$getAnsr =mysqli_query($mysqli, "SELECT * from question where cat_no = '".$rAns['row']."' order by cat_no asc, arrngmnt asc");
											while ($rAnsr = mysqli_fetch_assoc($getAnsr)){
												echo "<tr><td> ".$rAnsr['arrngmnt'].".  ".$rAnsr['question']." </th><td><center>";
												
													$getFrmRate1 = mysqli_query($mysqli, "SELECT * from evaluate where shed_no = '".$rER['row']."' and evaluator_no = '$row' and fac_no = '".$rERs['row']."'");
													if($getFRate = mysqli_fetch_assoc($getFrmRate1)){
														$getRate = $getFRate['rate'];
														$rateArray = explode(',', $getRate);
														$coutRate = count($rateArray);
														$tempRate = "";
														for($rX = 0;$rX < $coutRate;$rX++){
															$temp = explode(' ', $rateArray[$rX]);
															if($rAnsr['row'] == $temp[0]){
																$tempRate = $temp[1];
																if((int)$tempRate == 5)
																	echo "5";
																else if((int)$tempRate == 4)
																	echo "4";
																else if((int)$tempRate == 3)
																	echo "3";
																else if((int)$tempRate == 2)
																	echo "2";
																else if((int)$tempRate == 1)
																	echo "1";
																$totalAns += (int)$tempRate;
																$countAns++;
																$commentF = $getFRate['comment'];
															}
														}
													}
												echo "</center></td></tr>";
											}
										}
									}
								?>
							</table>
							</div>
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<tr><th>COMMENT</th></tr>
									<tr><td><?php echo $commentF;?></td></tr>
								</table>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						</div>
					</div>
				</div>
			</div>
                <div class="modal fade" id="evaluatemodal<?php echo $rER['row'];?>" role="dialog">
                    <div class="row navbar fixed-top" style="position:fixed;box-shadow:0px 0px  0px 0px;margin-top:0%">
                        <div class="col-sm-12">
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-warning-sign"></span> 
                                <strong>Warning:</strong> The content of this form may contain confidential data and is intended solely for the addressee(s). Any unauthorized review, use, disclosure, or distribution is strictly prohibited under the Data Privacy Act.
                            </div>
                        </div>
                    </div>
				<div class="modal-dialog" style="margin-top:15rem">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title custom_align" id="Heading">
							<?php 
								$resFormre =mysqli_query($mysqli, "SELECT * from form where row = '".$rER['frm_no']."'");
								if ($formre = mysqli_fetch_assoc($resFormre)){
									echo strtoupper($formre['frm_name']);
								}
							?>
							</h4>
						</div>
						<div class="modal-body">
							<h3><?php echo strtoupper($rERs['fn']." ".$rERs['ln']);?></h3>
							<div class="form-group">
								<div class="tab-content">
									<?php
										$div_count = 0;
                                        $tempcat='';
										$resQuestdata =mysqli_query($mysqli, "SELECT * from question order by cat_no asc, arrngmnt asc");
										while ($quest = mysqli_fetch_assoc($resQuestdata)){
											$resCategorydata =mysqli_query($mysqli, "SELECT * from category where row = '".$quest['cat_no']."'	");
											if ($category = mysqli_fetch_assoc($resCategorydata)){
												$resFormdata =mysqli_query($mysqli, "SELECT * from form where row = '".$rER['frm_no']."'");
												if ($form = mysqli_fetch_assoc($resFormdata)){
//													$div_count++;
													if($div_count == 1){
												?>	
													<div id="<?php echo $rER['row'];?>eval<?php echo $div_count;?>" >
													<div class="row">
												<?php
													}else{
												?>
													<div id="<?php echo $rER['row'];?>eval<?php echo $div_count;?>" >
													<div class="row">
												<?php
													}
													$resCateQuestdata =mysqli_query($mysqli, "SELECT * from question where cat_no = '".$category['row']."'");
													if ($qData = mysqli_fetch_assoc($resCateQuestdata)){
                                                        
                                                        if($tempcat != $category['cat_name']){
                                                            echo "<center><h4><strong>".strtoupper($category['cat_name'])."</strong></h4></center>";
                                                        }
                                                        $tempcat = $category['cat_name'];
//														echo "<center><h4><strong>".strtoupper($category['cat_name'])."</strong></h4></center>";
														echo '
														<div class="col-md-12">
															<div class="form-group">
																<label>'.strtoupper($quest['question']).'</label></br>
																<form>
																<div class="col-md-6">
																	<div class="radio">
																		<label><input type="radio" class="rb'.$quest['row'].'" name="rb'.$quest['row'].'" value="5" checked>5 Outstanding</label>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="radio">
																		<label><input type="radio" class="rb'.$quest['row'].'" name="rb'.$quest['row'].'"  value="4">4 Very Satisfactory</label>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="radio">
																		<label><input type="radio" class="rb'.$quest['row'].'" name="rb'.$quest['row'].'" value="3">3 Satisfactory</label>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="radio">
																		<label><input type="radio" class="rb'.$quest['row'].'" name="rb'.$quest['row'].'" value="2">2 Fair</label>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="radio">
																		<label><input type="radio" class="rb'.$quest['row'].'" name="rb'.$quest['row'].'" value="1">1 Poor</label>
																	</div>
																</div>
																</form>
															</div>
														</div>';
													}
												?>
													</div>
													</div>
												<?php
												}
											}
										}
									?>
									<div id="<?php echo $rER['row'];?>eval<?php echo $div_count+1;?>">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="comment<?php echo $rER['row'];?>">Comment:</label>
													<textarea class="form-control" rows="5" id="comment<?php echo $rER['row'];?>" style="resize: vertical;"></textarea>
												</div>
												<hr>
												<div class="form-group">
													<div class="alert alert-danger">
														<span class="glyphicon glyphicon-warning-sign"></span> 
														This cannot be undone. Are you sure you want to submit?
													</div>
												</div>
												<hr>
												<div class="form-group">
													<a href="#" class="btn btn-success pull-right" data-toggle="tab" style="text-decoration:none;;width:100%" onclick="subEval<?php echo $rER['row'];?>()" >
														<span class="glyphicon glyphicon-ok-sign"></span> Submit
													</a>
												</div>	
											</div>
										</div>
									</div>
								</div>
							</div>
							<script>
								function subEval<?php echo $rER['row'];?>(){
									<?php
										$datas = "";
										$dCount = 0;
										$resQuestdata =mysqli_query($mysqli, "SELECT * from question order by cat_no asc, arrngmnt asc");
										while ($quest = mysqli_fetch_assoc($resQuestdata)){
											$resCategorydata =mysqli_query($mysqli, "SELECT * from category where row = '".$quest['cat_no']."'	");
											if ($category = mysqli_fetch_assoc($resCategorydata)){
												$resFormdata =mysqli_query($mysqli, "SELECT * from form where row = '".$rER['frm_no']."'");
												if ($form = mysqli_fetch_assoc($resFormdata)){
													$resCateQuestdata =mysqli_query($mysqli, "SELECT * from question where cat_no = '".$category['row']."'");
													if ($getQ = mysqli_fetch_assoc($resCateQuestdata)){
														$dCount++;
														echo 'var quest'.$quest['row'].' = "'.$quest['row'].' "+$("input[type=radio].rb'.$quest['row'].':checked").val();';
														if($dCount == 1){
															$datas = $datas."'quest".$quest['row']."='+quest".$quest['row'];
														}else{
															$datas = $datas."+'&quest".$quest['row']."='+quest".$quest['row'];
														}
													}
												}
											}
										}
										echo "var comment".$rER['row']." = $('#comment".$rER['row']."').val();";
										echo "var datas = '';";
										echo "
											datas = ".$datas."+'&eval=0'+'&evaluator_no=".$row."'+'&fac_no=".$rER['fac_no']."'+'&comment='+comment".$rER['row'].";
											$.ajax({
												type: 'POST',
												url: 'saveEvaluate.php?id=+".$rER['row']."',
												data: datas
											}).done(function(data){
												$('#evaluatemodal".$rER['row']."').modal('hide');
												$('.modal-backdrop').hide();
												evalRecordTab();
												$('#alertMessage').html(data);
												hideAlert();
											});";
									?>
								}
							</script>
						</div>
					</div>
				</div>
			</div>
		<?php
			}
		?>
	</div>
</div>
<div class="modal fade" id="pref200" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Preference</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="aySched2">School Year</label>
					<select class="form-control" id="aySched2">
						<?php
                            if ($ay1 == 'All')
							 echo "<option value='All' hidden>All</option>";
                            else
							 echo "<option value='".$ay1."' hidden>".$ay1."-".($ay1+1)."</option>";
							for($x = (int)date('Y'); $x >= 2009; $x--){
								echo "<option value='".$x."'>".$x."-".($x+1)."</option>";
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="semSched2">Semester</label>
					<select class="form-control" id="semSched2">
						<?php echo "<option value='".$sem1."' hidden>".$sem1."</option>";?>
						<option value="First Semester">First Semester</option>
						<option value="Second Semester">Second Semester</option>
						<option value="Summer">Summer</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<a type="button" class="btn btn-primary" onclick="prefe2();"><span class="glyphicon glyphicon-floppy-disk"></span> Set</a>
				<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
			</div>
		</div>
	</div>
</div>

<script>
	function prefe2(){
		var ay = $('#aySched2').val();
		var sem = $('#semSched2').val();
		var datas="ay="+ay+"&sem="+sem;
		$.ajax({
			type: "POST",
			url: "preference.php",
			data: datas
		}).done(function( data) {
			$('#pref').modal('hide');
			$('.modal-backdrop').hide();
			evalRecordTab();
		});
	}
	$(document).ready(function() {
		$('#datatableEvaluated').dataTable();
		$("[data-toggle=tooltip]").tooltip();
	});
	
	function warning(){
		var msg = new SpeechSynthesisUtterance();
		msg.text = "Warning : unauthorized review, use, disclosure, or distribution is a violation against Republic act number 1 0 1 7 3.";
		window.speechSynthesis.speak(msg);
	}
</script>