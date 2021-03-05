<?php
if(isset($_POST['actiune'])){
	if($_POST['actiune'] == "actualizare"){
		mysqli_query($con,"UPDATE `filme` set 
				`inceput` = '".mysqli_real_escape_string($con,date('Y-m-d H:i:s',strtotime($_POST["start"])))."', 
				`sfarsit` = '".mysqli_real_escape_string($con,date('Y-m-d H:i:s',strtotime($_POST["end"])))."' 
				where id = '".mysqli_real_escape_string($con,$_POST["id"])."'");
				exit();
	} elseif($_POST['actiune'] == "adaugare") {
		mysqli_query($con,"INSERT INTO `filme` (
                    `titlu`,
					`regia`,
					`gen`,
					`descriere`,
					`url_trailer`,
					`url_imagine`,
					`pret`,
                    `inceput`,
                    `sfarsit` 
                    )
                    VALUES (
                    '".mysqli_real_escape_string($con,$_POST["title"])."',
                    '".mysqli_real_escape_string($con,$_POST["regia"])."',
                    '".mysqli_real_escape_string($con,$_POST["gen"])."',
                    '".mysqli_real_escape_string($con,$_POST["descriere"])."',
                    '".mysqli_real_escape_string($con,$_POST["url_trailer"])."',
                    '".mysqli_real_escape_string($con,$_POST["url_imagine"])."',
                    '".$_POST["pret"]."',
                    '".$_POST["start"]."',
                    '".$_POST["end"]."'
                    )");
					exit();
	} elseif($_POST['actiune'] == "sterge"){
		mysqli_query($con, "DELETE FROM `filme` WHERE `id` = ". $_POST['id'] ."");
		echo json_encode(1);
		exit();
	}
}
?>