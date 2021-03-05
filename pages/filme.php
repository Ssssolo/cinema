<!DOCTYPE html>
<html lang="en">
	<?php include('includes/head.php'); ?>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
	<link rel='stylesheet' href='css/filme.css'>
	<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
		<?php include('includes/navbar.php'); ?>
		<!-- Page-name Section -->
		<section id="page-name">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 wp1 delay-05s">
						<h1>Filme săptămânale</h1>
						<p>Vezi ce filme vor rula în această săptămână la cinema și hotărăște-te care este filmul tău favorit pentru a-l viziona.</p>
					</div>
					<!-- /.col-lg-12 --> 
				</div>
				<!-- /.row --> 
			</div>
			<!-- /.container --> 
		</section>
		<!-- /#page-name --> 
		<!-- Page Section -->
		<section id="blog">
			<div class="container">
				<!-- /.row -->     
				<div class="board">
					<div class="board-inner">
						<ul class="nav nav-tabs" id="myTab">
							<div class="liner"></div>
							<li <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 1 ? 'class="active"' : ''; ?>>
								<a href="" data-toggle="tab">
									<span data-nr_zi="1" class="round-tabs <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 1 ? 'actual' : 'normal'; ?>">Lun.</span>
								</a>
							</li>
							<li <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 2 ? 'class="active"' : ''; ?>>
								<a href="" data-toggle="tab" title="Marți">
									<span data-nr_zi="2" class="round-tabs <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 2 ? 'actual' : 'normal'; ?>">Mar.</span>
								</a>
							</li>
							<li <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 3 ? 'class="active"' : ''; ?>>
								<a href="" data-toggle="tab" title="Miercuri">
									<span data-nr_zi="3" class="round-tabs <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 3 ? 'actual' : 'normal'; ?>">Mie.</span>
								</a>
							</li>
							<li <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 4 ? 'class="active"' : ''; ?>>
								<a href="" data-toggle="tab" title="Joi">
									<span data-nr_zi="4" class="round-tabs <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 4 ? 'actual' : 'normal'; ?>">Joi</span>
								</a>
							</li>
							<li <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 5 ? 'class="active"' : ''; ?>>
								<a href="" data-toggle="tab" title="Vineri">
									<span data-nr_zi="5" class="round-tabs <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 5 ? 'actual' : 'normal'; ?>">Vin.</span>
								</a>
							</li>
							<li <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 6 ? 'class="active"' : ''; ?>>
								<a href="" data-toggle="tab" title="Sâmbătă">
									<span data-nr_zi="6" class="round-tabs <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 6 ? 'actual' : 'normal'; ?>">Sâm.</span>
								</a>
							</li>
							<li <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 7 ? 'class="active"' : ''; ?>>
								<a href="" data-toggle="tab" title="Duminică">
									<span data-nr_zi="7" class="round-tabs <?php echo strftime("%u", strtotime(date('Y-m-d H:i:s'))) == 7 ? 'actual' : 'normal'; ?>">Dum.</span>
								</a>
							</li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="row body-card">
							<?php
							$zi = strftime("%u", strtotime(date('Y-m-d H:i:s')));

							$sql = mysqli_query($con, "SELECT * FROM `filme` WHERE WEEKDAY(`inceput`)+1 = $zi AND YEARWEEK(`inceput`, 1) = YEARWEEK(CURDATE(), 1) ORDER BY `inceput` ASC");

							if(!mysqli_num_rows($sql)){
							?>
							<br>
							<center>
								<div class="alert alert-info">
									<i class="fa fa-info-circle"></i> <strong>Info:</strong> În această zi momentan nu s-a găsit niciun film! Vă rugăm să reveniți mai târziu.
								</div>
							</center>
							<?php
							} else
								while($rand = mysqli_fetch_assoc($sql)){
							?>
							<!--movie-card-->
							<div class="movie-card">
								<div class="movie-header manOfSteel">
									<div class="play-container">
										<a href="rezervare-bilet/<?php echo $rand['id']; ?>">
										<i class="material-icons play"></i>
										</a>
									</div>
								</div>
								<!--movie-header-->
								<div class="movie-content">
									<div class="movie-content-header">
										<a href="rezervare-bilet/<?php echo $rand['id']; ?>">
											<h3 class="movie-title"><?php echo $rand['titlu']; ?></h3>
										</a>
										<a href="rezervare-bilet/<?php echo $rand['id']; ?>">
										<button class="btn btn-primary btn-sm imax-logo">Rezervă</button>
										</a>
									</div>
									<div class="movie-info">
										<div class="info-section">
											<label>Data & Ora</label>
											<span>24 feb. ora 10:00</span>
										</div>
										<!-- date, time -->
										<div class="info-section">
											<label>Durată</label>
											<span>260 min.</span>
										</div>
										<!--screen-->
										<div class="info-section">
											<label>Liber</label>
											<span>56 locuri</span>
										</div>
										<!--row-->
										<div class="info-section">
											<label>Preț</label>
											<span>25 LEI</span>
										</div>
										<!--seat-->
									</div>
								</div>
								<!--movie-content-->
							</div>
							<?php } ?>
						</div>
					</div>
				</div>			
			</div>
			<!-- /.container --> 
		</section>
		<!-- /#blog --> 
		<!-- Core JavaScript Files -->
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<!-- Custom Theme JavaScript -->
		<script>
		$('.round-tabs').click(function(){
			var zi_select = $(this).data("nr_zi");

			$.ajax
			({
				url: 'ajax/afis_filme.php',
				data: {
					zi: zi_select
				},
				type: 'POST',
				success: function(data)
				{
					$('.body-card').html(data);
				}
			});
		});
		
		$(function(){
			$('a[title]').tooltip();
		});
		</script>
	</body>
	<?php include('includes/footer.php'); ?>
</html>