<!DOCTYPE html>
<html>
	<?php
	$titlu = "Setări articole";
	$setari = 1;
	include('includes/head.php');
	
	$info = json_decode($date_website['articole'], true);
	
	/*
	print_r($info);
	$array = json_decode($date_website['articole'], true);
	$data = array();
	foreach($array as $val){
		foreach($val[0] as $k=>$v){
			$data[$k]=$v;
		}
	}

	var_export($data);
	mysqli_query($con, "UPDATE `setari` SET `articole` = JSON_SET(`articole`,'$.afisare[0].afisare_comentarii',123)");
	*/
	if(isset($_POST['submit1'])){
		
	}
	?>

	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			<?php
			include('includes/navbar.php');
			include('includes/sidebar.php');
			?>
			
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<?php include('includes/content-header.php');?>

				<!-- Main content -->
                <section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<div class="card card-<?php echo culoare_card(isset($_POST['submit1']) ? 1 : 0, $eroare); ?>">
									<div class="card-header">
										<?php echo mesaj_card(isset($_POST['submit1']) ? 1 : 0, $eroare, $eroare, 'Opțiuni afișare'); ?>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-4">
												<!-- Afișare articole -->
												<div class="form-group">
													<label>Afișare articole</label>
														<div class="input-group">
														<input type="checkbox" name="afisare_articole" <?php echo $info['afisare'][0]['afisare_articole'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
											<!-- /.col-md-4 -->
											
											<div class="col-md-4">
												<!-- Afișare vizualizari articol-->
												<div class="form-group">
													<label>Afișare vizualizări</label>
														<div class="input-group">
														<input type="checkbox" name="afisare_vizualizari" <?php echo $info['afisare'][0]['afisare_vizualizari'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
											<!-- /.col-md-4 -->
											
											<div class="col-md-4">
												<!-- Afișare aprecieri articol-->
												<div class="form-group">
													<label>Afișare aprecieri</label>
														<div class="input-group">
														<input type="checkbox" name="afisare_aprecieri" <?php echo $info['afisare'][0]['afisare_aprecieri'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
											<!-- /.col-md-4 -->
										</div>
										<!-- /.col-md-4 -->
										
										<div class="row">
											<div class="col-md-4">
												<!-- Afișare autor articol-->
												<div class="form-group">
													<label>Afișare autor</label>
														<div class="input-group">
														<input type="checkbox" name="afisare_autor" <?php echo $info['afisare'][0]['afisare_autor'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
											<!-- /.col-md-4 -->
											
											<div class="col-md-4">
												<!-- Afișare data postare articol-->
												<div class="form-group">
													<label>Afișare data</label>
														<div class="input-group">
														<input type="checkbox" name="afisare_data" <?php echo $info['afisare'][0]['afisare_data'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
											<!-- /.col-md-4 -->
											
											<div class="col-md-4">
												<!-- Afișare comentarii articol-->
												<div class="form-group">
													<label>Afișare comentarii</label>
														<div class="input-group">
														<input type="checkbox" name="afisare_comentarii" <?php echo $info['afisare'][0]['afisare_comentarii'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
											<!-- /.col-md-4 -->
										</div>
										<!-- /.row -->
										
										<div class="row">
											<div class="col-md-4">
												<!-- Afișare categorii generale-->
												<div class="form-group">
													<label>Afișare categorii</label>
														<div class="input-group">
														<input type="checkbox" name="afisare_categorii" <?php echo $info['afisare'][0]['afisare_categorii'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
											<!-- /.col-md-4 -->
											
											<div class="col-md-4">
												<!-- Afișare postari recente-->
												<div class="form-group">
													<label>Afișare postări recente</label>
														<div class="input-group">
														<input type="checkbox" name="afisare_postari" <?php echo $info['afisare'][0]['afisare_postari'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
											<!-- /.col-md-4 -->
											
											<div class="col-md-4">
												<!-- Afișare tag-uri generale-->
												<div class="form-group">
													<label>Afișare tag-uri</label>
														<div class="input-group">
														<input type="checkbox" name="afisare_taguri" <?php echo $info['afisare'][0]['afisare_taguri'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
											<!-- /.col-md-4 -->
											
											<div class="col-md-4">
												<!-- Afișare tag-uri generale-->
												<div class="form-group">
														<label>Afișare bară căutare</label>
														<div class="input-group">
															<input type="checkbox" name="afisare_search" <?php echo $info['afisare'][0]['afisare_search'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
												<!-- /.col-md-4 -->
										</div>
										<!-- /.row -->
									</div>
                                    <!-- /.card-body -->
								</div>
								<!-- /.card -->
							</div>
                           <!-- /.col (left) -->
						   
							<div class="col-md-6">
								<div class="card card-<?php echo culoare_card(isset($_POST['submit2']) ? 1 : 0, $eroare); ?>">
									<div class="card-header">
										<?php echo mesaj_card(isset($_POST['submit2']) ? 1 : 0, $eroare, $eroare, 'Opțiuni permisiuni'); ?>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-4">
												<!-- Permitere aprecieri-->
												<div class="form-group">
													<label>Permitere aprecieri</label>
														<div class="input-group">
														<input type="checkbox" name="permitere_aprecieri" <?php echo $info['permitere'][0]['permitere_aprecieri'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
											<!-- /.col-md-4 -->
											
											<div class="col-md-4">
												<!-- Permitere comentarii-->
												<div class="form-group">
													<label>Permitere comentarii</label>
														<div class="input-group">
														<input type="checkbox" name="permitere_comentarii" id="test" <?php echo $info['permitere'][0]['permitere_comentarii'] == 1 ? 'checked' : ''; ?> data-bootstrap-switch data-on-color="info">
													</div>
													<!-- /.input group -->
												</div>
												<!-- /.form group -->
											</div>
											<!-- /.col-md-4 -->
										</div>
										<!-- /.row -->	
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
			<!-- /.content-wrapper -->
		</div>
		<!-- ./wrapper -->
		<?php
		$script = '<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>';
		include('includes/footer.php');
		include('includes/scripts.php');
		?>
		<script>
		  $(function () {
			$("input[data-bootstrap-switch]").each(function(){
			  $(this).bootstrapSwitch('state', $(this).prop('checked'));
			});
		  })
		  
		  
		  $("input[type=checkbox]").bootstrapSwitch({
		  onSwitchChange: function(e, state) {
			$(document).ready(function() {
				// alert(state);
				$.ajax({
					type: 'POST',
					url: 'ajax/setari.php',
					data: {actiune: e.target.name, stare: state},
					error: function(xhr, status, error) {
						alert(status);
						alert(xhr.responseText);
					}
				});
			})
		  }
		});
		</script>
	</body>

</html>