<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
?>
<div class="container">
	<h3>Evaluation</h3>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label for="evalForm">Form</label>
				<select class="form-control" id="evalForm">
					<?php
						$resEF =mysqli_query($mysqli, "SELECT * from form");
						while ($rEF = mysqli_fetch_assoc($resEF)){
							echo "<option value='".$rEF['row']."'>".$rEF['frm_name']."</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="ayear">Academic Year</label>
				<select class="form-control" id="ayear">
					<?php
						for($x = (int)date('Y'); $x >= 2009; $x--){
							echo "<option value='".$x."'>".$x."-".($x+1)."</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="sem">Semester</label>
				<select class="form-control" id="sem">
					<option value="First Semester">First Semester</option>
					<option value="Second Semester">Second Semester</option>
					<option value="Summer">Summer</option>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="addEF">Evaluation Form</label>
				<button type="button" class="btn btn-primary btn-block" onclick="addEvaluationForm();">
					<span class="glyphicon glyphicon-plus"> Add
				</button>
			</div>
		</div>
	</div>
</div><br/>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive"><br/>
				<table id="datatableEva" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>Form</th>
							<th>Academic Year</th>
							<th>Semester</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
							<th>Form</th>
							<th>Academic Year</th>
							<th>Semester</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
							$resEFs =mysqli_query($mysqli, "SELECT * from evaluation_form");
							while ($eEFs = mysqli_fetch_assoc($resEFs)){
								echo "<tr>
										<td><center>
											<a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#editEFs".$eEFs['row']."'>
												<span class='glyphicon glyphicon-pencil'></span>
											</a>
										</td>";
								$resFrnNo =mysqli_query($mysqli, "SELECT * from form where row = '".$eEFs['frm_no']."'");
								if($eEF2 = mysqli_fetch_assoc($resFrnNo)){
									echo "<td> $eEF2[frm_name] </td>";
								}
								echo 	"<td> ".$eEFs['ay']."-".($eEFs['ay']+1)." </td>
										<td> $eEFs[sem] </td>";
						?>
						
						<div class="modal fade" id="editEFs<?php echo $eEFs['row']?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Edit Evaluation Form</h4>
									</div>
									<div class="modal-body">
										<span id="alertuEF<?php echo $eEFs['row']?>"></span>
										<div class="form-group">
											<label for="evalForm<?php echo $eEFs['row']?>">Form</label>
											<select class="form-control" id="evalForm<?php echo $eEFs['row']?>">
												<?php
													$resFrnNo2 =mysqli_query($mysqli, "SELECT * from form where row = '".$eEFs['frm_no']."'");
													if($eEF3 = mysqli_fetch_assoc($resFrnNo2)){
														echo "<option value='".$eEF3['row']."' hidden>".$eEF3['frm_name']."</option>";
													}
													$resEF =mysqli_query($mysqli, "SELECT * from form");
													while ($rEF = mysqli_fetch_assoc($resEF)){
														echo "<option value='".$rEF['row']."'>".$rEF['frm_name']."</option>";
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="ayear<?php echo $eEFs['row']?>">Academic Year</label>
											<select class="form-control" id="ayear<?php echo $eEFs['row']?>">
												<?php
													echo "<option value='".$eEFs['ay']."' hidden>".$eEFs['ay']."-".($eEFs['ay']+1)."</option>";
													for($x = (int)date('Y'); $x >= 2009; $x--){
														echo "<option value='".$x."'>".$x."-".($x+1)."</option>";
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="sem<?php echo $eEFs['row']?>">Semester</label>
											<select class="form-control" id="sem<?php echo $eEFs['row']?>">
												<?php
													echo "<option value='".$eEFs['sem']."' hidden>".$eEFs['sem']."</option>";
												?>
												<option value="First Semester">First Semester</option>
												<option value="Second Semester">Second Semester</option>
												<option value="Summer">Summer</option>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning btn-block" onclick="updateEvaluationForm<?php echo $eEFs['row']?>();"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
									</div>
								</div>
							</div>
						</div>
						<script>
							function updateEvaluationForm<?php echo $eEFs['row']?>(){
								var row = "<?php echo $eEFs['row']?>";
								var frm_no = $('#evalForm<?php echo $eEFs['row']?>').val();
								var ay = $('#ayear<?php echo $eEFs['row']?>').val();
								var sem = $('#sem<?php echo $eEFs['row']?>').val();
								var datas="row="+row+"&frm_no="+frm_no+"&ay="+ay+"&sem="+sem;
								$.ajax({
									type: "POST",
									url: "updateEvaluation.php",
									data: datas
								}).done(function( data) {
									if(data == "formError"){
										$('#alertuEF<?php echo $eEFs['row']?>').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Evaluation Form already exist!</div>');
									}else{
										$('#editEFs<?php echo $eEFs['row']?>').modal('hide');
										$('.modal-backdrop').hide();
										evaluationTab();
										$('#alertMessage').html(data);
										hideAlert();
									}
								});
							}
						</script>
						<?php
							echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#datatableEva').dataTable();
		 $("[data-toggle=tooltip]").tooltip();
	});
	
	function addEvaluationForm(){
		var frm_no = $('#evalForm').val();
		var ay = $('#ayear').val();
		var sem = $('#sem').val();
		var datas="frm_no="+frm_no+"&ay="+ay+"&sem="+sem;
		$.ajax({
			type: "POST",
			url: "addEvaluation.php",
			data: datas
		}).done(function( data) {
			if(data == "formError"){
				$('#alertMessage').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Evaluation Form already exist!</div>');
			}else{
				evaluationTab();
				$('#alertMessage').html(data);
			}
			hideAlert();
		});
	}
</script>