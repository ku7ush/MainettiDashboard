<?php

	session_start();

	require_once('./libs/ripcord.php');

	include		"./libs/session_control.inc";
	
	include		"./functions/functions.php";
	
    // Ripcord
    
	$url = 'http://sv.coopenerp.net:7788';
	$openerpDB = 'mainetti';
	$username = 'admin';
	$password = 'cricchia';

	$common = ripcord::client($url . '/xmlrpc/common');
	$models = ripcord::client($url . '/xmlrpc/object');

	$uid = $common->authenticate($openerpDB, $username, $password, array());

	// Vars

	// Search/Read
	
	$ordersListFields = array('id', 'create_date', 'name', 'amount_untaxed', 'amount_total', 'state', 'from_web_order');
	
	if ($_SESSION['login_mode'] == "Customer" && $_SESSION['customer'] == 1) {
		$ordersIds = $models->execute(
			$openerpDB,
			$uid,
			$password,
			'sale.order',
			'search',
			[['partner_id', '=', $_SESSION['id']], ['state', '!=', 'draft'], ['state', '!=', 'cancel']],
			null,
			100
  		);

		$orders = $models->execute(
			$openerpDB, 
			$uid, 
			$password, 
			'sale.order', 
			'read',
			$ordersIds,
			$ordersListFields
		);	
	} elseif ($_SESSION['login_mode'] == "Agent") {
		$ordersIds = $models->execute(
			$openerpDB,
			$uid,
			$password,
			'sale.order',
			'search',
			[['partner_id', '=', $_SESSION['id']]],
			null,
			100
  		);

		$orders = $models->execute(
			$openerpDB, 
			$uid, 
			$password, 
			'sale.order', 
			'read',
			$ordersIds,
			$ordersListFields
		);
	}
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
		<p class="debug_bar" hidden><?php print_r($_SESSION);?></p>
		<div class="pd-ltr-20 mCustomScrollbar height-100-p xs-pd-20-10" data-mcs-theme="dark">
			<div class="row clearfix">				
				<div class="page-header animated slideInRight delay-075s">
					<div class="col-md-12 col-sm-12">						
						<div class="icon-options-link col-md-2 col-sm-2 pull-left">
							<a href="nuovo-ordine.php" class="new-link"><i class="animated fadeIn delay-125s fa fa-plus back-icon pull-left"></i></a>	
						</div>
						<div class="title col-md-10 col-sm-10 pull-right">
							<h4>Ordini</h4>
						</div>							
					</div>	
				</div>
			</div>

			<div class="orders-wrap pd-20 bg-primary box-shadow-strong mb-30 animated fadeIn delay-075s">
				<div class="orders-list table-responsive">					
					<table class="table table-bordered" id="ordersTable">
						<thead>
							<tr class="ordersParams">
								<th>#</th>
								<th>Protocollo</th>
								<th>Data</th>
								<th>Imponibile</th>
								<th>Totale</th>
								<th>Stato</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if ($orders > 0) {
									foreach ($orders as $key => $order) {
										$datetime = $order['create_date']; 
										$dateFinal = DateTime::createFromFormat("Y-m-d H:i:s", $datetime);

										echo '<tr id="'.$order['id'].'">';
											echo '<td>' . $order['id'] . '</td>';
											echo '<td>' . $order['name'] . '</td>';
											echo '<td>' . $dateFinal->format("d/m/Y H:i:s") . '</td>';
											echo '<td>' . $order['amount_untaxed'] . '</td>';
											echo '<td>' . $order['amount_total'] . '</td>';
											switch ($order['state']) {
											    case 'draft':
											        echo '<td>Bozza</td><td class="order-icons"><a href="modifica-ordine.php?orderId='.$order['id'].'"><i class="fa fa-edit"></i></a><a href="functions/cancel_order.php?id='.$order['id'].'"><i class="fa fa-trash-alt"></i></a></td>';
											        break;
											    case 'manual':
											        echo '<td>In attesa</td><td class="order-icons"><a href="visualizza-ordine.php?orderId='.$order['id'].'"><i class="fa fa-eye"></i></a><a href="functions/ripeti_ordine.php?orderId='.$order['id'].'"><i class="fa fa-cart-plus"></i></a></td>';
											        break;
											    case 'cancel':
											        echo '<td>Annullato</td><td class="order-icons"><a href="visualizza-ordine.php?orderId='.$order['id'].'"><i class="fa fa-eye"></i></a></td>';
											        break;
											    case 'progress':
											    	echo '<td>Fatturato</td><td class="order-icons"><a href="visualizza-ordine.php?orderId='.$order['id'].'"><i class="fa fa-eye"></i></a><a href="functions/ripeti_ordine.php?orderId='.$order['id'].'"><i class="fa fa-cart-plus"></i></a></td>';
											    	break;
											};
										echo '</tr>';
									}
								}
							?>
						</tbody>
					</table>
					<?php include('include/inline/table_filter.php'); ?>					
				</div>
			</div>
			<?php //include('include/footer.php'); ?>
		</div>
	</div>
</body>
</html>