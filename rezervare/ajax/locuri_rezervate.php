<?php
include('../../core/database/connect.php');
$sql = mysqli_query($con, "SELECT * FROM `rezervari` WHERE `id_film` = ". $_GET['id'] ."");
if(!mysqli_num_rows($sql))
	echo 0;
else {
	$locuri = array();
	while($rand = mysqli_fetch_assoc($sql))
		$locuri[] = $rand['locuri'];

	$locuri_rez = implode(',', $locuri);
	
	header ("content-type: application/json; charset=utf-8");
	echo json_encode($locuri_rez);
}
?>

