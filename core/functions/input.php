<?php
function curatare($val){
	return filter_var($val, FILTER_SANITIZE_SPECIAL_CHARS);
}

function curatare_email($email){
	return filter_var($email, FILTER_SANITIZE_EMAIL);
}

function curatare_parola($con, $parola){
	return mysqli_real_escape_string($con, $parola);
}

function validare_url($url){
	return filter_var($url, FILTER_VALIDATE_URL) ? true : false;
}

function nr_tel($number){
	if(ctype_digit($number) && strlen($number) == 10) {
  	$number = substr($number, 0, 4) .' '. substr($number, 4, 3) .' '. substr($number, 7);
	} else {
		if(ctype_digit($number) && strlen($number) == 7) {
			$number = substr($number, 0, 3) .'-'. substr($number, 3, 4);
		}
	}
	return $number;

}
?>