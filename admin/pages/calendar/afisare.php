<?php
$data = array();
$query = "SELECT * FROM `filme` ORDER BY `id`";
$result = mysqli_query($con, $query);

$i=0;
//Selectam valorile din baza de date
foreach($result as $row) {
	$data[] = array(
		'id'        => $row["id"],
		'title'     => $row["titlu"],
		'regia'     => $row["regia"],
		'gen'       => $row["gen"],
		'descriere' => $row["descriere"],
		'trailer'   => $row["url_trailer"],
		'imagine'   => $row["url_imagine"],
		'pret'      => $row["pret"],
		'start'     => $row["inceput"],
		'end'       => $row["sfarsit"]
	);
	
	//Daca valorile sunt goale, le facem "nedefinite"
	if(empty($data[$i]['title']))
		$data[$i]['title'] = '#Nedefinit';
	 
	if(empty($data[$i]['regia']))
		$data[$i]['regia'] = '#Nedefinit';
	 
	if(empty($data[$i]['gen']))
		$data[$i]['gen'] = '#Nedefinit';
	 
	if(empty($data[$i]['descriere']))
		$data[$i]['descriere'] = '#Nedefinit';
	 
	if(empty($data[$i]['trailer']))
		$data[$i]['trailer'] = '#Nedefinit';
	 
	if(empty($data[$i]['imagine']))
		$data[$i]['imagine'] = '#Nedefinit';
	 
	if(empty($data[$i]['pret']))
		$data[$i]['pret'] = '#Nedefinit';

	$i++;
}

//Afisam datele in format json
echo json_encode($data);

?>
