<!DOCTYPE html>
<html>
	<?php
	//Verificam daca id-ul este numeric si daca utilizatorul exista in baza de date
	$sql = mysqli_query($con, "SELECT * FROM `utilizatori` WHERE `id` = ". $_GET['id'] ."");
	if(!is_numeric($_GET['id']) || !mysqli_num_rows($sql))
		header('Location: eroare');
	
	//Includem fisierele principale
	$titlu = "Editare utilizator";
	$css = '
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	';
	include('includes/head.php');
	
	//Preluam informatiile despre utilizator din baza de date
	$rand = mysqli_fetch_assoc($sql);

	//Daca s-a trimis formularul
	if(isset($_POST['submit'])){
		$nume    = curatare($_POST['nume']);
		$prenume = curatare($_POST['prenume']);
		$parola  = $_POST['parola'];
		$email   = curatare_email($_POST['email']);
		$telefon = $_POST['telefon'];
		$activ   = $_POST['activ'];
		$acces   = $_POST['acces'];

		$sql  = mysqli_query($con, "SELECT `email` FROM `utilizatori` WHERE `email` = '". $email ."' AND `id` != ". $_GET['id'] ."");
		$email_existent = mysqli_num_rows($sql); 
		
		if(empty($nume) || empty($_POST['prenume']) || empty($_POST['email']) || empty($_POST['telefon']))
			$eroare = "Toate câmpurile trebuie să fie completate.";
		else
			if(strlen($nume) <= 3 || strlen($nume) > 15)
				$eroare = "Numele trebuie sa aiba minimum 3 caractere si maxim 15 caractere.";
		else
			if(strlen($prenume) <= 3 || strlen($prenume) > 15)
				$eroare = "Prenumele trebuie sa aiba minim 3 caractere si maxim 15 caractere.";
		else
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				$eroare = "Email-ul introdus nu este valid.";
		else
			if($email_existent)
				$eroare = "Email-ul introdus există deja în baza de date.";
		else
			if(!preg_match('/^\(?07\d{2}\)?[-\s]?\d{3}[-\s]?\d{3}$/', $telefon))
				$eroare = "Numărul de telefon introdus nu este valid.";
		else
			if(!is_numeric($activ) && ($activ < 0 || $activ > 1))
				$eroare = "Valoare greșită pentru câmpul activ.";
		else
			if(!is_numeric($acces) && ($acces < -1 || $acces > 1))
				$eroare = "Valoare greșită pentru câmpul acces.";
		else {
			$valori = "`nume` = '". $nume ."',`prenume` = '". $prenume ."', `telefon` = '". $telefon ."', `email` = '". $email ."', `activ` = '". $activ ."', `acces` = '". $acces ."'";
			if($parola = '')
				mysqli_query($con, "UPDATE `utilizatori` SET $valori WHERE `id` = ". $_GET['id'] ."");
			else
				mysqli_query($con, "UPDATE `utilizatori` SET $valori, `parola` = '". md5($parola) ."' WHERE `id` = ". $_GET['id'] ."");
				
			// header("Refresh: 2");
		}
		
	}
	?>

    <body class="hold-transition sidebar-mini">
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
								<div class="card card-<?php echo culoare_card(isset($_POST['submit']) ? 1 : 0, $eroare); ?>">
									<div class="card-header">
										<?php echo mesaj_card(isset($_POST['submit']) ? 1 : 0, $eroare, $eroare, "Editare utilizator"); ?>
									</div>
									<div class="card-body">
										<form action="" method="POST">
											<!-- Numele utilizatorului -->
											<div class="form-group">
												<label>Nume & prenume</label>

												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="far fa-user"></i></span>
													</div>
													<input type="text" name="nume" required class="form-control" value="<?php echo isset($_POST['submit']) ? $_POST['nume'] : (!empty($rand['nume']) ? $rand['nume'] : "# Nedefinit"); ?>">
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->

											<!-- Prenumele utilizatorului -->
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="far fa-user"></i></span>
													</div>
													<input type="text" name="prenume" required class="form-control" value="<?php echo isset($_POST['submit']) ? $_POST['prenume'] : (!empty($rand['prenume']) ? $rand['prenume'] : "# Nedefinit"); ?>">
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->

											<!-- Parola-ul utilizatorului -->
											<div class="form-group">
												<label>Parola:</label>

												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fas fa-lock"></i></span>
													</div>
													<input type="password" name="parola" class="form-control" placeholder="*********">
												</div>
												<!-- /.input group -->
											</div>
											
											<!-- Email-ul utilizatorului -->
											<div class="form-group">
												<label>Email:</label>

												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fas fa-envelope"></i></span>
													</div>
													<input type="email" name="email" oninvalid="this.setCustomValidity('Introduceți un email valid')" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' required class="form-control" value="<?php echo isset($_POST['submit']) ? $_POST['email'] : (!empty($rand['email']) ? $rand['email'] : "# Nedefinit"); ?>"">
												</div>
												<!-- /.input group -->
											</div>
											
											<!-- Numarul de telefon-->
											<div class="form-group">
												<label>Telefon:</label>

												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fas fa-phone"></i></span>
													</div>
													<input type="number" name="telefon" required class="form-control" data-inputmask="'mask': ['9999-999-999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask value="<?php echo isset($_POST['submit']) ? $_POST['telefon'] : (!empty($rand['telefon']) ? $rand['telefon'] : "# Nedefinit"); ?>"">
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->

											<!-- Activitate cont-->
											<div class="form-group">
												<label>Cont activ:</label>

												<div class="input-group">
													<select name="activ" class="form-control" style="width: 100%;">
														<option <?php echo (!empty($rand['activ']) && $rand['activ'] == 1) ? 'selected="active"' : ''; ?> value="1">Cont activ</option>
														<option <?php echo (!empty($rand['activ']) && !$rand['activ']) ? 'selected="active"' : ''; ?> value="0">Cont inactiv</option>
													</select>
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
											
											<!-- Accesul contului-->
											<div class="form-group">
												<label>Acces cont:</label>

												<div class="input-group">
													<select name="acces" class="form-control" style="width: 100%;">
														<option <?php echo (!empty($rand['acces']) && $rand['acces'] == 1) ? 'selected="active"' : ''; ?> value="1">Administrator</option>
														<option <?php echo (!empty($rand['acces']) && !$rand['acces']) ? 'selected="active"' : ''; ?> value="0">Utilizator</option>
														<option <?php echo (!empty($rand['acces']) && $rand['acces'] == -1) ? 'selected="active"' : ''; ?> value="-1">Banat</option>
													</select>
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
											<button type="submit" name="submit" class="btn btn-success">Salvează</button>
										</form>
									</div>
                                    <!-- /.card-body -->
								</div>
                                <!-- /.card -->

							</div>
                            <!-- /.col (left) -->

                            <div class="col-md-6">
								<div class="card card-primary">
									<div class="card-header">
										<h3 class="card-title">Informații generale</h3>
									</div>
                                    <div class="card-body">
										<?php
										$lista = json_decode($rand['logIP'], true);
										$lista = array_unique($lista);
										?>
										<!-- IP mask -->
                                        <div class="form-group">
											<label>Ultimul IP:</label>

                                            <div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-laptop"></i></span>
                                                </div>
                                                <input type="text" disabled class="form-control" value="<?php echo !empty($rand['logIP']) ? $lista[0] : "Nu s-a logat încă pe cont"; ?>">
											</div>
                                            <!-- /.input group -->
										</div>
                                        <!-- /.form group -->

                                        <!-- IP lists-->
                                        <div class="form-group">
											<label>Listă IP-uri:</label>

                                            <div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-laptop"></i></span>
												</div>
												<textarea type="text" disabled class="form-control" <?php echo !empty($rand['logIP']) ? 'rows="4"' : ''; ?>><?php echo !empty($rand['logIP']) ? '< '.implode(' >, < ', $lista).' >' : "Nu s-a logat încă pe cont"; ?></textarea>
											</div>
                                            <!-- /.input group -->
										</div>
                                        <!-- /.form group -->

                                        <!-- User Agent lists-->
                                        <div class="form-group">
											<label>Informații device:</label>

                                            <div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fas fa-laptop"></i></span>
												</div>
                                                <textarea type="text" disabled class="form-control" <?php echo !empty($rand['user_agent']) ? 'rows="3"' : ''; ?>><?php echo !empty($rand['user_agent']) ? $rand['user_agent'] : "Nu s-a logat încă pe cont"; ?></textarea>
											</div>
                                            <!-- /.input group -->
										</div>
                                        <!-- /.form group -->
									</div>
									<!-- /.card-body -->
								</div>
                                <!-- /.card -->
							</div>
                            <!-- /.col (right) -->
						</div>
						<!-- /.row -->
					</div>
                    <!-- /.container-fluid -->
				</section>
            <!-- /.content -->
		</div>
        <!-- ./wrapper -->
    </body>
    <?php include('includes/footer.php'); ?>
    <?php include('includes/scripts.php'); ?>
</html>