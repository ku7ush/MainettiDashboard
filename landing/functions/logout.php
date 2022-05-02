<?php
	session_start();
	session_destroy();
	header( "Location: http://localhost/landing/pages/login.php");
	//header( "Location: http://kurush.netsons.org/landing/pages/login.php");
?>