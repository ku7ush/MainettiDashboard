	<nav id="sidebar" class="d-flex flex-column align-items-center left-side-bar animated slideInLeft fast delay-1s">
		<div class="brand-logo">			
			<a class="navbar-brand js-scroll-trigger animated fadeInLeft delay-05s" href="#">M</a>
		</div>
		
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul class="list-unstyled components" id="appMenu">
		            <li class="active">
		                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" id="home-button" class=""><span class="fa fa-home"></span><span class="mtext">Home</span></a>		                
		            </li>
		            <?php
						if ($_SESSION['login_mode'] == "Agent") {
							echo '
							<li>
				                <a href="#clientiSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-user"></span><span class="mtext">Clienti</span></a>
				                <ul class="collapse list-unstyled" id="clientiSubmenu">
				                    <li>
				                        <a class="menu-item" id="clienti-menu-item" href="../template/clienti.php">Gestisci clienti</a>
				                    </li>
				                    <li>
				                        <a class="menu-item" href="../template/aggiungi_cliente.php">Aggiungi cliente</a>
				                    </li>
				                </ul>
				            </li>
							';
						}
					?>
		            
		            <li>
		                <a href="#ordiniSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span class="fa fa-desktop"></span><span class="mtext">Ordini </span></a>
		                <ul class="collapse list-unstyled" id="ordiniSubmenu">
		                    <li>
		                        <a class="menu-item" id="ordini-menu-item" href="../template/ordini.php">Gestisci ordini</a>
		                    </li>
		                    <?php
								if ($_SESSION['login_mode'] == "Agent") {
									echo '<li><a class="menu-item" href="../template/aggiungi_ordine.php">Crea ordine</a></li>';
								}
							?>			                    
		                </ul>
		            </li>
		        </ul>
			</div>
		</div>
	</nav>