<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
?>
<div class="container">
	<h3>Department</h3>
	<button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addDpt" style="margin-bottom: 10px;">
		<span class="glyphicon glyphicon-plus"> Add Department
	</button><br/>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive"><br/>
			<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>Department Acronym</th>
							<th>Full Description</th>
							<th>Email (Header)</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
							<th>Department Acronym</th>
							<th>Full Description</th>
							<th>Email (Header)</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
							$resDpt =mysqli_query($mysqli, "SELECT * from department");
								while ($rDpt = mysqli_fetch_assoc($resDpt)){
									echo "<tr>
											<td><center>
												<a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#editDpt".$rDpt['row']."'>
													<span class='glyphicon glyphicon-pencil'></span>
												</a>
												<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#deltDpt".$rDpt['row']."'>
													<span class='glyphicon glyphicon-trash'></span>
												</a></center>
											</td>
											<td> $rDpt[dptno] </td>
											<td> $rDpt[dscrpt] </td>
											<td> $rDpt[email] </td>";
						?>
						<div class="modal fade" id="editDpt<?php echo $rDpt['row']?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
									</div>
									<div class="modal-body">
										<span id="alertuDpt<?php echo $rDpt['row']?>"></span>
										<div class="form-group">
											<label for="dptnoDprt">Department Acronym</label>
											<input class="form-control" id="dptnoDprt<?php echo $rDpt['row']?>" value="<?php echo $rDpt['dptno'];?>" type="text" placeholder="Department Acronym">
										</div>
										<div class="form-group">
											<label for="dscrptDprt">Full Description<b style="color:red">*</b></label>
											<input class="form-control" id="dscrptDprt<?php echo $rDpt['row']?>" value="<?php echo $rDpt['dscrpt'];?>" type="text" placeholder="Full Description">
										</div>
										<hr/>
										<label>HEADER</label>
										<div class="form-group">
											<label for="emailDprt<?php echo $rDpt['row']?>">Email<b style="color:red">*</b></label>
											<input class="form-control" id="emailDprt<?php echo $rDpt['row']?>" value="<?php echo $rDpt['email'];?>" type="text" placeholder="Email for Header">
										</div>
										<div class="form-group">
											<label for="contactDprt<?php echo $rDpt['row']?>">Contact</label>
											<input class="form-control" id="contactDprt<?php echo $rDpt['row']?>" value="<?php echo $rDpt['contact'];?>" type="text" placeholder="Contact No. for Header">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning btn-block" id="updateDepartment<?php echo $rDpt['row']?>"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="deltDpt<?php echo $rDpt['row']?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
									</div>
									<div class="modal-body">
										<div class="alert alert-danger">
											<span class="glyphicon glyphicon-warning-sign"></span> 
											Are you sure you want to delete this Department?
										</div>
									</div>
									<div class="modal-footer">
										<a type="button" class="btn btn-success" id="deleteDepartment<?php echo $rDpt['row']?>"><span class="glyphicon glyphicon-ok-sign"></span> Yes</a>
										<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</a>
									</div>
								</div>
							</div>
						</div>
						<script>
							$('#deleteDepartment<?php echo $rDpt['row']?>').on('click', function () {
								var row = "<?php echo $rDpt['row']?>";
								var datas="row="+row;
								$.ajax({
									type: "POST",
									url: "deleteDpt.php",
									data: datas
								}).done(function(data){
									$('#deltDpt<?php echo $rDpt['row']?>').modal('hide');
									$('.modal-backdrop').hide();
									departmentTab();
									adminTab();
									$('#alertMessage').html(data);
									hideAlert();
								});
							});
							$('#updateDepartment<?php echo $rDpt['row']?>').on('click', function () {
								var row = "<?php echo $rDpt['row']?>";
								var dptno = $('#dptnoDprt<?php echo $rDpt['row']?>').val();
								var dscrpt = $('#dscrptDprt<?php echo $rDpt['row']?>').val();
								var email = $('#emailDprt<?php echo $rDpt['row']?>').val();
								var contact = $('#contactDprt<?php echo $rDpt['row']?>').val();
								if(dptno == "" || dscrpt == "" || email == ""){
									$('#alertuDpt<?php echo $rDpt['row']?>').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill empty field!</div>');
								}else{
									var datas="row="+row+"&dptno="+dptno+"&dscrpt="+dscrpt+"&email="+email+"&contact="+contact;
									$.ajax({
										type: "POST",
										url: "updateDpt.php",
										data: datas
									}).done(function(data){
										if(data == "dptnoError"){
											$('#alertuDpt').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Department Acronym already exist!</div>');
										}else if(data == "dscrptError"){
											$('#alertuDpt').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Department Description already exist!</div>');
										}else{
											$('#editDpt<?php echo $rDpt['row']?>').modal('hide');
											$('.modal-backdrop').hide();
											departmentTab();
											adminTab();
											$('#alertMessage').html(data);
											hideAlert();
										}
									});
								}
							});
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
<div class="modal fade" id="addDpt" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Add Department</h4>
			</div>
			<div class="modal-body">
				<span id="alertDpt"></span>
				<div class="form-group">
					<label for="daDprt">Department Acronym<b style="color:red">*</b></label>
					<input class="form-control" id="daDprt" type="text" placeholder="Department Acronym">
				</div>
				<div class="form-group">
					<label for="fdDprt">Full Description<b style="color:red">*</b></label>
					<input class="form-control" id="fdDprt" type="text" placeholder="Full Description">
				</div>
				<hr/>
				<label>HEADER</label>
				<div class="form-group">
					<label for="emailDprt">Email<b style="color:red">*</b></label>
					<input class="form-control" id="emailDprt" type="text" placeholder="Email for Header">
				</div>
				<div class="form-group">
					<label for="contactDprt">Contact</label>
					<input class="form-control" id="contactDprt" type="text" placeholder="Contact No. for Header">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="addDepartment();"><span class="glyphicon glyphicon-ok-sign"></span> Add</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#datatable').dataTable();
		 $("[data-toggle=tooltip]").tooltip();
	});
	
	function addDepartment(){
		var dptno = $('#daDprt').val();
		var dscrpt = $('#fdDprt').val();
		var email = $('#emailDprt').val();
		var contact = $('#contactDprt').val();
		if(dptno == "" || dscrpt == "" || email == ""){
			$('#alertDpt').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill required field!</div>');
		}else{
			var datas="dptno="+dptno+"&dscrpt="+dscrpt+"&email="+email+"&contact="+contact;
			$.ajax({
				type: "POST",
				url: "addDepartment.php",
				data: datas
			}).done(function( data) {
				if(data == "dptnoError"){
					$('#alertDpt').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Department Acronym already exist!</div>');
				}else if(data == "dscrptError"){
					$('#alertDpt').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Department Description already exist!</div>');
				}else{
					$('#addDpt').modal('hide');
					$('.modal-backdrop').hide();
					departmentTab();
					adminTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
</script>