<?php
function afisare_eroare_bts($eroare){
	return '
		<div class="alert alert-danger">
			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			<strong>Eroare! </strong>'. $eroare .'
		</div>';
}

function afisare_succes($succes){
	return '
		<div class="alert alert-success">
			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			<strong>Succes! </strong>'. $succes .'
		</div>';
}
?>