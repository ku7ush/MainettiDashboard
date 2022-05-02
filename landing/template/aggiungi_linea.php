<?php

	session_start();

	// Loading Ripcord
	require_once('../libs/ripcord.php');

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
?>
<script type="text/javascript" src="../js/aggiungi_linea.js"></script>
<form id="lineForm">
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Prodotto</label>
		<select id="product_modal_select" class="custom-select col-sm-12 col-md-6 form-control">
			<?php
				foreach ($products as $key => $product) {
					echo '<option selected="" value="' .$product['id']. '">' . $product['name'] . '</option>';					
				}
			?>
		</select>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Prezzo unitario</label>
		<?php
			echo '<input disabled type="number" class="col-sm-12 col-md-1 form-control" id="prezzou" name="prezzou" value="'.
			$product['standard_price'] . '"/>';
		?>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Quantità</label>
		<input type="number" class="form-control col-sm-12 col-md-2" id="qty" name="qty" min="1" value=""/>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Sconto</label>
		<input type="number" class="form-control col-sm-12 col-md-1" id="discount" name="discount" min="0" max="100" value="0"/>
	</div>
	<br>
	<br>
	<br>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Subtotale</label>
		<input type="number" class="form-control col-sm-12 col-md-2" disabled id="parziale" name="parziale" value="0"/>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Sconto</label>
		<input type="number" class="form-control col-sm-12 col-md-2" disabled id="sconto" name="sconto" value="0"/>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-3 col-form-label">Totale</label>
		<input type="number" class="form-control col-sm-12 col-md-2" disabled id="total" name="total" value="0"/>
	</div>
</form>