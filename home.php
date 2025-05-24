<?php
    include_once 'dbConfig.php';
	require_once('loginSession.php');
	$row = $_SESSION['row'];
	$position = $_SESSION['position'];
	$loadBody = "";
	$resultID = "SELECT * FROM superadmin WHERE row='$row' AND position='$position';";
	$resultID .= "SELECT * FROM admin WHERE row='$row' AND position='$position';";
	$resultID .= "SELECT * FROM faculty JOIN supervisor ON supervisor.fac_no = faculty.row WHERE supervisor.row='$row' AND supervisor.position='$position';";
	$resultID .= "SELECT * FROM student WHERE row='$row' AND position='$position';";

	if (mysqli_multi_query($mysqli, $resultID)) {
		do {
			if ($result = mysqli_store_result($mysqli)) {
				if ($r = mysqli_fetch_array($result)){
					if($position == "Supervisor"){
						$fn = $r['fn'];
						$ln = $r['ln'];
					}else if($position == "Student"){
						$fn = $r['fn'];
						$ln = $r['ln'];
						$signature = $r['signature'];
					}else{
						$fn = $r['fn'];
						$ln = $r['ln'];
					}
					$image = $r['image'];
				}
				mysqli_free_result($result);
			}
		} while (mysqli_next_result($mysqli));
	}
	
	
	if($position != "Student"){
		$loadBody = "dashboardTab();";
	}
	else if($position == "Student"){
		$loadBody = "evalRecordTab();";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>FES - <?php echo $position;?></title>
		<meta charset="utf-8">
		<link REL='shortcut icon' href="images/logo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/dataTables.bootstrap.css">
		<link rel="stylesheet" href="css/selectize.bootstrap3.min.css">
		<!--<link rel="stylesheet" href="css/normalize.min.css">
		<link rel="stylesheet" href="css/paper.css">-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.js"></script>
		<script src="js/Chart.js"></script>
		<script src="js/jspdf.debug.js"></script>
		<script src="js/selectize.min.js"></script>
		<style>
			.previous:hover, .next:hover {
			  background-color: #ddd;
			  color: black;
			}

			.previous, .next{
			  background-color: #f1f1f1;
			  color: black;
			  display: inline-block;
			  padding: 8px 16px;
			}

			.round {
			  border-radius: 50%;
			}
			.pagination>li {
				display: inline;
				padding:0px !important;
				margin:0px !important;
				border:none !important;
			}
			iframe
			{
				height:700px !important;
			}

			@media print
			{    
				.no-print, .no-print *
				{
					display: none !important;
				}
			}

			html{
				position: relative;
				min-height: 100%;
				overflow-x: hidden;
			}
			body{
				padding:0;
				margin: 0;
				background: #e8e8e8;
				overflow-x: hidden;
			}
			@font-face {
				font-family: myFont;
				src: url(fonts/poppins/Poppins-Regular.ttf);
			}

			.navbar{
				box-shadow: 0 0 15px #A9A9A9;
			}

			#wrapper {
				padding-left: 0;
				-webkit-transition: all 0.5s ease;
				-moz-transition: all 0.5s ease;
				-o-transition: all 0.5s ease;
				transition: all 0.5s ease;
				overflow-x: hidden;
			}

			#wrapper.toggled {
				padding-left: 250px;
			}

			#sidebar-wrapper {
				position: fixed;
				left: 250px;
				width: 0;
				height: 100%;
				margin-left: -250px;
				overflow-y: auto;
				box-shadow: 0 0 15px #A9A9A9;
				background: #F8F8F8;
				-webkit-transition: all 0.5s ease;
				-moz-transition: all 0.5s ease;
				-o-transition: all 0.5s ease;
				transition: all 0.5s ease;
				overflow-x: hidden;
			}

			#wrapper.toggled #sidebar-wrapper {
				width: 250px;
			}

			#page-content-wrapper {
				width: 100%;
				position: absolute;
				padding: 15px;
			}

			#wrapper.toggled #page-content-wrapper {
				position: absolute;
				margin-right: -250px;
			}

			/* Sidebar Styles */

			.sidebar-nav {
				position: absolute;
				top: 0;
				width: 250px;
				margin: 0;
				padding: 0;
				list-style: none;
			}

			.sidebar-nav li {
				text-indent: 20px;
				line-height: 40px;
				color: #616161;
			}

			.sidebar-nav li a {
				display: block;
				text-decoration: none;
				color: #5a8dee;
			}
			
			.activeTab{
				text-decoration: none !important;
				color: #fff !important;
				background: #5a8dee !important;
			}

			.sidebar-nav li a:hover {
				text-decoration: none;
				color: #000;
				background: rgba(255,255,255,255);
			}

			.sidebar-nav li a:active,
			.sidebar-nav li a:focus {
				text-decoration: none;
			}

			.sidebar-nav > .sidebar-brand {
				margin-top: 30px;
				margin-right: 25px;
				font-size: 15px;
				color: #5a8dee;
			}

			.navbar-brand{
				/* color: #5a8dee !important; */
			}

			.sidebar-nav > .sidebar-brand a {
				color: #5a8dee;
			}

			.sidebar-nav > .sidebar-brand a:hover {
				color: #000;
				background: none;
			}
			
			.preloaderBg {
				z-index: 10; 
				margin-top: 10%;
				margin-left:auto;
				margin-right:auto;
				text-align: center;
			}

			.preloader {
				margin: auto;
				background: url(images/logo.png) no-repeat center;
				background-size: 200px;
				animation: spin2 1s ease-in-out infinite ;
				position: relative;
				width: 300px;
				height: 300px;
				z-index: 12;
			}
			
			.preloader:hover{
				animation: spin1 1s ease-in-out infinite ;
				opacity: 1; 
			}

			.preloader2 {
				border: 5px solid #66a7ec;
				border-top: 5px solid #003a75;
				border-bottom: 5px solid #003a75;
				border-radius: 50%;
				box-shadow: 0 0 15px #A9A9A9;
				width: 250px;
				height: 250px;
				animation: spin 1s ease-in-out infinite ;
				position: relative;
				margin: auto;
				top: -275px;
				z-index: 11;
			}
			
			@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}
			
			@keyframes spin1 {
				100% { transform: rotate(0deg); }
				0% { transform: rotate(360deg); }
			}

			@keyframes spin2 {
				0% { 
					-webkit-filter: grayscale(100%);
					filter: grayscale(100%);
					opacity: .3;
				}
				100% { 
					-webkit-filter: grayscale(0%);
					filter: grayscale(0%);
					opacity: 1; 
				}
			}
			
			@media(min-width:768px) {
				#wrapper {
					padding-left: 250px;
				}

				#wrapper.toggled {
					padding-left: 0;
				}

				#sidebar-wrapper {
					width: 250px;
				}

				#wrapper.toggled #sidebar-wrapper {
					width: 0;
				}

				#page-content-wrapper {
					padding: 20px;
					position: relative;
				}

				#wrapper.toggled #page-content-wrapper {
					position: relative;
					margin-right: 0;
				}
			}
			.logout{
				display: none;
			}
			.sidebar-button{
				display: none;
			}
			.text-header:after{
				content: 'Faculty Evaluation System (FES)';
			}
			.preClass{
				padding: 10px; 
				background: #F5ee97; 
				color: #CB8E37;
				border-radius: 3px;
			}
			@media only screen and (max-width: 768px) {
				.preClass{
					margin: auto;
					width: 80%;
				}
				.nav{
					display: none;
				}
				.logout{
					display: block;
				}
				.sidebar-button{
					display: block;
				}
				.text-header:after{
					content: 'FES';
				}
				.preloaderBg {
					margin-top: auto;
				}
			}
			@media only screen and (max-width: 400px) {
				.preloaderBg {
					margin-top: 40%;
				}
			}
			::-webkit-scrollbar {
				width: 3px;
			}
			:hover::-webkit-scrollbar {
				width: 10px;
			}

			::-webkit-scrollbar-track {
				-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
				border-radius: 5px;
			}

			::-webkit-scrollbar-thumb {
				-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
				border-radius: 5px;
			}
			.container{
				box-shadow: 0 0 15px #A9A9A9;
				border-radius: 3px;
				background:#f7f7f7;
				color: #616161;
			}
			.modal-header {
				padding:9px 15px;
				background-color: #0480be;
				color: #fff;
				-webkit-border-top-left-radius: 5px;
				-webkit-border-top-right-radius: 5px;
				-moz-border-radius-topleft: 5px;
				-moz-border-radius-topright: 5px;
			}
		</style>
	</head>
	<body onload="<?php echo $loadBody;?>">
		<div id="wrapper">
			<div id="sidebar-wrapper">
				<ul class="sidebar-nav">
					<li class="sidebar-brand">
						<center>
							<a data-toggle="modal" data-target="#imageModal">
								<?php
									if($image == "" or $image == "None"){
								?>
										<img src="images/default.jpg" class="img-circle" alt="Photo" height="160px;" width="160px;">
								<?php
									}else{
								?>
										<img src="<?php print($image);?>" class="img-circle img-display" alt="Photo" height="160px;" width="160px;" style="box-shadow: 0 0 15px #A9A9A9;object-fit: cover;">
								<?php
									}
								?>
							</a>
						</center>
						<center>
							<?php print(strtoupper("<strong>$fn $ln</strong>"));?>
						</center>
					</li>	
					<hr>
					<li>MY</li>
					<?php
						if($position != 'Student'){
					?>
					<li>
						<a href="#dbdTab" data-toggle="tab" id="btn1" class="activeTab"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a>
					</li>
					<?php
						}
					?>
					<li>
						<a data-toggle="modal" data-target="#profileModal" id="btn2"><span class="glyphicon glyphicon-user"></span> Profile</a>
					</li>
					<?php
						if($position == 'Student'){
					?>
					<li>Evaluation</li>
					<li>
						<a href="#evaluateRecordTab" data-toggle="tab" id="btn3" class="activeTab"><span class="glyphicon glyphicon-edit"></span> Evaluate</a>
					</li>
					<?php
						}
						else if($position == 'Supervisor'){
					?>
						<li>Evaluation</li>
						<li>
							<a href="#evaluateRecordTabF" data-toggle="tab" id="btn17" onclick="evalRecordTabF();"><span class="glyphicon glyphicon-edit"></span> Evaluate</a>
						</li>
					<?php
						}
						if($position == 'Administrator' || $position == 'Super Administrator'){
					?>
					<li>SETUP</li>
					<li>
						<a href="#dptTab" data-toggle="tab" id="btn4" onclick="departmentTab();"><span class="glyphicon glyphicon-th-list"></span> Department</a>
					</li>
					<li>
						<a href="#evlTab" data-toggle="tab" id="btn5" onclick="evaluationTab();"><span class="glyphicon glyphicon-tasks"></span> Evaluation</a>
					</li>
					<li>
						<a href="#frmTab" data-toggle="tab" id="btn6" onclick="formTab();"><span class="glyphicon glyphicon-file"></span> Form</a>
					</li>
					<li>
						<a href="#schedTab" data-toggle="tab" id="btn7" onclick="scheduleShow();"><span class="glyphicon glyphicon-list"></span> Schedule</a>
					</li>
					<li>
						<a href="#facTab" data-toggle="tab" id="btn8" onclick="facultyTab();"><span class="glyphicon glyphicon-user"></span> Faculty</a>
					</li>
					<li>
						<a href="#commiTab" data-toggle="tab" id="btn18" onclick="commiTab();"><span class="glyphicon glyphicon-user"></span> Committee</a>
					</li>
					<li>ACCOUNT</li>
					<li>
						<a href="#admnTab" data-toggle="tab" id="btn9" onclick="adminTab();"><span class="glyphicon glyphicon-user"></span> Administrator</a>
					</li>
					<li>
						<a href="#svTab" data-toggle="tab" id="btn10" onclick="supervisorTab();"><span class="glyphicon glyphicon-user"></span> Supervisor</a>
					</li>
					<li>
						<a href="#stdTab" data-toggle="tab" id="btn11" onclick="studentTab();"><span class="glyphicon glyphicon-user"></span> Student</a>
					</li>
					<?php
						}
						if($position != 'Student'){
					?>
					<li>Report</li>
					<li>
						<a href="#evaluatedTab" data-toggle="tab" id="btn12" onclick="evaluatedTab();"><span class="glyphicon glyphicon-check"></span> Evaluation Report</a>
					</li>
					<li>
						<a href="#overallTab" data-toggle="tab" id="btn13" onclick="overallTab();"><span class="glyphicon glyphicon-tasks"></span> Faculty Report</a>
					</li>
					<li>
						<a href="#sumTab" data-toggle="tab" id="btn14" onclick="summaryTab();"><span class="glyphicon glyphicon-list-alt"></span> Summary</a>
					</li>
					<?php
						}
					?>
                <hr>
					<span class="logout">
						<li>
							<a data-toggle="modal" data-target="#logoutModal" id="btn15"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
						</li>
					</span>
				</ul>
			</div>
			<div id="page-content-wrapper">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
							<a href="#menu-toggle" class="navbar-brand btn sidebar-button" id="menu-toggle">☰</a>
							<a class="navbar-brand" rel="home" href="home.php" title="FES">
								<img style="max-width:35px; margin-top: -11px; margin-bottom: -7px;" src="images/logo.png">
								<span class="text-header"></span>
							</a>
						</div>
						<ul class="nav navbar-nav navbar-right">
							<li><a data-toggle="modal" data-target="#logoutModal" id="btn16"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
						</ul>
					</div>
				</nav>
				<div id="alertMessage" width="100%"></div>
				<div class="tab-content">
					<?php
						if($position == 'Student'){
					?>
					<div id="evaluateRecordTab" class="tab-pane fade in active">
						<div id="evalRecordTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<?php
						}else{
					?>
					<div id="dbdTab" class="tab-pane fade in active">
						<div id="dashboardTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<div id="evaluateRecordTabF" class="tab-pane fade">
						<div id="evalRecordTabF">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<?php
						}
					?>
					<div id="evaluatedTab" class="tab-pane fade">
						<div id="evaluatedTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<div id="overallTab" class="tab-pane fade">
						<div id="overall">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<div id="evlTab" class="tab-pane fade">
						<div id="evaluationTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<div id="frmTab" class="tab-pane fade">
						<div id="formTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<div id="schedTab" class="tab-pane fade">
						<div id="scheduleTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
						<div id="scheduleTable"></div>
					</div>
					<div id="dptTab" class="tab-pane fade">
						<div id="departmentTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<div id="admnTab" class="tab-pane fade">
						<div id="adminTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<div id="svTab" class="tab-pane fade">
						<div id="supervisorTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<div id="facTab" class="tab-pane fade">
						<div id="facultyTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<div id="stdTab" class="tab-pane fade">
						<div id="studentTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<div id="commiTab" class="tab-pane fade">
						<div id="commitTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
					<div id="sumTab" class="tab-pane fade">
						<div id="summaryTab">
							<div class="preloaderBg" id="preloader" onload="preloader()">
								<div class="preloader"></div>
								<div class="preloader2"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<div class="modal fade" id="profileModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="Heading">Edit you profile</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="passProfl">Password<b style="color:red">*</b></label>
						<input class="form-control" id="passProfl" type="password" placeholder="Will not change if empty">
					</div>
					<div class="form-group">
						<label for="passProfl2">Confirm Password<b style="color:red">*</b></label>
						<input class="form-control" id="passProfl2" type="password" placeholder="Confirm Password">
					</div>
					<span id="alertPrfl"></span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" onclick="saveProfile();"><span class="glyphicon glyphicon-ok-sign"></span> Save Changes</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="logoutModal" role="dialog">
		<div class="modal-dialog">
			<div class="col-sm-2"></div>
			<div class="col-sm-8"><br/><br/><br/>
				<div class="modal-content" style="padding: 10px;">
					<div class="row">
						<div class="col-sm-12">
							<h4>Do you want to log out?</h4>
						</div>
						<div class="col-sm-12">
							<button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
							<a href="logout.php" class="btn btn-primary pull-right" style="margin-right:10px;"><span class="glyphicon glyphicon-ok"></span> Yes, log out</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
	<div class="modal fade" id="imageModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title custom_align" id="Heading">Edit you photo</h4>
				</div>
				<div class="modal-body">
					<form action="upload.php" method="POST" role="form" enctype="multipart/form-data">
					<label>Photo:</label><input type="file" name="image" accept="image/*">
					<input type="text" class="form-control" value="<?php echo $row;?>" name="row" style="width: 0px; height:0px;border-color:#fff;">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Save Photo</button>
					</form>
					<button type="button" class="btn btn-danger" onclick="deletePhoto();"><span class="glyphicon glyphicon-trash"></span> Delete Photo</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		(function hideMyURL() {
			var re = new RegExp(/^.*\//);
			window.history.pushState("object or string", "Title", re.exec(window.location.href));
		})();
		document.addEventListener("keyup", function (e) {
			var keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode == 44) {
                stopPrntScr();
            }
        });
		
		function stopPrntScr() {
            var inpFld = document.createElement("input");
            inpFld.setAttribute("value", ".");
            inpFld.setAttribute("width", "0");
            inpFld.style.height = "0px";
            inpFld.style.width = "0px";
            inpFld.style.border = "0px";
            document.body.appendChild(inpFld);
            inpFld.select();
            document.execCommand("copy");
            inpFld.remove(inpFld);
        }
		
		function AccessClipboardData() {
            try {
                window.clipboardData.setData('text', "Access   Restricted");
            } catch (err) {
            }
        }
		
        setInterval("AccessClipboardData()", 300);
		
		$("#btn1, #bt3n, #btn4, #btn5, #btn6, #btn7, #btn8, #btn9, #btn10, #btn11, #btn12, #btn13, #btn14, #btn17, #btn18").click(function (e) {     
			$("#btn1, #bt3n, #btn4, #btn5, #btn6, #btn7, #btn8, #btn9, #btn10, #btn11, #btn12, #btn13, #btn14, #btn17, #btn18").removeClass("activeTab");   
			$( this ).addClass("activeTab");
		});
		
		$("#btn1, #btn2, #bt3n, #btn4, #btn5, #btn6, #btn7, #btn8, #btn9, #btn10, #btn11, #btn12, #btn13, #btn14, #btn15, #btn16, #btn17, #btn18").click(function(e) {
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				e.preventDefault();
				$("#wrapper").toggleClass("toggled");
			}
		});
		
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
		
		var preloadTime;

		function preloader() {
			preloadTime = setTimeout(showPage, 5000);
		}

		function showPage() {
			document.getElementById("preloader").style.display = "none";
		}
		
		function saveProfile() {
			var row = "<?php echo $row;?>";
			var pass = $('#passProfl').val();
			var pass2 = $('#passProfl2').val();
			var datas = "row="+row+"&pass="+pass+"&pass2="+pass2;
			if(pass == "" && pass2 == ""){
				$('#alertMessage').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password not changed!</div>');
				$('#profileModal').modal('hide');
				$('.modal-backdrop').hide();
				hideAlert();
			}else if(pass != pass2){
				$('#alertPrfl').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password not match!</div>');
			}else{
				$.ajax({
					type: "POST",
					url: "changePassword.php",
					data: datas
				}).done(function(data){
					$('#profileModal').modal('hide');
					$('.modal-backdrop').hide();
					$('#alertMessage').html(data);
					hideAlert();
				});
			}
		}
		function deletePhoto(){
			var row = "<?php echo $row;?>";
			var datas = "row="+row;
			
			$.ajax({
				type: "POST",
				url: "deletePhoto.php",
				data: datas
			}).done(function(data){
				$('#imageModal').modal('hide');
				$('.modal-backdrop').hide();
				$('#alertMessage').html(data);
				location.replace('home.php');
				$('#alertMessage').html(data);
				hideAlert();
			});
		}
		
		function dashboardTab(){
			$.ajax({
				type: "GET",
				url: "dashboard.php"
			}).done(function(data){
				$('#dashboardTab').html(data);
			});
		}
		
		function evalRecordTab(){
			$.ajax({
				type: "GET",
				url: "evaluateRecord.php"
			}).done(function(data){
				$('#evalRecordTab').html(data);
			});
		}
		
		function evalRecordTabF(){
			$.ajax({
				type: "GET",
				url: "evaluateRecordF.php"
			}).done(function(data){
				$('#evalRecordTabF').html(data);
			});
		}
		
		function evaluatedTab(){
			$.ajax({
				type: "GET",
				url: "evaluatedRecord.php"
			}).done(function(data){
				$('#evaluatedTab').html(data);
			});
		}
		
		function overallTab(){
			$.ajax({
				type: "GET",
				url: "overall.php"
			}).done(function(data){
				$('#overall').html(data);
			});
		}
		
		function summaryTab(){
			$.ajax({
				type: "GET",
				url: "summary.php"
			}).done(function(data){
				$('#summaryTab').html(data);
			});
		}
		
		function adminTab(){
			$.ajax({
				type: "GET",
				url: "admin.php"
			}).done(function(data){
				$('#adminTab').html(data);
			});
		}
		
		function supervisorTab(){
			$.ajax({
				type: "GET",
				url: "supervisor.php"
			}).done(function(data){
				$('#supervisorTab').html(data);
			});
		}
		
		function departmentTab(){
			$.ajax({
				type: "GET",
				url: "department.php"
			}).done(function(data){
				$('#departmentTab').html(data);
			});
		}
		
		function formTab(){
			$.ajax({
				type: "GET",
				url: "form.php"
			}).done(function(data){
				$('#formTab').html(data);
			});
		}
		
		function scheduleShow(){
			$.ajax({
				type: "GET",
				url: "scheduleTable.php"
			}).done(function(data){
				$('#scheduleTable').html(data);
				scheduleTab();
			});
		}
		function scheduleTab(){
			$.ajax({
				type: "GET",
				url: "schedule.php"
			}).done(function(data){
				$('#scheduleTab').html(data);
			});
		}
		
		function scheduleTable(){
			$.ajax({
				type: "GET",
				url: "scheduleTable.php"
			}).done(function(data){
				$('#scheduleTable').html(data);
			});
		}
		
		function schedulePreference(){
			$.ajax({
				type: "GET",
				url: "schedulePreference.php"
			}).done(function(data){
				$('#schedulePreference').html(data);
			});
		}
		
		function evaluationTab(){
			$.ajax({
				type: "GET",
				url: "evaluation.php"
			}).done(function(data){
				$('#evaluationTab').html(data);
			});
		}
		
		function facultyTab(){
			$.ajax({
				type: "GET",
				url: "faculty.php"
			}).done(function(data){
				$('#facultyTab').html(data);
			});
		}
		
		function studentTab(){
			$.ajax({
				type: "GET",
				url: "student.php"
			}).done(function(data){
				$('#studentTab').html(data);
			});
		}
		
		function commiTab(){
			$.ajax({
				type: "GET",
				url: "committee.php"
			}).success(function(data){
				$('#commitTab').html(data);
			});
		}
		
		function hideAlert(){
			$("#alertMessage").fadeTo(3000, 500).slideUp(500, function(){			
			});
			$("#alertSched").fadeTo(3000, 500).slideUp(500, function(){			
			});
		}
	</script>
</html>