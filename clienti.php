<?php

	session_start();

	require_once('./libs/ripcord.php');

	include		"./libs/session_control.inc";
	
	include		"./functions/functions.php";

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

	$clientsListFields = array('name', 'contact_address', 'email', 'phone', 'vat', 'ref', 'fiscalcode', 'is_company');

	/*$clientsIds = $models->execute_kw(
		$openerpDB,
		$uid,
		$password,
		'res.partner',
		'search',
		[[["customer","=", true], ["active", "=", 1]]],
		['offset'=> 0, 'limit'=> 50]
  	);*/

  	//print_r($clientsIds);

  	$clientsIds = $_SESSION['customers'];

	$clients = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'res.partner', 
		'read',
		$clientsIds,
		$clientsListFields
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

	<div class="main-container" id="clients">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="row clearfix">
				<div class="page-header animated slideInRight delay-075s">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="icon-options-link col-md-2 col-sm-2 pull-left">
								<a href="nuovo-cliente.php" class="new-link"><i class="animated fadeIn delay-125s fa fa-plus back-icon pull-left"></i></a>	
							</div>
							<div class="title">
								<h4>Clienti</h4>
							</div>							
						</div>
					</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 mb-30">									

				</div>
		
	</div>

	<div class="clients-wrap pd-20 bg-primary box-shadow-strong mb-30 animated fadeIn delay-075s">
				<div class="clients-list table-responsive">					
					<table class="table table-bordered" id="clientsTable">
						<thead>
							<tr class="clientsParams">
								<th>Ref</th>
								<th>Nome</th>
								<th>Indirizzo</th>
								<th>Telefono</th>
								<th>Email</th>
								<th>CF/PI</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if ($clients > 0) {
									foreach ($clients as $key => $client) {
										$exploded = explode(",", $client['email']);
										$client['email'] = $exploded[0];
										echo '<tr id="'. $client['id'] .'">';
											echo '<td>' . $client['ref'] . '</td>';
											echo '<td>' . $client['name'] . '</td>';
											echo '<td>' . $client['contact_address'] . '</td>';
											echo '<td>' . $client['phone'] . '</td>';
											echo '<td>' . $client['email'] . '</td>';
											if($client['is_company'] == 1){
												echo '<td>' . $client['fiscalcode'] . '</td>';
											} else {
												echo '<td>' . $client['vat'] . '</td>';
											}
											echo '<td class="client-icons"><a href="modifica-cliente.php?clientId='.$client['id'].'"><i class="fa fa-edit"></i></a></td>';
										echo '</tr>';
									}
								}
							?>
						</tbody>
					</table>
					<?php include('include/inline/clients_table_filter.php'); ?>					
				</div>
			</div>
			<?php //include('include/footer.php'); ?>	
</body>
</html>