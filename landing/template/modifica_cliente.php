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

		// Province

	$provinceIds = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'res.province',
	    'search',
	    array()	    
	);

	$provinces = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'res.province',
	    'read',
	    $provinceIds,
	    array()
	);	

	function sortBySubValue($array, $value, $asc = true, $preserveKeys = false)
	{
	    if ($preserveKeys) {
	        $c = [];
	        if (is_object(reset($array))) {
	            foreach ($array as $k => $v) {
	                $b[$k] = strtolower($v->$value);
	            }
	        } else {
	            foreach ($array as $k => $v) {
	                $b[$k] = strtolower($v[$value]);
	            }
	        }
	        $asc ? asort($b) : arsort($b);
	        foreach ($b as $k => $v) {
	            $c[$k] = $array[$k];
	        }
	        $array = $c;
	    } else {
	        if (is_object(reset($array))) {
	            usort($array, function ($a, $b) use ($value, $asc) {
	                return $a->{$value} == $b->{$value} ? 0 : ($a->{$value} <=> $b->{$value}) * ($asc ? 1 : -1);
	            });
	        } else {
	            usort($array, function ($a, $b) use ($value, $asc) {
	                return $a[$value] == $b[$value] ? 0 : ($a[$value] <=> $b[$value]) * ($asc ? 1 : -1);
	            });
	        }
	    }

	    return $array;
	}

	$orderedProvinces = sortBySubValue($provinces, 'name', true, true);

		// Cliente

	$clientsListFields = array('name', 'street', 'city', 'province', 'zip', 'email', 'phone', 'vat', 'ref', 'fiscalcode', 'is_company');

  	$clientId =  $_POST['id'];

	$client = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'res.partner', 
		'read',
		array($clientId),
		$clientsListFields
	);	

	$cliente = $client[0];
?>

<script type="text/javascript" src="../js/modifica_cliente.js"></script>
<div class="php-content-wrapper nuovo-cliente-wrapper">	
	<div class="text-white title d-flex flex-row animated fadeIn delay-025s">
		<div class="icon-options-link col-md-2 col-sm-2 pull-left">
			<a href="#" class="back-link"><i class="animated fadeIn delay-125s fa fa-arrow-left back-icon pull-left"></i></a>
			<a href="#" class="save-link"><i class="animated fadeIn delay-150s fa fa-save back-icon pull-left"></i></a>							
		</div>
		<div class="content-title">MODIFICA CLIENTE</div>
	</div>
	<div class="nuovo-cliente-form pt-4">
		<form id="newClientForm" method="post" action="">
			<?php 
				echo '<input type="text" name="idCliente" value="' . $cliente['id'] . '" hidden>';
			?>
			<div class="form-group row">							
				<label class="col-sm-12 col-md-2 col-form-label">Nome</label>
				<div class="col-sm-12 col-md-4">								
					<?php
						echo '<input class="form-control" type="text" name="nomeCliente" value="' .
						$cliente['name'] . '"/>';
					?>
				</div>
			</div>

			<div class="form-group row">							
				<label class="col-sm-12 col-md-2 col-form-label">Indirizzo</label>
				<div class="col-sm-12 col-md-4">						
					<?php
						echo '<input class="form-control" type="char" name="indirizzoCliente" value="' .
						$cliente['street'] . '"/>';
					?>
				</div>
			</div>

			<div class="form-group row">							
				<label class="col-sm-12 col-md-2 col-form-label">Città</label>
				<div class="col-sm-12 col-md-4">								
					<?php
						echo '<input class="form-control" type="text" name="cittaCliente" value="' .
						$cliente['city'] . '"/>';
					?>
				</div>
			</div>

			<div class="form-group row">							
				<label class="col-sm-12 col-md-2 col-form-label">Provincia</label>
				<div class="col-sm-12 col-md-4">								
					<select id="province-selector" class="custom-select" name="provinciaCliente">
						<?php
							foreach ($orderedProvinces as $key => $province) {
								if ($province['id'] == $cliente['province'][0]) {
									echo '<option value="' .$province['id']. '" selected>';
									echo $province['name'];
									echo '</option>';	
								} else {
									echo '<option value="' .$province['id']. '">';
									echo $province['name'];
									echo '</option>';								
								}
							}
						?>								
					</select>
				</div>
			</div>

			<div class="form-group row">							
				<label class="col-sm-12 col-md-2 col-form-label">E-Mail</label>
				<div class="col-sm-12 col-md-4">						
					<?php
						echo '<input class="form-control" type="email" name="emailCliente" value="' .
						$cliente['email'] . '"/>';
					?>					
				</div>
			</div>

			<div class="form-group row">							
				<label class="col-sm-12 col-md-2 col-form-label">CF/PI</label>
				<div class="col-sm-12 col-md-4">								
					<?php
						echo '<input class="form-control" type="text" name="vatCliente" value="' .
						$cliente['vat'] . '"/>';
					?>					
				</div>
			</div>

			<div class="form-group row">							
				<label class="col-sm-12 col-md-2 col-form-label">Cap</label>
				<div class="col-sm-12 col-md-2">								
					<?php
						echo '<input class="form-control" type="text" name="capCliente" value="' .
						$cliente['zip'] . '"/>';
					?>					
				</div>
			</div>


			<div class="form-group row">							
				<label class="col-sm-12 col-md-2 col-form-label">Telefono</label>
				<div class="col-sm-12 col-md-2">								
					<?php
						echo '<input class="form-control" type="text" name="telefonoCliente" value="' .
						$cliente['phone'] . '"/>';
					?>					
				</div>
			</div>


			<div class="form-group row">
				<label class="col-sm-12 col-md-2 col-form-label">Is Company</label>							
				<div class="col-sm-12 col-md-4 col-form-label">		
					<?php
						if ($cliente['is_company'] == 1) {
							echo '<input type="checkbox" class="custom-checkbox" checked name="isCompany" value="' .
							$cliente['is_company'] . '">';
						} else {
							echo '<input type="checkbox" class="custom-checkbox" name="isCompany" value="' .
							$cliente['is_company'] . '">';
						}
					?>
				</div>			
			</div>
			
			<input type="submit" value="submit" name="Submit" hidden/>
		</form>
	</div>	
</div>