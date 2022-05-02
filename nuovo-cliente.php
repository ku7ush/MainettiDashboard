<?php

	session_start();

	require_once('./libs/ripcord.php');

	include		"./libs/session_control.inc";
	
	include		"./functions/functions.php";

	include		"./functions/actions.php";

    // Ripcord
    
	$url = 'http://sv.coopenerp.net:7788';
	$openerpDB = 'mainetti';
	$username = 'admin';
	$password = 'cricchia';

	$common = ripcord::client($url . '/xmlrpc/common');
	$models = ripcord::client($url . '/xmlrpc/object');

	$uid = $common->authenticate($openerpDB, $username, $password, array());

	// Vars
	

	// Search/Read

	
?>

<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
</head>
<body>
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php include('include/script.php'); ?>

	<div class="main-container" id="nuovo-cliente">
		<div class="modal fade hidden" id="line-modal" tabindex="-1" role="dialog" style="display: block;">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content box-shadow">
					<div class="modal-header">
						<button type="button" class="close"><i class="fa fa-times"></i></button>
					</div>
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">									
						<button type="button" id="button_save_line" class="btn btn-primary">AGGIUNGI</button>
					</div>
				</div>
			</div>
		</div>
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="row clearfix">
				<div class="page-header">
					<div class="col-md-12 col-sm-12">						
						<div class="icon-options-link col-md-2 col-sm-2 pull-left">
							<a href="clienti.php" class="back-link"><i class="animated fadeIn delay-125s fa fa-arrow-left back-icon pull-left"></i></a>
							<a href="#" class="save-link"><i class="animated fadeIn delay-150s fa fa-save back-icon pull-left"></i></a>							
						</div>
						<div class="title col-md-10 col-sm-10 pull-right">
							<h4 class="animated slideInRight delay-05s"> Nuovo cliente </h4>
						</div>							
					</div>						
				</div>
			</div>

			<div class="orders-wrap pd-20 bg-primary box-shadow-strong mb-30 animated fadeIn delay-075s">
				<div class="order-detail-list">					
					<p class="order-protocol-number">
						
					</p>

					<form id="newClientForm" method="post" action="/functions/save_client.php">

						<div class="form-group row">							
							<label class="col-sm-12 col-md-2 col-form-label">Nome</label>
							<div class="col-sm-12 col-md-10">								
								<input class="form-control" type="text" name="nomeCliente" value=""/>
							</div>
						</div>

						<div class="form-group row">							
							<label class="col-sm-12 col-md-2 col-form-label">Indirizzo</label>
							<div class="col-sm-12 col-md-10">								
								<input class="form-control" type="char" name="indirizzoCliente" value=""/>
							</div>
						</div>

						<div class="form-group row">							
							<label class="col-sm-12 col-md-2 col-form-label">Città</label>
							<div class="col-sm-12 col-md-10">								
								<input class="form-control" type="text" name="cittaCliente" value=""/>
							</div>
						</div>

						<div class="form-group row">							
							<label class="col-sm-12 col-md-2 col-form-label">Provincia</label>
							<div class="col-sm-12 col-md-10">								
								<input class="form-control" type="text" name="provinciaCliente" value=""/>
							</div>
						</div>

						<div class="form-group row">							
							<label class="col-sm-12 col-md-2 col-form-label">Cap</label>
							<div class="col-sm-12 col-md-10">								
								<input class="form-control" type="number" name="capCliente" value=""/>
							</div>
						</div>


						<div class="form-group row">							
							<label class="col-sm-12 col-md-2 col-form-label">Telefono</label>
							<div class="col-sm-12 col-md-10">								
								<input class="form-control" type="text" name="telefonoCliente" value=""/>
							</div>
						</div>

						<div class="form-group row">							
							<label class="col-sm-12 col-md-2 col-form-label">E-Mail</label>
							<div class="col-sm-12 col-md-10">								
								<input class="form-control" type="email" name="emailCliente" value=""/>
							</div>
						</div>

						<div class="form-group row">							
							<label class="col-sm-12 col-md-2 col-form-label">CF/PI</label>
							<div class="col-sm-12 col-md-10">								
								<input class="form-control" type="text" name="vatCliente" value=""/>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Is Company</label>							
							<div class="col-sm-12 col-md-10">								
								<input type="checkbox" class="custom-checkbox" name="isCompany" value="0">
							</div>
							
						</div>
						
						<input type="submit" value="submit" name="Submit" hidden/>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>