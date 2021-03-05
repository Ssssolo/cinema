<?php
//fetch_comment.php
include('core/database/connect.php');

$query = mysqli_query($con, "SELECT * FROM comentarii WHERE `parinte` IS NULL AND `id_articol` = ". $_POST['id'] ." ORDER BY id DESC");


$output = '';
foreach($query as $row)
{
	$sql2 = mysqli_query($con, "SELECT `nume`, `prenume` FROM `utilizatori` WHERE `id` = ". $row['id_utilizator'] ."");
	$nume = mysqli_fetch_assoc($sql2);
 $output .= '
	<li class="box" id="com'. $row['id'] .'">
		<div class="comment">
			<span class="comment-info">
				<a href="" id="nume">'. ucfirst($nume['prenume']).' '.$nume['nume'][0].'.</a>
				<span>'. strftime("%d %B %Y - %H:%M", strtotime($row['data'])) .'</span>
			</span>
			
			<div class="row">
				<div class="col-md-10">
					<p>'. $row['text'] .'</p>
				</div>
				<div class="col-md-2 raspunde">
					<button class="btn btn-default btn-xs reply" id="'.$row["id"].'">Răspunde</button>
				</div>
			</div>
		</div>
	
 ';
 $output .= get_reply_comment($con, $row["id"]);
}

echo $output;

function get_reply_comment($con, $parent_id = 0, $marginleft = 0)
{
	$query = mysqli_query($con, "SELECT * FROM comentarii WHERE `parinte` = '".$parent_id."'");
	$output = '';
	
 
 $count = mysqli_num_rows($query);

 if($count > 0)
 {
	$output .= '<ul class="children">';
  foreach($query as $row)
  {
	  $sql2 = mysqli_query($con, "SELECT `nume`, `prenume` FROM `utilizatori` WHERE `id` = ". $row['id_utilizator'] ."");
	$nume = mysqli_fetch_assoc($sql2);
   $output .= '
		<li>
			<div class="comment">
				<span class="comment-info">
					<a href="" id="nume">'. ucfirst($nume['prenume']).' '.$nume['nume'][0].'.</a>
                    <span>'. strftime("%d %B %Y - %H:%M", strtotime($row['data'])) .'</span>
				</span>
                <p>'. $row['text'] .'.</p>
			</div>
		</li>
	
   ';
   $output .= get_reply_comment($con, $row["id"], $marginleft);
  }
  $output .= '</ul>';
 }
 return $output.'</li>';
}

?>

<script>


$(function(){
	// let ul1_btns = document.querySelectorAll('#comentarii button');
				// for(var i=0; i<ul1_btns.length; i++){
				  // ul1_btns[i].addEventListener('click', (e)=>{
					// alert(e.target.parentNode);
					// var a_name = e.target.parentNode.querySelector('.nume').text();
				  // });
				// }
    // $(".box").hover(function(){
		// $(this).find(".raspunde").show();
    // },function(){
		// $(this).find(".raspunde").fadeOut();
    // });        
});
</script>