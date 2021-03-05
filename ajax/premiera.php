<?php
include('../../core/database/connect.php');

//Preluam filmul cu id-ul respectiv si verificam daca se afla in saptamana curenta
$sql = mysqli_query($con, "SELECT `premiera`, `inceput` FROM `filme` WHERE WEEKOFYEAR(inceput) = WEEKOFYEAR(NOW()) AND `id` = ". $_POST['id'] ."");
$rand = mysqli_fetch_assoc($sql);

//Daca nu este ok returnam eroare
if(!mysqli_num_rows($sql))
	die(json_encode('A intervenit o eroare'));

$info = array();
$info['id'] = $_POST['id'];
// print_r($info);
//Daca premiera este = 1 o setam cu 0
if($rand['premiera'] == 1){
	mysqli_query($con, "UPDATE `filme` SET `premiera` = 0 WHERE `id` = ". $_POST['id'] ."");
	$info['stare'] = 0;
} else {
	//Verificam daca exista mai multe premiere in aceeasi saptamana
	$sql = mysqli_query($con, "SELECT * FROM `filme` WHERE `premiera` = 1");
	if(mysqli_num_rows($sql) >= 1)
		die(json_encode('Nu poti seta mai multe filme in premiera in aceeasi saptamana!'));
	else {
		//Daca nu exista setam premiera
		mysqli_query($con, "UPDATE `filme` SET `premiera` = 1 WHERE `id` = ". $_POST['id'] ."");
		$info['stare'] = 1;
	}
}

echo json_encode($info);
?>