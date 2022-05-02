<?php
	session_start();

	require_once('../libs/ripcord.php');

	include		"../libs/session_control.inc";

    // fetch users with ripcord
    
	$url = 'http://sv.coopenerp.net:7788';
	$openerpDB = 'mainetti';
	$username = 'admin';
	$password = 'cricchia';

	$common = ripcord::client($url . '/xmlrpc/common');
	$models = ripcord::client($url . '/xmlrpc/object');

	$uid = $common->authenticate($openerpDB, $username, $password, array());

	// Fetch utenti

	if (isset($_POST['username']) && isset($_POST['password'])) {
		$fetchUsers = $models->execute(
			$openerpDB, 
			$uid, 
			$password, 
			'res.partner', 
			'search',
			[['web_order_username', 'like', $_POST['username']]],
			null
		);
		
		if ($fetchUsers == null) {			
			return false;
			exit;
		};

		$readUsers = $models->execute(
			$openerpDB, 
			$uid, 
			$password, 
			'res.partner', 
			'read',
			$fetchUsers
		);

		$user = $readUsers[0];

		$readSaleClient = $models->execute(
			$openerpDB, 
			$uid, 
			$password, 
			'sale.agent', 
			'read',
			$user['agent_id'][0]
		);

		$customers = array_merge($readSaleClient, $user['child_ids']);

		$exploded = explode(",", $user['email']);
		$user['email'] = $exploded[0];

		if($user['web_order_username'] == $_POST['username'] && $user['web_order_password'] == $_POST['password']) {
			$_SESSION["login"]		=		true;
			$_SESSION["id"]			=		$user['id'];
			$_SESSION["name"]		=		$user['name'];	
			$_SESSION["partner_id"]		=		$user['commercial_partner_id'][0];
			$_SESSION["partner_id_name"]		=		$user['commercial_partner_id'][1];
			$_SESSION["customer"]		=		$user['customer'];
			$_SESSION["agent"]		=		$user['web_order_salesagent'];
			$_SESSION["user_id"]		=		$user['user_id'];
			$_SESSION["agent_id"]		=		$user['agent_id'];			

			if ($_SESSION["agent"] == 1) {
				$_SESSION['login_mode'] = "Agent";
			} else {
				$_SESSION['login_mode'] = "Customer";
			}

			if (isset($customers["customer"])) {
				$_SESSION["customers"]		=		$customers["customer"];
			} else {
				$_SESSION["customers"]		=		array();
			}
			
			echo true;
		} else {
			echo false;
		}
	} 	
?>