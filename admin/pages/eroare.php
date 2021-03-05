<?php
http_response_code(404);
header("HTTP/1.0 404 Not Found");
?>
<!DOCTYPE html>
<html>
	<?php
	$titlu = "Pagina nu a fost găsită";
	include('includes/head.php');
	include('functions/general.php');
	?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
		<?php
		include('includes/navbar.php');
		include('includes/sidebar.php');
		?>
		<div class="content-wrapper">
			<?php include('includes/content-header.php'); ?>
			<!-- Main content -->
			<section class="content">
				<div class="error-page">
					<h2 class="headline text-warning"> 404</h2>

					<div class="error-content">
						<h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Pagina nu a fost găsită.</h3>

						<p>
							Nu am găsit pagina pe care o căutați. Între timp, puteți reveni la <a href="index.html">panoul principal</a> sau încercați să utilizați formularul de căutare.
						</p>

						<form class="search-form">
							<div class="input-group">
								<input type="text" name="search" class="form-control" placeholder="Caută o pagină">

								<div class="input-group-append">
									<button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
									</button>
								</div>
							</div>
							<!-- /.input-group -->
						</form>
					</div>
					<!-- /.error-content -->
				</div>
				<!-- /.error-page -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
	</div>
	<!-- /.wrapper -->
	<?php 
	include('includes/footer.php');
	include('includes/scripts.php');
	?>
	
</body>

</html>