<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
?>
<div class="container">
	<h3>Add Schedule</h3>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="stude_noSched">Student Name</label>
				<select class="form-control" id="stude_noSched">
					 <option value="" hidden>Select Student</option>
					<?php
						$resUs =mysqli_query($mysqli, "SELECT * from student");
						while ($rU = mysqli_fetch_assoc($resUs)){
							echo "<option value='".$rU['row']."'>".$rU['id']." | ".strtoupper($rU['ln'].", ".$rU['fn'])."</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="aySched1">Academic Year</label>
				<select class="form-control" id="aySched1">
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
				<label for="semSched1">Semester</label>
				<select class="form-control" id="semSched1">
					<option value="First Semester">First Semester</option>
					<option value="Second Semester">Second Semester</option>
					<option value="Summer">Summer</option>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="setPreference">View Schedule</label>
				<button type="button" class="btn btn-success btn-block" onclick="setPre();">
					<span class="glyphicon glyphicon-search"> Search
				</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label for="frm_noSched">Form</label>
				<select class="form-control" id="frm_noSched">
					<?php
						$resFrms =mysqli_query($mysqli, "SELECT * from form");
						while ($rFU = mysqli_fetch_assoc($resFrms)){
							echo "<option value='".$rFU['row']."'>".strtoupper($rFU['frm_name'])."</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="col-md-7">
			<div class="form-group">
				<label for="dep_noSched">Department</label>
				<select class="form-control" id="dep_noSched">
					<?php
						$resDeps =mysqli_query($mysqli, "SELECT * from department");
						while ($rDU = mysqli_fetch_assoc($resDeps)){
							echo "<option value='".$rDU['row']."'>".$rDU['dscrpt']."</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label>Evaluation Form</label>
				<button type="button" class="btn btn-primary btn-block" onclick="addFac123();">
					<span class="glyphicon glyphicon-plus"> Add Faculty
				</button>
			</div>
		</div>
	</div>
	<div class="col-md-12" id="alertSched"></div>
	
	<div class="col-md-12 hide" id="searchTable">
		<div class="table-responsive"><br/>
			<table class="table table-striped">
				<thead>
					<tr>
						<th data-toggle="modal" data-target="#deltSched"><span style="color: #d9534f;"><span class="glyphicon glyphicon-remove"></span></span></th>
						<th>Form</th>
						<th>Student</th>
						<th>A.Y. & Semester</th>
						<th>Faculty Name</th>
					</tr>
				</thead>
				<tbody id="schedulePreference">
				</tbody>
			</table>
		</div>
	</div>
</div>
<br/>
<div id="schedData"></div>
	<script>
		 $(document).ready(function () {
			$('#fac_noSched').selectize({
				sortField: 'text'
			});
			$('#stude_noSched').selectize({
				sortField: 'text'
			});
		});
		
		$(".checkbox-menu").on("change", "input[type='checkbox']", function() {
			$(this).closest("li").toggleClass("active", this.checked);
		});

		$(document).on('click', '.allow-focus', function (e) {
			e.stopPropagation();
		});
		
		function widthdraw(){
			var items = document.getElementsByName('withdraw');
			var checkid = "";
			for (var i = 0; i < items.length; i++) {
				if(checkid == "")
					var checkid = items[i].value;
				else
					var checkid = checkid + " " + items[i].value;
			}
			
			var datas="checkid="+checkid;
			$.ajax({
				type: "POST",
				url: "withdraw.php",
				data: datas
			}).done(function( data) {
				$('#deltSched').modal('hide');
				$('.modal-backdrop').hide();
				$('#searchTable').addClass('hide');
				$('#alertSched').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Successfully withdraw!</div>');
				hideAlert();
			});
		}
						
		
		function addFac123(){
			var frm_no = $('#frm_noSched').val();
			var stud_no = $('#stude_noSched').val();
			var ay = $('#aySched1').val();
			var sem = $('#semSched1').val();
			var dept = $('#dep_noSched').val();
			
			var datas="frm_no="+frm_no+"&stud_no="+stud_no+"&ay="+ay+"&sem="+sem+"&dept="+dept;
			$.ajax({
				type: "POST",
				url: "checkStudent.php",
				data: datas
			}).done(function( data) {
				if(data == '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Student not found!</div>'){
					$('#alertSched').html(data);
					$('#schedData').html("");
					hideAlert();
				}else{
					$('#schedData').html(data);
				}
			});
		}
		
		function setPre(){
			var stud_no = $('#stude_noSched').val();
			if(stud_no==""){
				$('#alertSched').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Empty student field!</div>');
				$('#searchTable').addClass('hide');
				hideAlert();
			}else{
				var frm_no = $('#frm_noSched').val();
				var stud_no = $('#stude_noSched').val();
				var ay = $('#aySched1').val();
				var sem = $('#semSched1').val();
				var datas="frm_no="+frm_no+"&stud_no="+stud_no+"&ay="+ay+"&sem="+sem;
				$.ajax({
					type: "POST",
					url: "schedulePreference.php",
					data: datas
				}).done(function( data) {
					if(data == ""){
						$('#searchTable').addClass('hide');
						$('#alertSched').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>No schedule found!</div>');
						hideAlert();
					}else{
						$('#searchTable').removeClass('hide');
						$('#schedulePreference').html(data);
					}
				});
			}
		}
</script>
<div class="modal fade" id="deltSched" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Withdraw</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger">
					<span class="glyphicon glyphicon-warning-sign"></span> 
					Are you sure you want to withdraw?
				</div>
			</div>
			<div class="modal-footer">
				<a type="button" class="btn btn-success" onclick="widthdraw();"><span class="glyphicon glyphicon-ok-sign"></span> Yes</a>
				<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</a>
			</div>
		</div>
	</div>
</div>