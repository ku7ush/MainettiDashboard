<?php
	session_start();
	clearstatcache();

	require_once('../libs/ripcord.php');

	include		"../libs/session_control.inc";
	
	//include		"../functions/functions.php";

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

	
		// Ordine

	//$orderListFields = array('name', 'street', 'city', 'province', 'zip', 'email', 'phone', 'vat', 'ref', 'fiscalcode', 'is_company');

  	$orderID =  $_POST['id'];

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

	//console($fetchedLines);

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

<script type="text/javascript" src="../js/visualizza_ordine.js"></script>
<div class="php-content-wrapper nuovo-cliente-wrapper">
	<div class="custom-modal hideme">
		<div class="custom-modal-header">
			<i class="close-modal fa fa-times"></i>
		</div>
		<div class="custom-modal-content">
			
		</div>
	</div>	
	<div class="text-white title d-flex flex-row animated fadeIn delay-025s">
		<div class="icon-options-link col-md-2 col-sm-2 pull-left">
			<a href="#" class="back-link"><i class="animated fadeIn delay-125s fa fa-arrow-left back-icon pull-left"></i></a>			
		</div>
		<div class="content-title">VISUALIZZA ORDINE</div>
	</div>
	<div class="visualizza-ordine-form pt-4">
		<form id="orderForm" method="post" action="">
			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Cliente</label>
				<div class="col-sm-12 col-md-4">
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
				<div class="col-sm-12 col-md-4">
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
				<div class="col-sm-12 col-md-4">
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
								echo '<td class="order-icons"><a class="visualizza-linea-button" href="#"><i class="fa fa-eye"></i></a>';
								if ($order['state'] == 'draft') {
									echo '<i class="fa fa-trash-alt"></i></td>';
								}											
							echo '</tr>';
						}
					?>
				</tbody>
			</table>
		</div>
	</div>	
</div>