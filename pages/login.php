<?php
nuesteLogat();

if(isset($_POST['submit'])){
	$email = curatare_email(strtolower($_POST['email']));
	$parola   = curatare_parola($con,$_POST['parola']);

	if(empty($email) || empty($parola))
		$eroare = 'Vă rugăm să completați toate câmpurile!';
	else {
		// Verificam daca utilizatorul exista in baza de date
		$sql = mysqli_query($con, "SELECT `email`, `parola` FROM `utilizatori` WHERE `email` = '". $email ."' AND `parola` = '". $parola ."'");	
		$exista = mysqli_num_rows($sql);
		
		// Daca acest cont exista, executam
		if($exista == 1){
			$sql = mysqli_query($con, "SELECT `id`, `logIP`, `acces`, `activ`, `cod_activare`  FROM `utilizatori` WHERE `email` = '". $email ."'");	
			$rand = mysqli_fetch_array($sql);

			if(!$rand['activ'] || !empty($rand['cod_activare']))
				$eroare = "Acest cont încă nu a fost activat, verificați-vă adresa de email!";
			else
				//Daca contul este banat nu permitem accesul
				if($rand['acces'] == -1)
					$eroare = "Ne pare rău dar acest cont a fost dezactivat de către un administrator!";
				else{
					// Creare sesiune cu id
					$_SESSION['id'] = $rand['id'];
					
					// Adaugam ip-ul utilizatorului in lista de ip-uri
					$logIP = json_decode($rand['logIP'], true);
					array_unshift($logIP, $_SERVER['REMOTE_ADDR']);
					$logIP = array_unique($logIP);
					mysqli_query($con, "UPDATE `utilizatori` SET `logIP` = '". json_encode($logIP) ."', `user_agent` = '". $_SERVER["U"] ."' WHERE `id` = ". $rand['id'] ."");
					
					if(isset($_GET['id']) && !empty($_GET['id']))
						header('Location: ../profil');
					else
						header('Location: profil');
				}
	} else
		if($exista == 0)
			$eroare = 'Email-ul introdus sau parola sunt greșite!';
		else
			if($exista > 1)
				$eroare = 'Vă rugăm să copiați codul erorii și contactați administratorul! #6V971X35';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<?php
	$titlu = 'Logare';
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
						<h1>Intră în cont</h1>
						<p>De acum îți poți face rezervare la orice film dorești în doar câteva minute cu ajutorul website-ului.</p>
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
					<center>
						<h1>Autentificare</h1>
						<br><br>
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="card">
								<?php
								echo !empty($eroare) ? afisare_eroare_bts($eroare).'<br>' : '';

								if(isset($_GET['id']) && !empty($_GET['id'])){
									$cod  = $_GET['id'];
									$sql  = mysqli_query($con, "SELECT `activ`, `cod_activare` FROM `utilizatori` WHERE `cod_activare` = '$cod'");
									$info = mysqli_fetch_assoc($sql);

									if(mysqli_num_rows($sql))
										if($info['activ'])
											echo afisare_eroare_bts('Codul dvs. este deja folosit, vă rugăm să contactați administratorul!');	
										else {
											echo afisare_succes('Contul dvs. a fost activat cu succes, acum te poți loga!');
											mysqli_query($con, "UPDATE `utilizatori` SET `activ` = 1, `cod_activare` = '' WHERE `cod_activare` = '$cod'"); 
										}
									else
										echo afisare_eroare_bts('Nu s-a găsit niciun cont cu acest cod de activare!');	
								} else {
								?>
								<div class="card-body">
									<form action="" method="POST">
										<div class="form-group row">
											<label for="email" class="col-md-4 col-form-label text-md-right">Adresa de email</label>
											<div class="col-md-6">
												<input type="email" name="email" id="email" class="form-control" required autofocus placeholder="Introduceți adresa de email">
											</div>
										</div>

										<div class="form-group row">
											<label for="parola" class="col-md-4 col-form-label text-md-right">Parola</label>
											<div class="col-md-6">
												<input type="password" name="parola" id="parola" class="form-control" required placeholder="Intorduceți parola">
											</div>
										</div>
										<br>
										<br>
										<div class="col-md-3"></div>
										<div class="col-md-7 offset-md-4">
											<button type="submit" name="submit" class="btn btn-primary">
												Logare
											</button>
											<a href="resetare" class="btn btn-link">
												Ai uitat parola?
											</a>
										</div>
									</form>
								</div>
								<?php } ?>
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