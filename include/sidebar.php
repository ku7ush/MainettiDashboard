	<div class="left-side-bar animated slideInLeft fast delay-1s">
		<div class="brand-logo">
			<a href="index.php">
				<img src="vendors/images/login-img.png" alt="logo" class="logo-img">
			</a>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-home"></span><span class="mtext">Home</span>
						</a>
						<ul class="submenu">
							<li><a href="index.php">Dashboard</a></li>
						</ul>
					</li>
					<?php
						if ($_SESSION['login_mode'] == "Agent") {
							echo '<li class="dropdown">
								<a href="javascript:;" class="dropdown-toggle">
									<span class="fa fa-user"></span><span class="mtext">Clienti</span>
								</a>
								<ul class="submenu">
									<li><a href="clienti.php">Visualizza clienti</a></li>
									<li><a href="nuovo-cliente.php">Registra cliente</a></li>
								</ul>
							</li>';
						}
					?>					
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fa-desktop"></span><span class="mtext"> Ordini </span>
						</a>
						<ul class="submenu">
							<li><a href="orders.php">Gestisci ordini</a></li>
							<?php
							if ($_SESSION['login_mode'] == "Agent") {
								echo '<li><a href="nuovo-ordine.php">Nuovo ordine</a></li>';
							}?>							
						</ul>
					</li>			
				</ul>
			</div>
		</div>
	</div>