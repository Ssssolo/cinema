<!DOCTYPE html>
<html lang="en">
	<?php
	$titlu = 'Filme';
	include('includes/head.php');
	?>
	<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
		<?php include('includes/navbar.php'); ?>
		<!-- Page-name Section -->
		<section id="page-name">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 wp1 delay-05s">
						<h1>Articole</h1>
						<p>În această secțiune veți găsi articole cu conținut informativ despre filmele săptămânale redate de către noi. Pentru a vă putea rezerva locuri trebuie să vă creați un cont.</p>
					</div>
					<!-- /.col-lg-12 --> 
				</div>
				<!-- /.row --> 
			</div>
			<!-- /.container --> 
		</section>
		<!-- /#page-name --> 
		<!-- Blog Section -->
		<section id="blog">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 wp2 delay-05s">
						<?php
							$sql = mysqli_query($con, "SELECT * FROM `articole` ORDER BY `id` DESC");
							$nr = mysqli_num_rows($sql);
							
							
							$info = json_decode($date_website['articole'], true);
							if(!$info['afisare'][0]['afisare_articole'])
								echo '<div class="alert alert-danger" role="alert">
								<center>
									<i class="fa fa-exclamation-triangle fa-3" aria-hidden="true"></i> <b>Avertizare:</b> Această secțiune a fost dezactivată temporar de către un administrator.
								</center>
							</div>';
							else
								if(!numarare($con, 'articole', 'ORDER BY `id` DESC'))
									echo '<div class="alert alert-info" role="alert">
									<center>
										<i class="fa fa-info-circle fa-3" aria-hidden="true"></i> <b>Info:</b> Momentan nu există nicio postare, vă rugăm să reveniți mai târziu.
									</center>
								</div>';
							else{
								if (isset($_GET['id']) && $_GET['id']!="") {
								$page_no = $_GET['id'];
								} else {
									$page_no = 1;
									}
							
								$total_records_per_page = 3;
								$offset = ($page_no-1) * $total_records_per_page;
								$previous_page = $page_no - 1;
								$next_page = $page_no + 1;
								$adjacents = "2"; 
							
								$result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `articole`");
								$total_records = mysqli_fetch_array($result_count);
								$total_records = $total_records['total_records'];
								$total_no_of_pages = ceil($total_records / $total_records_per_page);
								$second_last = $total_no_of_pages - 1; // total page minus 1
							
								$result = mysqli_query($con,"SELECT * FROM `articole` ORDER BY `id` DESC LIMIT $offset, $total_records_per_page");
								while($rand = mysqli_fetch_array($result)){
							?>
						<div class="blog-item blog-item-full">
							<div class="blog-item-img"><a href="img/articole/<?php echo $rand['imagine']; ?>" class="popup"><img src="img/articole/<?php echo $rand['imagine']; ?>" alt="imagine" onerror="this.src='img/articole/default.jpg';"></a></div>
							<div class="blog-item-info page-scroll">
								<span><?php echo strftime("%d", strtotime($rand['data'])); ?></span>
								<small><?php echo strftime("%B", strtotime($rand['data'])); ?></small>
								<a href="blog#comments-area"><i class="fa fa-comments-o"></i><small><?php echo numarare($con, 'comentarii', 'WHERE `id_articol` = '. $rand['id'] .''); ?></small></a>
							</div>
							<!-- /.blog-item-info --> 
							<div class="blog-item-text">
								<h3><a href="articol/<?php echo $rand['id']; ?>"><?php echo $rand['titlu']; ?></a></h3>
								<p><?php echo strip_tags($rand['text']); ?></p>
							</div>
							<!-- /.blog-item-text --> 
						</div>
						<!-- blog-item -->
						<hr>
						<?php
							}
						}
						
						if(numarare($con, 'articole', 'ORDER BY `id` DESC')){
						?>
						<!-- Pagination -->    
						<div class="pagination">
							<ul>
								<?php // if($page_no > 1){ echo "<li><a href='blog/1'>First Page</a></li>"; } ?>
								<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
									<a <?php if($page_no > 1){ echo "href='blog/$previous_page'"; } ?>>Înapoi</a>
								</li>
								<?php 
									if ($total_no_of_pages <= 10){  	 
										for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
											if ($counter == $page_no) {
										   echo "<li class='active'><a>$counter</a></li>";	
												}else{
										   echo "<li><a href='blog/$counter'>$counter</a></li>";
												}
										}
									}
									elseif($total_no_of_pages > 10){
										
									if($page_no <= 4) {			
									 for ($counter = 1; $counter < 4; $counter++){		 
											if ($counter == $page_no) {
										   echo "<li class='active'><a>$counter</a></li>";	
												}else{
										   echo "<li><a href='blog/$counter'>$counter</a></li>";
												}
										}
										echo "<li><a>...</a></li>";
										echo "<li><a href='blog/$second_last'>$second_last</a></li>";
										echo "<li><a href='blog/$total_no_of_pages'>$total_no_of_pages</a></li>";
										}
									
									 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
										echo "<li><a href='blog/1'>1</a></li>";
										echo "<li><a href='blog/2'>2</a></li>";
										echo "<li><a>...</a></li>";
										for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
										   if ($counter == $page_no) {
										   echo "<li class='active'><a>$counter</a></li>";	
												}else{
										   echo "<li><a href='blog/$counter'>$counter</a></li>";
												}                  
									   }
									   echo "<li><a>...</a></li>";
									   echo "<li><a href='blog/$second_last'>$second_last</a></li>";
									   echo "<li><a href='blog/$total_no_of_pages'>$total_no_of_pages</a></li>";      
											}
										
										else {
										echo "<li><a href='blog/1'>1</a></li>";
										echo "<li><a href='blog/2'>2</a></li>";
										echo "<li><a>...</a></li>";
									
										for ($counter = $total_no_of_pages - 3; $counter <= $total_no_of_pages; $counter++) {
										  if ($counter == $page_no) {
										   echo "<li class='active'><a>$counter</a></li>";	
												}else{
										   echo "<li><a href='blog/$counter'>$counter</a></li>";
												}                   
												}
											}
									}
									?>
								<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
									<a <?php if($page_no < $total_no_of_pages) { echo "href='blog/$next_page'"; } ?>>Înainte</a>
								</li>
								<?php if($page_no < $total_no_of_pages){
									echo "<li><a href='blog/$total_no_of_pages'>Ultima &rsaquo;&rsaquo;</a></li>";
									} ?>
							</ul>
						</div>
						<?php } ?>
					</div>
					<!-- /.col-lg-8 --> 
					<?php include('includes/sidebar.php'); ?>
				</div>
				<!-- /.row -->     	    
			</div>
			<!-- /.container --> 
		</section>
		<!-- /#blog -->  
		<!-- Core JavaScript Files -->
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.easing.min.js"></script>
		<!-- JavaScript -->
		<script src="js/lib/jquery.appear.js"></script>
		<script src="js/lib/owl-carousel/owl.carousel.min.js"></script>
		<script src="js/lib/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="js/lib/video/jquery.mb.YTPlayer.js"></script> 		
		<script src="js/lib/flipclock/flipclock.js"></script>
		<script src="js/lib/jquery.animateNumber.js"></script>
		<script src="js/lib/waypoints.min.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="js/main.js"></script>
	</body>
	<?php include('includes/footer.php'); ?>
</html>