<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
?>
<div class="container">
	<h3>Faculty</h3>
	<button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addFclty" style="margin-bottom: 10px;">
		<span class="glyphicon glyphicon-plus"> Add Faculty
	</button><br/>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
			<table id="datatableFcty" class="table table-striped table-bordered">
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
							$resFclty =mysqli_query($mysqli, "SELECT * from faculty order by row desc");
								while ($rFcty = mysqli_fetch_assoc($resFclty)){
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
									echo 	"<td> $rFcty[rank] </td>
											<td>
												<center>
													<button class='btn btn-warning btn-xs' data-toggle='modal' data-target='#editFclty".$rFcty['row']."'>
														<span class='glyphicon glyphicon-pencil'></span> Edit
													</button>
												</center>
											</td>
											<td>
												<center>
													<button class='btn btn-danger btn-xs' data-toggle='modal' data-target='#deltFclty".$rFcty['row']."'>
														<span class='glyphicon glyphicon-trash'></span> Delete
													</button>
												</center>
											</td>
										</tr>";
						?>
						<div class="modal fade" id="deltFclty<?php echo $rFcty['row']?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
									</div>
									<div class="modal-body">
										<div class="alert alert-danger">
											<span class="glyphicon glyphicon-warning-sign"></span> 
											Are you sure you want to delete this Faculty Account?
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" onclick="deleteFclty('<?php echo $rFcty['row']?>');"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
										<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="editFclty<?php echo $rFcty['row']?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label for="idFclty<?php echo $rFcty['row']?>">ID<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rFcty['id']?>" id="idFclty<?php echo $rFcty['row']?>" type="text" placeholder="ID">
										</div>
										<div class="form-group">
											<label for="fnFclty<?php echo $rFcty['row']?>">First Name<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rFcty['fn']?>" id="fnFclty<?php echo $rFcty['row']?>" type="text" placeholder="First Name">
										</div>
										<div class="form-group">
											<label for="mnFclty<?php echo $rFcty['row']?>">Middle Name</label>
											<input class="form-control" value="<?php echo $rFcty['mn']?>" id="mnFclty<?php echo $rFcty['row']?>" type="text" placeholder="Middle Name">
										</div>
										<div class="form-group">
											<label for="lnFclty<?php echo $rFcty['row']?>">Last Name<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rFcty['ln']?>" id="lnFclty<?php echo $rFcty['row']?>" type="text" placeholder="Last Name">
										</div>
										<div class="form-group">
											<label for="deptFclty<?php echo $rFcty['row']?>">Department<b style="color:red">*</b></label>
											<select class="form-control" id="deptFclty<?php echo $rFcty['row']?>">
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
											<label for="rankFclty<?php echo $rFcty['row']?>">Academic Rank</label>
											<select class="form-control" id="rankFclty<?php echo $rFcty['row']?>">
												<option value="<?php echo $rFcty['rank']?>" hidden><?php echo $rFcty['rank']?></option>
												<option value="None">None</option>
												<option value="Visiting Instructor">Visiting Instructor</option>
												<option value="Visiting Professor">Visiting Professor</option>
												<option value="Instructor I">Instructor I</option>
												<option value="Instructor II">Instructor II</option>
												<option value="Instructor III">Instructor III</option>
												<option value="Assistant Professor I">Assistant Professor I</option>
												<option value="Assistant Professor II">Assistant Professor II</option>
												<option value="Assistant Professor III">Assistant Professor III</option>
												<option value="Assistant Professor IV">Assistant Professor IV</option>
												<option value="Associate Professor I">Associate Professor I</option>
												<option value="Associate Professor II">Associate Professor II</option>
												<option value="Associate Professor III">Associate Professor III</option>
												<option value="Associate Professor IV">Associate Professor IV</option>
												<option value="Associate Professor V">Associate Professor V</option>
												<option value="Professor I">Professor I</option>
												<option value="Professor II">Professor II</option>
												<option value="Professor III">Professor III</option>
												<option value="Professor IV">Professor IV</option>
												<option value="Professor V">Professor V</option>
												<option value="Professor VI">Professor VI</option>
												<option value="College/University Professor">College/University Professor</option>
											</select>
										</div>
										<span id="alertuSpr<?php echo $rFcty['row']?>"></span>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning btn-block" onclick="updateFclty('<?php echo $rFcty['row']?>');"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
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
<div class="modal fade" id="addFclty" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Add Faculty</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="idFclty">ID<b style="color:red">*</b></label>
					<input class="form-control" id="idFclty" type="text" placeholder="ID">
				</div>
				<div class="form-group">
					<label for="fnFclty">First Name<b style="color:red">*</b></label>
					<input class="form-control" id="fnFclty" type="text" placeholder="First Name">
				</div>
				<div class="form-group">
					<label for="mnFclty">Middle Name</label>
					<input class="form-control" id="mnFclty" type="text" placeholder="Middle Name">
				</div>
				<div class="form-group">
					<label for="lnFclty">Last Name<b style="color:red">*</b></label>
					<input class="form-control" id="lnFclty" type="text" placeholder="Last Name">
				</div>
				<div class="form-group">
					<label for="deptFclty">Department<b style="color:red">*</b></label>
					<select class="form-control" id="deptFclty">
						<?php
							$resSlct =mysqli_query($mysqli, "SELECT * from department");
							while ($rSlt = mysqli_fetch_assoc($resSlct)){
								echo "<option value='$rSlt[row]'>$rSlt[dscrpt]</option>";
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="rankFclty">Academic Rank</label>
					<select class="form-control" id="rankFclty">
						<option value="None">None</option>
						<option value="Visiting Instructor">Visiting Instructor</option>
						<option value="Visiting Professor">Visiting Professor</option>
						<option value="Instructor I">Instructor I</option>
						<option value="Instructor II">Instructor II</option>
						<option value="Instructor III">Instructor III</option>
						<option value="Assistant Professor I">Assistant Professor I</option>
						<option value="Assistant Professor II">Assistant Professor II</option>
						<option value="Assistant Professor III">Assistant Professor III</option>
						<option value="Assistant Professor IV">Assistant Professor IV</option>
						<option value="Associate Professor I">Associate Professor I</option>
						<option value="Associate Professor II">Associate Professor II</option>
						<option value="Associate Professor III">Associate Professor III</option>
						<option value="Associate Professor IV">Associate Professor IV</option>
						<option value="Associate Professor V">Associate Professor V</option>
						<option value="Professor I">Professor I</option>
						<option value="Professor II">Professor II</option>
						<option value="Professor III">Professor III</option>
						<option value="Professor IV">Professor IV</option>
						<option value="Professor V">Professor V</option>
						<option value="Professor VI">Professor VI</option>
						<option value="College/University Professor">College/University Professor</option>
					</select>
				</div>
				<span id="alertFcty"></span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="addFaculty();"><span class="glyphicon glyphicon-ok-sign"></span> Add</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#datatableFcty').dataTable();
		 $("[data-toggle=tooltip]").tooltip();
	});
	
	function deleteFclty(id) {
		var row = id;
		var datas = "row="+row;
		$.ajax({
			type: "POST",
			url: "deleteFaculty.php",
			data: datas
		}).done(function(data){
			$('#deltFclty'+row).modal('hide');
			$('.modal-backdrop').hide();
			facultyTab();
			scheduleTable();
			scheduleTab();
			$('#alertMessage').html(data);
			hideAlert();
		});
	}
	
	function updateFclty(id) {
		var row = id;
		var ids = $('#idFclty'+row).val();
		var fn = $('#fnFclty'+row).val();
		var mn = $('#mnFclty'+row).val();
		var ln = $('#lnFclty'+row).val();
		var dept = $('#deptFclty'+row).val();
		var rank = $('#rankFclty'+row).val();
		var datas="row="+row+"&id="+ids+"&fn="+fn+
		"&mn="+mn+"&ln="+ln+"&dept="+dept+"&rank="+rank;
		if(fn == "" || ln == "" || ids == ""){
			$('#alertuSpr'+row).html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill required field!</div>');
		}else{
			$.ajax({
				type: "POST",
				url: "updateFaculty.php",
				data: datas
			}).done(function(data){
				if(data == "idError"){
					$('#alertuSpr'+row).html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>ID already taken!</div>');
				}else{
					$('#editFclty'+row).modal('hide');
					$('.modal-backdrop').hide();
					facultyTab();
					scheduleTable();
					scheduleTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
							
	function addFaculty(){
		var id = $('#idFclty').val();
		var fn = $('#fnFclty').val();
		var mn = $('#mnFclty').val();
		var ln = $('#lnFclty').val();
		var dept = $('#deptFclty').val();
		var rank = $('#rankFclty').val();
		if(id == "" || fn == "" || ln == ""){
			$('#alertFcty').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill required field!</div>');
		}else{
			var datas="id="+id+"&fn="+fn+"&mn="+mn+"&ln="+ln+"&dept="+dept+"&rank="+rank;
			$.ajax({
				type: "POST",
				url: "addFaculty.php",
				data: datas
			}).done(function( data) {
				if(data == "idError"){
					$('#alertFcty').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>ID already taken!</div>');
				}else{
					$('#addFclty').modal('hide');
					$('.modal-backdrop').hide();
					facultyTab();
					scheduleTable();
					scheduleTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
</script>