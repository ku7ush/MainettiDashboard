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

/*$ordine = array(
	'partner_id'=> 5690,
	'user_id' => 47,
	'date_order' => date("Y-m-d"),
    'product_id'=> 4355,
    'order_policy' => 'manual',
    'name'=>'Test Order',
    'pricelist_id' => 1,
    'payment_term' => 1,
    'partner_invoice_id' => 5690,
    'partner_shipping_id' => 5690
);

$creaOrdine = $models->execute_kw(
	$openerpDB,
	$uid,
	$password,
	'sale.order',
	'create',
    array(
    	$ordine
    )
);

echo 'created new sale order with id:' . print_r($creaOrdine);*/
			

$dati = array(
	'name' => "BUSTONI BIANCO RIGENERATI  CM.50+15+15X 120",
	'order_id' => 10261,
	'product_id' => 4355,
	'product_uom_qty' => 1,
	'prezzo_conai' => 127.8,/*
	'discount' => 10,
	'product_uom_qty' => 100,
    'price_unit' => 1.42,
    'price_total' => 127.8,
    'prezzo_conai' => 127.8*/
);

$crea_linea_ordine = $models->execute_kw(
	$openerpDB,
	$uid,
	$password,
	'sale.order.line',
	'create',
	array(
		$dati
	)
);

print_r($crea_linea_ordine);




//header( "Location: http://localhost/orders.php");*/
?>