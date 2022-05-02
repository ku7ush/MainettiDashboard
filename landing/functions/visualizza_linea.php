<?php
	session_start();
	clearstatcache();

	require_once('../libs/ripcord.php');

	include		"../libs/session_control.inc";

    // fetch orders with ripcord
    
	$url = 'http://sv.coopenerp.net:7788';
	$openerpDB = 'mainetti';
	$username = 'admin';
	$password = 'cricchia';

	$common = ripcord::client($url . '/xmlrpc/common');
	$models = ripcord::client($url . '/xmlrpc/object');

	$uid = $common->authenticate($openerpDB, $username, $password, array());

	// Vars

	// Search/Read

	$searchLine = $models->execute(
		$openerpDB,
		$uid,
		$password,
		'sale.order.line',
		'search',
		[['id', '=', $_POST['id']]],
		null
  	);

	$readLine = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'sale.order.line', 
		'read',
		$searchLine
	);

	$fetchedLine = $readLine[0];
?>

<form id="lineForm" class="editRow">
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Prodotto</label>
		<?php 
			echo '<input type="text" class="col-md-9 col-sm-12 form-control" disabled id="name" name="name" value="' .$fetchedLine['name']. '"></input>';
		?>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Prezzo unitario</label>
		<?php 
			echo '<input type="text" class="col-md-4 col-sm-12 form-control" disabled id="prezzou" name="prezzou" value="' .$fetchedLine['price_unit']. '"></input>';
		?>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Quantità</label>
		<?php 
			echo '<input type="text" disabled class="form-control col-md-4 col-sm-12" id="qty" name="qty" min="1" value="' .$fetchedLine['product_uom_qty']. '"></input>';
		?>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Sconto</label>
		<?php 
			echo '<input type="text" disabled class="form-control col-md-4 col-sm-12" id="discount" name="discount" min="0" value="' .$fetchedLine['discount']. '"></input>';
		?>		 
	</div>
	<br>
	<br>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Totale</label>
		<?php 
			echo '<input type="text" class="form-control col-md-4 col-sm-12" disabled id="total" name="total" value="' .$fetchedLine['price_subtotal']. '"></input>';
		?>
	</div>
	<br>
	<br>
</form>