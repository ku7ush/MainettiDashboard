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


/*print_r($_POST);
exit;*/

if($_POST['update'] == "true"){
	if(isset($_POST['line_id'])){
		$orderline = (int)$_POST['line_id'];
	}

	$crea_linea_ordine = $models->execute_kw(
		$openerpDB,
		$uid,
		$password,
		'sale.order.line',
		'write',
		array(
			$orderline,
	    	array(
	    		'order_id' => $_POST['order_id'],
				'product_id' => $_POST['prodotto_id'],
				'name' => $_POST['product_name'],
				'discount' => $_POST['discount'],
				'product_uom_qty' => $_POST['qty'],
		        'price_unit' => $_POST['price_unit'],
		        'price_total' => $_POST['price_total'],
		        'prezzo_conai' => $_POST['price_total']
			)	
		)
	);	
	

} elseif ($_POST['update'] == "unlink") {
	$crea_linea_ordine = $models->execute_kw(
		$openerpDB,
		$uid,
		$password,
		'sale.order.line',
		'unlink',
		array(
	    	array(
				$_POST['line_id']
			)	
		)
	);	
} elseif ($_POST['update'] == "false") {
	$crea_linea_ordine = $models->execute_kw(
	$openerpDB,
	$uid,
	$password,
	'sale.order.line',
	'create',
	array(
    	array(
			'order_id' => $_POST['order_id'],
			'product_id' => $_POST['prodotto_id'],
			'name' => $_POST['product_name'],
			'discount' => $_POST['discount'],
			'product_uom_qty' => $_POST['qty'],
	        'price_unit' => $_POST['price_unit'],
	        'price_total' => $_POST['price_total'],
	        'prezzo_conai' => $_POST['price_total']
		)	
	)
	);	
}

echo print_r($crea_linea_ordine);
//echo $_POST['update'];

//header( "Location: http://localhost/orders.php");
?>