<?php
include('../../core/database/connect.php');
//Preluam datele
$com = $_POST['text'];
$id  = $_POST['id'];

$nr = mysqli_query($con, "SELECT * FROM `comentarii` WHERE `id_utilizator` = $id");
if($nr && mysqli_num_rows($nr)){
	mysqli_query($con, "UPDATE `comentarii` SET `text` = '". $com ."' WHERE `id_utilizator` = $id");
	echo 1;
}else
	echo 0;
?>