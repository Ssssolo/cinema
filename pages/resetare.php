<?php
nuesteLogat();

if(isset($_POST['submit'])){
	$email         = curatare_email(strtolower($_POST['email']));
	$criptare_init = criptare('encrypt', ''.date('Y-m-d H:i:s').','. $email .'');
	$criptare_fin  = explode('=', ''. $criptare_init .'');
	
	$sql  = mysqli_query($con, "SELECT `email`,`cod_resetare` FROM `utilizatori` WHERE `email` = '$email'");
	$info = mysqli_fetch_assoc($sql);
	
	$ora_trim = explode(',', criptare('decrypt', ''. $info['cod_resetare'] .''));
	$ora1     = strtotime("". $ora_trim[0] ."");
	$ora2     = strtotime("". date('Y-m-d H:i:s') ."");
	$interval = abs($ora1 - $ora2);
	$minute   = round($interval / 60);

	if(!mysqli_num_rows($sql))
		$eroare = "Nu există niciun cont cu această adresă de email!";
	else
		if(!empty($info['cod_resetare']) && $minute <= 15)
			$eroare = "S-a trimis deja o solicitare pentru schimbarea parolei, reveniți in 15 minute!";
	
	
	if(empty($eroare)){
		mysqli_query($con, "UPDATE `utilizatori` SET `cod_resetare` = '". $criptare_fin[0] ."' WHERE `email` = '$email'");
		trimite_mail("".$email."", "Informații resetare parolă", "Salut <b>$email</b><br><br> Cineva a solicitat un link pentru a vă reseta parola. Puteți face acest lucru accesând linkul de mai jos.<br><br><a href='https://". $_SERVER['HTTP_HOST'] ."/resetare/". $criptare_fin[0] ."'>https://". $_SERVER['HTTP_HOST'] ."/resetare/". $criptare_fin[0] ."</a><br><br>Dacă nu ați solicitat acest lucru, vă rugăm să ignorați acest e-mail. Parola dvs. nu se va schimba până când nu accesați linkul de mai sus.");
	}
}

if(isset($_GET['id']) && !empty($_GET['id'])){
	$info = explode(',', ''.criptare('decrypt', ''. $_GET['id'] .'==').'');
	$ok = 1;
	
	//Verificam daca datele decriptate din `id` sunt valide
	$sql = mysqli_query($con, "SELECT `email`, `cod_resetare` FROM `utilizatori` WHERE `email` = '". $info[1] ."' AND `cod_resetare` = '". $_GET['id'] ."'");
	
	//Verificam daca exista email-ul respectiv in baza de date
	if(!mysqli_num_rows($sql)){
		$eroare = "Ne pare rău dar link-ul accesat nu este valid!";
		$ok = 0;
	} else //Verificam daca email-ul are forma corespunzatoare
		if(!filter_var($info[1], FILTER_VALIDATE_EMAIL)){
			$eroare = "A apărut o eroare la procesarea codului! (eroare #3N89U41)";
			$ok = 0;
	} else
		if($minute > 15){
			$eroare = "Ne pare rău dar link-ul introdus este expirat!";
			$ok = 0;
		}
	
	if(empty($eroare) && isset($_POST['submit2'])){
		$parola_noua  = curatare_parola($con, $_POST['parola_noua']);
		$parola_noua2 = curatare_parola($con, $_POST['parola_noua2']);
		
		if($parola_noua != $parola_noua2)
			$eroare = "Parolele introduse nu corespund!";
		else
			if(strlen($parola_noua) < 6)
				$eroare = "Parola trebuie să aibă minim 6 caractere!";

		if(empty($eroare)){
			mysqli_query($con, "UPDATE `utilizatori` SET `parola` = '$parola_noua', `cod_resetare` = NULL, `nrResetari` = `nrResetari` + 1 WHERE `email` = '". $info[1] ."'");
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<?php
	$titlu = 'Recuperare parolă';
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
						<h1>Ai uitat parola?</h1>
						<p>Dacă ți-ai uitat parola nu este nicio problemă, completează formularul și vei primi instant pe adresa de email o parolă nouă.</p>
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
						<h1>Recuperare parolă</h1>
						<br><br>
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="card">
								<?php
								if(!empty($eroare))
									echo afisare_eroare_bts($eroare);
								else
									if(!empty($_POST))
										if(isset($_GET['id']) && !empty($_GET['id']))
											echo afisare_succes('Parola contului dvs. a fost resetată cu succes!');
										else	
											echo afisare_succes('Un link cu informații de resetare a parolei a fost trimis la această adresă de e-mail!');
								
								?>
								<div class="card-body">
									<form action="" method="POST">
										<?php
										if(isset($_GET['id']) && !empty($_GET['id'])){
											if($ok){
										?>
										<div class="form-group row">
											<label for="parola_noua" class="col-md-4 col-form-label text-md-right">Parolă nouă</label>
											<div class="col-md-6">
												<input type="password" name="parola_noua" id="parola_noua" class="form-control" required autocomplete="off" placeholder="Introduceți o parolă nouă">
											</div>
										</div>
										<div class="form-group row">
											<label for="parola_noua2" class="col-md-4 col-form-label text-md-right">Repetare parolă nouă</label>
											<div class="col-md-6">
												<input type="password" name="parola_noua2" id="parola_noua2" class="form-control" required autocomplete="off" placeholder="Repetați parola nouă">
											</div>
										</div>
										<br>
										<div class="col-md-3"></div>
										<div class="col-md-7 offset-md-4">
											<button type="submit" name="submit2" class="btn btn-primary">
												Resetare
											</button>
										</div>
										<?php
											}
										} else {
										?>
										<div class="form-group row">
											<label for="email" class="col-md-4 col-form-label text-md-right">Adresa de email</label>
											<div class="col-md-6">
												<input type="email" name="email" id="email" class="form-control" required autocomplete="off" placeholder="Introduceți adresa de email">
											</div>
										</div>
										<br>
										<div class="col-md-3"></div>
										<div class="col-md-7 offset-md-4">
											<button type="submit" name="submit" class="btn btn-primary">
												Recuperare
											</button>
										</div>
										<?php
										}
										?>
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