<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
	$row = $_SESSION['row'];
	$position = $_SESSION['position'];
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3>Students</h3>
			<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStd" style="margin-bottom: 10px;"><span class="glyphicon glyphicon-plus">&nbsp;</span>Add Student</a>
		</div>
	</div>	
	<div class="row">
	<script>
	$(document).ready(function() {
		$('#datatableStud').dataTable();
		 $("[data-toggle=tooltip]").tooltip();
	});
</script>
		<div class="col-md-12">
			<div class="table-responsive">
				<table id="datatableStud" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Last Name</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Grade/ Section</th>
							<?php 
								if( $position == "Super Administrator" ) {
									echo "<th>Teacher</th>";
								}
							?>
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
							<th>Grade/ Section</th>
							<?php 
								if( $position == "Super Administrator" ) {
									echo "<th>Teacher</th>";
								}
							?>
							<th><center>Edit</center></th>
							<th><center>Delete</center></th>
						</tr>
					</tfoot>
					<tbody>
						<?php
						$resStud ='';
						if($position == "Administrator") {
							$resStud =mysqli_query($mysqli, "SELECT * from students WHERE faculty = '$row' ORDER BY year ASC, ln ASC");
						}else if($position == "Super Administrator")  {
							$resStud =mysqli_query($mysqli, "SELECT * from students");
						}
							while ($rFcty = mysqli_fetch_assoc($resStud)){
								echo "<tr>
										<td> $rFcty[id] </td>
										<td> $rFcty[ln] </td>
										<td> $rFcty[fn] </td>
										<td> $rFcty[mn] </td>
										<td> $rFcty[year]"."- "."$rFcty[section] </td>";
									if( $position == "Super Administrator" ) {
										$teacher  =  mysqli_query($mysqli, "SELECT * FROM users WHERE row = $rFcty[faculty] ");
										$rteacher = mysqli_fetch_assoc($teacher);
										echo "<td>$rteacher[name]</td>";
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
													<span class='glyphicon glyphicon-remove'></span> Delete
												</button>
											</center>
										</td>
									</tr>";
						?>
						<?php //include 'deleteStudentModal.php'; ?>
						<?php //include 'updateStudentModal.php'; ?>
						<?php				 
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addStd" role="dialog"  data-backdrop="static" data-keyboad="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading"><span class="glyphicon glyphicon-plus"></span> Add a Student</h4>
			</div>
			<div class="modal-body">
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
					<label for="yrStud">Grade</label>
					<select class="form-control" id="yrStud" type="text" placeholder="Year">
						<option selected disabled>Grade Level</option>
						<?php 
							$resGrde0 =mysqli_query($mysqli, "SELECT * from grades");
							while ($rgrde0 = mysqli_fetch_assoc($resGrde0)){
								echo "<option value=$rgrde0[grade]>Grade $rgrde0[grade]</option>";
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="secStud">Section<b style="color:red">*</b></label>
					<input class="form-control" id="secStud" type="text" placeholder="Section">
				</div>
				<?php
				if($position == "Super Administrator"){
				?>
					<div class="form-group">
						<label for="facStud">Instructor<b style="color:red">*</b></label>
						<select class="form-control" id="facStud" type="text" placeholder="Instructor">
							<option value='' selected disabled>Instructor</option>
							<?php
								$facRes = mysqli_query($mysqli, "SELECT * FROM users WHERE position = 'Administrator' ");
								while ($r = mysqli_fetch_assoc($facRes)) {
									echo "<option value=$r[row]>$r[name]</option>	";
								}
							?>
						</select>
					</div>
				<?php 
				}
				?>
				<script>				
					$(document).ready(function() {
						$("#addStd").on("hidden.bs.modal", function() {
						$("#addStd input").val('');
						});
					});
				</script>
				<span id="alertStud"></span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-block" onclick="addStudent();"><span class="glyphicon glyphicon-plus"></span> Add this Student</button>
			</div>
		</div>
	</div>
</div>
<?php //include 'addStudentModal.php'; ?>
<!-- <script src='student.js'></script> -->
 <script type="text/javascript">
	
	$(document).ready(function() {
		$('#datatableStud').dataTable();
		 $("[data-toggle=tooltip]").tooltip();
	});
	
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
			$('#alertMessage').html(data);
			hideAlert();
		});
	}
	
	function updateStud(id) {
		var row = id;
		var ids = $('#idStud'+row).val();
		var fn = $('#fnStud'+row).val();
		var mn = $('#mnStud'+row).val();
		var ln = $('#lnStud'+row).val();
		var yr = $('#yrStud'+row).val();
		var sec = $('#secStud'+row).val();
		
		var datas="row="+row+"&ids="+ids+"&fn="+fn+"&mn="+mn+"&ln="+ln+"&sec="+sec+"&yr="+yr;
		$.ajax({
			type: "POST",
			url: "updateStudent.php",
			data: datas
		}).done(function(data){
			if(data == `idError`){
				$('#alertuStd'+row).html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>ID already taken!</div>');
			}
			else if(data == `Empty`){
				$('#alertuStd'+row).html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please fill required empty field/s!</div>');
			}
			else{
				$('#editStud'+row).modal('hide');
				$('.modal-backdrop').hide();
				studentTab();
				$('#alertMessage').html(data);
				hideAlert();
			}
		});
	}
						
	function addStudent(){
		// var user = $('#userStud').val();
		var position = $('#position-id').val();
		var id = $('#idStud').val();
		var fn = $('#fnStud').val();
		var mn = $('#mnStud').val();
		var ln = $('#lnStud').val();
		var yr = $('#yrStud').val();
		var sec = $('#secStud').val();
		var facNo ='';

		if(position == "Administrator") facNo = $('#faculty-id').val(); else facNo = $('#facStud').val();

		var datas="&id="+id+"&fn="+fn+"&mn="+mn+"&ln="+ln+"&yr="+yr+"&sec="+sec+"&facNo="+facNo;
		$.ajax({
			type: "POST",
			url: "addStudent.php",
			data: datas
		}).done(function( data) {
			if(data == `idError`){
				$('#alertStud').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>ID already taken!</div>');
			}else if(data == `isStudentEmpty`){
				$('#alertStud').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please fill all fields!</div>');
			}
			else{
				$('#addStd').modal('hide');
				$('.modal-backdrop').hide();
				studentTab();
				$('#alertMessage').html(data);
				hideAlert();
			}
		});
	}
 </script>