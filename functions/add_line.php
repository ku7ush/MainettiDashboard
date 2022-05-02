<?php

session_start();

require_once('../libs/ripcord.php');
include		"../functions/actions.php";
// Loading Ripcord

$url = 'http://sv.coopenerp.net:7788';
$openerpDB = 'mainetti';
$username = 'admin';
$password = 'cricchia';

$common = ripcord::client($url . '/xmlrpc/common');
$models = ripcord::client($url . '/xmlrpc/object');

$uid = $common->authenticate($openerpDB, $username, $password, array());

$productsId = $models->execute(
	$openerpDB,
	$uid,
	$password,
	'product.product',
	'search',
	[['id', '>', 0]],
	null,
	8
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

if (isset($_POST['loaded'])) {	

	$products = array(
		array(
			'id' => $_POST['id'],
			'name' => $_POST['name'],
			'standard_price' => $_POST['standard_price'],
			'qty' => $_POST['qty'],
			'discount' => $_POST['discount']
		)
	);
}

//console($products);

$content =
'<form id="lineForm">'.
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Prodotto</label>' .
		'<select id="product_modal_select" class="custom-select col-12 form-control">';

foreach ($products as $key => $product) {
	if (!isset($_POST['loaded'])){
		$product['qty'] = "1";
		$product['discount'] = "0";	
	};
	$content .= '<option selected="" value="' .$product['id']. '">' . $product['name'] . '</option>';

	//console(print_r($product));
}

$content .= '</select>' .
	'</div>' .
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Prezzo unitario</label>' .
		'<input type="number" class="form-control" disabled id="prezzou" name="prezzou" value="'. $product['standard_price'] .'"/>'.
	'</div>' .
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Quantità</label>' .
		'<input type="number" class="form-control" id="qty" name="qty" min="1" value=""/>'.
	'</div>' .
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Sconto</label>' .
		'<input type="number" class="form-control" id="discount" name="discount" min="0" value="' . $product['discount'] . '"/>' .
	'</div>' .
	'<br>' .
	'<br>' .
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Subtotale</label>' .
		'<input type="number" class="form-control" disabled id="parziale" name="parziale" value="0"/>' .
	'</div>' .
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Sconto</label>' .
		'<input type="number" class="form-control" disabled id="sconto" name="sconto" value="0"/>' .
	'</div>' .
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Totale</label>' .
		'<input type="number" class="form-control" disabled id="total" name="total" value="0"/>' .
	'</div>' .
	'<br>' .
	'<br>' .	
'</form>
<script>
	$(document).ready(function() { 
		$("#product_modal_select option").first().prop("selected",true)
		$("#qty").val(1)
		$("#qty").trigger("change")
	})
</script>'
;



echo $content;

?>