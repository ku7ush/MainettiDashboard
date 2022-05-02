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

	$productsId = $models->execute(
		$openerpDB,
		$uid,
		$password,
		'product.product',
		'search',
		[['id', '=', $_POST['id']]],
		null,
		1
	);

	$products = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'product.product', 
		'read',
		$productsId,
		array('name', 'standard_price')
	);

	$price =  $products[0]['standard_price'];

	echo $price;
?>