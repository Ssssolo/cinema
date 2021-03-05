<!DOCTYPE html>
<html>
	<?php
	$titlu = "Articole";
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
				if($_GET['pagina'] == 'articole-stergere-succes')
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
							<center><strong>Operațiune reușită!</strong> Articolul respectiv a fost șters cu succes.</center>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
				?>
					<!-- Default box -->
					<div class="card card-solid">
						<div class="card-header">
							<div class="row">
								<div class="col-md-11">
									<h3 class="card-title">Articole postate</h3>
								</div>
								<div class="col-md-1">
									<a href="articole-adaugare"><button class="btn btn-primary btn-xs">Adaugă</button></a>
								</div>
							</div>
						</div>
						<div class="card-body pb-0">
							<div id="pagination_data"></div>
						</div>
					</div>
	
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
		</div>
		<!-- ./wrapper -->
		<div class="modal fade" id="sterge" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Ești sigur că ștergi articolul cu titlul  "<u><span id="titlu"></span></u>"?</p>
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
		<script src="plugins/pagination/pagination.js"></script>
		';
		include('includes/scripts.php');
		?>
		<script>
		 $(document).ready(function(){  
			  load_data();  
			  function load_data(page)  
			  {  
				   $.ajax({  
						url:"articole-paginare",  
						method:"POST",  
						data:{page:page},  
						success:function(data){  
							 $('#pagination_data').html(data);  
						}
				   })
			  }  
			  $(document).on('click', '.pagination-link', function(){  
				   var page = $(this).attr("id");
				   load_data(page);  
			  });  
		 });

		function modificare(titlu, id){
			$('#titlu').html(titlu);
			$("#link").attr("href", "articole-stergere/" + id)

		}		 
		 </script>
	</body>
</html>