<?php

	session_start();

	require_once('./libs/ripcord.php');

	include		"./libs/session_control.inc";
	
	include		"./functions/functions.php";

	include		"./functions/actions.php";

    // Ripcord
    
	$url = 'http://sv.coopenerp.net:7788';
	$openerpDB = 'mainetti';
	$username = 'admin';
	$password = 'cricchia';

	$common = ripcord::client($url . '/xmlrpc/common');
	$models = ripcord::client($url . '/xmlrpc/object');

	$uid = $common->authenticate($openerpDB, $username, $password, array());

	// Vars

	$orderID = $_GET['orderId'];
	$inputAttribs = '';


	/*$order['state'] = "draft";
	$order['partner_id'] = 'Scegli il cliente';
	$order['name'] = 'Nuovo Ordine';
	$order['partner_invoice_id'] = 'Indirizzo Fatturazione' ;
	$order['partner_shipping_id'] = 'Indirizzo Spedizione' ;
	$order['create_date'] = date('d/m/Y');

	$fetchedLines = [];*/
	
	// Search/Read

	$partnersListFields = array('name', 'street');
	$limit = null;
	$sortString = 'name asc';

	$partnersSearch = $models->execute_kw(
		$openerpDB, 
		$uid, 
		$password, 
		'res.partner', 
		'search',
		[[["customer","=", true]]],
		['offset'=> 0, 'limit'=> $limit, 'order' => $sortString]
	);

	$partners = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'res.partner',
	    'read',
	    $partnersSearch,
	    $partnersListFields
	);
	

	$searchOrder = $models->execute(
		$openerpDB,
		$uid,
		$password,
		'sale.order',
		'search',
		[['id', '=', $orderID]],
		null
  	);

	$fetchedOrder = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'sale.order', 
		'read',
		$searchOrder
	);

	$order = $fetchedOrder[0];

	//print_r($order);

	$fetchLines = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'sale.order.line', 
		'search',
		[['order_id', '=', $order['id']]],
		null
	);

	$fetchedLines = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'sale.order.line', 
		'read',
		$fetchLines
	);

	$searchClients = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'res.partner', 
		'search',
		[['id', '=', $order['partner_id'][0]]]
	);
?>

<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
</head>
<body>
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php include('include/script.php'); ?>

	<?php //print_r($order); ?>

	<div class="main-container update-page modifica-ordine" id="ordini">
		<div class="modal hidden" id="line-modal" tabindex="-1" role="dialog" style="display: block;">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content box-shadow">
					<div class="modal-header">
						<button type="button" class="close"><i class="fa fa-times"></i></button>
					</div>
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">									
						<button type="button" id="button_save_line" class="btn btn-primary">AGGIUNGI</button>
					</div>
				</div>
			</div>
		</div>
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="row clearfix">
				<div class="page-header">
					<div class="col-md-12 col-sm-12">						
						<div class="icon-options-link col-md-2 col-sm-2 pull-left">
							<a href="orders.php" class="back-link"><i class="animated fadeIn delay-125s fa fa-arrow-left back-icon pull-left"></i></a>
							<?php							
								echo '<a href="#" class="save-link"><i class="animated fadeIn delay-150s fa fa-save back-icon pull-left"></i></a>';
								echo '<a href="/functions/cancel_order.php?id='.$orderID.'" class="delete-link"><i class="animated fadeIn delay-175s fa fa-trash back-icon pull-left"></i></a>';
							?>							
						</div>
						<div class="title col-md-10 col-sm-10 pull-right">
							<?php
								echo '<h4 class="animated slideInRight delay-05s"> Ordine  <span class="order-title-id">'.$orderID.'</span></h4>';
							?>
						</div>							
					</div>						
				</div>
			</div>

			<div class="orders-wrap pd-20 bg-primary box-shadow-strong mb-30 animated fadeIn delay-075s">
				<div class="order-detail-list">					
					<p class="order-protocol-number">
						<?php 
							echo $order['name'];														
						?>							
					</p>

					<form id="orderForm" class="update-form" method="post" action="/functions/update_order.php">						
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Cliente</label>
							<div class="col-sm-12 col-md-10">
								<select id="client-selector" <?php echo $inputAttribs;?> class="custom-select col-12" name="cliente">
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
								echo '<input type="number" name="order_id" value="'.$orderID.'" hidden/>';								
							?>

							<label class="col-sm-12 col-md-2 col-form-label">Indirizzo</label>
							<div class="col-sm-12 col-md-10">
								<select id="address-selector" <?php echo $inputAttribs;?> class="custom-select col-12" name="indirizzo">
								</select>
							</div>
						</div>


						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Data</label>
							<div class="col-sm-12 col-md-10">
								<?php								
									echo '<input '.$inputAttribs.' class="form-control date-picker" disabled name="date" value="'.$order['create_date'].'" placeholder="Scegli una data" type="text">';
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
								<a href="#"><i class="fa fa-plus"></i></a>							
						</div>	

						<table class="table table-bordered" id="orderProductsTable" data-update="true">
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
								<?php								
								foreach ($fetchedLines as $key => $line) {									
									echo '<tr data-update="true" data-index="'.$key.'">';
										echo '<td class="input-prodid" data-product-id="' . $line['product_id'][0] . '" hidden></td>';
										echo '<td class="input-lineid" data-product-lineid="' . $line['id'] . '" hidden>' . $line['id'] . '</td>';
										echo '<td class="input-name" data-product-name="' . $line['name'] . '">' . $line['name'] . '</td>';
										echo '<td class="input-prezzo" data-prezzo-unita="' . $line['price_unit'] . '">' . $line['price_unit'] . '</td>';
										echo '<td class="input-qty" data-qty="' . $line['product_uom_qty'] . '">' . $line['product_uom_qty'] . '</td>';
										echo '<td class="input-subtotal" data-subtotal="' . $line['price_subtotal'] . '">' . $line['price_subtotal'] . '</td>';
										echo '<td class="input-discount" data-discount="' . $line['discount'] . '">' . $line['discount'] . '</td>';
										echo '<td class="input-total" data-totale="' . $line['price_subtotal'] . '">' . $line['price_subtotal'] . ' </td>';
										echo '<td class="order-icons"><a href="#"><i class="edit-line fa fa-edit"></i><i class="delete-line fa fa-trash-alt"></i></td></a>';
									echo '</tr>';
								}?>
							</tbody>
						</table>
					</div>
					<script>
						<?php echo "$('#client-selector').val(" . $order['partner_id'][0] . ")";?>
					</script>
				</div>
			</div>
		</div>
		
		
	</div>
</body>
</html>

<?php /*						
	foreach ($fetchedLines as $key => $line) {
		echo '<tr id="'.$line['id'].'" data-index="'.$key.'">';											
			echo '<td class="input-name">' . $line['name'] . '</td>';
			echo '<td class="input-prezzo">' . $line['price_unit'] . ' €</td>';
			echo '<td class="input-qty">' . $line['product_uom_qty'] . ' pz.</td>';
			echo '<td class="input-subtotal">' . $line['price_subtotal'] . ' €</td>';
			echo '<td class="input-discount">' . $line['discount'] . '%</td>';
			echo '<td class="input-total">' . $line['price_subtotal'] . ' €</td>';
			echo '<td class="order-icons"><a href="#"><i class="edit-line fa fa-edit"></i><i class="delete-line fa fa-trash-alt"></i></td></a>';
		echo '</tr>';
	}*/
?>