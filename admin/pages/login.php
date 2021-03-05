<?php
if(isset($_POST['submit'])){
	$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	$parola = filter_var($_POST['parola'], FILTER_SANITIZE_STRING);
	
	$sql = mysqli_query($con, "SELECT `id`, `prenume`, `email`, `parola`, `acces` FROM `utilizatori` WHERE `email` = '$email' AND `parola` = '$parola' AND `acces` = 1");
	$data = mysqli_fetch_array($sql);
	
	if(empty($email) || empty($parola))
		$eroare = "Vă rugăm să completați toate câmpurile.";
	else 
		if(mysqli_num_rows($sql) == 1){
			$_SESSION['admin'] = $data['id'];
			$_SESSION['prenume'] = $data['prenume'];
			mysqli_query($con, "UPDATE `utilizatori` SET `ip` = '". $_SERVER['REMOTE_ADDR']."', `ultima_logare` = '". date("Y-m-d H:i:s")."', `user_agent` = '". $_SERVER['HTTP_USER_AGENT'] ."' WHERE `id` = ". $data['id'] ."");
			
			header('Location: ./');
		} else {
			if(mysqli_num_rows($sql) == 0)
				$eroare = "Ne pare rău dar acest cont nu exista.";
			
			if($data['acces'] != 1)
				$eroare = "Ne pare rău dar nu aveți acces.";
			
			if($email != $data['email'] && $parola != $data['parola'])
				$eroare = "Ne pare rău dar datele introduse sunt incorecte.";
		}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Cinema Melodia | Administrator</title>
		<link rel="shortcut icon" href="favicon.png" />
		
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/adminlte.min.css">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	</head>

	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<b>Cinema</b> Melodia
			</div>
			<!-- /.login-logo -->
			<div class="card">
			<?php if(isset($_POST['submit']) && !empty($eroare)){ ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Eroare</strong> <?php echo $eroare; ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php } ?>
				<div class="card-body login-card-body">
					<p class="login-box-msg">Logare în contul de administrator</p>

					<form action="" method="POST">
						<div class="input-group mb-3">
							<input type="email" class="form-control" name="email" required placeholder="Email">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-envelope"></span>
								</div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input type="password" class="form-control" name="parola" required placeholder="Parola">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-8">
								<div class="icheck-primary">
									<input type="checkbox" id="remember">
									<label for="remember">
										Rămâi conectat
									</label>
								</div>
							</div>
							<!-- /.col -->
							<div class="col-4">
								<button type="submit" name="submit" class="btn btn-primary btn-block">Conectare</button>
							</div>
							<!-- /.col -->
						</div>
					</form>

					<div class="social-auth-links text-center mb-3">
						<p>- INFO -</p>
						<a href="forgot-password.html" class="btn btn-block btn-warning">
							<i class="fas fa-question-circle"></i> Recuperează parola
						</a>
					</div>
					<!-- /.social-auth-links -->
				</div>
				<!-- /.login-card-body -->
			</div>
		</div>
		<!-- /.login-box -->

		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>

	</body>
</html>