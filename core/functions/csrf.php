<?php
function store_in_session($key,$value){
	if(isset($_SESSION))
		$_SESSION[$key] = $value;
}

function unset_session($key){
	$_SESSION[$key] = ' ';
	unset($_SESSION[$key]);
}

function get_from_session($key){
	if(isset($_SESSION[$key]))
		return $_SESSION[$key];
	else 
		return false;
}

function csrfguard_generate_token($unique_form_name){
	$token = bin2hex(random_bytes(10)); // PHP 7, sau cu paragonie/random_compat
	store_in_session($unique_form_name,$token);
	return $token;
}

function csrfguard_validate_token($unique_form_name,$token_value){
	$token  =  get_from_session($unique_form_name);
	if(!is_string($token_value)) 
		return false;
	
	$result  =  !empty($token) ? hash_equals($token, $token_value) : false;
	unset_session($unique_form_name);
	return $result;
}

function csrfguard_replace_forms($form_data_html){
	$count = preg_match_all("/<form(.*?)>(.*?)<\\/form>/is",$form_data_html,$matches,PREG_SET_ORDER);
	if(is_array($matches)){
		foreach($matches as $m){
			if(strpos($m[1],"nocsrf") !== false)
				continue;
			$name = "CSRFGuard_".mt_rand(0,mt_getrandmax());
			$token = csrfguard_generate_token($name);
			$form_data_html  =  str_replace($m[0],
				"<form{$m[1]}>
					<input type = 'hidden' name = 'CSRFName' value = '{$name}' />
					<input type = 'hidden' name = 'CSRFToken' value = '{$token}' />{$m[2]}</form>",$form_data_html);
		}
	}
	return $form_data_html;
}

function csrfguard_inject(){
	$data = ob_get_clean();
	$data = csrfguard_replace_forms($data);
	echo $data;
}

function csrfguard_start(){
	global $eroare;
	
	if(count($_POST)){
		$name  = isset($_POST['CSRFName']) ? $_POST['CSRFName'] : false;
		$token = isset($_POST['CSRFToken']) ? $_POST['CSRFToken'] : false;
		
		if(!isset($_POST['CSRFName']) || !isset($_POST['CSRFToken']) ){
			$eroare = "CSRFName nu a fost găsit, probabil cererea este invalidă.";
			
		} elseif(!csrfguard_validate_token($name, $token))
			$eroare ='Token-ul CSRF este invalid.';
			
		// if(!empty($eroare)){
			// echo ' <i><bq><a href="http://'. $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] .'">Refresh</a></i></b>';
			// array_splice($eroare, 1);
		// }
	}
	ob_start();
	/* adding double quotes for "csrfguard_inject" to prevent: 
          Notice: Use of undefined constant csrfguard_inject - assumed 'csrfguard_inject' */
	register_shutdown_function("csrfguard_inject");	
}
csrfguard_start();

?>