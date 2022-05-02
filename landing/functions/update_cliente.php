<?php

	session_start();

	require_once('../libs/ripcord.php');

	$url = 'http://sv.coopenerp.net:7788';
	$openerpDB = 'mainetti';
	$username = 'admin';
	$password = 'cricchia';

	$common = ripcord::client($url . '/xmlrpc/common');
	$models = ripcord::client($url . '/xmlrpc/object');

	$uid = $common->authenticate($openerpDB, $username, $password, array());

	$cliente = array(
		(int)$_POST['idCliente']
	);


	if (isset($_POST['isCompany'])) {
		if($_POST['isCompany'] == 1) {
			$piva = $_POST['vatCliente'];
			$cf = "";	
		} elseif ($_POST['isCompany'] == 0) {
			$piva = "";
			$cf = $_POST['vatCliente'];	
		}	
	} else {
		$_POST['isCompany'] = 0;
		$piva = "";
		$cf = $_POST['vatCliente'];	
	}

	$anagrafica = array(
		'name' => $_POST['nomeCliente'],
		'street' => $_POST['indirizzoCliente'],
		'city' => $_POST['cittaCliente'],
		'zip' => $_POST['capCliente'],
		'province' => $_POST['provinciaCliente'],
		'phone' => $_POST['telefonoCliente'],
		'email' => $_POST['emailCliente'],
		'is_company' => $_POST['isCompany'],
		'fiscalcode' => $piva,
		'vat' => $cf
	);

	$updateClient = $models->execute_kw(
		$openerpDB,
		$uid,
		$password,
		'res.partner',
		'write',
		array($cliente, $anagrafica)
	);
?>