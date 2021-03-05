<?php
include('core/init.php');

if(isset($_GET['pagina']))
	switch($_GET['pagina']){
		case 'index':
			include('pages/index.php');
			break;
			
		case 'blog':
			include('pages/blog.php');
			break;
			
		case 'articol':
			include('pages/articol.php');
			break;
			
		case 'articol-adaugare-comentariu':
			include('pages/comentarii/adauga_comentariu.php');
			break;
			
		case 'articol-afisare-comentariu':
			include('pages/comentarii/afisare_comentariu.php');
			break;
			
		case 'filme':
			include('pages/filme.php');
			break;
			
		case 'login':
			include('pages/login.php');
			break;
			
		case 'profil':
			include('pages/profil.php');
			break;
			
		case 'inregistrare':
			include('pages/inregistrare.php');
			break;
			
		case 'resetare':
			include('pages/resetare.php');
			break;
			
		case 'rezervare-bilet':
			include('rezervare/index.php');
			break;
			
		default:
			include('pages/eroare.php');
			break;
	}
else
	include('pages/index.php');

?>