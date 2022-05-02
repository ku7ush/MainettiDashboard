<?php
	session_start();

	require_once('../libs/ripcord.php');

	include		"../libs/session_control.inc";
		

    // Ripcord
    
	$url = 'http://sv.coopenerp.net:7788';
	$openerpDB = 'mainetti';
	$username = 'admin';
	$password = 'cricchia';

	$common = ripcord::client($url . '/xmlrpc/common');
	$models = ripcord::client($url . '/xmlrpc/object');

	$uid = $common->authenticate($openerpDB, $username, $password, array());

	// Vars
	$orderID = 'new';
	$inputAttribs = '';

	$order['state'] = "draft";
	$order['partner_id'] = 'Scegli il cliente';
	$order['name'] = 'Nuovo Ordine';
	$order['partner_invoice_id'] = 'Indirizzo Fatturazione' ;
	$order['partner_shipping_id'] = 'Indirizzo Spedizione' ;
	$order['create_date'] = date('d/m/Y');

	$fetchedLines = [];

	// Search/Read

	$partnersListFields = array('name', 'street');
	$limit = null;
	$sortString = 'name asc';

	$partners = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'res.partner',
	    'read',
	    $_SESSION['customers'],
	    $partnersListFields
	);
?>
<script type="text/javascript" src="../js/creaordine.js"></script>
<div class="php-content-wrapper nuovo-ordine-wrapper">
	<div class="custom-modal hideme below">
		<div class="custom-modal-header">
			<i class="close-modal fa fa-times"></i>
		</div>
		<div class="custom-modal-content">
			
		</div>
		<div class="custom-modal-footer">
			<a class="add-line-to-order"><i class="fa fa-save"></i></a>
		</div>
	</div>
	<div class="text-white title d-flex flex-row animated fadeIn delay-025s">
		<div class="icon-options-link col-md-2 col-sm-2 pull-left">
			<a href="#" class="back-link"><i class="animated fadeIn delay-125s fa fa-arrow-left back-icon pull-left"></i></a>
			<a href="#" class="save-link"><i class="animated fadeIn delay-150s fa fa-save back-icon pull-left"></i></a>							
		</div>
		<div class="content-title">NUOVO ORDINE</div>
	</div>
	<div class="nuovo-ordine-form">
		<form id="orderForm" method="post" action="/functions/save_order.php">			
			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Cliente</label>
				<div class="col-sm-12 col-md-4">
					<select id="client-selector" <?php echo $inputAttribs;?> class="custom-select" name="cliente">
						<?php
							foreach ($partners as $key => $partner) {
								echo '<option value="' .$partner['id']. '">';
									echo $partner['name'];
								echo '</option>';							
							}
						?>								
					</select>
				</div>
			</div>


			<div class="form-group row">							

				<?php
					// Hidden vendor
					echo '<input type="number" name="vendor" value="'.$_SESSION['id'][0].'" hidden/>';
				?>

				<label class="col-sm-12 col-md-2 col-form-label">Indirizzo</label>
				<div class="col-sm-12 col-md-4">
					<select id="address-selector" <?php echo $inputAttribs;?> class="custom-select" name="indirizzo">
					</select>
				</div>
			</div>


			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Data</label>
				<div class="col-sm-12 col-md-4">
					<?php								
						echo '<input '.$inputAttribs.' class="form-control date-picker" disabled name="data" value="'.$order['create_date'].'" placeholder="Scegli una data" type="text">';
					?>								
				</div>
			</div>
			<input type="submit" value="submit" name="Submit" hidden/>
		</form>

		<br>
		<br>
		<br>

		<div class="orders-list table-responsive">
			<div class="newline-suggest">
					<a id="add-newline-button" href="#"><i class="fa fa-plus"></i></a>							
			</div>	

			<table class="table table-bordered" id="orderProductsTable" data-update="false">
				<thead>
					<tr class="ordersParams">
						<th>Prodotto</th>
						<th>Prezzo unitario</th>
						<th>Quantità</th>
						<th>Subtotale</th>
						<th>Sconto %</th>
						<th>Totale</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>	
</div>