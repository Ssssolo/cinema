<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

//Setam fusul orar & locatia
date_default_timezone_set('Europe/Bucharest');
setlocale(LC_TIME, array('ro.utf-8', 'ro_RO.UTF-8', 'ro_RO.utf-8', 'ro', 'ro_RO', 'ro_RO.ISO8859-2'));

//Specificam codarea caracterelor
header('Content-type: text/html; charset=utf-8');

//Includem fisierele principale
include('database/connect.php');
include('functions/csrf.php');
include('functions/utilizatori.php');
require_once('functions/general.php');
include('functions/input.php');
include('functions/afisare.php');

//Preluam informatiile despre website
$date_website = date_website($con);

//Verificam daca website-ul se afla in mentenanta si redirectionam
if($date_website['mentenanta'] && !isset($_SESSION['admin']) && basename(getcwd()) != 'admin')
	die('site-ul este in mentenanta');

//Daca este logat, preluam datele utilizatorului
if(logat())
	$date_utilizator = date_utilizator($con, $_SESSION['id']);

if(logat() && $date_utilizator['acces'] == -1)
	die('banat');

?>