<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
?>
<div class="container">
	<h3>Student</h3>
	<button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addStud" style="margin-bottom: 10px;">
        <span class="glyphicon glyphicon-plus"> Add Student</span>
	</button><br/>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
			<table id="datatableStud" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Department</th>
							<th><center>Edit</center></th>
							<th><center>Delete</center></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID</th>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Department</th>
							<th><center>Edit</center></th>
							<th><center>Delete</center></th>
						</tr>
					</tfoot>
					<tbody>
						<?php
							$resStud =mysqli_query($mysqli, "SELECT * from student order by row desc");
								while ($rFcty = mysqli_fetch_assoc($resStud)){
									echo "<tr>
											<td> $rFcty[id] </td>
											<td> $rFcty[ln] </td>
											<td> $rFcty[fn] </td>
											<td> $rFcty[mn] </td>";
										$resDeprtmt =mysqli_query($mysqli, "SELECT * from department where row = '".$rFcty['dept']."'");
										if ($rDpt = mysqli_fetch_assoc($resDeprtmt)){
											echo "<td> $rDpt[dscrpt] </td>";
										}else{
											echo "<td>  </td>";
										}
									echo 	"<td>
												<center>
													<button class='btn btn-warning btn-xs' data-toggle='modal' data-target='#editStud".$rFcty['row']."'>
														<span class='glyphicon glyphicon-pencil'></span> Edit
													</button>
												</center>
											</td>
											<td>
												<center>
													<button class='btn btn-danger btn-xs' data-toggle='modal' data-target='#deltStud".$rFcty['row']."'>
														<span class='glyphicon glyphicon-trash'></span> Delete
													</button>
												</center>
											</td>
										</tr>";
						?>
						<script>
							function fileSignatured<?php echo $rFcty['row']?>(){
								var row = "<?php echo $rFcty['row']?>";
								var file = document.getElementById("sign<?php echo $rFcty['row']?>").value;
								var input = document.getElementById("sign<?php echo $rFcty['row']?>");
								var fReader = new FileReader();
								var img = document.getElementById("signShow<?php echo $rFcty['row']?>");
								if(file != ""){
									fReader.readAsDataURL(input.files[0]);
									fReader.onloadend = function(event){
										img.src = event.target.result;
										$('#signData<?php echo $rFcty['row']?>').val(event.target.result);
									}
									$('#imgPath<?php echo $rFcty['row']?>').val(input.files[0].name);
									$('#signShow<?php echo $rFcty['row']?>').removeClass('hide');
								}else{
									$('#imgPath<?php echo $rFcty['row']?>').val('');
									$('#signData<?php echo $rFcty['row']?>').val('');
									img.src = "images/default image.png";
									$('#signShow<?php echo $rFcty['row']?>').addClass('hide');
								}
							}
						</script>
						<div class="modal fade" id="deltStud<?php echo $rFcty['row']?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
									</div>
									<div class="modal-body">
										<div class="alert alert-danger">
											<span class="glyphicon glyphicon-warning-sign"></span> 
											Are you sure you want to delete this Student Account?
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" onclick="deleteStud('<?php echo $rFcty['row']?>');"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
										<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="editStud<?php echo $rFcty['row']?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label for="userStud<?php echo $rFcty['row']?>">Username<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rFcty['user']?>" id="userStud<?php echo $rFcty['row']?>" type="text" placeholder="Username">
										</div>
										<div class="form-group">
											<label for="passeStud<?php echo $rFcty['row']?>">Password</label>
											<input class="form-control" id="passeStud<?php echo $rFcty['row']?>" type="password" placeholder="If empty will not change">
										</div>
										<div class="form-group">
											<label for="passeStud2<?php echo $rFcty['row']?>">Confirm Password</label>
											<input class="form-control" id="passeStud2<?php echo $rFcty['row']?>" type="password" placeholder="Confirm Password">
										</div>
										<div class="form-group">
											<label for="idStud<?php echo $rFcty['row']?>">ID<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rFcty['id']?>" id="idStud<?php echo $rFcty['row']?>" type="text" placeholder="ID">
										</div>
										<div class="form-group">
											<label for="fnStud<?php echo $rFcty['row']?>">First Name<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rFcty['fn']?>" id="fnStud<?php echo $rFcty['row']?>" type="text" placeholder="First Name">
										</div>
										<div class="form-group">
											<label for="mnStud<?php echo $rFcty['row']?>">Middle Name</label>
											<input class="form-control" value="<?php echo $rFcty['mn']?>" id="mnStud<?php echo $rFcty['row']?>" type="text" placeholder="Middle Name">
										</div>
										<div class="form-group">
											<label for="lnStud<?php echo $rFcty['row']?>">Last Name<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rFcty['ln']?>" id="lnStud<?php echo $rFcty['row']?>" type="text" placeholder="Last Name">
										</div>
										<div class="form-group">
											<label for="deptStud<?php echo $rFcty['row']?>">Department<b style="color:red">*</b></label>
											<select class="form-control" id="deptStud<?php echo $rFcty['row']?>">
												<?php
													$resSlct=mysqli_query($mysqli, "SELECT * from department where row = '".$rFcty['dept']."'");
													if($rSlt = mysqli_fetch_assoc($resSlct)){
														echo "<option value='".$rSlt['row']."'>".$rSlt['dscrpt']."</option>";
													}
													$resSlcte2=mysqli_query($mysqli, "SELECT * from department where row <> '".$rFcty['dept']."'");
													while($rSlte1 = mysqli_fetch_assoc($resSlcte2)){
														echo "<option value='".$rSlte1['row']."'>".$rSlte1['dscrpt']."</option>";
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="signature<?php echo $rFcty['row']?>">Signature (png)<b style="color:red">*</b></label>
											<div class="input-group">
												<label class="input-group-addon label-info" id="signature<?php echo $rFcty['row']?>" style="color: #fff;">
													Browse <input type="file" id="sign<?php echo $rFcty['row']?>" style="display: none" accept="image/png" onchange="fileSignatured<?php echo $rFcty['row']?>();">
												</label>
												<input for="signature<?php echo $rFcty['row']?>" id="imgPath<?php echo $rFcty['row']?>" type="text" class="form-control" placeholder="Signature" onkeydown="return false;" onclick="$('#signature<?php echo $rFcty['row']?>').trigger('click'); $(this).blur();">
											</div>
										</div>
										<?php
											if($rFcty['signature'] == ""){
										?>
										<img src="images/default image.png" class="img-thumbnail hide" id="signShow<?php echo $rFcty['row']?>" alt="Signature" width="100%">
										<?php
											}else{
										?>
										<img src="<?php echo str_replace(" ","+",$rFcty['signature']);?>" class="img-thumbnail" id="signShow<?php echo $rFcty['row']?>" alt="Signature" width="100%">
										<?php
											}
										?>
										<textarea id="signData<?php echo $rFcty['row']?>" style="margin-bottom: -100px; visibility:hidden;"><?php echo str_replace(" ","+",$rFcty['signature']);?></textarea>
										<span id="alertuStd<?php echo $rFcty['row']?>"></span>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning btn-block" onclick="updateStud('<?php echo $rFcty['row']?>');"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
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
<div class="modal fade" id="addStud" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Add Student</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="userStud">Username<b style="color:red">*</b></label>
					<input class="form-control" id="userStud" type="text" placeholder="Username">
				</div>
				<div class="form-group">
					<label for="passStud">Password<b style="color:red">*</b></label>
					<input class="form-control" id="passStud" type="password" placeholder="Password">
				</div>
				<div class="form-group">
					<label for="passStud2">Confirm Password<b style="color:red">*</b></label>
					<input class="form-control" id="passStud2" type="password" placeholder="Confirm Password">
				</div>
				<div class="form-group">
					<label for="idStud">ID<b style="color:red">*</b></label>
					<input class="form-control" id="idStud" type="text" placeholder="ID">
				</div>
				<div class="form-group">
					<label for="fnStud">First Name<b style="color:red">*</b></label>
					<input class="form-control" id="fnStud" type="text" placeholder="First Name">
				</div>
				<div class="form-group">
					<label for="mnStud">Middle Name</label>
					<input class="form-control" id="mnStud" type="text" placeholder="Middle Name">
				</div>
				<div class="form-group">
					<label for="lnStud">Last Name<b style="color:red">*</b></label>
					<input class="form-control" id="lnStud" type="text" placeholder="Last Name">
				</div>
				<div class="form-group">
					<label for="deptStud">Department<b style="color:red">*</b></label>
					<select class="form-control" id="deptStud">
						<?php
							$resSlct =mysqli_query($mysqli, "SELECT * from department");
							while ($rSlt = mysqli_fetch_assoc($resSlct)){
								echo "<option value='$rSlt[row]'>$rSlt[dscrpt]</option>";
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="signature">Signature (png)<b style="color:red">*</b></label>
					<div class="input-group">
						<label class="input-group-addon label-info" id="signature" style="color: #fff;">
							Browse <input type="file" id="sign" style="display: none" accept="image/png" onchange="fileSignature();">
						</label>
						<input for="signature" id="imgPath" type="text" class="form-control" placeholder="Signature" onkeydown="return false;" onclick="$('#signature').trigger('click'); $(this).blur();">
					</div>
				</div>
				<img src="images/default image.png" class="img-thumbnail hide" id="signShow" alt="Signature" width="100%">
				<textarea id="signData" style="margin-bottom: -100px; visibility:hidden;"></textarea>
				<span id="alertStud"></span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="addStudent();"><span class="glyphicon glyphicon-ok-sign"></span> Add</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#datatableStud').dataTable();
		 $("[data-toggle=tooltip]").tooltip();
	});
	
	function fileSignature(){
		var file = document.getElementById("sign").value;
		var input = document.getElementById("sign");
		var fReader = new FileReader();
		var img = document.getElementById("signShow");
		if(file != ""){
			fReader.readAsDataURL(input.files[0]);
			fReader.onloadend = function(event){
				img.src = event.target.result;
				$('#signData').val(event.target.result);
			}
			$('#imgPath').val(input.files[0].name);
			$('#signShow').removeClass('hide');
		}else{
			$('#imgPath').val('');
			$('#signData').val('');
			img.src = "images/default image.png";
			$('#signShow').addClass('hide');
		}
	}
	
	function deleteStud(id) {
		var row = id;
		var datas = "row="+row;
		$.ajax({
			type: "POST",
			url: "deleteStudent.php",
			data: datas
		}).done(function(data){
			$('#deltStud'+row).modal('hide');
			$('.modal-backdrop').hide();
			studentTab();
			scheduleTable();
			scheduleTab();
			$('#alertMessage').html(data);
			hideAlert();
		});
	}
	
	function updateStud(id) {
		var row = id;
		var user = $('#userStud'+row).val();
		var pass = $('#passeStud'+row).val();
		var pass2 = $('#passeStud2'+row).val();
		var ids = $('#idStud'+row).val();
		var fn = $('#fnStud'+row).val();
		var mn = $('#mnStud'+row).val();
		var ln = $('#lnStud'+row).val();
		var dept = $('#deptStud'+row).val();
		var signature = $('#signData'+row).val();
		var datas="row="+row+"&user="+user+"&pass="+pass+
		"&id="+ids+"&fn="+fn+"&mn="+mn+"&ln="+ln+
		"&dept="+dept+"&signature="+signature;
		if(pass != pass2){
			$('#alertuStd'+row).html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password not match!</div>');
		}else if(fn == "" || ln == "" || user == "" || ids == ""){
			$('#alertuStd'+row).html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill required field!</div>');
		}if(signature == ""){
			$('#alertuStd'+row).html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Signature Required!</div>');
		}else{
			$.ajax({
				type: "POST",
				url: "updateStudent.php",
				data: datas
			}).done(function(data){
				if(data == "userError"){
					$('#alertuStd'+row).html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Username already taken!</div>');
				}else if(data == "idError"){
					$('#alertuStd'+row).html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>ID already taken!</div>');
				}else{
					$('#editStud'+row).modal('hide');
					$('.modal-backdrop').hide();
					studentTab();
					scheduleTable();
					scheduleTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
							
	function addStudent(){
		var user = $('#userStud').val();
		var pass = $('#passStud').val();
		var pass2 = $('#passStud2').val();
		var id = $('#idStud').val();
		var fn = $('#fnStud').val();
		var mn = $('#mnStud').val();
		var ln = $('#lnStud').val();
		var dept = $('#deptStud').val();
		var signature = $('#signData').val();
		if(pass != pass2){
			$('#alertStud').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password not match!</div>');
		}else if(id == "" || fn == "" || ln == "" || user == "" || pass == ""){
			$('#alertStud').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill required field!</div>');
		}if(signature == ""){
			$('#alertStud').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Signature Required!</div>');
		}else{
			var datas="user="+user+"&pass="+pass+"&id="+id+"&fn="+fn+"&mn="+mn+"&ln="+ln+"&dept="+dept+"&signature="+signature;
			$.ajax({
				type: "POST",
				url: "addStudent.php",
				data: datas
			}).done(function( data) {
				if(data == "userError"){
					$('#alertStud').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Username already taken!</div>');
				}else if(data == "idError"){
					$('#alertStud').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>ID already taken!</div>');
				}else{
					$('#addStud').modal('hide');
					$('.modal-backdrop').hide();
					studentTab();
					scheduleTable();
					scheduleTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
</script>