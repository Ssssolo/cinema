<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top wp1" role="navigation">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./">
                <i class="fa fa-video-camera"></i> Cinema <span class="font-light"> Melodia</span>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
				<?php
				if(!isset($_GET['view']) || $_GET['view'] == 'index'){
				?>
                <li class="page-scroll">
                    <a href="#about">Despre</a>
                </li>
                <li class="page-scroll">
                    <a href="#movie-player">Video</a>
                </li>
				<!--
                <li class="page-scroll">
                    <a href="#actors">Actori</a>
                </li>
                <li class="page-scroll">
                    <a href="#gallery">Galerie</a>
                </li>
				-->
                <li class="page-scroll">
                    <a href="#contact">Contact</a>
                </li>
				<?php
				} else {
				?>
				<li class="page-scroll">
                    <a href="./">Acasă</a>
                </li>
				<?php } ?>
                <li class="page-scroll">
                    <a href="filme">Filme</a>
                </li>
				<li class="page-scroll">
                    <a href="blog">Blog</a>
                </li>
                <?php if(logat()){ ?>
                <li class="page-scroll">
					<a href="profil">Profil</a>
                </li>
				<?php if($date_utilizator['acces'] == 1) { ?>
                <li class="page-scroll">
					<a href="admin">Admin</a>
                </li>
				<?php } ?>
				<li class="page-scroll">
					<a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                </li>
				<?php } else { ?>
				<li class="page-scroll">
					<a href="login">Login</a>
                </li>
				<li class="page-scroll">
					<a href="inregistrare">Înregistrare</a>
                </li>
				<?php } ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>