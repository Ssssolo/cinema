<?php
function date_utilizator($con, $id){
	$data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `utilizatori` WHERE `id` = '$id'"));
	return $data;
}

function logat() {
	return (isset($_SESSION['id']) ? true : false);
}

function admin() {
	return (isset($_SESSION['admin']) ? true : false);
}

function esteLogat() {
	if(!logat())
		return header('Location: login');
}

function nuesteLogat() {
	if(logat())
		if(isset($_GET['id']) && !empty($_GET['id']))
			return header('Location: ../profil');
		else
			return header('Location: profil');
			
}

function confirmare_email($email, $prenume, $data, $cod) {
	$subiect = 'Verificare cont';
	$mesaj = 'Salut <i>'.$prenume.'</i>!\n Tocmai ți-ai creat un cont <b>('.$data.')</b> iar codul tau de activare este <b>'.$cod.'</b> ';
	$headers = 'From: noreply @ company . com';
	mail($email,$subiect,$mesaj,$headers);
}

// A function to return a unique identifier for the user's browser
function create_unique() {
    // Read the user agent, IP address, current time, and a random number:

    $data = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] .
            time() . rand();
    $secret_key = 'really secret sequence for this web-applications function only';//change t
    // Return this value HMAC with sha256
    return hash_hmac('sha256',$data,$secret_key);
}
?>