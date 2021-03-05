<!DOCTYPE html>
<html>
<?php
	//Includem fisierele principale
	$titlu = "Adăugare articol";
	$css = '<!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">';
	include('includes/head.php');
	include('functions/general.php');

	//Daca s-a trimis formularul
	if(isset($_POST['submit'])){
		$titlu_articol = curatare($_POST['titlu']);
		$text 	= $_POST['text'];
		$taguri = !empty($_POST['taguri']) ? curatare($con, $_POST['taguri']) : '';
		
		if(empty($titlu_articol) || empty($text))
			$eroare = 'Toate câmpurile trebuie completate';

		if(!empty($_FILES["imagine"]["name"])){
			$target_dir = "../img/articole/";
			$imageFileType = strtolower(pathinfo($target_dir . basename($_FILES["imagine"]["name"]),PATHINFO_EXTENSION));
			
			//Redenumim imaginea
			$_FILES["imagine"]["name"] = 'img_'. time() .'.' . $imageFileType;
			$target_file = $target_dir . basename($_FILES["imagine"]["name"]);
			$uploadOk = 1;
			
			/*
				$check = getimagesize($_FILES["imagine"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$eroare = "Fișierul introdus nu este o imagine.";
					$uploadOk = 0;
				}
			*/
			
			// Check if file already exists
			if (file_exists($target_file)) {
				$eroare = "Fișierul introdus există deja.";
				$uploadOk = 0;
			}

			// Allow certain file formats
			if($_FILES["imagine"]["size"] && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$eroare = "Sunt acceptate numai fișiere de tipul JPG, JPEG, PNG & GIF.";
				$uploadOk = 0;
			}
			
			// Check file size
			if ($_FILES["imagine"]["size"] > 500000) {
				$eroare = "Mărimea fișierului este prea mare. Limita maximă este de <b>0.5 MB</b> iar fișierul dvs. are <b>".marime_fisier($_FILES["imagine"]["tmp_name"])."</b>.";
				$uploadOk = 0;
			}
		}
		
		if(empty($eroare)){
			if(!empty($_FILES["imagine"]["name"]) && $uploadOk)
				move_uploaded_file($_FILES["imagine"]["tmp_name"], $target_file);

			$nume_img = !empty($_FILES["imagine"]["name"]) ? $_FILES["imagine"]["name"] : 'default.jpg';
			mysqli_query($con, "INSERT INTO `articole` (`titlu`, `text`, `imagine`, `autor`, `IP`, `taguri`, `data`) VALUES ('". $titlu_articol ."', '". $text ."', '". $nume_img ."', '". $_SESSION['prenume'] ."', '". $_SERVER['REMOTE_ADDR'] ."', '". $taguri ."', '". date("Y-m-d H:i:s") ."')");
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
							<div class="col-md-3">
								<a href="articole" class="btn btn-primary btn-block mb-3">Înapoi la articole</a>

								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Informații</h3>

										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
											</button>
										</div>
									</div>
									<div class="card-body">
										<ul>
										
										</ul>
									</div>
								</div>
								<!-- /.card -->
							</div>
							<!-- /.col -->
							<div class="col-md-9">
								<div class="card card-<?php echo culoare_card(isset($_POST['submit']) ? 1 : 0, $eroare); echo (empty($erori) && !isset($_POST['submit'])) ? ' card-outline' : ''; ?>">
									<div class="card-header">
										<h3 class="card-title"><?php echo mesaj_card(isset($_POST['submit']) ? 1 : 0, !empty($eroare) ? 1 : 0 , !empty($eroare) ? $eroare : 'Articolul a fost adăugat cu succes!', "Adăugați un articol nou"); ?></h3>
									</div>
									<!-- /.card-header -->
									<form action="" method="POST" enctype="multipart/form-data">
										<div class="card-body">
											<div class="form-group">
												<input type="text" name="titlu" class="form-control" placeholder="Titlu articol" required>
											</div>
											<div class="form-group">
												<input type="file" name="imagine" class="form-control">
											</div>
											
											<div class="form-group">
												<input type="text" name="taguri" class="form-control" placeholder="Tag-uri specifice">
											</div>
											<div class="form-group">
												<textarea id="compose-textarea" name="text" class="form-control" style="height: 300px" placeholder="Introduceți datele articolului" required></textarea>
											</div>
										</div>
										<!-- /.card-body -->
										<div class="card-footer">
											<div class="float-right">
												<button type="submit" name="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Salvează</button>
											</div>
										</div>
										<!-- /.card-footer -->
									</form>
								</div>
								<!-- /.card -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
					<!-- /.container-fluid -->
				</section>
            <!-- /.content -->
		</div>
        <!-- ./wrapper -->
    </body>
    <?php
	include('includes/footer.php');
	$script = ' <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>';
	include('includes/scripts.php');
	?>
	<script>
        $(function() {
            //Add text editor
            $('#compose-textarea').summernote()
        })
    </script>
</html>