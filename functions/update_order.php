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

//print_r($_POST);

$datiOrdine = array(
	'user_id' => $_SESSION['id'][0],
	'partner_id' => $_POST['cliente'],
	'order_policy' => 'manual',
	'order_id' => $_POST['order_id'] ,
	'lines' => [],
	'pricelist_id' => 1,
	'partner_shipping_id' => $_POST['indirizzo'],
	'payment_term' => 1,
	'partner_invoice_id' => $_POST['indirizzo']
);

$order = array(
	(int)$_POST['order_id']
);

//print_r($datiOrdine);

$creaOrdine = $models->execute_kw(
	$openerpDB,
	$uid,
	$password,
	'sale.order',
	'write',
    array(
    	$order,
    	$datiOrdine
    )
);

echo (int)$_POST['order_id'];

//header( "Location: http://localhost/orders.php");
?>