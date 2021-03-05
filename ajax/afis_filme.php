<?php
include('../core/database/connect.php');
$zi = $_POST['zi'];

$sql = mysqli_query($con, "SELECT * FROM `filme` WHERE WEEKDAY(`inceput`)+1 = $zi AND YEARWEEK(`inceput`, 1) = YEARWEEK(CURDATE(), 1) ORDER BY `inceput` ASC");

if(!mysqli_num_rows($sql)){
?>
<br>
<center>
	<div class="alert alert-info">
		<i class="fa fa-info-circle"></i> <strong>Info:</strong> În această zi momentan nu s-a găsit niciun film! Vă rugăm să reveniți mai târziu.
	</div>
</center>
<?php
} else
	while($rand = mysqli_fetch_assoc($sql)){
?>
<!--movie-card-->
<div class="movie-card">
	<div class="movie-header manOfSteel">
		<div class="play-container">
			<a href="rezervare-bilet/<?php echo $rand['id']; ?>">
			<i class="material-icons play"></i>
			</a>
		</div>
	</div>
	<!--movie-header-->
	<div class="movie-content">
		<div class="movie-content-header">
			<a href="rezervare-bilet/<?php echo $rand['id']; ?>">
				<h3 class="movie-title"><?php echo $rand['titlu']; ?></h3>
			</a>
			<a href="rezervare-bilet/<?php echo $rand['id']; ?>">
			<button class="btn btn-primary btn-sm imax-logo">Rezervă</button>
			</a>
		</div>
		<div class="movie-info">
			<div class="info-section">
				<label>Data & Ora</label>
				<span>24 feb. ora 10:00</span>
			</div>
			<!-- date, time -->
			<div class="info-section">
				<label>Durată</label>
				<span>260 min.</span>
			</div>
			<!--screen-->
			<div class="info-section">
				<label>Liber</label>
				<span>56 locuri</span>
			</div>
			<!--row-->
			<div class="info-section">
				<label>Preț</label>
				<span>25 LEI</span>
			</div>
			<!--seat-->
		</div>
	</div>
	<!--movie-content-->
</div>
<?php } ?>