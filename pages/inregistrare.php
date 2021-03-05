<?php
nuesteLogat();

if(isset($_POST['submit'])){
	$nume     = curatare(mb_strtolower($_POST['nume']));
	$prenume  = curatare(mb_strtolower($_POST['prenume']));
	$email    = curatare_email(strtolower($_POST['email']));
	$telefon  = curatare($_POST['telefon']);
	$parola   = curatare_parola($con, $_POST['parola']);
	$parola2  = curatare_parola($con, $_POST['parola2']);
	$activare = create_unique();
	
	$sql = mysqli_query($con, "SELECT * FROM `utilizatori` WHERE `email` = '$email' OR `telefon` = '$telefon'");
	$exista = mysqli_num_rows($sql);

	if(empty($nume) || empty($prenume) || empty($email) || empty($telefon) || empty($parola) || empty($parola2))
		$eroare = 'Vă rugăm să completați toate câmpurile!';
	
	if(strlen($nume) > 20)
		$eroare = 'Numele introdus este prea lung.';
	
	if(strlen($prenume) > 20)
		$eroare = 'Prenumele introdus este prea lung.';
	
	if($exista)
		$eroare = 'Există deja un cont cu acest email sau număr de telefon.';
	
	if(!is_numeric($telefon) || !preg_match('/^(\+4|)?(07[0-8]{1}[0-9]{1}|02[0-9]{2}|03[0-9]{2}){1}?(\s|\.|\-)?([0-9]{3}(\s|\.|\-|)){2}$/', $telefon))
		$eroare = 'Numărul de telefon este invalid.';
	
	if(strlen($parola) < 6)
		$eroare = 'Parola introdusă trebuie să aibă minim 6 caractere.';
	
	if($parola != $parola2)
		$eroare = 'Parolele introduse nu corespund.';
	
	if(empty($eroare)){
		mysqli_query($con, "INSERT INTO `utilizatori` (`nume`, `prenume`, `telefon`, `email`, `parola`, `data_inregistrare`, `regIP`, `user_agent_initial`, `cod_activare`) VALUES ('$nume', '$prenume', '$telefon', '$email', '$parola', '". date("Y-m-d H:i:s")."', '". $_SERVER['REMOTE_ADDR'] ."', '". $_SERVER['HTTP_USER_AGENT'] ."', '". $activare ."')");
		trimite_mail("".$email."", "🎉 Informații cont nou", "Salut $prenume,<br><br> Detaliile contului tau sunt:<br> Email: <b>$email</b><br> Parola: <b>$parola</b><br><br> Activeaza contul<br><a href='https://www.". $_SERVER['HTTP_HOST'] ."/login/". $activare ."'>https://www.". $_SERVER['HTTP_HOST'] ."/login/". $activare ."</a>");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<?php
	$titlu = 'Înregistrare cont';
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
						<h1>Încă nu ai un cont?</h1>
						<p>Pentru a avea mai multe accese și pentru a vedea mai rapid informațiile legate de filmele viitoare îți poți face rapid un cont.</p>
                    </div>
                    <!-- /.col-lg-12 -->
				</div>
                <!-- /.row -->
			</div>
			<!-- /.container -->
		</section>
        <!-- /#page-name -->

		<section id="blog">
			<div class="container">
				<div class="row">
					<center>
						<h1>Înregistrare</h1>
						<br><br>
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="card">
								<?php echo (!empty($eroare)) ? afisare_eroare_bts($eroare) : (!empty($_POST) ? afisare_succes('Contul a fost creat. Verificați-vă adresa de email pentru confirmarea contului (poate dura 15 minute până la primirea confirmării).') : ''); ?>
								<div class="card-body">
									<form action="" method="POST">
										<div class="form-group row">
											<label for="nume" class="col-md-4 col-form-label text-md-right">Nume</label>
											<div class="col-md-6">
												<input type="text" name="nume" id="nume" class="form-control" required autofocus placeholder="Introduceți numele de familie" value="<?php echo (isset($_POST['submit']) && !empty($_POST)) ? $_POST['nume'] : ''; ?>">
											</div>
										</div>
										
										<div class="form-group row">
											<label for="prenume" class="col-md-4 col-form-label text-md-right">Prenume</label>
											<div class="col-md-6">
												<input type="text" name="prenume" id="prenume" class="form-control" required placeholder="Introduceți prenumele" value="<?php echo (isset($_POST['submit']) && !empty($_POST)) ? $_POST['prenume'] : ''; ?>">
											</div>
										</div>
										
										<div class="form-group row">
											<label for="telefon" class="col-md-4 col-form-label text-md-right">Număr de telefon</label>
											<div class="col-md-6">
												<input type="text" name="telefon" id="telefon" maxlength="10" class="form-control" required autocomplete="off" placeholder="Introduceți numărul de telefon" value="<?php echo (isset($_POST['submit']) && !empty($_POST)) ? $_POST['telefon'] : ''; ?>">
											</div>
										</div>
										
										<div class="form-group row">
											<label for="email" class="col-md-4 col-form-label text-md-right">Adresa de email</label>
											<div class="col-md-6">
												<input type="email" name="email" id="email" class="form-control" required autocomplete="off" placeholder="Introduceți adresa de email" value="<?php echo (isset($_POST['submit']) && !empty($_POST)) ? $_POST['email'] : ''; ?>">
											</div>
										</div>

										<div class="form-group row">
											<label for="parola" class="col-md-4 col-form-label text-md-right">Parola</label>
											<div class="col-md-6">
												<input type="password" name="parola" id="parola" class="form-control" required autocomplete="off" placeholder="Introduceți parola dorită">
											</div>
										</div>
										
										<div class="form-group row">
											<label for="parola2" class="col-md-4 col-form-label text-md-right">Confirmare parolă</label>
											<div class="col-md-6">
												<input type="password" name="parola2" id="parola2" class="form-control" required autocomplete="off" placeholder="Confirmați parola">
											</div>
										</div>
										<br>
										<br>
										<div class="col-md-3"></div>
										<div class="col-md-7 offset-md-4">
											<button type="submit" name="submit" class="btn btn-primary">
												Înregistrare
											</button>
											<a href="resetare" class="btn btn-link">
												Ai uitat parola?
											</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</center>
			</div>
			<!-- /.row -->
		</section>
    </body>
    <?php include('includes/footer.php'); ?>

</html>