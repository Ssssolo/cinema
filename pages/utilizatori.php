<!DOCTYPE html>
<html>
	<?php
	$titlu = "Utilizatori";
	$css = '
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	';
	include('includes/head.php');
	include('functions/general.php');
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
				<?php
				if($_GET['pagina'] == 'utilizatori-stergere-succes')
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
							<center><strong>Operațiune reușită!</strong> Utilizatorul respectiv a fost șters cu succes.</center>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
				?>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Utilizatori înregistrați</h3>
								</div>
                                <!-- /.card-header -->
                                <div class="card-body">
									<table id="example2" class="table table-bordered responsive table-striped">
										<thead>
											<tr><th>ID</th>
                                                <th>Nume</th>
                                                <th>Prenume</th>
                                                <th>Email</th>
                                                <th>Activ</th>
                                                <th>Acces</th>
												<th>Acțiune</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql = mysqli_query($con, "SELECT * FROM `utilizatori`");
											while($rand = mysqli_fetch_assoc($sql)){
											?>
                                            <tr>
												<td><?php echo (is_numeric($rand['id']) && !empty($rand['id'])) ? $rand['id'] : '<i style="color:red; font-weight:bold;"># Nedefinit</i>';?></td>
                                                <td><?php echo !empty($rand['nume']) ? $rand['nume'] : '<i style="color:red; font-weight:bold;"># Nedefinit</i>';?></td>
                                                <td><?php echo !empty($rand['prenume']) ? $rand['prenume'] : '<i style="color:red; font-weight:bold;"># Nedefinit</i>';?></td>
                                                <td><?php echo !empty($rand['email']) ? $rand['email'] : '<i style="color:red; font-weight:bold;"># Nedefinit</i>';?></td>
                                                <td><?php
													if($rand['activ'] > 1 || $rand['activ'] < 0) 
														echo '<i style="color:red; font-weight:bold;"># Eroare</i>';
													else{
														if(!$rand['activ'])
															echo "Inactiv";
														else
															echo "Activ";
													}
													?></td>
                                                <td><?php
														if($rand['acces'] == 0)
															echo 'Utilizator';
														else
															if($rand['acces'] == 1)
																echo 'Administrator';
														else
															if($rand['acces'] == -1)
																echo 'Banat';
														else
															echo '<i style="color:red; font-weight:bold;"># Eroare</i>';
													?></td>
                                                <td>
													<a href="<?php echo (isset($rand['id']) && is_numeric($rand['id'])) ? " utilizatori-editare/".$rand['id']: '#'; ?>">
														<button class="btn btn-info"><i class="fa fa-edit"></i></button>
                                                    </a>
													<?php if($rand['id'] != $_SESSION['admin']){ ?>
													<button class="btn btn-danger" data-toggle="modal" data-target="#sterge" onclick="modificare('<?php echo filter_var($rand['nume'].' '.$rand['prenume'],FILTER_SANITIZE_SPECIAL_CHARS).'\', \''.$rand['id']; ?>');"><i class="fa fa-trash"></i></button>
													<?php } ?>
												</td>
											</tr>
                                            <?php } ?>
										</tbody>
                                        <tfoot>
											<tr><th>ID</th>
                                                <th>Nume</th>
                                                <th>Prenume</th>
                                                <th>Email</th>
                                                <th>Activ</th>
                                                <th>Acțiune</th>
											</tr>
										</tfoot>
									</table>
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
            <?php include('includes/footer.php'); ?>
		</div>
        <!-- ./wrapper -->
		<div class="modal fade" id="sterge" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Șterge utilizator</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Ești sigur că ștergi utilizatorul <u><span id="nume"></span></u>?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Anulează</button>
						<a href="" id="link"><button type="button" class="btn btn-danger">Șterge</button></a>
					</div>
				</div>
			</div>
		</div>
        <?php
		$script = '
		<!-- DataTables -->
		<script src="plugins/datatables/jquery.dataTables.js"></script>
		<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
		';
		include('includes/scripts.php');
		?>
        <script type="text/javascript">
		function modificare(nume, id){
			$('#nume').html(nume);
			$("#link").attr("href", "utilizatori-stergere/" + id)
		}
	
		$(document).ready(function() {
                $('#example2').DataTable({
					responsive: true,
					"paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
				});
			});
		</script>
    </body>
</html>