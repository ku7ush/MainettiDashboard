<?php

	session_start();

	require_once('./libs/ripcord.php');

	include		"./libs/session_control.inc";
	
	include		"./functions/functions.php";
	
    include		"./libs/MysqliDb.php";

    // fetch orders with ripcord
    
	$url = 'http://sv.coopenerp.net:7788';
	$openerpDB = 'mainetti';
	$username = 'admin';
	$password = 'cricchia';

	$common = ripcord::client($url . '/xmlrpc/common');
	$models = ripcord::client($url . '/xmlrpc/object');

	$uid = $common->authenticate($openerpDB, $username, $password, array());

	$productsId = $models->execute(
		$openerpDB,
		$uid,
		$password,
		'product.product',
		'search',
		[['id', '>', 0]],
		null,
		100
  	);

	$products = $models->execute(
		$openerpDB, 
		$uid, 
		$password, 
		'product.product', 
		'read',
		$productsId,
		array('name', 'total_price')
	);	

	//print_r($products)
?>

<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
</head>
<body>
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>

	<div class="main-container" id="products">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="row clearfix">
				<div class="page-header animated slideInRight delay-075s">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Prodotti</h4>
							</div>							
						</div>
					</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 mb-30">									

					<div class="product-wrap">
						<div class="product-list">
							<ul class="row">
								<?php
									foreach ($products as $product) {
										echo '<li class="col-lg-3 col-md-6 col-sm-6 animated fadeIn delay-1s">';
											echo '<div class="product-box box-shadow-strong">';
												echo 	'<div class="producct-img"><img src="vendors/images/product-img1.jpg" alt=""></div>';
												echo 	'<div class="product-caption">
															<h4><a href="#">'. $product['name'] . '</a></h4>
															<div class="price">
																<ins>' . $product['total_price'] . ' € </ins>
															</div>
															<a href="#" class="btn btn-outline-primary">Dettagli</a>
														</div>';
											echo '</div>';
										echo '</li>';
									}
								?>
							</ul>
						</div>

						<div class="blog-pagination mb-30 hidden">
							<div class="btn-toolbar justify-content-center mb-15">
								<div class="btn-group">
									<a href="#" class="btn btn-outline-primary prev"><i class="fa fa-angle-double-left"></i></a>
									<a href="#" class="btn btn-outline-primary">1</a>
									<a href="#" class="btn btn-outline-primary">2</a>
									<span class="btn btn-primary current">3</span>
									<a href="#" class="btn btn-outline-primary">4</a>
									<a href="#" class="btn btn-outline-primary">5</a>
									<a href="#" class="btn btn-outline-primary next"><i class="fa fa-angle-double-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>				

		
	</div>
			<?php include('include/footer.php'); ?>
	<?php include('include/script.php'); ?>
</body>
</html>