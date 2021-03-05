<!-- Contact Section -->
<section id="contact">
    <div class="overlay"></div>
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-12 wp11">

                <ul class="social-buttons">
                    <li><a href="https://twitter.com/"><i class="fa fa-twitter fa-fw"></i> <span>Twitter</span></a></li>
                    <li><a href="https://www.facebook.com/"><i class="fa fa-facebook fa-fw"></i> <span>Facebook</span></a></li>
                    <li><a href="https://plus.google.com/"><i class="fa fa-google-plus fa-fw"></i> <span>Google+</span></a></li>
                    <li><a href="https://www.flickr.com/"><i class="fa fa-flickr fa-fw"></i> <span>Flickr</span></a></li>
                    <li><a href="https://youtube.com/"><i class="fa fa-youtube fa-fw"></i> <span>You Tube</span></a></li>
                </ul>

            </div>
            <!-- /.col-lg-12 -->

        </div>
        <!-- /.row -->
        <div class="row">

            <div class="copyright">
                <b>© Cinema Melodia - <?php echo date("Y"); ?></b> | <small>Website realizat de Solomei Ștefan-Lucian</small>
            </div>
            <div class="footer-line"></div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /#contact -->
<!-- Core JavaScript Files -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>

<!-- JavaScript -->
<script src="js/lib/jquery.appear.js"></script>
<script src="js/lib/owl-carousel/owl.carousel.min.js"></script>
<script src="js/lib/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="js/lib/flipclock/flipclock.js"></script>
<script src="js/lib/jquery.animateNumber.js"></script>
<script src="js/lib/waypoints.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/main.js?"></script>
<?php
$sql = mysqli_query($con, "SELECT * FROM `filme` WHERE WEEKOFYEAR(`inceput`) = WEEKOFYEAR(NOW()) AND `premiera` = 1");
$nr = mysqli_num_rows($sql);
if($nr){
	$info = mysqli_fetch_assoc($sql);
	if($nr == 1)
?>
<script>
var clock;


// Grab the current date
var currentDate = new Date();

// Set some date in the future. In this case, it's always Jan 1
futureDate = new Date("<?php echo $info['inceput']; ?>");

// Calculate the difference in seconds between the future and current date
var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

// Instantiate a coutdown FlipClock
if(diff < 0) 
	diff = 0;

clock = $('.clock').FlipClock(diff, {
	clockFace: 'DailyCounter',
	countdown: true
});
</script>
<?php } ?>