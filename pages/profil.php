<?php
esteLogat();

if(isset($_POST['submit1'])){
	$nume    = curatare($_POST['nume']);
	$prenume = curatare($_POST['prenume']);
	$email   = curatare($_POST['email']);
	$telefon = curatare($_POST['telefon']);
	$parola  = curatare_parola($con, $_POST['parola']);
	
	if(empty($nume) || empty($prenume) || empty($email) || empty($telefon) || empty($parola))
		$eroare = 'Toate câmpurile trebuie completate.';
	
	if($parola != $date_utilizator['parola'])
		$eroare = 'Parola introdusă nu este corectă.';
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		$eroare = 'Email-ul introdus nu este valid.';
	
	if(!is_numeric($telefon) || strlen($telefon) < 10 || strlen($telefon) > 10)
		$eroare = 'Numărul de telefon este invalid.';
	
	if(empty($eroare))
		mysqli_query($con, "UPDATE `utilizatori` SET `nume` = '$nume', `prenume` = '$prenume', `email` = '$email', `telefon` = '$telefon' WHERE `id` = ". $date_utilizator['id'] ."");
	
}

if(isset($_POST['submit2'])){
	$parolav    = curatare_parola($con, $_POST['parola_veche']);
	$parolan    = curatare_parola($con, $_POST['parola_noua']);
	$parolancf  = curatare_parola($con, $_POST['confirmare_parola']);

	if(empty($parolav) || empty($parolan) || empty($parolancf))
		$eroare = 'Toate câmpurile trebuie completate.';
	
	if($parolav != curatare_parola($con, $date_utilizator['parola']))
		$eroare = 'Parola acutală nu este corectă.';
	
	if($parolan == curatare_parola($con, $date_utilizator['parola']))
		$eroare = 'Parola nouă este aceeași ca și parola actuală.';
	
	if($parolan != $parolancf)
		$eroare = 'Parolele introduse nu corespund.';
	
	if(empty($eroare))
		mysqli_query($con, "UPDATE `utilizatori` SET `parola` = '$parolan' WHERE `id` = '". $date_utilizator['id'] ."'");
}

?>
<!DOCTYPE html>
<html lang="en">
	<?php include('includes/head.php'); ?>
    <body id="page-top" data-spy="scroll" data-target=".navbar-custom">
        <?php include('includes/navbar.php'); ?>
        <!-- Page-name Section -->
        <section id="page-name">
			<div class="overlay"></div>
            <div class="container">
				<div class="row">
                        <div class="col-lg-8 col-lg-offset-2 wp1 delay-05s">
                            <h1>Bine ai venit, <?php echo curatare($date_utilizator['prenume']); ?>!</h1>
                            <p>De acum îți poți face rezervare la orice film dorești în doar câteva minute cu ajutorul website-ului.</p>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </section>
            <!-- /#page-name -->

            <section id="blog">
				<div class="container bootstrap snippet">
					<div class="row">
						<div class="col-sm-10">
							<h1><?php echo curatare($date_utilizator['prenume']); ?></h1>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<!--left col-->
							<div class="text-center">
								<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
								<!--
								<h6>Upload a different photo...</h6>
								<input type="file" class="text-center center-block file-upload">
								-->
							</div>
							</hr>
							<br><br>
							<!--
							<div class="panel panel-default">
								<div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
								<div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">Social Media</div>
								<div class="panel-body">
									<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
								</div>
							</div>
							-->
						</div>
						<!--/col-3-->
						<div class="col-sm-9">
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#general">General</a></li>
								<li><a data-toggle="tab" href="#mesaje">Mesaje</a></li>
								<li><a data-toggle="tab" href="#setari">Setări</a></li>
								<li><a data-toggle="tab" href="#parola">Schimbare parolă</a></li>
								<li><a data-toggle="tab" href="#rezervari">Bilete rezervate</a></li>
								<li><a data-toggle="tab" href="filme">Rezervare bilet</a></li>
							</ul>
							<div class="tab-content">
								<?php echo (!empty($eroare)) ? '<br>'.afisare_eroare_bts($eroare) : (!empty($_POST) ? '<br>'.afisare_succes('Datele introduse au fost modificate.') : ''); ?>
								<div class="tab-pane active" id="general">
									<form class="form" id="registrationForm">
										<div class="form-group">
											<div class="col-xs-6">
												<label for="nume">
													<h4>Nume</h4>
												</label>
												<input name="nume" disabled class="form-control" placeholder="first name" value="<?php echo curatare($date_utilizator['nume']); ?>" title="Nume de familie">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label for="prenume">
													<h4>Prenume</h4>
												</label>
												<input name="prenume" disabled class="form-control" value="<?php echo curatare($date_utilizator['prenume']); ?>" title="Prenume">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label for="email">
													<h4>Email</h4>
												</label>
												<input name="email" disabled class="form-control" value="<?php echo $date_utilizator['email']; ?>" title="Adresa de email">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label for="telefon">
													<h4>Telefon</h4>
												</label>
												<input name="telefon" disabled class="form-control" value="<?php echo $date_utilizator['telefon']; ?>" title="Numărul de telefon">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label for="data">
													<h4>Data înregistrare</h4>
												</label>
												<input name="data" disabled class="form-control" value="<?php echo date("d-m-Y H:i", strtotime($date_utilizator['data_inregistrare'])); ?>" title="Dată înregistrare.">
											</div>
										</div>
										</form>
									<hr>
								</div>
								<!--/tab-pane-->
								
								<div class="tab-pane" id="mesaje">
									<br>
									<div class="alert alert-info">
										<center>
											<i class="fa fa-exclamation-circle" aria-hidden="true"></i> <strong>INFO</strong> Momentan nu aveți niciun mesaj primit.
										</center>
									</div>
								</div>
								<!--/tab-pane-->
								
								<div class="tab-pane" id="setari">
									<form role="form" action="profil" id="setari" method="POST">
										<div class="form-group">
											<div class="col-xs-6">
												<label for="nume">
													<h4>Nume</h4>
												</label>
												<input class="form-control" type="text" required name="nume" value="<?php echo isset($_POST['submit1']) ? $nume : (!empty($date_utilizator['nume']) ? $date_utilizator['nume'] : "#Nedefinit"); ?>" placeholder="Introduceți numele">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label for="prenume">
													<h4>Prenume</h4>
												</label>
												<input class="form-control" type="text" required name="prenume" value="<?php echo isset($_POST['submit1']) ? $prenume : (!empty($date_utilizator['prenume']) ? $date_utilizator['prenume'] : "#Nedefinit"); ?>" placeholder="Introduceți prenumele">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label for="email">
													<h4>Email</h4>
												</label>
												<input class="form-control" type="text" required name="email" value="<?php echo isset($_POST['submit1']) ? $email : (!empty($date_utilizator['email']) ? $date_utilizator['email'] : "#Nedefinit"); ?>" placeholder="Introduceți adresa de email">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label for="telefon">
													<h4>Telefon</h4>
												</label>
												<input class="form-control" type="text" required name="telefon" value="<?php echo isset($_POST['submit1']) ? $telefon : (!empty($date_utilizator['telefon']) ? $date_utilizator['telefon'] : "#Nedefinit"); ?>" placeholder="Introduceți numărul de telefon">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label for="confp">
													<h4>Confirmare parolă</h4>
												</label>
												<input class="form-control" type="password" required name="parola"  placeholder="Introduceți parola actuală">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-12">
												<br>
												<input type="submit" name="submit1" id="submit1" class="btn btn-lg btn-success" value="Salvează">
											</div>
										</div>
									</form>
								</div>
								<!--/tab-pane-->
								
								<div class="tab-pane" id="parola">
									<form role="form" action="" method="POST">
										<br>
										<br>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Parolă actuală</label>
											<div class="col-lg-9">
												<input class="form-control" type="password" required name="parola_veche"  placeholder="Introduceți parola actuală">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Confirmare nouă</label>
											<div class="col-lg-9">
												<input class="form-control" type="password" required name="parola_noua"  placeholder="Introduceți parola nouă">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 col-form-label form-control-label">Confirmare parolă nouă</label>
											<div class="col-lg-9">
												<input class="form-control" type="password" required name="confirmare_parola"  placeholder="Confirmați parola nouă">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-12">
												<br>
												<input type="submit" name="submit2" class="btn btn-lg btn-success" value="Salvează">
											</div>
										</div>
									</form>
								</div>
								<!--/tab-pane-->
								
								<div class="tab-pane" id="rezervari">
									<br>
									<?php
									$sql = mysqli_query($con, "SELECT * FROM `rezervari` WHERE `id_user` = ". $date_utilizator['id'] ."");
									if(mysqli_num_rows($sql)){
									?>
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th>#</th>
													<th>Nume film</th>
													<th>Locuri rezervate</th>
													<th>Total plată</th>
													<th>Stare</th>
													<th>Dată rezervare</th>
												</tr>
											</thead>
											<tbody>
											<?php
											$i=0;
											while($rand = mysqli_fetch_assoc($sql)){
												$sql2 = mysqli_query($con, "SELECT `titlu` FROM `filme` WHERE `id` = ". $rand['id_film'] ."");
												$info_film = mysqli_fetch_assoc($sql2);
											?>
												<tr>
													<td><?php echo ++$i;?></td>
													<td><?php echo isset($info_film['titlu']) ? $info_film['titlu'] : '<i># Nedefinit</i>';?></td>
													<td><?php echo isset($rand['locuri']) ? $rand['locuri'] : '<i># Nedefinit</i>';?></td>
													<td><?php echo isset($rand['pret']) ? $rand['pret'] : '<i># Nedefinit</i>';?> LEI</td>
													<td>ok</td>
													<td><?php echo strftime("%d %B %Y | %H:%M", strtotime($rand['data_rezervare'])); ?></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
									<?php } else { ?>
									<br>
									<center>
										<div class="alert alert-info">
											<i class="fa fa-info-circle"></i> <strong>Info:</strong> În acest moment nu ai niciun bilet rezervat.
										</div>
									</center>
									<?php } ?>
								</div>
								<!--/tab-pane-->
							</div>
							<!--/tab-pane-->
						</div>
						<!--/tab-content-->
					</div>
					<!--/col-9-->
				</div>
				<!-- /.row -->
			</section>

            <!-- Core JavaScript Files -->
            <script src="js/jquery-1.10.2.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.easing.min.js"></script>

            <!-- JavaScript -->
            <script src="js/lib/jquery.appear.js"></script>
            <script src="js/lib/video/jquery.mb.YTPlayer.js"></script>
            <script src="js/lib/flipclock/flipclock.js"></script>
            <script src="js/lib/jquery.animateNumber.js"></script>
            <script src="js/lib/waypoints.min.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="js/main.js"></script>

    </body>
    <?php include('includes/footer.php'); ?>

</html>