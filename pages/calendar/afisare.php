<?php
$data = array();

$query = "SELECT * FROM `filme` ORDER BY `id`";

$result = mysqli_query($con, $query);

$i=0;
foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["titlu"],
  'regia'   => $row["regia"],
  'gen'   => $row["gen"],
  'descriere'   => $row["descriere"],
  'start'   => $row["inceput"],
  'end'   => $row["sfarsit"]
 );
 if(empty($data[$i]['title']))
	 $data[$i]['title'] = '#Nedefinit';
 
 if(empty($data[$i]['regia']))
	 $data[$i]['regia'] = '#Nedefinit';
 
 if(empty($data[$i]['gen']))
	 $data[$i]['gen'] = '#Nedefinit';
 
 if(empty($data[$i]['descriere']))
	 $data[$i]['descriere'] = '#Nedefinit';

$i++;
}

echo json_encode($data);

?>
