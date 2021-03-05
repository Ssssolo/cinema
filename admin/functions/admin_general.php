<?php
function breadcrumb($url){
	$crumbs = explode("/",$url);
	$nr = count($crumbs);
	
	foreach($crumbs as $i => $crumb){
		if($i>=1)
			if(isset($_GET['id']) && $_GET['id'] != ''){
				if($i < $nr-2)
					echo '<li class="breadcrumb-item"><a href="">'.ucfirst(str_replace(array(".php","_","-"),array(""," "),$crumb) . ' ').'</a></li>';
				 else {
					echo '<li class="breadcrumb-item active">'.ucfirst(str_replace(array(".php","_","-"),array(""," "," / "),$crumb) . ' ').'</li>';
					return 0;
				}
			} else
				if($i < $nr-1)
					echo '<li class="breadcrumb-item"><a href="">'.ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . ' ').'</a></li>';
				else
					echo '<li class="breadcrumb-item active">'.ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . ' ').'</li>';
	}
}

function admin_logat() {
	return (isset($_SESSION['id']) ? true : false);
}

function marime_fisier($path)
{
    $marime = filesize($path);
    $unitati = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $putere = $marime > 0 ? floor(log($marime, 1024)) : 0;
    return number_format($marime / pow(1024, $putere), 2, '.', ',') . ' ' . $unitati[$putere];
}
?>