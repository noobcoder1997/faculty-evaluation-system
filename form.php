<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
?>
<div class="container">
	<h3>Form</h3>
	<button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addForm" style="margin-bottom: 10px;">
        <span class="glyphicon glyphicon-plus"> Add Form</span>
	</button><br/>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive"><br/>
			<table id="datatableForm" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>Form Name</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
							<th>Form Name</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
							$resForm =mysqli_query($mysqli, "SELECT * from form");
								while ($rFrm = mysqli_fetch_assoc($resForm)){
									echo "<tr>
											<td><center>
												<a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#editFrm".$rFrm['row']."'>
													<span class='glyphicon glyphicon-pencil'></span>
												</a> ";
										
										$resFrm1 =mysqli_query($mysqli, "SELECT * from evaluation_form where frm_no <> '".$rFrm['row']."'");
										$resFrm2 =mysqli_query($mysqli, "SELECT * from category where frm_no <> '".$rFrm['row']."'");
										if($rFrm1 = mysqli_fetch_assoc($resFrm1)){
											if($rFrm2 = mysqli_fetch_assoc($resFrm2)){
												echo "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#deltFrm".$rFrm['row']."'>
														<span class='glyphicon glyphicon-trash'></span>
													</a>";
											}
										}
									echo "</center></td>
											<td> $rFrm[frm_name] </td>";
						?>
						<div class="modal fade" id="editFrm<?php echo $rFrm['row'];?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Edit Your Form</h4>
									</div>
									<div class="modal-body">
										<span id="alertuFrm<?php echo $rFrm['row'];?>"></span>
										<div class="form-group">
											<label for="frm_name<?php echo $rFrm['row'];?>">Form Name</label>
											<input class="form-control" id="frm_name<?php echo $rFrm['row'];?>" value="<?php echo $rFrm['frm_name'];?>" type="text" placeholder="Form Name">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning btn-block" id="updateForm<?php echo $rFrm['row'];?>"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="deltFrm<?php echo $rFrm['row'];?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Delete this Form</h4>
									</div>
									<div class="modal-body">
										<div class="alert alert-danger">
											<span class="glyphicon glyphicon-warning-sign"></span> 
											Are you sure you want to delete this Form?
										</div>
									</div>
									<div class="modal-footer">
										<a type="button" class="btn btn-success" id="deleteForm<?php echo $rFrm['row'];?>"><span class="glyphicon glyphicon-ok-sign"></span> Yes</a>
										<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</a>
									</div>
								</div>
							</div>
						</div>
						<script>
							$('#deleteForm<?php echo $rFrm['row'];?>').on('click', function () {
								var row = "<?php echo $rFrm['row'];?>";
								var datas="row="+row;
								$.ajax({
									type: "POST",
									url: "deleteFrm.php",
									data: datas
								}).done(function(data){
									$('#deltFrm<?php echo $rFrm['row'];?>').modal('hide');
									$('.modal-backdrop').hide();
									formTab();
									$('#alertMessage').html(data);
									hideAlert();
								});
							});
							$('#updateForm<?php echo $rFrm['row'];?>').on('click', function () {
								var row = "<?php echo $rFrm['row'];?>";
								var frm_name = $('#frm_name<?php echo $rFrm['row'];?>').val();
								if(frm_name == ""){
									$('#alertuFrm<?php echo $rFrm['row'];?>').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill empty field!</div>');
								}else{
									var datas="row="+row+"&frm_name="+frm_name;
									$.ajax({
										type: "POST",
										url: "updateFrm.php",
										data: datas
									}).done(function(data){
										if(data == "formError"){
											$('#alertuFrm').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Form already exist!</div>');
										}else{
											$('#editDpt<?php echo $rFrm['row'];?>').modal('hide');
											$('.modal-backdrop').hide();
											formTab();
											scheduleTable();
											scheduleTab();
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
</div><br/>
<div class="container">
	<h3>Category</h3>
	<button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addCategory" style="margin-bottom: 10px;">
        <span class="glyphicon glyphicon-plus"> Add Category</span>
	</button><br/>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive"><br/>
			<table id="datatableCategory" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>Form</th>
							<th>Category</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
							<th>Form</th>
							<th>Category</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
							$resCtgry =mysqli_query($mysqli, "SELECT * from category");
								while ($rFrm = mysqli_fetch_assoc($resCtgry)){
									echo "<tr>
											<td><center>
												<a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#editCat".$rFrm['row']."'>
													<span class='glyphicon glyphicon-pencil'></span>
												</a> ";
												
									$resFrm1 =mysqli_query($mysqli, "SELECT * from question where cat_no = '".$rFrm['row']."'");
									if($rFrm1 = mysqli_fetch_assoc($resFrm1) == false){
										echo "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#deltCat".$rFrm['row']."'>
												<span class='glyphicon glyphicon-trash'></span>
											</a>";
									}
									
									echo "</center></td>";
									$resCat =mysqli_query($mysqli, "SELECT * from form where row = '".$rFrm['frm_no']."'");
									if($rcat = mysqli_fetch_assoc($resCat)){
										echo "<td> $rcat[frm_name] </td>";
									}
									echo 	"<td> $rFrm[cat_name] </td>";
						?>
						<div class="modal fade" id="editCat<?php echo $rFrm['row'];?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Edit Your Category</h4>
									</div>
									<div class="modal-body">
										<span id="alertuCat<?php echo $rFrm['row'];?>"></span>
										<div class="form-group">
											<label for="frm_no<?php echo $rFrm['row'];?>">Form Name<b style="color:red">*</b></label>
											<select class="form-control" id="frm_no<?php echo $rFrm['row'];?>">
												<?php
													$resCats=mysqli_query($mysqli, "SELECT * from form where row = '".$rFrm['frm_no']."'");
													while($rCats = mysqli_fetch_assoc($resCats)){
														echo "<option value='".$rCats['row']."' hidden>".$rCats['frm_name']."</option>";
													}
													$resForms=mysqli_query($mysqli, "SELECT * from form");
													while($rFrms = mysqli_fetch_assoc($resForms)){
														echo "<option value='".$rFrms['row']."'>".$rFrms['frm_name']."</option>";
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="cat_name<?php echo $rFrm['row'];?>">Category Name<b style="color:red">*</b></label>
											<input class="form-control" value="<?php echo $rFrm['cat_name'];?>" id="cat_name<?php echo $rFrm['row'];?>" type="text" placeholder="Category Name">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning btn-block" id="updateCategory<?php echo $rFrm['row'];?>"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="deltCat<?php echo $rFrm['row'];?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Delete this Category</h4>
									</div>
									<div class="modal-body">
										<div class="alert alert-danger">
											<span class="glyphicon glyphicon-warning-sign"></span> 
											Are you sure you want to delete this Category?
										</div>
									</div>
									<div class="modal-footer">
										<a type="button" class="btn btn-success" id="deleteCategory<?php echo $rFrm['row'];?>"><span class="glyphicon glyphicon-ok-sign"></span> Yes</a>
										<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</a>
									</div>
								</div>
							</div>
						</div>
						<script>
							$('#deleteCategory<?php echo $rFrm['row'];?>').on('click', function () {
								var row = "<?php echo $rFrm['row'];?>";
								var datas="row="+row;
								$.ajax({
									type: "POST",
									url: "deleteCat.php",
									data: datas
								}).done(function(data){
									$('#deltCat<?php echo $rFrm['row'];?>').modal('hide');
									$('.modal-backdrop').hide();
									formTab();
									scheduleTable();
									scheduleTab();
									$('#alertMessage').html(data);
									hideAlert();
								});
							});
							$('#updateCategory<?php echo $rFrm['row'];?>').on('click', function () {
								var row = "<?php echo $rFrm['row'];?>";
								var frm_no = $('#frm_no<?php echo $rFrm['row'];?>').val();
								var cat_name = $('#cat_name<?php echo $rFrm['row'];?>').val();
								if(cat_name == ""){
									$('#alertuCat<?php echo $rFrm['row'];?>').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill required field!</div>');
								}else{
									var datas="row="+row+"&frm_no="+frm_no+"&cat_name="+cat_name;
									$.ajax({
										type: "POST",
										url: "updateCat.php",
										data: datas
									}).done(function(data){
										if(data == "catError"){
											$('#alertuCat<?php echo $rFrm['row'];?>').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Category name already exist!</div>');
										}else{
											$('#editCat<?php echo $rFrm['row'];?>').modal('hide');
											$('.modal-backdrop').hide();
											formTab();
											scheduleTable();
											scheduleTab();
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
</div><br/>
<div class="container">
	<h3>Question</h3>
	<button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addQuestion" style="margin-bottom: 10px;">
        <span class="glyphicon glyphicon-plus"> Add Question </span>
	</button><br/>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive"><br/>
			<table id="datatableQuestion" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>Form</th>
							<th>Category</th>
							<th>Question</th>
							<th>Arrangement</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
							<th>Form</th>
							<th>Category</th>
							<th>Question</th>
							<th>Arrangement</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
							$countTempQ = 0;
							$rateTempQ  = "";
							$arrayQuestion = array();
							$resReport = mysqli_query($mysqli, "SELECT * from evaluate");
							while ($rRprt = mysqli_fetch_assoc($resReport)){
								if($countTempQ == 0){
									$rateTempQ = $rRprt['rate'];
								}else{
									$rateTempQ = $rateTempQ.",".$rRprt['rate'];
								}
								$countTempQ++;
							}
							$rateqSplit = explode(",",$rateTempQ);
							$countqsplit = count($rateqSplit);
							
							$countTempQ = 0;
							for($x = 0; $x < $countqsplit; $x++){
								$temp = explode(" ", $rateqSplit[$x]);
								$arrayQuestion[] = (int)$temp[0];
							}
							
							$resQuest=mysqli_query($mysqli, "SELECT * from question");
							while($rQstn = mysqli_fetch_assoc($resQuest)){
								echo "<tr>
									<td><center>
										<a class='btn btn-warning btn-xs' data-toggle='modal' data-target='#editQst".$rQstn['row']."'>
											<span class='glyphicon glyphicon-pencil'></span>
										</a> ";
										
								$countArray = 0;
								foreach($arrayQuestion as $array){
									if($array == (int)$rQstn['row'])
										$countArray++;
								}
								if($countArray <= 0){
									echo "<a class='btn btn-danger btn-xs' data-toggle='modal' data-target='#deltQst".$rQstn['row']."'>
												<span class='glyphicon glyphicon-trash'></span>
											</a>";
								}
								echo "</center>
									</td>";
								
								$resCates=mysqli_query($mysqli, "SELECT * from category where row='".$rQstn['cat_no']."'");
								if($rCates = mysqli_fetch_assoc($resCates)){
									$resFrms=mysqli_query($mysqli, "SELECT * from form where row='".$rCates['frm_no']."'");
									if($rFrms = mysqli_fetch_assoc($resFrms)){
										echo "<td> $rFrms[frm_name] </td>
											<td> $rCates[cat_name] </td>
											<td> $rQstn[question] </td>
											<td> $rQstn[arrngmnt] </td>";
									}
								}
						?>
						<div class="modal fade" id="editQst<?php echo $rQstn['row'];?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Edit Your Question</h4>
									</div>
									<div class="modal-body">
										<span id="alertuQst<?php echo $rQstn['row'];?>"></span>
										<div class="form-group">
											<label for="cat_no<?php echo $rQstn['row'];?>">Category<b style="color:red">*</b></label>
											<select class="form-control" id="cat_no<?php echo $rQstn['row'];?>">
												<?php
													$resCat2s=mysqli_query($mysqli, "SELECT * from category where row = '".$rQstn['cat_no']."'");
													while($rCat2s = mysqli_fetch_assoc($resCat2s)){
														$resForm2s=mysqli_query($mysqli, "SELECT * from form where row='".$rCat2s['frm_no']."'");
														if($rFrm2 = mysqli_fetch_assoc($resForm2s)){
															echo "<option value='".$rCat2s['row']."' hidden>".$rFrm2['frm_name'].": ".$rCat2s['cat_name']."</option>";
														}
													}
													$resCat1s=mysqli_query($mysqli, "SELECT * from category");
													while($rCat1s = mysqli_fetch_assoc($resCat1s)){
														$resForm1s=mysqli_query($mysqli, "SELECT * from form where row='".$rCat1s['frm_no']."'");
														if($rFrm1 = mysqli_fetch_assoc($resForm1s)){
															echo "<option value='".$rCat1s['row']."'>".$rFrm1['frm_name'].": ".$rCat1s['cat_name']."</option>";
														}
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="question<?php echo $rQstn['row'];?>">Question<b style="color:red;">*</b></label>
											<input class="form-control" value="<?php echo $rQstn['question'];?>" id="question<?php echo $rQstn['row'];?>" type="text" placeholder="Question">
										</div>
										<div class="form-group">
											<label for="arrngmnt<?php echo $rQstn['row'];?>">Arrangement<b style="color:red">*</b></label>
											<select class="form-control" id="arrngmnt<?php echo $rQstn['row'];?>">
												<?php
													echo "<option value='".$rQstn['arrngmnt']."' hidden>".$rQstn['arrngmnt']."</option>";
													for($x = 1; $x <= 100; $x++){
													echo "<option value='".$x."'>".$x."</option>";
													}
												?>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning btn-block" id="updateQuestion<?php echo $rQstn['row'];?>"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="deltQst<?php echo $rQstn['row'];?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title custom_align" id="Heading">Delete this Question</h4>
									</div>
									<div class="modal-body">
										<div class="alert alert-danger">
											<span class="glyphicon glyphicon-warning-sign"></span> 
											Are you sure you want to delete this Question?
										</div>
									</div>
									<div class="modal-footer">
										<a type="button" class="btn btn-success" id="deleteQuestion<?php echo $rQstn['row'];?>"><span class="glyphicon glyphicon-ok-sign"></span> Yes</a>
										<a type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</a>
									</div>
								</div>
							</div>
						</div>
						<script>
							$('#deleteQuestion<?php echo $rQstn['row'];?>').on('click', function () {
								var row = "<?php echo $rQstn['row'];?>";
								var datas="row="+row;
								$.ajax({
									type: "POST",
									url: "deleteQst.php",
									data: datas
								}).done(function(data){
									$('#deltQst<?php echo $rQstn['row'];?>').modal('hide');
									$('.modal-backdrop').hide();
									formTab();
									scheduleTable();
									scheduleTab();
									$('#alertMessage').html(data);
									hideAlert();
								});
							});
							$('#updateQuestion<?php echo $rQstn['row'];?>').on('click', function () {
								var row = "<?php echo $rQstn['row'];?>";
								var cat_no = $('#cat_no<?php echo $rQstn['row'];?>').val();
								var question = $('#question<?php echo $rQstn['row'];?>').val();
								var arrngmnt = $('#arrngmnt<?php echo $rQstn['row'];?>').val();
								if(question == ""){
									$('#alertuQst<?php echo $rQstn['row'];?>').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill required field!</div>');
								}else{
									var datas="row="+row+"&cat_no="+cat_no+"&question="+question+"&arrngmnt="+arrngmnt;
									$.ajax({
										type: "POST",
										url: "updateQst.php",
										data: datas
									}).done(function(data){
										if(data == "qstError"){
											$('#alertuQst<?php echo $rQstn['row'];?>').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Question name already exist!</div>');
										}else if(data == "arrError"){                                                                                                                            
											$('#alertuQst<?php echo $rQstn['row'];?>').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Arrangement already taken!</div>');
										}else{
											$('#editQst<?php echo $rQstn['row'];?>').modal('hide');
											$('.modal-backdrop').hide();
											formTab();
											scheduleTable();
											scheduleTab();
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
<div class="modal fade" id="addQuestion" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Add Question</h4>
			</div>
			<div class="modal-body">
				<span id="alertQst"></span>
				<div class="form-group">
					<label for="cat_no">Category<b style="color:red">*</b></label>
					<select class="form-control" id="cat_no">
						<?php
							$resCat1s=mysqli_query($mysqli, "SELECT * from category");
							while($rCat1s = mysqli_fetch_assoc($resCat1s)){
								$resForm1s=mysqli_query($mysqli, "SELECT * from form where row='".$rCat1s['frm_no']."'");
								if($rFrm1 = mysqli_fetch_assoc($resForm1s)){
									echo "<option value='".$rCat1s['row']."'>".$rFrm1['frm_name'].": ".$rCat1s['cat_name']."</option>";
								}
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="question">Question<b style="color:red;">*</b></label>
					<input class="form-control" id="question" type="text" placeholder="Question">
				</div>
				<div class="form-group">
					<label for="arrngmnt">Arrangement<b style="color:red">*</b></label>
					<select class="form-control" id="arrngmnt">
						<?php
							for($x = 1; $x <= 100; $x++){
							echo "<option value='".$x."'>".$x."</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="addQuestion();"><span class="glyphicon glyphicon-ok-sign"></span> Add</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addForm" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Add Form</h4>
			</div>
			<div class="modal-body">
				<span id="alertFrm"></span>
				<div class="form-group">
					<label for="frm_name">Form Name<b style="color:red">*</b></label>
					<input class="form-control" id="frm_name" type="text" placeholder="Form Name">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="addForm();"><span class="glyphicon glyphicon-ok-sign"></span> Add</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addCategory" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title custom_align" id="Heading">Add Category</h4>
			</div>
			<div class="modal-body">
				<span id="alertCat"></span>
				<div class="form-group">
					<label for="frm_no_c">Form Name<b style="color:red">*</b></label>
					<select class="form-control" id="frm_no_c">
						<?php
							$resultForm=mysqli_query($mysqli, "SELECT * from form");
							while($rFrm = mysqli_fetch_assoc($resultForm)){
								echo "<option value='".$rFrm['row']."'>".$rFrm['frm_name']."</option>";
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="cat_name_c">Category Name<b style="color:red">*</b></label>
					<input class="form-control" id="cat_name_c" type="text" placeholder="Category Name">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="addCategory();"><span class="glyphicon glyphicon-ok-sign"></span> Add</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#datatableForm').dataTable();
		 $("[data-toggle=tooltip]").tooltip();
	});
	$(document).ready(function() {
		$('#datatableCategory').dataTable();
		 $("[data-toggle=tooltip]").tooltip();
	});
	$(document).ready(function() {
		$('#datatableQuestion').dataTable();
		 $("[data-toggle=tooltip]").tooltip();
	});
	
	function addForm(){
		var frm_name = $('#frm_name').val();
		if(frm_name == ""){
			$('#alertFrm').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill Form name field!</div>');
		}else{
			var datas="frm_name="+frm_name;
			$.ajax({
				type: "POST",
				url: "addForm.php",
				data: datas
			}).done(function( data) {
				if(data == "formError"){
					$('#alertFrm').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Form name already exist!</div>');
				}else{
					$('#addForm').modal('hide');
					$('.modal-backdrop').hide();
					formTab();
					scheduleTable();
					scheduleTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
	
	function addCategory(){
		var frm_no = $('#frm_no_c').val();
		var cat_name = $('#cat_name_c').val();
		if(cat_name == ""){
			$('#alertCat').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill Category name field!</div>');
		}else{
			var datas="frm_no="+frm_no+"&cat_name="+cat_name;
			$.ajax({
				type: "POST",
				url: "addCategory.php",
				data: datas
			}).done(function( data) {
				if(data == "catError"){
					$('#alertCat').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Category name already exist!</div>');
				}else{
					$('#addForm').modal('hide');
					$('.modal-backdrop').hide();
					formTab();
					scheduleTable();
					scheduleTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
	
	function addQuestion(){
		var cat_no = $('#cat_no').val();
		var question = $('#question').val();
		var arrngmnt = $('#arrngmnt').val();
		if(question == ""){
			$('#alertQst').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill Question field!</div>');
		}else{
			var datas="cat_no="+cat_no+"&question="+question+"&arrngmnt="+arrngmnt;
			$.ajax({
				type: "POST",
				url: "addQuestion.php",
				data: datas
			}).done(function( data) {
				if(data == "qstError"){
					$('#alertQst').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Question name already exist!</div>');
				}else if(data == "arrError"){
					$('#alertQst').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Arrangement already taken!</div>');
				}else{
					$('#addQuestion').modal('hide');
					$('.modal-backdrop').hide();
					formTab();
					scheduleTable();
					scheduleTab();
					$('#alertMessage').html(data);
					hideAlert();
				}
			});
		}
	}
</script>