<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
		<i class="fas fa-video"> CM</i>
		<span class="brand-text font-weight-light"><b> Cinema</b> Melodia</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info" style="color:white;">
                Bine ai venit, <b><i><?php echo (isset($_SESSION['prenume']) && !empty($_SESSION['prenume'])) ? ucfirst($_SESSION['prenume']) : '#Nedefinit'; ?></i></b>!
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="dashboard" class="nav-link <?php echo $titlu == "Dashboard" ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="utilizatori" class="nav-link <?php echo $titlu == "Utilizatori" ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Utilizatori
                        </p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="articole" class="nav-link <?php echo $titlu == "Articole" ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Articole
                        </p>
                    </a>
                </li>
				<li class="nav-item has-treeview <?php echo (isset($comentarii) && $comentarii == 1) ? 'menu-open' : ''; ?>">
                    <a href="comentarii" class="nav-link <?php echo (isset($comentarii) && $comentarii == 1) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Comentarii
							<i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="comentarii" class="nav-link <?php echo $titlu == "Comentarii" ? 'active' : ''; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Listă comentarii</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="comentarii" class="nav-link <?php echo $titlu == "Listă neagră" ? 'active' : ''; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Listă neagră</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
                    <a href="filme" class="nav-link <?php echo $titlu == "Filme săptămânale" ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-film"></i>
                        <p>
                            Filme săptămânale
                        </p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="premiera" class="nav-link <?php echo $titlu == "Premieră" ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Premieră
                        </p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="bilete" class="nav-link <?php echo $titlu == "Bilete vândute" ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>
                            Bilete rezervate
                        </p>
                    </a>
                </li>
				<li class="nav-item has-treeview <?php echo (isset($setari) && $setari == 1) ? 'menu-open' : ''; ?>">
                    <a href="setari" class="nav-link <?php echo (isset($setari) && $setari == 1) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Setări
							<i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="setari-utilizatori" class="nav-link <?php echo $titlu == "Setări utilizatori" ? 'active' : ''; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Utilizatori</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="setari-articole" class="nav-link <?php echo $titlu == "Setări articole" ? 'active' : ''; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Articole</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="setari-generale" class="nav-link <?php echo $titlu == "Setări generale" ? 'active' : ''; ?>">
								<i class="far fa-circle nav-icon"></i>
								<p>General</p>
							</a>
						</li>
					</ul>
				</li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>