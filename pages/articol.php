<!DOCTYPE html>
<html lang="en">
	<?php
		//Preluam datele despre articolul respectiv
		$sql = mysqli_query($con, "SELECT * FROM `articole` WHERE `id` = ". $_GET['id'] ."");
		$rand = mysqli_fetch_assoc($sql);
		
		//Verificam daca articolul exista in baza de date
		if(!mysqli_num_rows($sql))
			header('Location: ../filme');
		
		//Preluam informatii despre setarile de afisare setate de administrator
		$info = json_decode($date_website['articole'], true);
		
		//Facem update vizualizarilor
		mysqli_query($con, "UPDATE `articole` SET `vizualizari` = `vizualizari` + 1 WHERE `id` = ". $_GET['id'] ."");
		
		/*
		if(isset($_POST['submit'])){
			$text = curatare($_POST['comentariu']);
			
			if(empty($text) || strlen($text) < 10)
				$eroare = 'Comentariul trebuie să conțină măcar 10 caractere.';
			
			if(empty($eroare)){
				mysqli_query($con, "INSERT INTO `comentarii` (`id_articol`, `id_utilizator`, `text`, `parinte`, `data`, `ip`) VALUES (". $_GET['id'] .", ". $date_utilizator['id'] .", '". $text ."', 0, '". date('Y-m-d H:i:s')."', '". $_SERVER['REMOTE_ADDR'] ."')");
			}
		}*/
		
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
						<a href="filme" class="back-to-main"><i class="fa fa-chevron-left"></i> &nbsp; Vezi toate articolele</a>
						<div class="blog-item blog-item-full">
							<div class="blog-item-img"><a href="img/articole/<?php echo $rand['imagine']; ?>" class="popup" onerror="if (this.src != 'img/default.jpg') this.src = 'img/default.jpg';"><img src="img/articole/<?php echo $rand['imagine']; ?>" alt="" onerror="if (this.src != 'img/default.jpg') this.src = 'img/default.jpg';"></a></div>
							<div class="blog-item-info page-scroll">
								<span><?php echo strftime("%d", strtotime($rand['data'])); ?></span>
								<small><?php echo strftime("%B", strtotime($rand['data'])); ?></small>
								<a href="#comments-area"><i class="fa fa-comments-o"></i><small><?php echo numarare($con, 'comentarii', ''); ?></small></a>
							</div>
							<!-- /.blog-item-info --> 
							<div class="blog-item-text">
								<h3><?php echo !empty($rand['titlu']) ? $rand['titlu'] : 'Titlul nu a fost definit!'; ?></h3>
								<ul class="blog-informers">
									<?php if($info['afisare'][0]['afisare_data']){ ?>
									<li>Ora<i class="fa fa-clock-o"></i><?php echo date("H:i", strtotime($rand['data'])); ?></li>
									<?php
										}
										if($info['afisare'][0]['afisare_autor']){
										?>
									<li><i class="fa fa-user"></i><a href="#"><?php echo !empty($rand['autor']) ? $rand['autor'] : '#Nedefinit'; ?></a></li>
									<?php
										}
										if($info['afisare'][0]['afisare_vizualizari']){
										?>
									<li><i class="fa fa-eye"></i><?php echo $rand['vizualizari']; ?></li>
									<?php
										}
										if($info['afisare'][0]['afisare_aprecieri']){
										?>
									<li><i class="fa fa-heart"></i><?php echo $rand['aprecieri']; ?></li>
									<?php } ?>
								</ul>
							</div>
							<!-- /.blog-item-text --> 
						</div>
						<!-- blog-item -->
						<hr>
						<!-- Content -->
						<?php
							echo $rand['text'];
							
							if(!empty($rand['taguri'])){
							?>
						<div class="blog-extra">
							<span class="tags">Tag-uri: &nbsp;
							<a href="#">actors</a>,&nbsp;
							<a href="#">avengers</a>,&nbsp;
							<a href="#">avengers 2</a>,&nbsp;
							<a href="#">marvel</a>,&nbsp;
							<a href="#">s.h.i.e.l.d</a>
							</span>
						</div>
						<!--/.blog-extra-->
						<?php } ?>
						<!-- Comment Area -->
						<div class="comments-area wp3" id="comments-area">
							<h2 class="sub-title">Comentarii <span class="text-color">(<?php echo numarare($con, 'comentarii', 'WHERE `id_articol` = '. $_GET['id'] .''); ?>)</span></h2>
							<br>
							<ul class="commentlist" id="comentarii">
								<?php if(!numarare($con, 'comentarii', 'WHERE `id_articol` = '. $_GET['id'] .'')) { ?>
								<div class="alert alert-info" role="alert">
									<center>
										<i class="fa fa-info fa-3" aria-hidden="true"></i> <b>Info:</b> Momentan nu există niciun comentariu la această postare, fii tu primul care o face!
									</center>
								</div>
								<?php
									} else {
										$sql  = mysqli_query($con, "SELECT * FROM `comentarii` WHERE `id_articol` = ". $_GET['id'] ."");
										$rand = mysqli_fetch_assoc($sql);
										
										$sql2 = mysqli_query($con, "SELECT `nume`, `prenume` FROM `utilizatori` WHERE `id` = ". $rand['id_utilizator'] ."");
										$nume = mysqli_fetch_assoc($sql2);
										
										$sql3 = mysqli_query($con, "SELECT * FROM `comentarii` WHERE `id_articol` = ". $_GET['id'] ."");
									if(!$info['afisare'][0]['afisare_comentarii'])
										echo '<div class="alert alert-danger" role="alert">
											<center>
												<i class="fa fa-exclamation-triangle fa-3" aria-hidden="true"></i> <b>Avertizare:</b> Secțiunea de comentarii a fost dezactivată temporar de către un administrator.
											</center>
										</div>';
									
									else{
								?>
									<div id="display_comment"></div>
								<?php
									}
								}
								?>
							</ul>
							<!--/.commentlist-->
							<!-- Comment Form -->
							<div class="comment-form wp4 delay-05s" id="comm">
								<h2 class="sub-title" id="titlu">Postează un comentariu</h2>
								<?php
									if(!$info['permitere'][0]['permitere_comentarii'])
										echo '<div class="alert alert-danger" role="alert">
											<center>
												<i class="fa fa-exclamation-triangle fa-3" aria-hidden="true"></i> <b>Avertizare:</b> Această secțiune a fost dezactivată temporar de către un administrator.
											</center>
										</div>';
									
									else
										if(!logat())
											echo '<div class="alert alert-warning" role="alert">
												<center>
													<i class="fa fa-shield fa-3" aria-hidden="true"></i> <b>Protecție:</b> Pentru a putea adăuga comentarii trebuie să fiți autentificat.
												</center>
											</div>';
										else{
											if(isset($_POST['submit']))
												if(!empty($eroare))
													echo '<div class="alert alert-danger" role="alert">
														<center>
															<i class="fa fa-exclamation-triangle fa-3" aria-hidden="true"></i> <b>Eroare:</b> '. $eroare .'
														</center>
													</div>';
												else
													echo '<div class="alert alert-success" role="alert">
														<center>
															<i class="fa fa-exclamation-triangle fa-3" aria-hidden="true"></i> <b>Succes:</b> Comentariul dumneavoastră a fost postat cu succes!
														</center>
													</div>'; 
									?>
								<span id="comment_message"></span>
								<form class="comment-form-wrapper" id="form" method="POST">
									<div class="row">
										<!--
											<div class="col-md-12 no-padding">
												<div class="col-lg-6">
													<input type="text" placeholder="Your name" Required>
												</div>
												<div class="col-lg-6">
													<input type="email" placeholder="Your mail" Required>
												</div>
											</div>
											-->
										<div class="col-md-12">
											<input type="hidden" name="id_comentariu" id="id_comentariu" value="0" />
											<textarea id="comentariu" placeholder="Introduceți un comentariu" rows="5" Required></textarea>
											<div class="col-md-3 col-xs-offset-3"><button value="clear"  class="clear-comment-form" onclick="javascript:eraseText();">Șterge<i class="fa fa-times"></i></button></div>
											<div class="col-md-3"><button type="submit" name="submit">Postează<i class="fa fa-chevron-right"></i></button></div>
										</div>
									</div>
								</form>
								<?php } ?>
							</div>
							<!--/.comment-form-->
						</div>
						<!--/.comments-area-->
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

		<script>
		$(document).ready(function() {
			$('#form').on('submit', function(event) {
				event.preventDefault();
				var com = $('#comentariu').val();
				var icom = $('#id_comentariu').val();

				$.ajax({
					url: "articol-adaugare-comentariu",
					method: "POST",
					data: {
						id_articol: <?php echo $_GET['id']; ?> ,
						id_utilizator : <?php echo $date_utilizator['id']; ?>,
						id_comentariu : icom,
						comentariu: com
					},
					dataType: "JSON",
					success: function(data) {
						if (data.error != '') {
							$('#form')[0].reset();
							$('#comment_message').html(data.error);
							$('#id_comentariu').val('0');
							alert("com"+icom);
							
							load_comment();

							setTimeout(function() {
								$('#eroare').fadeOut('fast');
							}, 4000);
						}
					}
				})
			});

			load_comment();

			function load_comment() {
				$.ajax({
					url: "articol-afisare-comentariu",
					method: "POST",
					data: {
						id: <?php echo $_GET['id']; ?>
					},
					success: function(data) {
						$('#display_comment').html(data);
					}
				})

			}

			$(document).on('click', '.reply', function() {
				var id_comentariu = $(this).attr("id");
				$('#id_comentariu').val(id_comentariu);
				$('#comentariu').focus();
				// alert($('.nume').text());
				$('#titlu').text('Răspunde-i lui ');
				$('textarea').attr("placeholder", "Răspunde-i lui");
			});

		});
		</script>
	</body>
	<?php include('includes/footer.php'); ?>
</html>