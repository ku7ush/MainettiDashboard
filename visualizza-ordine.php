<?php

	session_start();

	require_once('./libs/ripcord.php');

	include		"./libs/session_control.inc";
	
	include		"./functions/functions.php";

	include		"./functions/actions.php";

    // Loading Ripcord
    
	$url = 'http://sv.coopenerp.net:7788';
	$openerpDB = 'mainetti';
	$username = 'admin';
	$password = 'cricchia';

	$common = ripcord::client($url . '/xmlrpc/common');
	$models = ripcord::client($url . '/xmlrpc/object');

	$uid = $common->authenticate($openerpDB, $username, $password, array());

	// Ordine visualizzato
		
	$orderID = $_GET['orderId'];

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

	console($fetchedLines);

	$inputAttribs = 'disabled';

	$searchClients = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'res.partner', 
		'search',
		[['id', '=', $order['partner_id'][0]]]
	);

	$partner = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'res.partner', 
		'read',
		$searchClients
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

	<div class="main-container" id="ordini">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="row clearfix">
				<div class="page-header">
					<div class="col-md-12 col-sm-12">						
						<div class="icon-options-link col-md-2 col-sm-2 pull-left">
							<a href="orders.php" class="back-link"><i class="animated fadeIn delay-125s fa fa-arrow-left back-icon pull-left"></i></a>
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

					<form id="orderForm" method="post" action="/functions/save_order.php">						


						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Cliente</label>
							<div class="col-sm-12 col-md-10">
								<select <?php echo $inputAttribs;?> class="custom-select col-12" name="cliente">
									<?php
										echo '<option selected="" value="' .$order['partner_id'][0]. '">';
											echo $order['partner_id'][1];
										echo '</option>';										
									?>				
								</select>
							</div>
						</div>


						<div class="form-group row">
							<?php
								echo '<input type="number" name="vendor" value="'.$_SESSION['id'][0].'" hidden/>';
							?>
							<label class="col-sm-12 col-md-2 col-form-label">Indirizzo</label>
							<div class="col-sm-12 col-md-10">
								<select <?php echo $inputAttribs;?> class="custom-select col-12" name="indirizzo">
									<?php
										echo '<option selected="" value="' .$partner[0]['street']. '">';
											echo $partner[0]['street'];
										echo '</option>';
									?>
								</select>								
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Data</label>
							<div class="col-sm-12 col-md-10">
								<?php		
									$originalDate = $order['create_date'];
									$newDate = date("d/m/Y", strtotime($originalDate));
									echo '<input '.$inputAttribs.' class="form-control" disabled name="data" value="'.$newDate.'" placeholder="" type="text">';
								?>								
							</div>
						</div>
						<input type="submit" value="submit" name="Submit" hidden/>
					</form>

					<br>
					<br>
					<br>

					<div class="orders-list table-responsive">
						<table class="table table-bordered" id="orderProductsTable">
							<thead>
								<tr class="ordersParams">
									<th>Prodotto</th>
									<th>Prezzo unitario</th>
									<th>Quantità</th>
									<th>Subtotale</th>
									<th>Sconto</th>
									<th>Totale</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php						
									foreach ($fetchedLines as $key => $line) {
										echo '<tr id="'.$line['id'].'" data-index="'.$key.'">';											
											echo '<td class="input-name">' . $line['name'] . '</td>';
											echo '<td class="input-prezzo">' . $line['price_unit'] . ' €</td>';
											echo '<td class="input-qty">' . $line['product_uom_qty'] . ' pz.</td>';
											echo '<td class="input-subtotal">' . $line['price_subtotal'] . ' €</td>';
											echo '<td class="input-discount">' . $line['discount'] . '%</td>';
											echo '<td class="input-total">' . $line['price_subtotal'] . ' €</td>';
											echo '<td class="order-icons"><a href="#"><i class="fa fa-eye"></i></a>';
											if ($order['state'] == 'draft') {
												echo '<i class="fa fa-trash-alt"></i></td>';
											}											
										echo '</tr>';
									}
								?>
							</tbody>
						</table>
					</div>

					<div class="modal hidden" id="line-modal" tabindex="-1" role="dialog" style="display: block;">
						<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content box-shadow">
								<div class="modal-header">
									<button type="button" class="close"><i class="fa fa-times"></i></button>
								</div>
								<div class="modal-body">
								</div>
								<div class="modal-footer">									
								</div>
							</div>
						</div>
					</div>
					<script>
						
					</script>
				</div>
			</div>
		</div>
	</div>
</body>
</html>