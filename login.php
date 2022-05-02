<!DOCTYPE html>
<html>
<head>
	<?php
		include('include/head.php');
	?>
</head>
<body>	
	<div class="login-wrap d-flex flex-column align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-primary box-shadow-strong pd-30 animated fadeIn delay-025s slow">
			<img src="vendors/images/login-img.png" alt="login" class="login-img">			
			<form action="/functions/login_actions.php" method="post">
				<div class="input-group custom input-group-lg box-shadow">
					<input type="text" name="username" id="username" class="form-control" placeholder="Username">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="input-group custom input-group-lg box-shadow">
					<input type="password" name="password" id="password" class="form-control" placeholder="**********">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="input-group">
							<input class="btn btn-outline-primary btn-lg btn-block box-shadow" type="submit" value="Login">
							<!--a class="btn btn-outline-primary btn-lg btn-block box-shadow" href="#">Login</a-->
						</div>
					</div>
					<!--div class="col-sm-6">
						<div class="forgot-password padding-top-10"><a href="forgot-password.php">Forgot Password</a></div>
					</div-->
				</div>				
			</form>
		</div>
		<div class="error-box bg-primary box-shadow-strong pd-30 animated fadeIn delay-05s hidden">
			<div class="error-message">
				<p class="">La password o il nome utente inseriti non sono validi</p>
			</div>			
		</div>
	</div>
	<?php include('include/script.php'); ?>
</body>
</html>