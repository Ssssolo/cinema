<?php
include('../core/init.php');

if(!isset($_SESSION['admin']))
	include('pages/login.php');
else{
	if(isset($_GET['pagina'])){
		include('functions/admin_general.php');
		
		//Vedem pe ce pagina ne aflam
		switch($_GET['pagina']){
			case ($_GET['pagina'] == 'dashboard' || $_GET['pagina'] == 'index'):
				include('pages/dashboard.php');
				break;
				
			case 'utilizatori':
				include('pages/utilizatori.php');
				break;
				
			case 'utilizatori-editare':
				include('functions/admin_afisare.php');
				include('pages/edit/user/edit.php');
				break;
				
			case 'utilizatori-stergere':
				include('functions/admin_afisare.php');
				include('functions/validare.php');
				include('pages/delete/user/delete.php');
				break;
				
			case 'utilizatori-stergere-succes':
				include('pages/utilizatori.php');
				break;
				
			case 'articole':
				include('pages/articole.php');
				break;
				
			case 'articole-adaugare':
				include('functions/admin_afisare.php');
				include('pages/adaugare/articol.php');
				break;
				
			case 'articole-editare':
				include('functions/admin_afisare.php');
				include('pages/edit/articol/edit.php');
				break;
			
			case 'articole-stergere':
				include('functions/admin_afisare.php');
				include('functions/validare.php');
				include('pages/delete/articol/delete.php');
				break;
			
			case 'articole-stergere-succes':
				include('pages/articole.php');
				break;
				
			case 'articole-paginare':
				include('pages/articole_paginare.php');
				break;
				
			case 'comentarii':
				include('pages/comentarii.php');
				break;
					
			case 'comentarii-stergere':
				include('functions/admin_afisare.php');
				include('functions/validare.php');
				include('pages/delete/comentarii/delete.php');
				break;
				
			case 'comentarii-stergere-succes':
				include('pages/comentarii.php');
				break;
				
			case 'filme':
				include('pages/filme.php');
				break;
				
			case 'calendar-afisare':
				include('pages/calendar/afisare.php');
				break;
					
			case 'calendar-actiune':
				include('pages/calendar/actiune.php');
				break;
				
			case 'premiera':
				include('pages/premiera.php');
				break;
				
			case 'bilete':
				include('pages/bilete.php');
				break;
				
			case 'bilete-stergere':
				include('functions/admin_afisare.php');
				include('functions/validare.php');
				include('pages/delete/rezervare/delete.php');
				break;
				
			case 'bilete-stergere-succes':
				include('pages/bilete.php');
				break;
				
			case 'setari-utilizatori':
				include('pages/setari/utilizatori.php');
				break;
				
			case 'setari-articole':
				include('functions/admin_afisare.php');
				include('pages/setari/articole.php');
				break;
				
			case 'setari-generale':
				include('functions/admin_afisare.php');
				include('pages/setari/general.php');
				break;
				
			default:
				include('pages/eroare.php');
				break;
		}
	} else {
		include('functions/admin_general.php');
		include('pages/dashboard.php');
	}
}
?>