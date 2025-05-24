<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
	$row = $_SESSION['row'];
	$position = $_SESSION['position'];
	
	$resultIDs = "SELECT * FROM superadmin WHERE row='$row' AND position='$position';";
	$resultIDs .= "SELECT * FROM admin WHERE row='$row' AND position='$position';";
	$resultIDs .= "SELECT * FROM supervisor WHERE row='$row' AND position='$position';";

	if (mysqli_multi_query($mysqli, $resultIDs)) {
		do {
			if ($result = mysqli_store_result($mysqli)) {
				if ($rs = mysqli_fetch_array($result)){
					$ay1 = $rs['period'];
					$ay2 = $rs['period']+1;
					$ay3 = $rs['period']+2;
					if($rs['period'] != "")
						$sy = $rs['period']."-".($rs['period']+3);
					else
						$sy = 0;
					
				}
				mysqli_free_result($result);
			}
		} while (mysqli_next_result($mysqli));
	}
?>
<style>
    a {cursor: pointer;}
</style>
<div class="container" onload="">
	<div class="row" id="evalTable">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-9">
					<h3>Committee</h3>
				</div>
				<div class="col-md-3">
					<br/>
					<div class="col-md-12 label-warning preClass">
						Rating Period: <?php echo $sy;?>  <span data-toggle='modal' data-target='#prefCom' style='color: #5a8dee;'><span class='glyphicon glyphicon-edit'></span></span>
					</div>
					<br/>
					<button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addCommi" style="margin-bottom: 10px;">
                        <span class="glyphicon glyphicon-plus"> Add Committee Personnel</span>
					</button>
				</div>
				<br/>
			</div>
			<div class="table-responsive"><br/>
				<table id="datatableCommittee" class="table table-bordered table-striped">
					<thead>
						<th>Edit</th>
						<th>Delete</th>
						<th>First</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Extension</th>
<!--						<th>Rank</th>-->
						<th>Designation</th>
						<th>Rating Period</th>
					</thead>
					<tfoot>
						<th>Edit</th>
						<th>Delete</th>
						<th>First</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Extension</th>
<!--						<th>Rank</th>-->
						<th>Designation</th>
						<th>Rating Period</th>
					</tfoot>
					<tbody>
						<?php
						$resCom =mysqli_query($mysqli, "SELECT * from committee where period = '$ay1' ");
						while($rCom = mysqli_fetch_assoc($resCom)){
							echo "<tr>";
							echo "<td>
                                        <center>
                                            <button class='btn btn-warning btn-xs' data-toggle='modal' data-target='#editPer".$rCom['row']."'>
                                                <span class='glyphicon glyphicon-pencil'></span> Edit
                                            </button>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <button class='btn btn-danger btn-xs' data-toggle='modal' data-target='#deltPer".$rCom['row']."'>
                                                <span class='glyphicon glyphicon-trash'></span> Delete
                                            </button>
                                        </center>
                                    </td>";
                                    
                            
							echo "<td>".$rCom['fn']."</td>";
							echo "<td>".$rCom['mn']."</td>";
							echo "<td>".$rCom['ln']."</td>";
							echo "<td>".$rCom['ext']."</td>";
//							echo "<td>".$rCom['rank']."</td>";
							echo "<td>".$rCom['designation']."</td>";
							echo "<td>".$rCom['period']."-".($rCom['period']+3)."</td>";
							echo "</tr>";
                        ?>
                        	<div class="modal fade" id="deltPer<?php echo $rCom['row'];?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger">
                                                <span class="glyphicon glyphicon-warning-sign"></span>&nbsp;
                                                Are you sure you want to delete this Personnel's Account?
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" onclick="deletePer('<?php echo $rCom['row'];?>');"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="modal fade" id="editPer<?php echo $rCom['row'];?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title custom_align" id="Heading">Edit Personnel's Detail</h4>
                                        </div>
                                        <div class="modal-body">
<!--
                                            <div class="form-group">
                                                <a class="pull-right" onclick="_showForm(<?php //echo $rCom['row'];?>)" id="eshw<?php //echo $rCom['row'];?>" class="pull-right" > Use another way</a>
                                                <a class="pull-right" onclick="_hideForm(<?php //echo $rCom['row'];?>)" id="ehid<?php //echo $rCom['row'];?>" class="pull-right" style="display:none"> Return to list</a>
                                            </div>
-->
<!--
                                            <div class="form-group">
                                                <label for="eName<?php echo $rCom['row'];?>"> Name<b style="color:red">*</b></label>
                                                <?php
//                                                    $resFac0 =mysqli_query($mysqli, "SELECT * from faculty");
                                                ?>
                                                <select class="form-control" id="eName<?php echo $rCom['row'];?>" >
                                                    <option value="<?php //echo $rCom['row'] ;?>" hidden><?php //echo strtoupper($rCom['fn']." ".$rCom['mn']." ".$rCom['ln']); ?></option>
                                                    <?php
//                                                        while ($rFac0 = mysqli_fetch_assoc($resFac0)){
//                                                            echo "<option value='".$rFac0['row']."'>".strtoupper($rFac0['fn']." ".$rFac0['mn']." ".$rFac0['ln'])."</option>";
//                                                        }
                                                    ?>
                                                </select>
                                            </div>
-->
                                            <div class="form-group" id="_hiddenForm<?php echo $rCom['row'];?>" >
                                                <label for="fn1<?php echo $rCom['row'];?>">First Name <b style="color:red">*</b></label>
                                                <input class="form-control" id="fn1<?php echo $rCom['row'];?>" placeholder="First Name" value="<?php echo $rCom['fn'];?>" required>
                                                <label for="mn1<?php echo $rCom['row'];?>">Middle Name <b style="color:red">*</b></label>
                                                <input class="form-control" id="mn1<?php echo $rCom['row'];?>" placeholder="Middle Name" value="<?php echo $rCom['mn'];?>" required>
                                                <label for="ln1<?php echo $rCom['row'];?>">Last Name <b style="color:red">*</b></label>
                                                <input class="form-control" id="ln1<?php echo $rCom['row'];?>" placeholder="Last Name"  value="<?php echo $rCom['ln'];?>"required>
                                                <label for="extsion1<?php echo $rCom['row'];?>">Extension<b style="color:red">*</b></label>
                                                <input class="form-control" id="extsion1<?php echo $rCom['row'];?>" placeholder="Name extension E.g.(PhD, MSIT, MIT, MM)" value="<?php echo $rCom['ext'];?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="designationCom1<?php echo $rCom['row'];?>">Designation <b style="color:red">*</b></label>
                                                <select class="form-control" id="designationCom1<?php echo $rCom['row'];?>" disabled>
                                                    <option value="<?php echo $rCom['designation'];?>" hidden ><?php echo $rCom['designation'];?></option>
                                                    <option value="Member">Member</option>
<!--                                                    <option value="Faculty">Faculty</option>-->
                                                    <option value="Overall Chair">Overall Chair</option>
                                                    <option value="College Dean">College Dean</option>
                                                    <option value="Human Resource Officer">Human Resource Officer</option>
                                                    <option value="Faculty President">Faculty President</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="periodCom1<?php echo $rCom['row'];?>">Rating Period (3 School Year) <b style="color:red">*</b></label>
                                                <select class="form-control" id="periodCom1<?php echo $rCom['row'];?>">
                                                    <?php
                                                        echo "<option value='".$ay1."' hidden>".$ay1."-".($ay1+3)."</option>";
                                                        $start = 2020;
                                                        $data = floor(((int)date('Y')-$start)/3);
                                                        $calculate = (int)$data * 3;
                                                        $y = $calculate + $start;
                                                        for($x =  $y; $x >= $start; $x-=3){
                                                            if(($x+3) <= (int)date('Y'))
                                                                echo "<option value='".$x."'>".$x."-".($x+3)."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div id="alertCom1<?php echo $rCom['row']; ?>"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning btn-block" onclick="editPer('<?php echo $rCom['row'];?>');"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
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
<div class="modal fade" id="addCommi" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Committee</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="nameCom1"> Select Employee<b style="color:red">*</b></label>
                    <?php
                        $resFac0 =mysqli_query($mysqli, "SELECT * from faculty");
                    ?>
                    <select class="form-control" id="nameCom1" >
						<option value="" hidden>Select a Personnel</option>
                        <?php
							while ($rFac0 = mysqli_fetch_assoc($resFac0)){
                                echo "<option value='".$rFac0['row']."'>".strtoupper($rFac0['fn']." ".$rFac0['mn']." ".$rFac0['ln'])."</option>";
							}
						?>
					</select>
                    <a class="pull-right"onclick="showForm()" id="shw" class="pull-right" > Use another way</a>
                    <a class="pull-right"onclick="hideForm()" id="hid"class="pull-right" style="display:none"> Return to list</a>
				</div>
                <div class="form-group" hidden id="hiddenForm">
					<label for="fn">First Name <b style="color:red">*</b></label>
					<input class="form-control" id="fn" placeholder="First Name" required>
					<label for="mn">Middle Name <b style="color:red">*</b></label>
					<input class="form-control" id="mn" placeholder="Middle Name" required>
					<label for="ln">Last Name <b style="color:red">*</b></label>
					<input class="form-control" id="ln" placeholder="Last Name" required>				
				</div>
				<div class="form-group">
					<label for="extsion">Extension<b style="color:red">*</b></label>
					<input class="form-control" id="extsion" placeholder="Name extension E.g.(PhD, MSIT, MIT, MM)" required>
					<label for="designationCom">Designation <b style="color:red">*</b></label>
					<select class="form-control" id="designationCom">
						<option value="" hidden>Select Designation</option>
						<option value="Member">Member</option>
<!--						<option value="Faculty">Faculty</option>-->
						<option value="Overall Chair">Overall Chair</option>
						<option value="College Dean">College Dean</option>
						<option value="Human Resource Officer">Human Resource Officer</option>
						<option value="Faculty President">Faculty President</option>
					</select>
				</div>
				<div class="form-group">
					<label for="periodCom">Rating Period (3 School Year) <b style="color:red">*</b></label>
					<select class="form-control" id="periodCom">
                        <option value="" hidden>Select Rating Period</option>
						<?php
							echo "<option value='".$ay1."' hidden>".$ay1."-".($ay1+3)."</option>";
							$start = 2020;
							$data = floor(((int)date('Y')-$start)/3);
							$calculate = (int)$data * 3;
							$y = $calculate + $start;
							for($x =  $y; $x >= $start; $x-=3){
								if(($x+3) <= (int)date('Y'))
									echo "<option value='".$x."'>".$x."-".($x+3)."</option>";
							}
						?>
					</select>
				</div>
				<div id="alertCom"></div>
			</div>
			<div class="modal-footer">
				<a type="button" class="btn btn-primary" onclick="savePer();"><span class="glyphicon glyphicon-ok"></span> Save</a>
				<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="prefCom" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Preference</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="aySchedCom">Rating Period (3 School Year)</label>
					<select class="form-control" id="aySchedCom">
						<?php
							echo "<option value='".$ay1."' hidden>".$ay1."-".($ay1+3)."</option>";
							$start = 2020;
							$data = floor(((int)date('Y')-$start)/3);
							$calculate = (int)$data * 3;
							$y = $calculate + $start;
							for($x =  $y; $x >= $start; $x-=3){
								if(($x+3) <= (int)date('Y'))
									echo "<option value='".$x."'>".$x."-".($x+3)."</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<a type="button" class="btn btn-primary" onclick="prefeCom();"><span class="glyphicon glyphicon-floppy-disk"></span> Set</a>
				<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
			</div>
		</div>
	</div>
</div>
<script>
    
	$(document).ready(function() {
		$('#datatableCommittee').dataTable();
		$("[data-toggle=tooltip]").tooltip();
        
//        $('#nameCom1').selectize({
//			sortField: 'text'
//		});
	});
    
	function savePer(){
        var mn= $('#mn').val();
        var fn = $('#fn').val(); 
        var ext = $('#extsion').val();
//        var mn = x.charAt(0);               // get the first letter
        var ln = $('#ln').val();
//        var rank = $('#rank').val(); 
        var perNo = $('#nameCom1').val();   // rowNo of the faculty
		var designationCom = $('#designationCom').val();
		var periodCom = $('#periodCom').val();
		var datas="fn="+fn+"&mn="+mn+"&ln="+ln+"&ext="+ext+"&perNo="+perNo+"&designationCom="+designationCom+"&periodCom="+periodCom;
//        alert(datas);
		$.ajax({
			type: "POST",
			url: "addCommittee.php",
			data: datas
		}).done(function(data) {
			if(data == 'multiMemberError'){
				$('#alertCom').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The Data is already used by other personnel!</div>');
			}else if(data == 'isEmpty'){
				$('#alertCom').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please Fill empty fields!</div>');
			}else{
				$('#addCommi').modal('hide');
				$('.modal-backdrop').hide();
				commiTab();
				$('#alertMessage').html(data);
				hideAlert();
			}
		});
	}
    
	function prefeCom(){
		var ay = $('#aySchedCom').val();
		var datas="ay="+ay;
		$.ajax({
			type: "POST",
			url: "preferenceCommittee.php",
			data: datas
		}).done(function( data) {
			$('#prefCom').modal('hide');
			$('.modal-backdrop').hide();
			commiTab();
		});
	}
    
    function deletePer(id){
        var row = id;
		var datas = "row="+row;
		$.ajax({
			type: "POST",
			url: "delCommittee.php",
			data: datas
		}).done(function(data){
			$('#deltPer'+row).modal('hide');
			$('.modal-backdrop').hide();
			commiTab();
			scheduleTable();
			scheduleTab();
			$('#alertMessage').html(data);
			hideAlert();
		});
    }
    
    function editPer(id){
        var row= id;
        var mn= $('#mn1'+row).val();
        var fn = $('#fn1'+row).val(); 
        var ext = $('#extsion1'+row).val();
//        var mn = x.charAt(0);               // get the first letter
        var ln = $('#ln1'+row).val();
//        var rank = $('#rank1'+row).val(); 
//        var perNo = $('#nameCom1').val();   // rowNo of the faculty
		var designationCom = $('#designationCom1'+row).val();
		var periodCom = $('#periodCom1'+row).val();
		var datas="row="+row+"&fn="+fn+"&mn="+mn+"&ln="+ln+"&ext="+ext+"&designationCom="+designationCom+"&periodCom="+periodCom;
        
        $.ajax({
			type: "POST",
			url: "updateCommittee.php",
			data: datas
		}).done(function(data) {
			if(data == 'multiMemberError'){
				$('#alertCom1'+row).html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The Data is already used by other personnel!</div>');
			}else if(data == 'isEmpty'){
				$('#alertCom1'+row).html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please Fill empty fields!</div>');
			}else{
				$('#editPer'+row).modal('hide');
				$('.modal-backdrop').hide();
				commiTab();
				$('#alertMessage').html(data);
				hideAlert();
			}
		});
    }
    
    function showForm(){
        
        $('#hiddenForm').show();
        $('#shw').hide();
        $('#hid').show();
        $('#nameCom1').prop('disabled',true);
        $('#nameCom1').val('');
    }
    
    function hideForm(){
        
        $('#hiddenForm').hide();
        $('#shw').show();
        $('#hid').hide();;
        $('#nameCom1').removeAttr('disabled');
        $('#fn').val('');
        $('#mn').val('');
        $('#ln').val('');
        $('#extsion').val('');
        $('#rank').val('');
    }
    
//    function _showForm(id){
//        
//        $('#ehid'+id).show();
//        $('#eshw'+id).hide();
//        $('#_hiddenForm'+id).show();
//        $('#eName'+id).prop('disabled',true);
//        console.log(id);
//    }
//    
//    function _hideForm(id){
//        
//        $('#ehid'+id).hide();
//        $('#eshw'+id).show();
//        $('#_hiddenForm'+id).hide();
//        $('#eName'+id).removeAttr('disabled')
//    }
</script>