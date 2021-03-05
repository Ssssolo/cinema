<!DOCTYPE html>
<html>
	<?php
	$titlu = "Premieră";
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
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Premiera din săptamana <?php echo date('d', strtotime( 'monday this week')).'-'.date('d', strtotime( 'friday this week')).'.'.date('m.Y'); ?></h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<?php if(!numarare($con,'filme','')) echo 'Nu există niciun film pentru această săptămână!'; else {?>
									<table id="example2" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>ID</th>
												<th>Titlu film</th>
												<th>Regia</th>
												<th>Gen</th>
												<th>Descriere</th>
												<th>Setează</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$sql = mysqli_query($con, "SELECT * FROM `filme` WHERE WEEKOFYEAR(inceput) = WEEKOFYEAR(NOW()) ORDER BY `inceput` ASC");
												
												if(mysqli_num_rows($sql)){
													while($rand = mysqli_fetch_assoc($sql)){
												?>
											<tr id="id">
												<td><?php echo (is_numeric($rand['id']) && !empty($rand['id'])) ? $rand['id'] : '<i style="color:red; font-weight:bold;"># Nedefinit</i>';?></td>
												<td><?php echo !empty($rand['titlu']) ? $rand['titlu'] : '<i style="color:red; font-weight:bold;"># Nedefinit</i>';?></td>
												<td><?php echo !empty($rand['regia']) ? $rand['regia'] : '<i style="color:red; font-weight:bold;"># Nedefinit</i>';?></td>
												<td><?php echo !empty($rand['gen']) ? $rand['gen'] : '<i style="color:red; font-weight:bold;"># Nedefinit</i>';?></td>
												<td><?php echo !empty($rand['descriere']) ? $rand['descriere'] : '<i style="color:red; font-weight:bold;"># Nedefinit</i>';?></td>
												<td>
													<button class="btn btn-<?php echo ($rand['premiera'] == 1) ? 'warning' : 'danger'; ?>" id="test<?php echo $rand['id']; ?>" onclick="seteaza('<?php echo $rand['id']; ?>')"><i class="fa fa-star"></i></button>
												</td>
											</tr>
											<?php
												}
											} else {
											?>
											<tr>
												<td>#</td>
												<td>Nu există niciun film în această săptămână.</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
											</tr>
											<?php } ?>
										</tbody>
										<tfoot>
											<tr>
												<th>ID</th>
												<th>Nume</th>
												<th>Prenume</th>
												<th>Email</th>
												<th>Activ</th>
												<th>Setează</th>
											</tr>
										</tfoot>
									</table>
									<?php } ?>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
		</div>
		<!-- ./wrapper -->
		<?php 
		include('includes/footer.php');
		include('includes/scripts.php');
		?>
		<script>
		
		function seteaza(fid){
			$.ajax({
				url: "ajax/premiera.php",
				type: "POST",
				data: {id: fid},
				dataType: "json",
				error: function(xhr, status, error) {
                    alert(status);
                    alert(xhr.responseText);
                },
				success: function(x) {
					if(x.stare)
						$('#test'+x.id).removeClass().addClass('btn btn-warning');
					else
						$('#test'+x.id).removeClass().addClass('btn btn-danger');
				}
			});
		}
	</script>
	</body>
	
	
	

</html>