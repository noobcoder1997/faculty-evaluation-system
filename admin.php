<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
	$row = $_SESSION['row'];
	$position = $_SESSION['position'];
?>
<div class="container">
	<h3>Administrator</h3>
	<?php 
		if($position == "Super Administrator"){
	?>
	<button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addAdm" style="margin-bottom: 10px;">
		<span class="glyphicon glyphicon-plus"> Add Administrator
	</button><br/>
	<?php 
		}
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
			<table id="datatableAdmn" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<?php 
								if($position == "Super Administrator"){
							?>
							<th><center>Edit</center></th>
							<th><center>Delete</center></th>
							<?php 
								}
							?>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<?php 
								if($position == "Super Administrator"){
							?>
							<th><center>Edit</center></th>
							<th><center>Delete</center></th>
							<?php 
								}
							?>
						</tr>
					</tfoot>
					<tbody>
						<?php
							$resAdmn =mysqli_query($mysqli, "SELECT * from admin where position = 'Administrator' order by row desc");
								while ($rAdm = mysqli_fetch_assoc($resAdmn)){
									echo "<tr>
											<td> $rAdm[ln] </td>
											<td> $rAdm[fn] </td>
											<td> $rAdm[mn] </td>";
									if($position == "Super Administrator"){
										echo 	"<td>
													<center>
														<button class='btn btn-warning btn-xs' data-toggle='modal' data-target='#editAdmn".$rAdm['row']."'>
															<span class='glyphicon glyphicon-pencil'></span> Edit
														</button>
													</center>
												</td>
												<td>
													<center>
														<button class='btn btn-danger btn-xs' data-toggle='modal' data-target='#deltAdmn".$rAdm['row']."'>
															<span class='glyphicon glyphicon-trash'></span> Delete
														</button>
													</center>
												</td>
											</tr>";
									}
						?>
						<div class="modal fade" id="deltAdmn<?php echo $rAdm['row']?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
									</div>
									<div class="modal-body">
										<div class="alert alert-danger">
											<span class="glyphicon glyphicon-warning-sign"></span> 
											Are you sure you want to delete this Administrator Account?
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" onclick="deleteAdmin('<?php echo $rAdm['row']?>');"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
										<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="editAdmn<?php echo $rAdm['row']?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label for="userAdmin<?php echo $rAdm['row']?>">Username<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rAdm['user']?>" id="userAdmin<?php echo $rAdm['row']?>" type="text" placeholder="Username">
										</div>
										<div class="form-group">
											<label for="passeAdmin<?php echo $rAdm['row']?>">Password</label>
											<input class="form-control" id="passeAdmin<?php echo $rAdm['row']?>" type="password" placeholder="If empty will not change">
										</div>
										<div class="form-group">
											<label for="passeAdmin2<?php echo $rAdm['row']?>">Confirm Password</label>
											<input class="form-control" id="passeAdmin2<?php echo $rAdm['row']?>" type="password" placeholder="Confirm Password">
										</div>
										<div class="form-group">
											<label for="fnAdmin<?php echo $rAdm['row']?>">First Name<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rAdm['fn']?>" id="fnAdmin<?php echo $rAdm['row']?>" type="text" placeholder="First Name">
										</div>
										<div class="form-group">
											<label for="mnAdmin<?php echo $rAdm['row']?>">Middle Name</label>
											<input class="form-control" value="<?php echo $rAdm['mn']?>" value="<?php echo $rAdm['row']?>" id="mnAdmin<?php echo $rAdm['row']?>" type="text" placeholder="Middle Name">
										</div>
										<div class="form-group">
											<label for="lnAdmin<?php echo $rAdm['row']?>">Last Name<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rAdm['ln']?>" id="lnAdmin<?php echo $rAdm['row']?>" type="text" placeholder="Last Name">
										</div>
										<span id="alertuAdm<?php echo $rAdm['row']?>"></span>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning btn-block" onclick="updateAdmin('<?php echo $rAdm['row']?>');"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
									</div>
								</div>
							</div>
						</div>
						<?php				 
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addAdm" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Add Administrator</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="userAdmin">Username<b style="color:red">*</b></label>
					<input class="form-control" id="userAdmin" type="text" placeholder="Username">
				</div>
				<div class="form-group">
					<label for="passAdmin">Password<b style="color:red">*</b></label>
					<input class="form-control" id="passAdmin" type="password" placeholder="Password">
				</div>
				<div class="form-group">
					<label for="passAdmin2">Confirm Password<b style="color:red">*</b></label>
					<input class="form-control" id="passAdmin2" type="password" placeholder="Confirm Password">
				</div>
				<div class="form-group">
					<label for="fnAdmin">First Name<b style="color:red">*</b></label>
					<input class="form-control" id="fnAdmin" type="text" placeholder="First Name">
				</div>
				<div class="form-group">
					<label for="mnAdmin">Middle Name</label>
					<input class="form-control" id="mnAdmin" type="text" placeholder="Middle Name">
				</div>
				<div class="form-group">
					<label for="lnAdmin">Last Name<b style="color:red">*</b></label>
					<input class="form-control" id="lnAdmin" type="text" placeholder="Last Name">
				</div>
				<span id="alertAdm"></span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="addAdministrator();"><span class="glyphicon glyphicon-ok-sign"></span> Add</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#datatableAdmn').dataTable();
		 $("[data-toggle=tooltip]").tooltip();
	});
	
	function deleteAdmin(id) {
		var row = id;
		var datas="row="+row;
		$.ajax({
			type: "POST",
			url: "deleteAdmin.php",
			data: datas
		}).done(function(data){
			$('#deltAdmn'+row).modal('hide');
			$('.modal-backdrop').hide();
			adminTab();
			scheduleTable();
			scheduleTab();
			$('#alertMessage').html(data);
			hideAlert();
		});
	}
	
	function updateAdmin(id) {
		var row = id;
		var user = $('#userAdmin'+row).val();
		var pass = $('#passeAdmin'+row).val();
		var pass2 = $('#passeAdmin2'+row).val();
		var fn = $('#fnAdmin'+row).val();
		var mn = $('#mnAdmin'+row).val();
		var ln = $('#lnAdmin'+row).val();
		var datas="row="+row+"&user="+user+"&pass="+pass+
		"&fn="+fn+"&mn="+mn+"&ln="+ln;
		if(pass != pass2){
			$('#alertuAdm'+row).html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password not match!</div>');
		}else if(fn == "" || ln == "" || user == ""){
			$('#alertuAdm'+row).html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill required field!</div>');
		}else{
			$.ajax({
				type: "POST",
				url: "updateAdmin.php",
				data: datas
			}).done(function(data){
				if(data == "userError"){
					$('#alertuAdm'+row).html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Username already taken!</div>');
				}else{
					$('#deltAdmn'+row).modal('hide');
					$('.modal-backdrop').hide();
					adminTab();
					scheduleTable();
					scheduleTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
							
	function addAdministrator(){
		var user = $('#userAdmin').val();
		var pass = $('#passAdmin').val();
		var pass2 = $('#passAdmin2').val();
		var fn = $('#fnAdmin').val();
		var mn= $('#mnAdmin').val();
		var ln = $('#lnAdmin').val();
		if(pass != pass2){
			$('#alertAdm').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password not match!</div>');
		}else if(fn == "" || ln == "" || user == "" || pass == ""){
			$('#alertAdm').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill required field!</div>');
		}else{
			var datas="user="+user+"&pass="+pass+"&fn="+fn+"&mn="+mn+"&ln="+ln;
			$.ajax({
				type: "POST",
				url: "addAdministrator.php",
				data: datas
			}).done(function( data) {
				if(data == "userError"){
					$('#alertAdm').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Username already taken!</div>');
				}else{
					$('#addAdm').modal('hide');
					$('.modal-backdrop').hide();
					adminTab();
					scheduleTable();
					scheduleTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
</script>