<?php
include('../../core/init.php');

if(!logat())
	echo 0;
else
	//Verificam daca utilizatorul a mai facut o rezervare la filmul respectiv
	$sql = mysqli_query($con, "SELECT * FROM `rezervari` WHERE `id_film` = ". $_POST['id'] ." AND `id_user` = ". base64_decode($_POST['uid']) ."") or die(mysqli_error($con));

	//Daca a mai facut o rezervare facem update rezervarii curente
	if(mysqli_num_rows($sql)){
		//Preluam locurile selectate de utilizator
		$sql2 = mysqli_query($con, "SELECT `locuri` FROM `rezervari` WHERE `id_film` = ". $_POST['id'] ." AND `id_user` = ". base64_decode($_POST['uid']) ."") or die(mysqli_error($con));
		$info_rez = mysqli_fetch_assoc($sql2);
		
		//Transformam string-ul din baza de date in array
		$locuri_db  = explode(',', $info_rez['locuri']);
		
		//Unim cele 2 array-uri (din db si site) iar valorile duplicate le eliminam dupa care transformam in string
		$locuri_final = implode(",", array_unique(array_merge($locuri_db, $_POST['locuri'])));

		//Actualizam baza de date
		mysqli_query($con, "UPDATE `rezervari` SET `locuri` = '$locuri_final', `pret` = ". $_POST['pret'] ." WHERE `id_film` = ". $_POST['id'] ." AND `id_user` = ". base64_decode($_POST['uid']) ."");
		echo 1;
	} else { //Altfel introducem rezervarea in baza de date
		mysqli_query($con, "INSERT INTO `rezervari` (`id_film`, `id_user`, `locuri`, `pret`, `data_rezervare`) VALUES (". $_POST['id'] .", ". base64_decode($_POST['uid']) .", '". implode(",", $_POST['locuri']) ."', '". $_POST['pret'] ."', '". date("Y-m-d H:i:s") ."')");
		
		//Preluam titlul filmului
		$sql3 = mysqli_query($con, "SELECT `titlu` FROM `filme` WHERE `id` = ". $_POST['id'] ."");
		$info_film = mysqli_fetch_assoc($sql3);
		
		//Preluam filmele rezervate de utilizator pana acum
		$sql4 = mysqli_query($con, "SELECT `ultimele_filmeRez` FROM `utilizatori` WHERE `id` = ". $date_utilizator['id'] ."");
		$info_user = mysqli_fetch_assoc($sql4);
		
		//Decodam si introducem filmul rezervat in fata celorlalte
		$filmeRez = json_decode($info_user['ultimele_filmeRez'], true);
		array_unshift($filmeRez, $info_film['titlu']);
		
		$filmeRez = array_unique($filmeRez);
		mysqli_query($con, "UPDATE `utilizatori` SET `nrRezervari` = `nrRezervari` + 1, `ultimele_filmeRez` = '". json_encode($filmeRez) ."'  WHERE `id` = ". $date_utilizator['id'] ."");
		echo 2;
	}
?>