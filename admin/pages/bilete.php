<!DOCTYPE html>
<html>
	<?php
	$titlu = "Bilete vândute";
	$css = '
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	';
	include('includes/head.php');
	?>
    <body class="hold-transition sidebar-mini sidebar-collapse">
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
				if($_GET['pagina'] == 'bilete-stergere-succes')
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
							<center><strong>Operațiune reușită!</strong> Biletul respectiv a fost șters cu succes.</center>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
				?>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Bilete rezervate</h3>
								</div>
                                <!-- /.card-header -->
                                <div class="card-body">
									<table id="example2" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>ID</th>
                                                <th>Nume & prenume</th>
                                                <th>Email</th>
                                                <th>Telefon</th>
                                                <th>Nume film</th>
                                                <th>Locuri</th>
                                                <th>Total plată</th>
                                                <th>Dată rezervare</th>
												<th>Acțiune</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql = mysqli_query($con, "SELECT * FROM `rezervari` ORDER BY `id` DESC");
											while($info_rez = mysqli_fetch_assoc($sql)){
												$sql2 = mysqli_query($con, "SELECT `titlu` FROM `filme` WHERE `id` = ". $info_rez['id_film'] ."");
												$info_film = mysqli_fetch_assoc($sql2);
												
												$sql3 = mysqli_query($con, "SELECT `nume`, `prenume`, `email`, `telefon` FROM `utilizatori` WHERE `id` = ". $info_rez['id_user'] ."");
												$info_user = mysqli_fetch_assoc($sql3);
											?>
                                            <tr>
												<td><?php echo (is_numeric($info_rez['id']) && !empty($info_rez['id'])) ? $info_rez['id'] : '<i style="color:red; font-weight:bold;">NULL</i>';?></td>
                                                <td>
													<?php
													echo !empty($info_user['nume']) ? $info_user['nume'].' ' : '<i style="color:red; font-weight:bold;">NULL / </i> ';
													echo !empty($info_user['prenume']) ? $info_user['prenume'] : '<i style="color:red; font-weight:bold;">NULL</i>';
													?>
												</td>
                                                <td><?php echo !empty($info_user['email']) ? $info_user['email'] : '<i style="color:red; font-weight:bold;">NULL</i>';?></td>
                                                <td><?php echo !empty($info_user['telefon']) ? nr_tel($info_user['telefon']) : '<i style="color:red; font-weight:bold;">NULL</i>';?></td>
                                                <td><?php echo !empty($info_film['titlu']) ? $info_film['titlu']: '<i style="color:red; font-weight:bold;">NULL</i>';?></td>
                                                <td><?php echo !empty($info_rez['locuri']) ? $info_rez['locuri']: '<i style="color:red; font-weight:bold;">NULL</i>';?></td>
                                                <td><?php echo !empty($info_rez['pret']) ? $info_rez['pret']: '<i style="color:red; font-weight:bold;">NULL</i>';?> LEI</td>
                                                <td><?php echo strftime("%d %B %Y (%H:%M)", strtotime($info_rez['data_rezervare'])); ?></td>
                                                <td>
													<a href="<?php echo (isset($info_rez['id']) && is_numeric($info_rez['id'])) ? " utilizatori-editare/".$info_rez['id']: '#'; ?>">
														<button class="btn btn-info"><i class="fa fa-edit"></i></button>
                                                    </a>
													<button class="btn btn-danger" data-toggle="modal" data-target="#sterge" onclick="modificare('<?php echo filter_var($info_user['nume'].' '.$info_user['prenume'],FILTER_SANITIZE_SPECIAL_CHARS).'\', \''.$info_rez['id']; ?>');"><i class="fa fa-trash"></i></button>
												</td>
											</tr>
                                            <?php } ?>
										</tbody>
                                        <tfoot>
											<tr>
												<th>ID</th>
                                                <th>Nume & prenume</th>
                                                <th>Email</th>
                                                <th>Telefon</th>
                                                <th>Nume film</th>
                                                <th>Locuri</th>
                                                <th>Total plată</th>
                                                <th>Dată rezervare</th>
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
						<p>Ești sigur că ștergi rezervarea utilizatoruli <u><span id="nume"></span></u>?</p>
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
			$("#link").attr("href", "bilete-stergere/" + id)
		}
	
			$(function() {
                $('#example2').DataTable({
					"paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
						"loadingIndicator": true
					
				});
			});
		</script>
    </body>
</html>