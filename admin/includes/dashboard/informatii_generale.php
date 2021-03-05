<?php
$nr_bilete = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `rezervari`"));
$nr_utilizatori = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `utilizatori`"));
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $nr_bilete; ?></h3>

                <p>Bilete rezervate</p>
            </div>
            <div class="icon">
                <i class="ion ion-card"></i>
            </div>
            <a href="bilete" class="small-box-footer">Mai multe informații <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Rată rezervare bilete pe lună</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Mai multe informații <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo $nr_utilizatori; ?></h3>

                <p>Înregistrări</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="utilizatori" class="small-box-footer">Mai multe informații <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primrary">
            <div class="inner">
                <h3>65</h3>

                <p>Vizitatori unici / lună</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Mai multe informații <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->