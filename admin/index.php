<?php
// Start the session
session_start();

?>
<!DOCTYPE html>
<html  lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Login Page</title>
	<link rel="icon" sizes="192x192" href="icon.jpg">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.yellow-indigo.min.css" />
	<script src="mdl/material.min.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Square card -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	
	<style>
	.demo-card-square.mdl-card {
		width: 400px;
		height: auto;
		text-align: center;
		margin:auto;
		margin-top: 120px;

	}
	.demo-card-square > .mdl-card__title {
		color: white;
		background:#4177f4;
	}
	body{
		font-family: 'Roboto', sans-serif;
	}
</style>
</head>
<body>
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header class="mdl-layout__header">
			<div class="mdl-layout__header-row">
				<!-- Title -->
				<span class="mdl-layout-title" style="text-align: justify;"><img src="title.png" alt="hirent" width="70" height="70"><strong style="font-size: 30px;margin-left: 12px;">hiREnt | Admin Login</strong></span>
				
			</div>

		</header>
		<main class="mdl-layout__content" style="background:white url(1.jpg)   no-repeat fixed;">
			<div class="demo-card-square mdl-card mdl-shadow--3dp" style="border-radius: 50px;">
				<div class="mdl-card__title">
					<h4 class="mdl-card__title-text" style="padding-left: 145px;font-weight: bold;">Login</h4>
				</div>
				<div class="mdl-card__supporting-text">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="email">
						<label class="mdl-textfield__label" for="email" style="color: #4f84ff;">Enter Email</label>
						<span class="mdl-textfield__error">Incorrect Email address!!!</span>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="password" pattern=".{6,}" id="password">
						<label class="mdl-textfield__label" for="password" style="color: #4f84ff;">Password</label>
						<span class="mdl-textfield__error">Password must contain more than 6 Characters</span>
					</div>
					<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="margin-top: 15px;margin-bottom: 15px;" id="login">Login   <i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>
					</button>
				</div>
				
			</div>
			
		</main>
		<footer class="mdl-mini-footer">
			<div class="mdl-mini-footer__left-section">
				<div class="mdl-logo">hiREnt</div>
				<ul class="mdl-mini-footer__link-list">
					<li><a href="#">Help</a></li>
					<li><a href="priter.php">Privacy and Terms</a></li>
				</ul>
			</div>
		</footer>
	</div>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$("#login").click(function(event) {
				$.ajax({
					url: 'alogin.php',
					type: 'POST',
					data: {email: $("#email").val(),password: $("#password").val()},
					success:function(response){
						if(response==1)
						{
							window.location.href="home.php"
						}
						else
						{
							alert("Error logging user");
						}
					}
				})	
			});
		});
	</script>
</body>
</html>