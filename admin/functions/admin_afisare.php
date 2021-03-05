<?php
function culoare_card($val, $mesaj){
	if(!$val)
		return 'primary';
	else
		if(!empty($mesaj))
			return 'danger';
	
	return 'success';
}

function mesaj_card($trimis, $stare, $eroare, $default = "<i>Nu s-a setat valoarea default!</i>"){
	//Daca nu s-a trimis afisam mesajul defaul
	if(!$trimis)
		return '<h3 class="card-title">'. $default .'</h3>';
	else
		//Daca s-a trimis si a aparut eroare, o afisam
		if($stare)
			return '<strong>A apărut o eroare! </strong>'. $eroare .'';
		else
			return '<strong>Succes! </strong>Acțiunea a fost efectuată cu succes.';
}

function afisare_eroare($eroare){
	return '
		<div class="alert alert-danger">
			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			<strong>A apărut o eroare! </strong>'. $eroare .'
		</div>';
}

// function afisare_succes($succes){
	// return '
		// <div class="alert alert-danger">
			// <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			// <strong>A apărut o eroare! </strong>'. $succes .'
		// </div>';
// }
?>