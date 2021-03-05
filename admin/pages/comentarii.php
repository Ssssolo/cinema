<!DOCTYPE html>
<html>
	<?php
	$titlu = "Comentarii";
	$comentarii = 1;
	
	$css = '
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
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
				<?php
				if($_GET['pagina'] == 'comentarii-stergere-succes')
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
							<center><strong>Operațiune reușită!</strong> Comentariul respectiv a fost șters cu succes.</center>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
				?>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Comentarii adăugate</h3>
								</div>
                                <!-- /.card-header -->
                                <div class="card-body">
									<table id="example2" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>ID</th>
                                                <th>Nume & prenume</th>
                                                <th>Titlu articol</th>
                                                <th>Comentariu</th>
                                                <th>Data postare</th>
												<th>Acțiune</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql = mysqli_query($con, "SELECT * FROM `comentarii`");
											while($rand = mysqli_fetch_assoc($sql)){
												$sql2 = mysqli_query($con, "SELECT `id`, `nume`, `prenume` FROM `utilizatori` WHERE `id` = ". $rand['id_utilizator'] ."");
												$info_user = mysqli_fetch_assoc($sql2);
												
												$sql3 = mysqli_query($con, "SELECT `titlu` FROM `articole` WHERE `id` = ". $rand['id_articol'] ."");
												$info_articol = mysqli_fetch_assoc($sql3);
											?>
                                            <tr>
												<td><?php echo (is_numeric($rand['id']) && !empty($rand['id'])) ? $rand['id'] : '<i style="color:red; font-weight:bold;"># Nedefinit</i>';?></td>
                                                <td><?php
												if(!empty($info_user['nume']))
													echo $info_user['nume'].' ';
												
												if(!empty($info_user['prenume']))
													echo $info_user['prenume'];
												
												if(empty($info_user['nume']))
													echo '<i style="color:red"><b>NULL/</b></i>';
												
												if(empty($info_user['prenume']))
													echo '<i style="color:red"><b>NULL</b></i>';
												?></td>
                                                <td><?php echo !empty($info_articol['titlu']) ? $info_articol['titlu'] : '<i style="color:red; font-weight:bold;">Articol șters</i>';?></td>
                                                <td><?php echo !empty($rand['text']) ? $rand['text'] : '<i style="color:red; font-weight:bold;"># Nedefinit</i>';?></td>
                                                <td><?php echo date('d-m-Y H:i', strtotime($rand['data']));?></td>
                                                <td>
													<?php if(!empty($info_articol['titlu'])){ ?>
													<button class="btn btn-info" data-toggle="modal" data-target="#editare" onclick="mod_edit('<?php echo filter_var($rand['text'],FILTER_SANITIZE_SPECIAL_CHARS).'\', \''.$rand['id'].'\' , \''.$info_user['id']; ?>');"><i class="fa fa-edit"></i></button>
													<?php } ?>
													<button class="btn btn-danger" data-toggle="modal" data-target="#sterge" onclick="mod_del('<?php echo filter_var($rand['text'],FILTER_SANITIZE_SPECIAL_CHARS).'\', \''.$rand['id']; ?>');"><i class="fa fa-trash"></i></button>
												</td>
											</tr>
                                            <?php } ?>
										</tbody>
                                        <tfoot>
											<tr>
												<th>ID</th>
                                                <th>Nume & prenume</th>
                                                <th>Titlu articol</th>
                                                <th>Comentariu</th>
                                                <th>Data postare</th>
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
		</div>
		<!-- ./wrapper -->
		
		<!-- Modal editare comentariu-->
		<div class="modal fade" id="editare" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Editare comentariu</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<textarea id="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Anulează</button>
						<button type="button" class="btn btn-info" id="editare_fin" data-id1 data-id2>Editare</button>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal stergere comentariu -->
		<div class="modal fade" id="sterge" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Șterge comentariu</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Ești sigur că ștergi comentariul "<i><span id="comentariu"></span></i>"?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Anulează</button>
						<a href="" id="link"><button type="button" class="btn btn-danger">Șterge</button></a>
					</div>
				</div>
			</div>
		</div>
		<?php 
		include('includes/footer.php');
		$script = '
		<!-- DataTables -->
		<script src="plugins/datatables/jquery.dataTables.js"></script>
		<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
		';
		include('includes/scripts.php');
		?>
		<script type="text/javascript">
		function mod_edit(com, id1, id2){
			$('#text').html(com);
			$("#editare_fin").attr('data-id1', id1);
			$("#editare_fin").attr('data-id2', id2);
		}
		
		function mod_del(com, id){
			$('#comentariu').html(com);
			$("#link").attr("href", "comentarii-stergere/" + id)
		}
		
			$('#editare_fin').click(function() {
				$.ajax({
					url: 'ajax/edit_com.php',
					type: 'POST',
					data: {
						id1: $("#editare_fin").attr('data-id1'),
						id2: $("#editare_fin").attr('data-id2'),
						text: $("#text").val()
					},

					success: function(data) {
						$('#editare').modal('toggle');
						if(data == 1)
							Swal.fire({
							  title: 'Succes!',
							  html: "Comentariul a fost editat cu succes.",
							  icon: 'success',
							  allowOutsideClick: false
							}).then(function (result) {
								if (result.value) {
									window.location = "comentarii";
								}
							})
						else
							Swal.fire({
							  title: 'Eroare!',
							  html: "A apărut o eroare la actualizarea comentariului!",
							  icon: 'error',
							  allowOutsideClick: false
							})
							
					}
				});
			});
	
			$(function() {
                $('#example2').DataTable({
					"paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
				});
			});
		</script>
	</body>

</html>