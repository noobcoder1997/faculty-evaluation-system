<?php
	include_once 'dbConfig.php';
	if(isset($_SESSION['userStatus'])){
		header('location: home.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>FES - Login Page</title>
		<meta charset="utf-8">
		<link REL='shortcut icon' href="images/logo.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<style>
			html{
				position: relative;
				min-height: 100%;
			}
			body{
				padding:0;
				margin: 0;
				background: #e8e8e8;
			}
			@font-face {
				font-family: myFont;
				src: url(fonts/poppins/Poppins-Regular.ttf);
			}
			h3{
				color: #5a8dee;
				font-family: myFont;
			}
			.login-form{
				margin-top:20px;
				font-family: myFont;
			}
			.box{
				display: flex;
				flex-flow: row wrap;
				margin-top: 50px;
				box-shadow: 0 0 15px #A9A9A9;
				border-radius: 10px;
			}
			.login-tab{
				height: auto;
				border-radius: 10px 0px 0px 10px;
				color: #002D62;
				background-color: #fff;
				overflow: hidden;
				padding: 20px;
			}
			@media only screen and (max-width: 768px) {
				.login-tab{
					border-radius: 10px 10px 0px 0px;
				}
				.box{
					margin: 10px 2px 2px 2px;
				}
			}
			button{
				margin-top: 15px;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<div class="row box">
							<div class="col-sm-5 login-tab">
								<center>
									<h3>FACULTY EVALUATION SYSTEM (FES)</h3>
								</center>
								<div class="login-form">
									<span id="alertMessage"></span>
									<div class="form-group">
										<label for="user">Username:</label>
										<input type="text" class="form-control input-lg" id="user" placeholder="Username">
									</div>
									<div class="form-group">
										<label for="pass">Password:</label>
										<input type="password" class="form-control input-lg" id="pass" placeholder="Password">
									</div>
									<div class="checkbox">
									  <label><input type="checkbox" onclick="showPass();"> Show Password</label>
									</div>
									<button type="button" class="btn btn-primary btn-lg btn-block" onclick="login();">
										<span class="glyphicon glyphicon-log-in"></span> Login
									</button>
									<button type="button" class="btn btn-danger btn-lg btn-block" style="margin-top: 10px;">
										<span class="glyphicon glyphicon-lock"></span> Forgot Password
									</button>
								</div>
							</div>
							<div class="col-sm-7">
								<center>
									<img src="images/KingFish.png" alt="King Fisher" style="width:100%">
								</center>
							</div>
						</div>
					</div>
					<div class="col-sm-2"></div>
				</div>
			</div>
		</div>
	</body>
	<script>
		function showPass() {
			var x = document.getElementById("pass");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
		var userInput = document.getElementById("user");
		var passInput = document.getElementById("pass");
		userInput.onkeyup = function(e){
			if(e.keyCode == 13){
			   login();
			}
		}
		passInput.onkeyup = function(e){
			if(e.keyCode == 13){
			   login();
			}
		}
		function login(){
			var user = $('#user').val();
			var pass = $('#pass').val();
			if(user == "" || pass == ""){
				$('#alertMessage').html('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Fill empty field!</div>');
			}else{
				var datas="user="+user+"&pass="+pass;
				$.ajax({
					type: "POST",
					url: "login.php",
					data: datas
				}).done(function( data) {
					$('#alertMessage').html(data);
					if(data === '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Successfully Login!</div>'){
						location.reload();
					}
				});
			}
		}
	</script>
</html>