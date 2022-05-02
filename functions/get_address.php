<?php
	session_start();

	require_once('../libs/ripcord.php');

    // Loading Ripcord
    
	$url = 'http://sv.coopenerp.net:7788';
	$openerpDB = 'mainetti';
	$username = 'admin';
	$password = 'cricchia';

	$common = ripcord::client($url . '/xmlrpc/common');
	$models = ripcord::client($url . '/xmlrpc/object');

	$uid = $common->authenticate($openerpDB, $username, $password, array());	
		
	$id = $_POST['id'];

	$clienteSearch = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'res.partner', 
		'search',
		[['id', '=', $_POST['id']]]
	);

	$clienteRead = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'res.partner', 
		'read',
		$clienteSearch,
		array('street')
	);

	echo json_encode($clienteRead);
?>