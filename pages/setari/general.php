<!DOCTYPE html>
<html>
	<?php
	$titlu = "Setări generale";
	$setari = 1;
	include('includes/head.php');
	
	//Preluam informatiile despre utilizator din baza de date
	$sql = mysqli_query($con, "SELECT * FROM `setari`");
	$rand = mysqli_fetch_assoc($sql);

	//Daca s-a trimis formularul
	if(isset($_POST['submit1'])){
		$pagina_fb  = $_POST['pagina_fb'];
		$adresa     = curatare($_POST['adresa']);
		$telefon    = $_POST['telefon'];
		$email      = curatare($_POST['email']);
		
		if(empty($adresa) || empty($telefon) || empty($email))
			$eroare = "Toate câmpurile (fără facebook) trebuie să fie completate.";
		else
			if(!is_numeric($telefon))
				$eroare = "Numărul de telefon trebuie să conțină doar cifre.";
		else
			if(!preg_match('/^\(?07\d{2}\)?[-\s]?\d{3}[-\s]?\d{3}$/', $telefon))
				$eroare = "Numărul de telefon nu este valid.";
		else
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				$eroare = "Adresa de email este invalidă.";
		
		if(empty($eroare))
			mysqli_query($con, "UPDATE `setari` SET `pagina_fb` = '$pagina_fb', `adresa` = '$adresa', `telefon` = '$telefon', `email` = '$email'");
	}
	
	//Daca s-a trimis formularul
	if(isset($_POST['submit2'])){
		$titlu      = curatare($_POST['titlu']);
		$descriere  = curatare($_POST['descriere']);
		$cuvCheie   = curatare($_POST['cuvCheie']);
		
		if(empty($titlu) || empty($descriere) || empty($cuvCheie))
			$eroare = "Toate câmpurile trebuie să fie completate.";
		
		if(empty($erori))
			mysqli_query($con, "UPDATE `setari` SET `titlu` = '$titlu', `descriere` = '$descriere', `cuvinte_cheie` = '$cuvCheie'");
	}
	
	//Daca s-a trimis formularul
	if(isset($_POST['submit3'])){
		$cuvObscene = curatare($_POST['cuvObscene']);
		$mentenanta = isset($_POST['mentenanta']) ? 1 : 0;
		
		if(empty($cuvObscene))
			$eroare = "Câmpul trebuie să fie completat.";
		
		if(empty($eroare))
			mysqli_query($con, "UPDATE `setari` SET `cuvinte_obscene` = '$cuvObscene', `mentenanta` = '$mentenanta'");
	}
	
	?>
	<style>
	.fa-plus18 {
		font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		text-align: center;
		font-size: 80%;
		font-weight: bold;
	}

	.fa-plus18:before {
		content: "18+";
	}
	</style>
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			<?php
			include('includes/navbar.php');
			include('includes/sidebar.php');
			?>
			
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<?php include('includes/content-header.php'); ?>

				<!-- Main content -->
                <section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<div class="card card-<?php echo culoare_card(isset($_POST['submit1']) ? 1 : 0, $eroare); ?>">
									<div class="card-header">
										<?php echo mesaj_card(isset($_POST['submit1']) ? 1 : 0, empty($eroare) ? 0 : 1, $eroare, 'Informații contact'); ?>
									</div>
									<div class="card-body">
										<form action="" method="POST">
											<!-- Pagina facebook-->
											<div class="form-group">
												<label>Pagină facebook</label>
													<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
													</div>
													<input type="text" name="pagina_fb" class="form-control" value="<?php echo isset($_POST['submit1']) ? $_POST['pagina_fb'] : (!empty($rand['pagina_fb']) ? $rand['pagina_fb'] : ''); ?>" placeholder="Introduceți pagina de facebook">
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
											
											<!-- Adresa cinema-->
											<div class="form-group">
												<label>Adresă cinema</label>
													<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
													</div>
													<input type="text" name="adresa" required class="form-control" value="<?php echo isset($_POST['submit1']) ? $_POST['adresa'] : (!empty($rand['adresa']) ? $rand['adresa'] : ''); ?>" placeholder="Introduceți adresa">
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
											
											<!-- Numarul de telefon-->
											<div class="form-group">
												<label>Telefon:</label>
													<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fas fa-phone"></i></span>
													</div>
													<input type="number" name="telefon" required class="form-control" data-inputmask="'mask': ['9999-999-999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask value="<?php echo isset($_POST['submit1']) ? $_POST['telefon'] : (!empty($rand['telefon']) ? $rand['telefon'] : ''); ?>" placeholder='Introduceți numărul de telefon'>
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
											
											<!-- Email-ul utilizatorului -->
											<div class="form-group">
												<label>Email:</label>
													<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fas fa-envelope"></i></span>
													</div>
													<input type="email" name="email" required class="form-control" value="<?php echo isset($_POST['submit1']) ? $_POST['email'] : (!empty($rand['email']) ? $rand['email'] : ''); ?>" placeholder="Introduceți adresa de email">
												</div>
												<!-- /.input group -->
											</div>
											<button type="submit" name="submit1" class="btn btn-success">Salvează</button>
										</form>
									</div>
                                    <!-- /.card-body -->
								</div>
								<!-- /.card -->
							</div>
                           <!-- /.col (left) -->
						   
							<div class="col-md-6">
								<div class="card card-<?php echo culoare_card(isset($_POST['submit2']) ? 1 : 0, $eroare); ?>">
									<div class="card-header">
										<?php echo mesaj_card(isset($_POST['submit2']) ? 1 : 0, empty($eroare) ? 0 : 1, $eroare, 'Opțiuni SEO'); ?>
									</div>
									<div class="card-body">
										<form action="" method="POST">
											<!-- Titlu website -->
											<div class="form-group">
												<label>Titlu website</label>

												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fas fa-edit"></i></span>
													</div>
													<input type="text" name="titlu" required class="form-control" value="<?php echo isset($_POST['submit2']) ? $_POST['titlu'] : (!empty($rand['titlu']) ? $rand['titlu'] : ''); ?>" placeholder="Introduceți titlul website-ului">
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
											
											<!-- Descriere website -->
											<div class="form-group">
												<label>Descriere website (meta)</label>

												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fas fa-edit"></i></span>
													</div>
													<input type="text" name="descriere" required class="form-control" value="<?php echo isset($_POST['submit2']) ? $_POST['descriere'] : (!empty($rand['descriere']) ? $rand['descriere'] : ''); ?>" placeholder="Introduceți descrierea website-ului">
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
											
											<!-- Cuvinte cheie -->
											<div class="form-group">
												<label>Cuvinte cheie (meta keywords)</label>

												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fas fa-key"></i></span>
													</div>
													<input type="text" name="cuvCheie" required class="form-control" value="<?php echo isset($_POST['submit2']) ? $_POST['cuvCheie'] : (!empty($rand['cuvinte_cheie']) ? $rand['cuvinte_cheie'] : ''); ?>" placeholder="Introduceți cuvinte cheie">
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
											
											<button type="submit" name="submit2" class="btn btn-success">Salvează</button>
										</form>
									</div>
								<!-- /.card-body -->
								</div>
							<!-- /.card -->
							</div>
							<!-- /.col (left) -->
							
					</div>
					<!-- /.row -->
						
					<!-- row -->
					<div class="row">
						<!-- /.col (left) -->
							<div class="col-md-6">
								<div class="card card-<?php echo culoare_card(isset($_POST['submit3']) ? 1 : 0, $eroare); ?>">
									<div class="card-header">
										<?php echo mesaj_card(isset($_POST['submit3']) ? 1 : 0, empty($eroare) ? 0 : 1, $eroare, 'Alte opțiuni'); ?>
									</div>
									<div class="card-body">
										<form action="" method="POST">
											<!-- Cuvinte obscene -->
											<div class="form-group">
												<label>Cuvinte obscene</label>
													<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fa fa-circle fa-plus18"></i></span>
													</div>
													<textarea type="text" name="cuvObscene" required class="form-control" placeholder="Introduceți cuvinte obscene"><?php echo isset($_POST['submit3']) ? $_POST['cuvObscene'] : (!empty($rand['cuvinte_obscene']) ? $rand['cuvinte_obscene'] : ''); ?></textarea>
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
											
											<!-- Mentenata-->
											<div class="form-group">
												<label>Mentenanță</label>
													<div class="input-group">
													<input type="checkbox" name="mentenanta" <?php echo isset($_POST['submit3']) ? (isset($_POST['mentenanta']) ? 'checked' : '') : ($rand['mentenanta'] == 1 ? 'checked' : ''); ?> data-bootstrap-switch data-on-color="danger">
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
											
											<button type="submit" name="submit3" class="btn btn-success">Salvează</button>
										</form>
									</div>
                                    <!-- /.card-body -->
								</div>
                               <!-- /.card -->
							</div>
                           <!-- /.col (left) -->
						</div>
						<!-- /.row -->
					</div>
                   <!-- /.container-fluid -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
		</div>
		<!-- ./wrapper -->
		<?php
		$script = '<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>';
		include('includes/footer.php');
		include('includes/scripts.php');
		?>
		<script>
		  $(function () {
			$("input[data-bootstrap-switch]").each(function(){
			  $(this).bootstrapSwitch('state', $(this).prop('checked'));
			});
		  })
		</script>
	</body>

</html>