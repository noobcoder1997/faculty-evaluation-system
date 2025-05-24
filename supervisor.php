<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
?>
<div class="container">
	<h3>Supervisor</h3>
	<button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addSpvsr" style="margin-bottom: 10px;">
        <span class="glyphicon glyphicon-plus"> Add Supervisor</span>
	</button><br/>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
			<table id="datatableSvr" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Department</th>
							<th>Academic Rank</th>
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
							<th>Academic Rank</th>
							<th><center>Edit</center></th>
							<th><center>Delete</center></th>
						</tr>
					</tfoot>
					<tbody>
						<?php
							$resSpvsr1 =mysqli_query($mysqli, "SELECT * from supervisor order by row desc");
								while ($rSpr1 = mysqli_fetch_assoc($resSpvsr1)){
									$resSpvsr =mysqli_query($mysqli, "SELECT * from faculty where row = '".$rSpr1['fac_no']."' order by row desc");
									if ($rSpr = mysqli_fetch_assoc($resSpvsr)){
									echo "<tr>
											<td> $rSpr[id] </td>
											<td> $rSpr[ln] </td>
											<td> $rSpr[fn] </td>
											<td> $rSpr[mn] </td>";
										$resDeprtmt =mysqli_query($mysqli, "SELECT * from department where row = '".$rSpr['dept']."'");
										if ($rDpt = mysqli_fetch_assoc($resDeprtmt)){
											echo "<td> $rDpt[dscrpt] </td>";
										}else{
											echo "<td>  </td>";
										}
									echo 	"<td> $rSpr[rank] </td>
											<td>
												<center>
													<button class='btn btn-warning btn-xs' data-toggle='modal' data-target='#editSpvsr".$rSpr1['row']."'>
														<span class='glyphicon glyphicon-pencil'></span> Edit
													</button>
												</center>
											</td>
											<td>
												<center>
													<button class='btn btn-danger btn-xs' data-toggle='modal' data-target='#deltSpvsr".$rSpr1['row']."'>
														<span class='glyphicon glyphicon-trash'></span> Delete
													</button>
												</center>
											</td>
										</tr>";
						?>
                        <script>
							function fileSignatured<?php echo $rSpr1['row']?>(){
								var row = "<?php echo $rSpr1['row']?>";
								var file = document.getElementById("sign<?php echo $rSpr1['row']?>").value;
								var input = document.getElementById("sign<?php echo $rSpr1['row']?>");
								var fReader = new FileReader();
								var img = document.getElementById("signShow<?php echo $rSpr1['row']?>");
								if(file != ""){
									fReader.readAsDataURL(input.files[0]);
									fReader.onloadend = function(event){
										img.src = event.target.result;
										$('#signData<?php echo $rSpr1['row']?>').val(event.target.result);
									}
									$('#imgPath<?php echo $rSpr1['row']?>').val(input.files[0].name);
									$('#signShow<?php echo $rSpr1['row']?>').removeClass('hide');
								}else{
									$('#imgPath<?php echo $rSpr1['row']?>').val('');
									$('#signData<?php echo $rSpr1['row']?>').val('');
									img.src = "images/default image.png";
									$('#signShow<?php echo $rSpr1['row']?>').addClass('hide');
								}
							}
						</script>
						<div class="modal fade" id="deltSpvsr<?php echo $rSpr1['row'];?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
									</div>
									<div class="modal-body">
										<div class="alert alert-danger">
											<span class="glyphicon glyphicon-warning-sign"></span> 
											Are you sure you want to delete this Supervisor Account?
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" onclick="deleteSpvsr('<?php echo $rSpr1['row'];?>');"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
										<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="editSpvsr<?php echo $rSpr1['row'];?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label for="userSpvsr<?php echo $rSpr1['row'];?>">Username<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rSpr1['user']?>" id="userSpvsr<?php echo $rSpr1['row'];?>" type="text" placeholder="Username">
										</div>
										<div class="form-group">
											<label for="passeSpvsr<?php echo $rSpr1['row'];?>">Password</label>
											<input class="form-control" id="passeSpvsr<?php echo $rSpr1['row'];?>" type="password" placeholder="If empty will not change">
										</div>
										<div class="form-group">
											<label for="passeSpvsr2<?php echo $rSpr1['row'];?>">Confirm Password</label>
											<input class="form-control" id="passeSpvsr2<?php echo $rSpr1['row'];?>" type="password" placeholder="Confirm Password">
										</div>
										<span id="alertuSpr<?php echo $rSpr1['row'];?>"></span>
										<div class="form-group">
											<label for="fac_noST2<?php echo $rSpr1['row'];?>">Faculty</label>
											<select class="form-control" id="fac_noST2<?php echo $rSpr1['row'];?>">
												<?php
													echo "<option value='".$rSpr['row']."' hidden>".strtoupper($rSpr['ln'].", ".$rSpr['fn'])."</option>";
													$resUs =mysqli_query($mysqli, "SELECT * from faculty");
													while ($rU = mysqli_fetch_assoc($resUs)){
														echo "<option value='".$rU['row']."'>".strtoupper($rU['ln'].", ".$rU['fn'])."</option>";
													}
												?>
											</select>
										</div>
                                        
                                        <div class="form-group">
											<label for="signature<?php echo $rSpr1['row']?>">Signature (png)<b style="color:red">*</b></label>
											<div class="input-group">
												<label class="input-group-addon label-info" id="signature<?php echo $rSpr1['row']?>" style="color: #fff;">
													Browse <input type="file" id="sign<?php echo $rSpr1['row']?>" style="display: none" accept="image/png" onchange="fileSignatured<?php echo $rSpr1['row']?>();">
												</label>
												<input for="signature<?php echo $rSpr1['row']?>" id="imgPath<?php echo $rSpr1['row']?>" type="text" class="form-control" placeholder="Signature" onkeydown="return false;" onclick="$('#signature<?php echo $rSpr1['row']?>').trigger('click'); $(this).blur();">
											</div>
										</div>
										<?php
											if($rSpr1['signature'] == ""){
										?>
										<img src="images/default image.png" class="img-thumbnail hide" id="signShow<?php echo $rSpr1['row']?>" alt="Signature" width="50%">
										<?php
											}else{
										?>
										<img src="<?php echo str_replace(" ","+",$rSpr1['signature']);?>" class="img-thumbnail" id="signShow<?php echo $rSpr1['row']?>" alt="Signature" width="50%">
										<?php
											}
										?>
										<textarea id="signData<?php echo $rSpr1['row']?>" style="margin-bottom: -100px; visibility:hidden;"><?php echo str_replace(" ","+",$rSpr1['signature']);?></textarea>
										<span id="alertuStd<?php echo $rSpr1['row']?>"></span>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning btn-block" onclick="updateSpvsr('<?php echo $rSpr1['row'];?>');"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
									</div>
								</div>
							</div>
						</div>
						<?php				 
									}
								}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addSpvsr" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Add Supervisor</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="userSpvsr">Username<b style="color:red">*</b></label>
					<input class="form-control" id="userSpvsr" type="text" placeholder="Username">
				</div>
				<div class="form-group">
					<label for="passSpvsr">Password<b style="color:red">*</b></label>
					<input class="form-control" id="passSpvsr" type="password" placeholder="Password">
				</div>
				<div class="form-group">
					<label for="passSpvsr2">Confirm Password<b style="color:red">*</b></label>
					<input class="form-control" id="passSpvsr2" type="password" placeholder="Confirm Password">
				</div>
				<div class="form-group">
					<label for="fac_noST">Faculty</label>
					<select class="form-control" id="fac_noST">
						 <option value="" hidden>Select Faculty</option>
						<?php
							$resUs =mysqli_query($mysqli, "SELECT * from faculty");
							while ($rU = mysqli_fetch_assoc($resUs)){
								echo "<option value='".$rU['row']."'>".strtoupper($rU['ln'].", ".$rU['fn'])."</option>";
							}
						?>
					</select>
				</div>
                <div class="form-group">
					<label for="signature">Signature (png)<b style="color:red">*</b></label>
					<div class="input-group">
						<label class="input-group-addon label-info" id="signature" style="color: #fff;">
							Browse <input type="file" id="sign" style="display: none" accept="image/png" onchange="fileSignature1();">
						</label>
						<input for="signature" id="imgPath" type="text" class="form-control" placeholder="Signature" onkeydown="return false;" onclick="$('#signature').trigger('click'); $(this).blur();">
					</div>
				</div>
				<img src="images/default image.png" class="img-thumbnail hide" id="signShow" alt="Signature" width="50%">
				<textarea id="signData" style="margin-bottom: -100px; visibility:hidden;"></textarea>
				<span id="alertStud"></span>
				<span id="alertSvsr"></span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="addSupervisor();"><span class="glyphicon glyphicon-ok-sign"></span> Add</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#datatableSvr').dataTable();
		$("[data-toggle=tooltip]").tooltip();
		 
		$('#fac_noST').selectize({
			sortField: 'text'
		});
	});
    
    function fileSignature1(){
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
	
	function deleteSpvsr(id) {
		var row = id;
		var datas = "row="+row;
		$.ajax({
			type: "POST",
			url: "deleteSupervisor.php",
			data: datas
		}).done(function(data){
			$('#deltSpvsr'+row).modal('hide');
			$('.modal-backdrop').hide();
			supervisorTab();
			scheduleTable();
			scheduleTab();
			$('#alertMessage').html(data);
			hideAlert();
		});
	}
	
	function updateSpvsr(id) {
		var row = id;
		var user = $('#userSpvsr'+row).val();
		var pass = $('#passeSpvsr'+row).val();
		var pass2 = $('#passeSpvsr2'+row).val();
		var fac = $('#fac_noST2'+row).val();
        var signature = $('#signData'+row).val();
		var datas="row="+row+"&user="+user+"&signature="+signature+"&pass="+pass+"&fac="+fac;
		if(pass != pass2){
			$('#alertuSpr'+row).html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password not match!</div>');
		}else if(user == "" || fac == ""){
			$('#alertuSpr'+row).html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill required field!</div>');
		}else{
			$.ajax({
				type: "POST",
				url: "updateSupervisor.php",
				data: datas
			}).done(function(data){
				if(data == "userError"){
					$('#alertuSpr'+row).html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Username already taken!</div>');
				}else{
					$('#editSpvsr'+row).modal('hide');
					$('.modal-backdrop').hide();
					supervisorTab();
					scheduleTable();
					scheduleTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
							
	function addSupervisor(){
		var user = $('#userSpvsr').val();
		var pass = $('#passSpvsr').val();
		var pass2 = $('#passSpvsr2').val();
		var fac = $('#fac_noST').val();
        var signature = $('#signData').val();
		if(pass != pass2){
			$('#alertSvsr').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password not match!</div>');
		}else if(fac == "" || user == "" || pass == ""){
			$('#alertSvsr').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill required field!</div>');
		}if(signature == ""){
			$('#alertStud').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Signature Required!</div>');
		}else{
			var datas="user="+user+"&pass="+pass+"&signature="+signature+"&fac="+fac;
			$.ajax({
				type: "POST",
				url: "addSupervisor.php",
				data: datas
			}).done(function( data) {
				if(data == "userError"){
					$('#alertSvsr').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Username already taken!</div>');
				}else{
					$('#addSpvsr').modal('hide');
					$('.modal-backdrop').hide();
					supervisorTab();
					scheduleTable();
					scheduleTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
</script>