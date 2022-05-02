<?php
//session_start();

require_once('../libs/ripcord.php');

$url = 'http://sv.coopenerp.net:7788';
$openerpDB = 'mainetti';
$username = 'admin';
$password = 'cricchia';

$common = ripcord::client($url . '/xmlrpc/common');
$models = ripcord::client($url . '/xmlrpc/object');

$uid = $common->authenticate($openerpDB, $username, $password, array());

$cancellaOrdine = $models->execute_kw(
	$openerpDB,
	$uid,
	$password,
	'sale.order',
	'unlink',
    array(
    	array(
    		$_GET['id']
    	)
    )
);

header( "Location: http://localhost/orders.php");

?>