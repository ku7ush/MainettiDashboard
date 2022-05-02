<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Mainetti - Retail Solutions Worldwide</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">  

  <!-- Utils -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">

  <!-- Custom styles for this template -->
  <link href="../css/grayscale.css" rel="stylesheet">
  <link href="../css/custom.css" rel="stylesheet">
  <link href="../css/login.css" rel="stylesheet">

</head>

<body id="page-top">

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
	<div class="container-fluid">
	  <a class="navbar-brand js-scroll-trigger animated fadeInLeft delay-05s" href="../../frontpage.php"><i class="fa fa-chevron-left back-icon"></i></a>
	  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">        
	    <i class="fas fa-bars"></i>
	  </button>	  
	  <div class="collapse navbar-collapse animated fadeInRight delay-025s" id="navbarResponsive">
	    <ul class="navbar-nav ml-auto">
	      
	    </ul>
	  </div>
	</div>
	</nav>

	<!-- Header -->
	<header class="masthead lofi">
		<div class="container d-flex align-items-center justify-content-center flex-column vh-100">
			<div class="d-flex justify-content-center animated fadeIn delay-05s">
				<div class="card">
					<div class="card-header">
						<h3 class="logo text-center">M</h3>						
					</div>
					<div class="card-body">
						<form id="loginForm" action="../functions/login_actions.php" method="post">
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" class="form-control" id="username" placeholder="Username" name="username">
								
							</div>
							<div class="input-group form-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" class="form-control" id="password" placeholder="Password" name="password">
							</div>							
							<div class="form-group">
								<input type="submit" value="Login" class="btn float-right login_btn trans-button">
							</div>
						</form>
					</div>
					<div class="card-footer">
						
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-center error-box hideme">
				<div>
					Password o nome utente errati
				</div>				
			</div>
		</div>
	</header>

  	<!-- Back to top -->
	<a href="#page-top" id="backToTop" class="hideme js-scroll-trigger"><i class="fa fa-angle-up"></i></a>	

	<!-- Bootstrap core JavaScript -->
	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Plugin JavaScript -->
	<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for this template -->
	<script src="../js/grayscale.js"></script>
	<script src="../js/main.js"></script>
	<script src="../js/login.js"></script>

</body>

</html>