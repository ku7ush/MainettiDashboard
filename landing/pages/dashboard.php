<?php
	session_start();
?>

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
  <!--link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet"-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">  

  <!-- Utils -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cssgram/0.1.10/cssgram.min.css">
  <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css" />

  <!-- Custom styles for this template -->
  <link href="../css/grayscale.css" rel="stylesheet">
  <link href="../css/custom.css" rel="stylesheet">
  <link href="../css/sidebar.css" rel="stylesheet">
  <link href="../css/header.css" rel="stylesheet">
  <link href="../css/dashboard.css" rel="stylesheet">
  <link href="../css/aggiungicliente.css" rel="stylesheet">
  <link href="../css/aggiungiordine.css" rel="stylesheet">
  <link href="../css/ordini.css" rel="stylesheet">

</head>

<body id="page-top">

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
		<div class="container-fluid">
			<button class="navbar-toggler navbar-toggler-right animated fadeInDown delay-1s" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">        
	    		<i class="fas fa-bars"></i>
	  		</button>	  
		  <div class="user-info animated fadeInDown delay-1s">
		  	<div class="user-logged">
		  		<span class="user-icon"><i class="fas fa-user-tie"></i></span>
			  	<?php
					if (isset($_SESSION['name'])) {
						echo '<span class="user-name">'. ucwords(strtolower($_SESSION["name"])). '</span>';
					}
				?>	
		  	</div>	  	
			<a class="logout" href="../functions/logout.php"><i class="fa fa-sign-out-alt" aria-hidden="true"></i> <span class="logout-text">Log Out</span></a>
		  </div>
	</nav>

	<?php include('../template/sidebar.php'); ?>

	<!-- Header -->
	<header class="masthead lofi">
		<div class="dark-overlay-50"></div>
		<div id="content" class="container-fluid d-flex align-items-center justify-content-center flex-column vh-100">
			<div class="mCustomScrollbar customscroll" data-mcs-theme="light" data-mcs-axis="y">
				<div id="loaded-content" class="scheda animated fadeIn"></div>
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
	<script src="../js/vendor/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="../vendor/tablefilter/tablefilter.js"></script>

	<!-- Custom scripts for this template -->
	<script type="text/javascript" src="../js/grayscale.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript" src="../js/login.js"></script>
	<script type="text/javascript" src="../js/sidebar.js"></script>
	<script type="text/javascript" src="../js/dashboard.js"></script>
</body>

</html>