<?php 
	include_once 'dbConfig.php';
	require_once('loginSession.php');
	
	$message = "";
	$row = $_POST['stud_no'];
	$dept = $_POST['dept'];
	$ay = $_POST['ay'];
	$sem = $_POST['sem'];
	
	$resStud =mysqli_query($mysqli, "SELECT * from student where row = '$row'");
	if($resS = mysqli_fetch_assoc($resStud)){
		?>
			<div align="left" class="modal fade" id="modalAddFaculty">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Faculty</h4>
						</div>
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th><input type="checkbox" id="checkAll" onchange="checkAll();"></th>
											<th>Name</th>
											<th>Academic Rank</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th></th>
											<th>Name</th>
											<th>Academic Rank</th>
										</tr>
									</tfoot>
									<tbody>
										<?php
											$resFac1223 =mysqli_query($mysqli, "SELECT * from faculty where dept = '$dept'");
											while ($rF = mysqli_fetch_assoc($resFac1223)){
												
												$resFrm =mysqli_query($mysqli, "SELECT * from schedule where stud_no = '$row' and fac_no = '".$rF['row']."' and ay = '$ay' and  sem = '$sem'");
												if($rFrm = mysqli_fetch_assoc($resFrm)){
													echo "<tr class='success'>";
													echo "<td><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></td>";
													echo "<td>
																".strtoupper($rF['ln'].", ".$rF['fn'])."
															</td>";
												}else{
													echo "<tr onclick='check".$rF['row']."();'>";
													echo "<td><input type='checkbox' name='checkFac' value='".$rF['row']."' id='checkFac".$rF['row']."' onclick='check".$rF['row']."();'></td>";
													echo "<td>
															".strtoupper($rF['ln'].", ".$rF['fn'])."
														</td>";
												}
												
												echo "<td>".$rF['rank']."</td>";
												echo "<script> 
														function check".$rF['row']."(){
															if(document.getElementById('checkFac".$rF['row']."').checked == false)
																document.getElementById('checkFac".$rF['row']."').checked = true;
															else
																document.getElementById('checkFac".$rF['row']."').checked = false;
															document.getElementById('checkAll').checked = false;
														}
													</script>
													</tr>";
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success" onclick="addScheduleFaculty();">
								<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								 Add
							</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 
								Close
							</button>
						</div>
					</div>
				</div>
			</div>
			<script>
				function checkAll() {
					if(document.getElementById('checkAll').checked == false){
						var items = document.getElementsByName('checkFac');
						for (var i = 0; i < items.length; i++) {
							if (items[i].type == 'checkbox')
								items[i].checked = false;
						}
					}else{
						var items = document.getElementsByName('checkFac');
						for (var i = 0; i < items.length; i++) {
							if (items[i].type == 'checkbox')
								items[i].checked = true;
						}
					}
				}
				function addScheduleFaculty() {
					var items = document.getElementsByName('checkFac');
					var checkid = "";
					for (var i = 0; i < items.length; i++) {
						if (items[i].type == 'checkbox'){
							if(items[i].checked == true){
								if(checkid == "")
									var checkid = items[i].value;
								else
									var checkid = checkid + " " + items[i].value;
							}
						}
					}
					
					var frm_no = $('#frm_noSched').val();
					var stud_no = $('#stude_noSched').val();
					var ay = $('#aySched1').val();
					var sem = $('#semSched1').val();
					var datas="frm_no="+frm_no+"&stud_no="+stud_no+"&ay="+ay+"&sem="+sem+"&checkid="+checkid;
					$.ajax({
						type: "POST",
						url: "addSchedule.php",
						data: datas
					}).done(function( data) {
						$('#modalAddFaculty').modal('hide');
						$('.modal-backdrop').hide();
						scheduleTable();
						setPre();
						$('#alertSched').html(data);
						hideAlert();
					});
				}
			</script>
		<?php
		$message = "<script>$('#modalAddFaculty').modal('show');</script>";
	}else{
		$message = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Student not found!</div>';
	}
	
	echo $message;
	mysqli_close($mysqli);
 ?>