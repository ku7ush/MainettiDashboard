	<div class="pre-loader"></div>
	<div class="header clearfix">
		<div class="header-right animated slideInDown fast delay-05s box-shadow-strong bg-dark-color">
			<!--div class="brand-logo">
				<a href="index.php">
					<img src="vendors/images/login-img.png" alt="logo" class="mobile-logo">
				</a>
			</div-->
			<div class="menu-icon">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="user-info-dropdown animated slideInRight delay-1s">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon"><i class="fas fa-user-tie"></i></span>
						<?php
						if (isset($_SESSION['name'])) {
							echo '<span class="user-name">'. ucwords(strtolower($_SESSION["name"])). '</span>';
						}

						?>
						
					</a>
					<div class="dropdown-menu dropdown-menu-right box-shadow-strong">
						<!--a class="dropdown-item" href="profile.php"><i class="fas fa-user-tie" aria-hidden="true"></i> Profilo </a>
						<a class="dropdown-item" href="profile.php"><i class="fa fa-cog" aria-hidden="true"></i> Opzioni </a>
						<a class="dropdown-item" href="faq.php"><i class="fa fa-question" aria-hidden="true"></i> Assistenza </a-->
						<a class="dropdown-item" href="functions/logout.php"><i class="fa fa-sign-out-alt" aria-hidden="true"></i> Log Out</a>
					</div>
				</div>
			</div>
			<!--div class="user-notification animated fadeIn delay-150s">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="">
										<h3 class="clearfix">Tizio <span>3 minuti fa</span></h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="">
										<h3 class="clearfix">Tizio <span>5 minuti fa</span></h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div-->
		</div>
	</div>