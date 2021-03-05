<?php
$error = '';
$info = json_decode($date_website['articole'], true);

$text = curatare($_POST['comentariu']);
if(empty($text) || strlen($text) < 10)
	$error = '<div class="alert alert-danger" role="alert" id="eroare"><center><i class="fa fa-exclamation-triangle fa-3" aria-hidden="true"></i> <b>Eroare!</b> Comentariul trebuie să conțină minim 10 caractere. </center></div>';

if(!$info['permitere'][0]['permitere_comentarii'])
	$error = '<div class="alert alert-danger" role="alert" id="eroare"><center><i class="fa fa-exclamation-triangle fa-3" aria-hidden="true"></i> <b>Avertizare:</b> Această secțiune a fost dezactivată temporar de către un administrator.</center></div>';

$aid = $_POST['id_articol'];
$uid = $_POST['id_utilizator'];
$idcom = $_POST['id_comentariu'];	
if(!$idcom)
	$idcom = "NULL";

if($error == '')
{
 mysqli_query($con, "INSERT INTO `comentarii` (`id_articol`, `id_utilizator`, `text`, `parinte`, `data`, `ip`) VALUES ($aid, $uid, '$text', $idcom, '". date('Y-m-d H:i:s') ."', '". $_SERVER['REMOTE_ADDR'] ."')");

 $error = '<div class="alert alert-success" role="alert" id="eroare"><center><i class="fa fa-exclamation-triangle fa-3" aria-hidden="true"></i> <b>Succes!</b> Comentariul dvs. a fost adaugat cu succes. </center></div>';
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>