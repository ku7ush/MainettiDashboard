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

	// Search/Read
	
	//$ordersListFields = array('id', 'create_date', 'name', 'amount_untaxed', 'amount_total', 'state', 'from_web_order');
	$ordersListFields = array();
	
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

<script type="text/javascript" src="../js/ordini.js"></script>
<div class="php-content-wrapper">	
	<div class="text-white title d-flex flex-row content-title animated fadeIn delay-025s">ORDINI</div>	
	<div class="clients-list table-responsive">					
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
					if (isset($orders) AND $orders > 0) {
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
								        echo '<td>Bozza</td><td class="order-icons"><a class="modifica-ordine-button" href=""><i class="fa fa-edit"></i></a><a class="annulla-ordine-button" href=""><i class="fa fa-trash-alt"></i></a></td>';
								        break;
								    case 'manual':
								        echo '<td>In attesa</td><td class="order-icons"><a class="visualizza-ordine-button" href=""><i class="fa fa-eye"></i></a>';
								        	if ($_SESSION['login_mode'] == 'Customer') {
								        		echo '<a class="riordina-ordine-button" href=""><i class="fas fa-shopping-bag"></i></a>';
								        	}								        	
								        	echo '</td>';
								        break;
								    case 'cancel':
								        echo '<td>Annullato</td><td class="order-icons"><a class="visualizza-ordine-button" href=""><i class="fa fa-eye"></i></a></td>';
								        break;
								    case 'progress':
								    	echo '<td>Fatturato</td><td class="order-icons"><a class="visualizza-ordine-button" href=""><i class="fa fa-eye"></i></a>';
								    	if ($_SESSION['login_mode'] == 'Customer') {
								    		echo '<a class="riordina-ordine-button" href=""><i class="fas fa-shopping-bag"></i></a>';
								    	}
								    	echo '</td>';
								    	break;
								};
							echo '</tr>';
						}
					}
				?>
			</tbody>
		</table>
		<?php include('../template/inline/table_filter.php'); ?>	
	</div>
</div>