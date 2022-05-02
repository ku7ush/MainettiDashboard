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

	$creaOrdine = $models->execute_kw(
		$openerpDB,
		$uid,
		$password,
		'sale.order',
		'create',
	    array(
	    	array(
	    		'user_id' => $_SESSION['user_id'][0],
				'date_order' => date("Y-m-d"),
				'partner_id' => $_POST['cliente'],
				'order_policy' => 'manual',
				'name' => "/",
				'lines' => [],
				'pricelist_id' => 1,
				'partner_shipping_id' => $_POST['indirizzo'],
				'payment_term' => 1,
				'partner_invoice_id' => $_POST['indirizzo'],
				'from_web_order' => true
			)
	    )
	);

	echo $creaOrdine;
?>