<!-- Intro Section -->
<section id="intro">
    <div class="video-content">
        <div class="video-image wp1 delay-1s">
            <img src="img/default.jpg" alt="">
        </div>

        <div class="overlay">

            <div class="container-wrapper">
                <div class="container">
                    <div class="col-md-12 wp1 delay-05s">

                        <div class="intro-info-wrapper">
							<?php
							$sql = mysqli_query($con, "SELECT * FROM `filme` WHERE WEEKOFYEAR(inceput) = WEEKOFYEAR(NOW()) AND `premiera` = 1");
							if(mysqli_num_rows($sql) == 1){
								$info = mysqli_fetch_assoc($sql);
							?>
                            <h1 class="text-center"><?php echo $info['titlu']; ?></h1>
                            <div id="owl-intro" class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="clock-wrapper">
                                        <div class="clock"></div>
                                    </div>
                                </div>
								<!--
                                <div class="item">
                                    <p class="font-similar">Urmeaza curând pe data de May 01, 2015
                                    <br> Cel mai bun film din 2019!</p>
                                </div>
								-->
                            </div>
							<?php } else if(mysqli_num_rows($sql) > 1){ ?>
							<h1 class="text-center">Cinema <span class="text-color font-light">Melodia</span></h1>
                            <div id="owl-intro" class="owl-carousel owl-theme">
                                <div class="item">
                                    <p class="font-similar">
										A aparut o eroare (#D62MQ7)<br> va rugam sa contactati administratorul website-ului!
									</p>
                                </div>
                            </div>
							<?php } else { ?>
							<h1 class="text-center">Cinema <span class="text-color font-light">Melodia</span></h1>
                            <div id="owl-intro" class="owl-carousel owl-theme">
                                <div class="item">
                                    <p class="font-similar">Te astepam in cinema
                                        <br> pentru a urmari cele mai noi filme!</p>
                                </div>
                            </div>
							<?php
							}
							?>
                        </div>
                    </div>
                </div>
                <!-- /.intro-info-wrapper -->
				
                <div class="media-btns buttons page-scroll">
					<?php if(mysqli_num_rows($sql) == 1) {?>
                    <a href="rezervare-bilet">
						<div class="btn btn-default play-btn">
							Vezi video<i class="fa fa-play animated"></i>
						</div>
					</a>
                    <a class="btn btn-default about-btn" href="#about">
						Detalii film<i class="fa fa-chevron-right"></i>
					</a>
					<?php } else { ?>
					<a class="btn btn-default about-btn" href="filme">
						Filme actuale<i class="fa fa-chevron-right"></i>
					</a>
					<?php } ?>
                </div>

            </div>
        </div>

    </div>

</section>
<!-- /#intro -->