<?php

	session_start();

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

	$clientsListFields = array('name', 'contact_address', 'email', 'phone', 'vat', 'ref', 'fiscalcode', 'is_company');

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

<script type="text/javascript" src="../js/clienti.js"></script>
<div class="php-content-wrapper">	
	<div class="text-white title d-flex flex-row content-title animated fadeIn delay-025s">CLIENTI</div>	
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
								echo '<td class="client-icons"><a class="modifica-cliente-button" href="#"><i class="fa fa-edit"></i></a></td>';
							echo '</tr>';
						}
					}
				?>
			</tbody>
		</table>
		<?php include('../template/inline/clients_table_filter.php'); ?>	
	</div>
</div>