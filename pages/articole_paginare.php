<?php
$record_per_page = 6;
$page            = '';
$output          = '';
if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $record_per_page;
$query      = "SELECT * FROM `articole` ORDER BY `id` DESC LIMIT $start_from, $record_per_page";
$sql     = mysqli_query($con, $query);
$output .= '<div class="row d-flex align-items-stretch">';

if(!mysqli_num_rows($sql))
	$output .= 'Nu există niciun articol!';
else
	while($rand = mysqli_fetch_assoc($sql)){
		$output .= '
		<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
			<div class="card bg-light">
				<div class="card-header text-muted border-bottom-0">
					Postat la data de ';
		$output .= ($rand['data'] == "0000-00-00 00:00:00") ? '<b>#Nedefinit</b>' : '<b>'. date("d-m-Y", strtotime($rand['data'])).'</b> ora <b>'. date("H:i", strtotime($rand['data'])) .'</b>';
		$output .= '
				</div>
				<div class="card-body pt-0">
					<div class="row">
						<div class="col-12">
							<h2 class="lead"><b>';
		$output .= !empty($rand['titlu']) ? strip_tags($rand['titlu']) : "# Nedefinit";
		$output .= '</b></h2>
							<p class="text-muted text-sm">';
		$output .= !empty($rand['text']) ? strip_tags($rand['text']) : "# Nedefinit";
		$output .='
							</p>
							<ul class="ml-4 mb-0 fa-ul text-muted">
								<li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span>';
		$output .= !empty($rand['autor']) ? $rand['autor'] : "# Nedefinit";
		$output .= '
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="text-right">
						<a href="articole-editare/'. $rand['id'] .'" class="btn btn-sm bg-teal">
							<i class="fas fa-comments"></i> Editare
						</a>
						<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#sterge" onclick="modificare(\''. $rand['titlu'] .'\', '. $rand['id'] .');">
							<i class="fas fa-user"></i> Șterge
						</button>
					</div>
				</div>
			</div>
		</div>';
}
$page_query    = "SELECT * FROM `articole` ORDER BY `id` DESC";
$page_result   = mysqli_query($con, $page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages   = ceil($total_records / $record_per_page);
$output .= '
	</div>
	<div class="card-footer">
		<nav aria-label="Contacts Page Navigation">
			<ul class="pagination justify-content-center m-0">
		';
for ($i = 1; $i <= $total_pages; $i++) {
    $output .= '
				<li class="page-item ';
	$output .= ($i == $page) ? "active" : "";
	$output .= '">
					<button class="page-link pagination-link" href="#" id="'. $i .'">'. $i .'</button>
				</li>
	';
}
echo $output;
?> 