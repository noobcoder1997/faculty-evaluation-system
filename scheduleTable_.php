<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
?>
<!--<div class="row">-->
	<div class="col-md-12">
		<div class="table-responsive"><br/>
		<table id="datatableSchedd" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th></th>
						<th>Form</th>
						<th>Student Name</th>
						<th>Academic Year</th>
						<th>Semester</th>
						<th>Faculty Name</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th>Form</th>
						<th>Student Name</th>
						<th>Academic Year</th>
						<th>Semester</th>
						<th>Faculty Name</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
						$resSched =mysqli_query($mysqli, "SELECT * from schedule");
							while ($rS = mysqli_fetch_assoc($resSched)){
								echo "<tr>
										<td><center>
											<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#deltSched".$rS['row']."'>
												<span class='glyphicon glyphicon-trash'></span>
											</a></center>
										</td>";
								
								$res1Frms =mysqli_query($mysqli, "SELECT * from form where row ='".$rS['frm_no']."'");
								while ($r1FU = mysqli_fetch_assoc($res1Frms)){
									echo "<td> ".strtoupper($r1FU['frm_name'])." </td>";
								}
								$resSU =mysqli_query($mysqli, "SELECT * from student where row = '".$rS['stud_no']."'");
								if ($rSU = mysqli_fetch_assoc($resSU)){
									echo "<td> $rSU[fn] $rSU[ln] </td>";
								} 
								echo 	"<td> ".$rS['ay']."-".($rS['ay']+1)." </td>
										<td> $rS[sem] </td>";
										
								$resSU1 =mysqli_query($mysqli, "SELECT * from faculty where row = '".$rS['fac_no']."'");
								if ($rSU1 = mysqli_fetch_assoc($resSU1)){
									echo "<td> $rSU1[fn] $rSU1[ln] </td>";
								}
					?>
					<div class="modal fade" id="deltSched<?php echo $rS['row'];?>" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
								</div>
								<div class="modal-body">
									<div class="alert alert-danger">
										<span class="glyphicon glyphicon-warning-sign"></span> 
										Are you sure you want to delete this Schedule?
									</div>
								</div>
								<div class="modal-footer">
									<a type="button" class="btn btn-success" id="deleteSched<?php echo $rS['row'];?>"><span class="glyphicon glyphicon-ok-sign"></span> Yes</a>
									<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</a>
								</div>
							</div>
						</div>
					</div>
					<script>
						$('#deleteSched<?php echo $rS['row'];?>').on('click', function () {
							var row = "<?php echo $rS['row'];?>";
							var datas="row="+row;
							$.ajax({
								type: "POST",
								url: "deleteSch.php",
								data: datas
							}).done(function(data){
								$('#deltSched<?php echo $rS['row'];?>').modal('hide');
								$('.modal-backdrop').hide();
								scheduleTable();
								setPre();
								$('#alertSched').html(data);
								hideAlert();
							});
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
<!--</div>-->
<script>
	$(document).ready(function() {
		$('#datatableSchedd').dataTable();
		 $("[data-toggle=tooltip]").tooltip();
	});
</script>