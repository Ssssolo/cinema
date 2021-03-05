<?php
//Verificam daca id-ul este numeric si daca comentariul exista in baza de date
if(!is_numeric($_GET['id']) || !mysqli_num_rows($sql))
	header('Location: eroare');

mysqli_query($con, "DELETE FROM `comentarii` WHERE `id` = ". $_GET['id'] ."");

header("Location: ../comentarii-stergere-succes");
?>