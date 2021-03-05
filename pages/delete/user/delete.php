<?php
//Verificam ca id-ul trimis sa fie diferit fata de id-ul adminului logat
if($_GET['id'] != $date_utilizator['id']){
	//Verificam daca id-ul este numeric si daca utilizatorul exista in baza de date
	if(!is_numeric($_GET['id']) || !mysqli_num_rows($sql))
		header('Location: eroare');

	mysqli_query($con, "DELETE FROM `utilizatori` WHERE `id` = ". $_GET['id'] ."");
}

header("Location: ../utilizatori-stergere-succes");
?>