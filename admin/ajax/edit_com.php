<?php
include('../../core/database/connect.php');
//Preluam datele
$com     = $_POST['text'];
$id_com  = $_POST['id1'];
$id_user = $_POST['id2'];

$nr = mysqli_query($con, "SELECT * FROM `comentarii` WHERE `id_utilizator` = $id_user");
if($nr && mysqli_num_rows($nr)){
	mysqli_query($con, "UPDATE `comentarii` SET `text` = '". $com ."' WHERE `id` = $id_com");
	echo 1;
}else
	echo 0;
?>