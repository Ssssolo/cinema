<!DOCTYPE html>
<html>
<?php
	//Verificam daca id-ul este numeric si daca utilizatorul exista in baza de date
	$sql = mysqli_query($con, "SELECT * FROM `articole` WHERE `id` = ". $_GET['id'] ."");
	if(!is_numeric($_GET['id']) || !mysqli_num_rows($sql))
		header('Location: eroare');
	
	//Includem fisierele principale
	$titlu = "Editare articol";
	$css = '<!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">';
	include('includes/head.php');
	include('functions/general.php');
	
	//Preluam informatiile despre utilizator din baza de date
	$rand = mysqli_fetch_assoc($sql);

	//Daca s-a trimis formularul
	if(isset($_POST['submit'])){
		$titlu_articol   = curatare($_POST['titlu']);
		$text    = $_POST['text'];

		if(!empty($_FILES["imagine"]["name"])){
			$target_dir = "../img/articole/";
			$imageFileType = strtolower(pathinfo($target_dir . basename($_FILES["imagine"]["name"]),PATHINFO_EXTENSION));
			
			//Redenumim imaginea
			$_FILES["imagine"]["name"] = 'img_'. time() .'.' . $imageFileType;
			$target_file = $target_dir . basename($_FILES["imagine"]["name"]);
			$uploadOk = 1;
			
			// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES["imagine"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$eroare = "Fișierul introdus nu este o imagine.";
					$uploadOk = 0;
				}
			
			
			// Check if file already exists
			if (file_exists($target_file)) {
				$eroare = "Fișierul introdus există deja.";
				$uploadOk = 0;
			}
			
			// Check file size
			if ($_FILES["imagine"]["size"] > 500000) {
				$eroare = "Mărimea fișierului este prea mare.";
				$uploadOk = 0;
			}
			
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$eroare = "Sunt acceptate numai fișiere de tipul JPG, JPEG, PNG & GIF.";
				$uploadOk = 0;
			}
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$eroare = "Fișierul dvs. nu a putut fi încărcat.";
				
			// if everything is ok, try to upload file
			}
			
			if (!move_uploaded_file($_FILES["imagine"]["tmp_name"], $target_file)) 
				$eroare = "A apărut o eroare la încărcarea fișierului.";
		}
		
		if(empty($erori) && !empty($_FILES["imagine"]["name"]))
			mysqli_query($con, "UPDATE `articole` SET `titlu` = '". $titlu_articol ."', `text` = '". $text ."', `imagine` = '". $_FILES["imagine"]["name"] ."', `autor` = '". $_SESSION['prenume'] ."', `ultima_editare` = '". date("Y-m-d H:i:s") ."' WHERE `id` = ". $_GET['id'] ."");
		else
			mysqli_query($con, "UPDATE `articole` SET `titlu` = '". $titlu_articol ."', `text` = '". $text ."', `autor` = '". $_SESSION['prenume'] ."', `ultima_editare` = '". date("Y-m-d H:i:s") ."' WHERE `id` = ". $_GET['id'] ."");
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
									<div class="card-body p-0">
										<ul class="nav nav-pills flex-column">
											<li class="nav-item active">
												<div class="nav-link">
													<i class="fas fa-calendar-plus"></i> Dată postare:
													<span><b><?php echo ($rand['data'] == "0000-00-00 00:00:00") ? ' #Nedefinit' : date("d-m-Y H:i", strtotime($rand['data'])); ?></b></span>
												</div>
											</li>
											<li class="nav-item active">
												<div class="nav-link">
													<i class="fas fa-edit"></i> Ultima editare:
													<span><b><?php echo ($rand['ultima_editare'] == "0000-00-00 00:00:00") ? ' -' : date("d-m-Y H:i", strtotime($rand['ultima_editare'])); ?></b></span>
												</div>
											</li>
											<li class="nav-item active">
												<div class="nav-link">
													<i class="fas fa-calendar-plus"></i> Autor:
													<span><b><?php echo $rand['autor']; ?></b></span>
												</div>
											</li>
											<li class="nav-item active">
												<div class="nav-link">
													<i class="fas fa-laptop"></i> Adresă IP:
													<span><b><?php echo empty($rand['ip']) ? '# Nedefinit' : $rand['ip']; ?></b></span>
												</div>
											</li>
										</ul>
									</div>
									<!-- /.card-body -->
								</div>
								<!-- /.card -->
							</div>
							<!-- /.col -->
							<div class="col-md-9">
								<div class="card card-<?php echo culoare_card(isset($_POST['submit']) ? 1 : 0, $eroare); echo (empty($erori) && !isset($_POST['submit'])) ? ' card-outline' : ''; ?>">
									<div class="card-header">
										<h3 class="card-title"><?php echo mesaj_card(isset($_POST['submit']) ? 1 : 0, empty($eroare) ? 0 : 1, $eroare, "Editare articol"); ?></h3>
									</div>
									<!-- /.card-header -->
									<form action="" method="POST" enctype="multipart/form-data">
										<div class="card-body">
											<div class="form-group">
												<input type="text" name="titlu" class="form-control" placeholder="Titlu articol" value="<?php echo isset($_POST['submit']) ? curatare($_POST['titlu']) : (!empty($rand['titlu']) ? $rand['titlu'] : "#Nedefinit"); ?>">
											</div>
											<div class="form-group">
												<input type="file" name="imagine" class="form-control">
											</div>
											<div class="form-group">
												<textarea id="compose-textarea" name="text" class="form-control" style="height: 300px"><?php echo isset($_POST['submit']) ? $_POST['text'] : (!empty($rand['text']) ? $rand['text'] : "Nu există un text asociat acestui articol."); ?></textarea>
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