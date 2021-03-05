<?php
include('../../core/database/connect.php');
//Preluam datele
$string = $_POST['actiune'];

//Separam tipul datelor (ex: "permitere_test")
$data     = explode("_", $string, 2);

//actiune = permitere
$actiune  = $data[0];

//actiune2 = test
$actiune2 = $data[1];

//stare = true/false => stare = 1/0
$stare = ($_POST['stare'] === "true") ? 1 : 0;

$sql = "UPDATE `setari` SET `articole` = JSON_SET(`articole`,'$.".$actiune."[0].".$string."', ".$stare.")";
mysqli_query($con, $sql);

echo $stare;
?>