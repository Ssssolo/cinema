<!DOCTYPE html>
<html>
	<?php
	$titlu = "Dashboard";
	$css = '
	<!-- iCheck -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
	';
	include('includes/head.php');
	?>

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
						<?php include('includes/dashboard/informatii_generale.php'); ?>	
						<!-- Main row -->
						<div class="row">
							<!-- Left col -->
							<section class="col-lg-7 connectedSortable">
								<?php
								include('includes/dashboard/statistica1.php');
								include('includes/dashboard/de_facut.php');
								?>
							</section>
							<!-- /.Left col -->
								
							<!-- right col (We are only adding the ID to make the widgets sortable)-->
							<section class="col-lg-5 connectedSortable">
								<?php
								include('includes/dashboard/harta.php');
								include('includes/dashboard/statistica2.php');
								?>
							</section>
							<!-- right col -->
						</div>
						<!-- /.row (main row) -->
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
		</div>
		<!-- ./wrapper -->
		<?php 
		include('includes/footer.php');
		$script = '
		<!-- ChartJS -->
		<script src="plugins/chart.js/Chart.min.js"></script>
		<!-- Sparkline -->
		<script src="plugins/sparklines/sparkline.js"></script>
		<!-- JQVMap -->
		<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
		<script src="plugins/jqvmap/maps/jquery.vmap.europe.js?v=0.4"></script>
		<!-- jQuery Knob Chart -->
		<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
		<!-- daterangepicker -->
		<script src="plugins/moment/moment.min.js"></script>
		<script src="plugins/daterangepicker/daterangepicker.js"></script>
		<!-- Tempusdominus Bootstrap 4 -->
		<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
		<!-- Summernote -->
		<script src="plugins/summernote/summernote-bs4.min.js"></script>
		<!-- overlayScrollbars -->
		<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="dist/js/pages/dashboard.js?v=0.5"></script>
		';
		include('includes/scripts.php');
		?>
		
	</body>

</html>