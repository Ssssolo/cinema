<?php
function criptare($action, $string) {
	/* 
	$plain_txt = "**";
	echo "Plain Text =" .$plain_txt. "<br>";
	
	$encrypted_txt = encrypt_decrypt('encrypt', $plain_txt);
	echo "Encrypted Text = " .$encrypted_txt. "<br>";
	
	$decrypted_txt = encrypt_decrypt('decrypt', $encrypted_txt);
	echo "Decrypted Text =" .$decrypted_txt. "<br>";
	
	if($plain_txt === $decrypted_txt) 
		echo "SUCCESS";
	else 
		echo "FAILED";
	
	echo "<br>";
	*/
	
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'owmda';
    $secret_iv = 'solo2001';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function date_website($con){
	$data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `setari`"));
	return $data;
}
	
function numarare($con, $tabel, $conditie){
	$sql = mysqli_query($con, "SELECT * FROM `$tabel` $conditie");
	return mysqli_num_rows($sql);
}
	
function trimite_mail($destinatar, $subiect, $mesaj)
{
	ini_set("include_path", '/home/cinemame/php:' . ini_get("include_path") );
	require_once "Mail.php";
	$from = "Cinema Melodia <no-reply@cinema-melodia.ro>";
	$to = "Nume <$destinatar>";
	$subject = "$subiect";
	$body = "$mesaj";               
	 
	$host = "gaia.hosterion.net";
	$username = "no-reply@cinema-melodia.ro";
	$password = "7}=q.D6Ng0ik";  
	                        
	 
	$headers = array ('From' => $from,
	              'To' => $to,
	              'Subject' => $subject,
				  'Content-Type' => 'text/html; charset="UTF-8"'
				  );
	$smtp = Mail::factory('smtp',
	              array ('host' => $host,
	             'auth' => true,
	             'username' => $username,
	             'password' => $password));
	 
	$mail = $smtp->send($to, $headers, $body);
	 
	
	if (PEAR::isError($mail)) {
		echo("<p>" . $mail->getMessage() . "</p>");
	}
	
}

function cod_eroare(){
	return rand(1,9) . chr(rand(65,90)) . rand(1,974) .chr(rand(65,90)) . rand(22,51);
}
?>