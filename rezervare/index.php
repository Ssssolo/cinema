<?php
if(!logat())
	header('Location: ../login');

if($_GET['id'] == NULL)
	header('Location: filme');

$sql = mysqli_query($con, "SELECT * FROM `filme` WHERE `id` = '". $_GET['id'] ."'");
if(!mysqli_num_rows($sql))
	header('Location: ../filme');

$rand = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Rezervare locuri | <?php echo $date_website['titlu']; ?></title>
		<base href="<?php echo $date_website['url']; ?>/rezervare">
		<meta name="description" content="An experimental demo where a 3D perspective preview is shown for a selected seat in a cinema room." />
		<meta name="keywords" content="cinema, seat booking, seating plan, perspective, 3d" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" type="text/css" href="rezervare/css/normalize.css?v=0.1" />
		<link rel="stylesheet" type="text/css" href="rezervare/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="rezervare/css/component.css?v=0.4" />
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
		<script src="rezervare/js/modernizr-custom.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.min.css">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>

	</head>
	<body>
		<header class="header">
			<div class="codrops-links">
				<a class="codrops-icon codrops-icon--prev" href="filme" title="Înapoi la filmele săptămânale"><span>Înapoi la filmele săptămânale</span></a>
				<a href="blog" title="Înapoi la blog"><i class="fa fa-newspaper-o fa-2" aria-hidden="true"></i></a>
			</div>
			<h1 class="header__title">Cinema Melodia</h1>
			<p class="note note--screen">Vizualizați de pe un dispozitiv mai mare pentru a vedea sala 3D</p>
			<p class="note note--support">Ne pare rău dar browser-ul dvs. nu suportă prezentarea 3D!</p>
		</header>
		<div class="container">
			<div class="cube">
				<div class="cube__side cube__side--front"></div>
				<div class="cube__side cube__side--back">
					<div class="screen">
						<div class="video">
							<iframe id="yt" class="video-player" src="https://www.youtube.com/embed/6QiVSub-U8E" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							<button hidden id="btn" class="action action--play action--shown" aria-label="Play Video"></button>
						</div>
						<div class="intro intro--shown">
							<div class="intro__side">
								<h2 class="intro__title">
									<span class="intro__up">Cinema Melodia <em>prezintă</em></span>
									<span class="intro__down"><?php echo !empty($rand['titlu']) ? $rand['titlu'] : '# Nedefinit'; ?> <span class="intro__partial"><em>regia</em> <a href="#"><?php echo !empty($rand['regia']) ? $rand['titlu'] : '# Nedefinit'; ?></a></span></span>
								</h2>
							</div>
							<div class="intro__side">
								<button class="action action--seats">Rezervați-vă locurile</button>
							</div>
						</div>
					</div>
				</div>
				<div class="cube__side cube__side--left"></div>
				<div class="cube__side cube__side--right"></div>
				<div class="cube__side cube__side--top"></div>
				<div class="rows rows--large">
					<div class="row">
						<div data-seat="A1" class="row__seat"></div>
						<div data-seat="A2" class="row__seat"></div>
						<div data-seat="A3" class="row__seat"></div>
						<div data-seat="A4" class="row__seat"></div>
						<div data-seat="A5" class="row__seat"></div>
						<div data-seat="A6" class="row__seat"></div>
						<div data-seat="A7" class="row__seat"></div>
						<div data-seat="A8" class="row__seat"></div>
						<div data-seat="A9" class="row__seat"></div>
						<div data-seat="A10" class="row__seat"></div>
						<div data-seat="A11" class="row__seat"></div>
						<div data-seat="A12" class="row__seat"></div>
						<div data-seat="A13" class="row__seat"></div>
						<div data-seat="A14" class="row__seat"></div>
						<div data-seat="A15" class="row__seat"></div>
						<div data-seat="A16" class="row__seat"></div>
						<div data-seat="A17" class="row__seat"></div>
						<div data-seat="A18" class="row__seat"></div>
						<div data-seat="A19" class="row__seat"></div>
					</div>
					<div class="row">
						<div data-seat="B1" class="row__seat"></div>
						<div data-seat="B2" class="row__seat"></div>
						<div data-seat="B3" class="row__seat"></div>
						<div data-seat="B4" class="row__seat"></div>
						<div data-seat="B5" class="row__seat"></div>
						<div data-seat="B6" class="row__seat"></div>
						<div data-seat="B7" class="row__seat"></div>
						<div data-seat="B8" class="row__seat"></div>
						<div data-seat="B9" class="row__seat"></div>
						<div data-seat="B10" class="row__seat"></div>
						<div data-seat="B11" class="row__seat"></div>
						<div data-seat="B12" class="row__seat"></div>
						<div data-seat="B13" class="row__seat"></div>
						<div data-seat="B14" class="row__seat"></div>
						<div data-seat="B15" class="row__seat"></div>
						<div data-seat="B16" class="row__seat"></div>
						<div data-seat="B17" class="row__seat"></div>
						<div data-seat="B18" class="row__seat"></div>
					</div>
					<div class="row">
						<div data-seat="C1" class="row__seat"></div>
						<div data-seat="C2" class="row__seat"></div>
						<div data-seat="C3" class="row__seat"></div>
						<div data-seat="C4" class="row__seat"></div>
						<div data-seat="C5" class="row__seat"></div>
						<div data-seat="C6" class="row__seat"></div>
						<div data-seat="C7" class="row__seat"></div>
						<div data-seat="C8" class="row__seat"></div>
						<div data-seat="C9" class="row__seat"></div>
						<div data-seat="C10" class="row__seat"></div>
						<div data-seat="C11" class="row__seat"></div>
						<div data-seat="C12" class="row__seat"></div>
						<div data-seat="C13" class="row__seat"></div>
						<div data-seat="C14" class="row__seat"></div>
						<div data-seat="C15" class="row__seat"></div>
						<div data-seat="C16" class="row__seat"></div>
						<div data-seat="C17" class="row__seat"></div>
						<div data-seat="C18" class="row__seat"></div>
						<div data-seat="C19" class="row__seat"></div>
					</div>
					<div class="row">
						<div data-seat="D1" class="row__seat"></div>
						<div data-seat="D2" class="row__seat"></div>
						<div data-seat="D3" class="row__seat"></div>
						<div data-seat="D4" class="row__seat"></div>
						<div data-seat="D5" class="row__seat"></div>
						<div data-seat="D6" class="row__seat"></div>
						<div data-seat="D7" class="row__seat"></div>
						<div data-seat="D8" class="row__seat"></div>
						<div data-seat="D9" class="row__seat"></div>
						<div data-seat="D10" class="row__seat"></div>
						<div data-seat="D11" class="row__seat"></div>
						<div data-seat="D12" class="row__seat"></div>
						<div data-seat="D13" class="row__seat"></div>
						<div data-seat="D14" class="row__seat"></div>
						<div data-seat="D15" class="row__seat"></div>
						<div data-seat="D16" class="row__seat"></div>
						<div data-seat="D17" class="row__seat"></div>
						<div data-seat="D18" class="row__seat"></div>
					</div>
					<div class="row">
						<div data-seat="E1" class="row__seat"></div>
						<div data-seat="E2" class="row__seat"></div>
						<div data-seat="E3" class="row__seat"></div>
						<div data-seat="E4" class="row__seat"></div>
						<div data-seat="E5" class="row__seat"></div>
						<div data-seat="E6" class="row__seat"></div>
						<div data-seat="E7" class="row__seat"></div>
						<div data-seat="E8" class="row__seat"></div>
						<div data-seat="E9" class="row__seat"></div>
						<div data-seat="E10" class="row__seat"></div>
						<div data-seat="E11" class="row__seat"></div>
						<div data-seat="E12" class="row__seat"></div>
						<div data-seat="E13" class="row__seat"></div>
						<div data-seat="E14" class="row__seat"></div>
						<div data-seat="E15" class="row__seat"></div>
						<div data-seat="E16" class="row__seat"></div>
						<div data-seat="E17" class="row__seat"></div>
						<div data-seat="E18" class="row__seat"></div>
						<div data-seat="E19" class="row__seat"></div>
					</div>
					<div class="row">
						<div data-seat="F1" class="row__seat"></div>
						<div data-seat="F2" class="row__seat"></div>
						<div data-seat="F3" class="row__seat"></div>
						<div data-seat="F4" class="row__seat"></div>
						<div data-seat="F5" class="row__seat"></div>
						<div data-seat="F6" class="row__seat"></div>
						<div data-seat="F7" class="row__seat"></div>
						<div data-seat="F8" class="row__seat"></div>
						<div data-seat="F9" class="row__seat"></div>
						<div data-seat="F10" class="row__seat"></div>
						<div data-seat="F11" class="row__seat"></div>
						<div data-seat="F12" class="row__seat"></div>
						<div data-seat="F13" class="row__seat"></div>
						<div data-seat="F14" class="row__seat"></div>
						<div data-seat="F15" class="row__seat"></div>
						<div data-seat="F16" class="row__seat"></div>
						<div data-seat="F17" class="row__seat"></div>
						<div data-seat="F18" class="row__seat"></div>
					</div>
					<div class="row">
						<div data-seat="G1" class="row__seat"></div>
						<div data-seat="G2" class="row__seat"></div>
						<div data-seat="G3" class="row__seat"></div>
						<div data-seat="G4" class="row__seat"></div>
						<div data-seat="G5" class="row__seat"></div>
						<div data-seat="G6" class="row__seat"></div>
						<div data-seat="G7" class="row__seat"></div>
						<div data-seat="G8" class="row__seat"></div>
						<div data-seat="G9" class="row__seat"></div>
						<div data-seat="G10" class="row__seat"></div>
						<div data-seat="G11" class="row__seat"></div>
						<div data-seat="G12" class="row__seat"></div>
						<div data-seat="G13" class="row__seat"></div>
						<div data-seat="G14" class="row__seat"></div>
						<div data-seat="G15" class="row__seat"></div>
						<div data-seat="G16" class="row__seat"></div>
						<div data-seat="G17" class="row__seat"></div>
						<div data-seat="G18" class="row__seat"></div>
						<div data-seat="G19" class="row__seat"></div>
					</div>
					<div class="row">
						<div data-seat="H1" class="row__seat"></div>
						<div data-seat="H2" class="row__seat"></div>
						<div data-seat="H3" class="row__seat"></div>
						<div data-seat="H4" class="row__seat"></div>
						<div data-seat="H5" class="row__seat"></div>
						<div data-seat="H6" class="row__seat"></div>
						<div data-seat="H7" class="row__seat"></div>
						<div data-seat="H8" class="row__seat"></div>
						<div data-seat="H9" class="row__seat"></div>
						<div data-seat="H10" class="row__seat"></div>
						<div data-seat="H11" class="row__seat"></div>
						<div data-seat="H12" class="row__seat"></div>
						<div data-seat="H13" class="row__seat"></div>
						<div data-seat="H14" class="row__seat"></div>
						<div data-seat="H15" class="row__seat"></div>
						<div data-seat="H16" class="row__seat"></div>
						<div data-seat="H17" class="row__seat"></div>
						<div data-seat="H18" class="row__seat"></div>
					</div>
					<div class="row">
						<div data-seat="I1" class="row__seat"></div>
						<div data-seat="I2" class="row__seat"></div>
						<div data-seat="I3" class="row__seat"></div>
						<div data-seat="I4" class="row__seat"></div>
						<div data-seat="I5" class="row__seat"></div>
						<div data-seat="I6" class="row__seat"></div>
						<div data-seat="I7" class="row__seat"></div>
						<div data-seat="I8" class="row__seat"></div>
						<div data-seat="I9" class="row__seat"></div>
						<div data-seat="I10" class="row__seat"></div>
						<div data-seat="I11" class="row__seat"></div>
						<div data-seat="I12" class="row__seat"></div>
						<div data-seat="I13" class="row__seat"></div>
						<div data-seat="I14" class="row__seat"></div>
						<div data-seat="I15" class="row__seat"></div>
						<div data-seat="I16" class="row__seat"></div>
						<div data-seat="I17" class="row__seat"></div>
						<div data-seat="I19" class="row__seat"></div>
					</div>
					<div class="row">
						<div data-seat="J1" class="row__seat"></div>
						<div data-seat="J2" class="row__seat"></div>
						<div data-seat="J3" class="row__seat"></div>
						<div data-seat="J4" class="row__seat"></div>
						<div data-seat="J5" class="row__seat"></div>
						<div data-seat="J6" class="row__seat"></div>
						<div data-seat="J7" class="row__seat"></div>
						<div data-seat="J8" class="row__seat"></div>
						<div data-seat="J9" class="row__seat"></div>
						<div data-seat="J10" class="row__seat"></div>
						<div data-seat="J11" class="row__seat"></div>
						<div data-seat="J12" class="row__seat"></div>
						<div data-seat="J13" class="row__seat"></div>
						<div data-seat="J14" class="row__seat"></div>
						<div data-seat="J15" class="row__seat"></div>
						<div data-seat="J16" class="row__seat"></div>
						<div data-seat="J17" class="row__seat"></div>
						<div data-seat="J18" class="row__seat"></div>
					</div>
					<div class="row">
						<div data-seat="K1" class="row__seat"></div>
						<div data-seat="K2" class="row__seat"></div>
						<div data-seat="K3" class="row__seat"></div>
						<div data-seat="K4" class="row__seat"></div>
						<div data-seat="K5" class="row__seat"></div>
						<div data-seat="K6" class="row__seat"></div>
						<div data-seat="K7" class="row__seat"></div>
						<div data-seat="K8" class="row__seat"></div>
						<div data-seat="K9" class="row__seat"></div>
						<div data-seat="K10" class="row__seat"></div>
						<div data-seat="K11" class="row__seat"></div>
						<div data-seat="K12" class="row__seat"></div>
					</div>
				</div>
				<!-- /rows -->
			</div><!-- /cube -->
		</div><!-- /container -->
		<div class="plan">
			<h3 class="plan__title">Planul sălii de cinema</h3>
			<div class="rows rows--mini">
				<div class="row">
					<div class="row__seat tooltip" data-tooltip="A1"></div>
					<div class="row__seat tooltip" data-tooltip="A2"></div>
					<div class="row__seat tooltip" data-tooltip="A3"></div>
					<div class="row__seat tooltip" data-tooltip="A4"></div>
					<div class="row__seat tooltip" data-tooltip="A5"></div>
					<div class="row__seat tooltip" data-tooltip="A6"></div>
					<div class="row__seat tooltip" data-tooltip="A7"></div>
					<div class="row__seat tooltip" data-tooltip="A8"></div>
					<div class="row__seat tooltip" data-tooltip="A9"></div>
					<div class="row__seat tooltip" data-tooltip="A10"></div>
					<div class="row__seat tooltip" data-tooltip="A11"></div>
					<div class="row__seat tooltip" data-tooltip="A12"></div>
					<div class="row__seat tooltip" data-tooltip="A13"></div>
					<div class="row__seat tooltip" data-tooltip="A14"></div>
					<div class="row__seat tooltip" data-tooltip="A15"></div>
					<div class="row__seat tooltip" data-tooltip="A16"></div>
					<div class="row__seat tooltip" data-tooltip="A17"></div>
					<div class="row__seat tooltip" data-tooltip="A18"></div>
					<div class="row__seat tooltip" data-tooltip="A19"></div>
				</div>
				<div class="row">
					<div class="row__seat tooltip" data-tooltip="B1"></div>
					<div class="row__seat tooltip" data-tooltip="B2"></div>
					<div class="row__seat tooltip" data-tooltip="B3"></div>
					<div class="row__seat tooltip" data-tooltip="B4"></div>
					<div class="row__seat tooltip" data-tooltip="B5"></div>
					<div class="row__seat tooltip" data-tooltip="B6"></div>
					<div class="row__seat tooltip" data-tooltip="B7"></div>
					<div class="row__seat tooltip" data-tooltip="B8"></div>
					<div class="row__seat tooltip" data-tooltip="B9"></div>
					<div class="row__seat tooltip" data-tooltip="B10"></div>
					<div class="row__seat tooltip" data-tooltip="B11"></div>
					<div class="row__seat tooltip" data-tooltip="B12"></div>
					<div class="row__seat tooltip" data-tooltip="B13"></div>
					<div class="row__seat tooltip" data-tooltip="B14"></div>
					<div class="row__seat tooltip" data-tooltip="B15"></div>
					<div class="row__seat tooltip" data-tooltip="B16"></div>
					<div class="row__seat tooltip" data-tooltip="B17"></div>
					<div class="row__seat tooltip" data-tooltip="B18"></div>
				</div>
				<div class="row">
					<div class="row__seat tooltip" data-tooltip="C1"></div>
					<div class="row__seat tooltip" data-tooltip="C2"></div>
					<div class="row__seat tooltip" data-tooltip="C3"></div>
					<div class="row__seat tooltip" data-tooltip="C4"></div>
					<div class="row__seat tooltip" data-tooltip="C5"></div>
					<div class="row__seat tooltip" data-tooltip="C6"></div>
					<div class="row__seat tooltip" data-tooltip="C7"></div>
					<div class="row__seat tooltip" data-tooltip="C8"></div>
					<div class="row__seat tooltip" data-tooltip="C9"></div>
					<div class="row__seat tooltip" data-tooltip="C10"></div>
					<div class="row__seat tooltip" data-tooltip="C11"></div>
					<div class="row__seat tooltip" data-tooltip="C12"></div>
					<div class="row__seat tooltip" data-tooltip="C13"></div>
					<div class="row__seat tooltip" data-tooltip="C14"></div>
					<div class="row__seat tooltip" data-tooltip="C15"></div>
					<div class="row__seat tooltip" data-tooltip="C16"></div>
					<div class="row__seat tooltip" data-tooltip="C17"></div>
					<div class="row__seat tooltip" data-tooltip="C18"></div>
					<div class="row__seat tooltip" data-tooltip="C19"></div>
				</div>
				<div class="row">
					<div class="row__seat tooltip" data-tooltip="D1"></div>
					<div class="row__seat tooltip" data-tooltip="D2"></div>
					<div class="row__seat tooltip" data-tooltip="D3"></div>
					<div class="row__seat tooltip" data-tooltip="D4"></div>
					<div class="row__seat tooltip" data-tooltip="D5"></div>
					<div class="row__seat tooltip" data-tooltip="D6"></div>
					<div class="row__seat tooltip" data-tooltip="D7"></div>
					<div class="row__seat tooltip" data-tooltip="D8"></div>
					<div class="row__seat tooltip" data-tooltip="D9"></div>
					<div class="row__seat tooltip" data-tooltip="D10"></div>
					<div class="row__seat tooltip" data-tooltip="D11"></div>
					<div class="row__seat tooltip" data-tooltip="D12"></div>
					<div class="row__seat tooltip" data-tooltip="D13"></div>
					<div class="row__seat tooltip" data-tooltip="D14"></div>
					<div class="row__seat tooltip" data-tooltip="D15"></div>
					<div class="row__seat tooltip" data-tooltip="D16"></div>
					<div class="row__seat tooltip" data-tooltip="D17"></div>
					<div class="row__seat tooltip" data-tooltip="D18"></div>
				</div>
				<div class="row">
					<div class="row__seat tooltip" data-tooltip="E1"></div>
					<div class="row__seat tooltip" data-tooltip="E2"></div>
					<div class="row__seat tooltip" data-tooltip="E3"></div>
					<div class="row__seat tooltip" data-tooltip="E4"></div>
					<div class="row__seat tooltip" data-tooltip="E5"></div>
					<div class="row__seat tooltip" data-tooltip="E6"></div>
					<div class="row__seat tooltip" data-tooltip="E7"></div>
					<div class="row__seat tooltip" data-tooltip="E8"></div>
					<div class="row__seat tooltip" data-tooltip="E9"></div>
					<div class="row__seat tooltip" data-tooltip="E10"></div>
					<div class="row__seat tooltip" data-tooltip="E11"></div>
					<div class="row__seat tooltip" data-tooltip="E12"></div>
					<div class="row__seat tooltip" data-tooltip="E13"></div>
					<div class="row__seat tooltip" data-tooltip="E14"></div>
					<div class="row__seat tooltip" data-tooltip="E15"></div>
					<div class="row__seat tooltip" data-tooltip="E16"></div>
					<div class="row__seat tooltip" data-tooltip="E17"></div>
					<div class="row__seat tooltip" data-tooltip="E18"></div>
					<div class="row__seat tooltip" data-tooltip="E19"></div>
				</div>
				<div class="row">
					<div class="row__seat tooltip" data-tooltip="F1"></div>
					<div class="row__seat tooltip" data-tooltip="F2"></div>
					<div class="row__seat tooltip" data-tooltip="F3"></div>
					<div class="row__seat tooltip" data-tooltip="F4"></div>
					<div class="row__seat tooltip" data-tooltip="F5"></div>
					<div class="row__seat tooltip" data-tooltip="F6"></div>
					<div class="row__seat tooltip" data-tooltip="F7"></div>
					<div class="row__seat tooltip" data-tooltip="F8"></div>
					<div class="row__seat tooltip" data-tooltip="F9"></div>
					<div class="row__seat tooltip" data-tooltip="F10"></div>
					<div class="row__seat tooltip" data-tooltip="F11"></div>
					<div class="row__seat tooltip" data-tooltip="F12"></div>
					<div class="row__seat tooltip" data-tooltip="F13"></div>
					<div class="row__seat tooltip" data-tooltip="F14"></div>
					<div class="row__seat tooltip" data-tooltip="F15"></div>
					<div class="row__seat tooltip" data-tooltip="F16"></div>
					<div class="row__seat tooltip" data-tooltip="F17"></div>
					<div class="row__seat tooltip" data-tooltip="F18"></div>
				</div>
				<div class="row">
					<div class="row__seat tooltip" data-tooltip="G1"></div>
					<div class="row__seat tooltip" data-tooltip="G2"></div>
					<div class="row__seat tooltip" data-tooltip="G3"></div>
					<div class="row__seat tooltip" data-tooltip="G4"></div>
					<div class="row__seat tooltip" data-tooltip="G5"></div>
					<div class="row__seat tooltip" data-tooltip="G6"></div>
					<div class="row__seat tooltip" data-tooltip="G7"></div>
					<div class="row__seat tooltip" data-tooltip="G8"></div>
					<div class="row__seat tooltip" data-tooltip="G9"></div>
					<div class="row__seat tooltip" data-tooltip="G10"></div>
					<div class="row__seat tooltip" data-tooltip="G11"></div>
					<div class="row__seat tooltip" data-tooltip="G12"></div>
					<div class="row__seat tooltip" data-tooltip="G13"></div>
					<div class="row__seat tooltip" data-tooltip="G14"></div>
					<div class="row__seat tooltip" data-tooltip="G15"></div>
					<div class="row__seat tooltip" data-tooltip="G16"></div>
					<div class="row__seat tooltip" data-tooltip="G17"></div>
					<div class="row__seat tooltip" data-tooltip="G18"></div>
					<div class="row__seat tooltip" data-tooltip="G19"></div>
				</div>
				<div class="row">
					<div class="row__seat tooltip" data-tooltip="H1"></div>
					<div class="row__seat tooltip" data-tooltip="H2"></div>
					<div class="row__seat tooltip" data-tooltip="H3"></div>
					<div class="row__seat tooltip" data-tooltip="H4"></div>
					<div class="row__seat tooltip" data-tooltip="H5"></div>
					<div class="row__seat tooltip" data-tooltip="H6"></div>
					<div class="row__seat tooltip" data-tooltip="H7"></div>
					<div class="row__seat tooltip" data-tooltip="H8"></div>
					<div class="row__seat tooltip" data-tooltip="H9"></div>
					<div class="row__seat tooltip" data-tooltip="H10"></div>
					<div class="row__seat tooltip" data-tooltip="H11"></div>
					<div class="row__seat tooltip" data-tooltip="H12"></div>
					<div class="row__seat tooltip" data-tooltip="H13"></div>
					<div class="row__seat tooltip" data-tooltip="H14"></div>
					<div class="row__seat tooltip" data-tooltip="H15"></div>
					<div class="row__seat tooltip" data-tooltip="H16"></div>
					<div class="row__seat tooltip" data-tooltip="H17"></div>
					<div class="row__seat tooltip" data-tooltip="H18"></div>
				</div>
				<div class="row">
					<div class="row__seat tooltip" data-tooltip="I1"></div>
					<div class="row__seat tooltip" data-tooltip="I2"></div>
					<div class="row__seat tooltip" data-tooltip="I3"></div>
					<div class="row__seat tooltip" data-tooltip="I4"></div>
					<div class="row__seat tooltip" data-tooltip="I5"></div>
					<div class="row__seat tooltip" data-tooltip="I6"></div>
					<div class="row__seat tooltip" data-tooltip="I7"></div>
					<div class="row__seat tooltip" data-tooltip="I8"></div>
					<div class="row__seat tooltip" data-tooltip="I9"></div>
					<div class="row__seat tooltip" data-tooltip="I10"></div>
					<div class="row__seat tooltip" data-tooltip="I11"></div>
					<div class="row__seat tooltip" data-tooltip="I12"></div>
					<div class="row__seat tooltip" data-tooltip="I13"></div>
					<div class="row__seat tooltip" data-tooltip="I14"></div>
					<div class="row__seat tooltip" data-tooltip="I15"></div>
					<div class="row__seat tooltip" data-tooltip="I16"></div>
					<div class="row__seat tooltip" data-tooltip="I17"></div>
					<div class="row__seat tooltip" data-tooltip="I18"></div>
					<div class="row__seat tooltip" data-tooltip="I19"></div>
				</div>
				<div class="row">
					<div class="row__seat tooltip" data-tooltip="J1"></div>
					<div class="row__seat tooltip" data-tooltip="J2"></div>
					<div class="row__seat tooltip" data-tooltip="J3"></div>
					<div class="row__seat tooltip" data-tooltip="J4"></div>
					<div class="row__seat tooltip" data-tooltip="J5"></div>
					<div class="row__seat tooltip" data-tooltip="J6"></div>
					<div class="row__seat tooltip" data-tooltip="J7"></div>
					<div class="row__seat tooltip" data-tooltip="J8"></div>
					<div class="row__seat tooltip" data-tooltip="J9"></div>
					<div class="row__seat tooltip" data-tooltip="J10"></div>
					<div class="row__seat tooltip" data-tooltip="J11"></div>
					<div class="row__seat tooltip" data-tooltip="J12"></div>
					<div class="row__seat tooltip" data-tooltip="J13"></div>
					<div class="row__seat tooltip" data-tooltip="J14"></div>
					<div class="row__seat tooltip" data-tooltip="J15"></div>
					<div class="row__seat tooltip" data-tooltip="J16"></div>
					<div class="row__seat tooltip" data-tooltip="J17"></div>
					<div class="row__seat tooltip" data-tooltip="J18"></div>
				</div>
				<div class="row">
					<div class="row__seat tooltip" data-tooltip="K1"></div>
					<div class="row__seat tooltip" data-tooltip="K2"></div>
					<div class="row__seat tooltip" data-tooltip="K3"></div>
					<div class="row__seat tooltip" data-tooltip="K4"></div>
					<div class="row__seat tooltip" data-tooltip="K5"></div>
					<div class="row__seat tooltip" data-tooltip="K6"></div>
					<div class="row__seat tooltip" data-tooltip="K7"></div>
					<div class="row__seat tooltip" data-tooltip="K8"></div>
					<div class="row__seat tooltip" data-tooltip="K9"></div>
					<div class="row__seat tooltip" data-tooltip="K10"></div>
					<div class="row__seat tooltip" data-tooltip="K11"></div>
					<div class="row__seat tooltip" data-tooltip="K12"></div>
				</div>
			</div>
			<!-- /rows -->
			<ul class="legend">
				<li class="legend__item legend__item--free">Liber</li>
				<li class="legend__item legend__item--reserved">Rezervat</li>
				<li class="legend__item legend__item--selected">Selectat</li>
			</ul>
			<button id="rezerva" class="action action--buy">Rezervă locuri</button>
		</div><!-- /plan -->
		<button class="action action--lookaround " arial-label="Unlook View"></button>
		
		<script>
		//Completare locuri_rez rezervate
		$.ajax({  
			type: 'GET',
			url: 'rezervare/ajax/locuri_rezervate.php', 
			data: { id: <?php echo $_GET['id']; ?>, uid: <?php echo $date_utilizator['id']; ?>},
			dataType:"json",
			success: function(raspuns) {
				if(raspuns){
					let locuri_ocupate = raspuns.split(',');

					$(".tooltip").each(function() {
						var loc_actual = $(this).data("tooltip");
						if(jQuery.inArray(loc_actual, locuri_ocupate) !== -1){
							$(this).removeClass("tooltip")
							$(this).last().addClass("row__seat--reserved");
						}

					});
				}
			},
			error: function (request, status, error) {
				Swal.fire({
					title: 'A apărut o eroare',
					html: request.responseText,
					icon: 'error',
					allowOutsideClick: false
				}).then(function (result) {
					if (result.value) {
						window.location = "filme";
					}
				})
			}
		});
		
		var locuri_rez = [];
		
		//Memoram locurile selectate
		$(".tooltip").click(function(){
			if(!$(this).hasClass("row__seat--reserved"))
				//Daca debifam un loc deja selectat
				if ($(this).hasClass( "row__seat--selected" )) {
					var sterge = $(this).data("tooltip");

					//Stergem locul din array
					locuri_rez = jQuery.grep(locuri_rez, function(val) {
						return val != sterge;
					});
				} else {
					locuri_rez.push($(this).data("tooltip"));
				}
		});
		
		//Confirmare rezervare
		$(document).on('click', '#rezerva', function(e) {
			if(locuri_rez.length>0){
				<?php
				$sql2 = mysqli_query($con, "SELECT `locuri`, `pret` FROM `rezervari` WHERE `id_film` = ". $_GET['id'] ." AND `id_user` = ". $date_utilizator['id'] ."");
				$info_rez = mysqli_fetch_assoc($sql2);
				
				if(mysqli_num_rows($sql2)){
				?>
				total = locuri_rez.length * <?php echo isset($rand['pret']) && $rand['pret'] > 0 ? $rand['pret'] : 0; ?> + <?php echo isset($info_rez['pret']) && $info_rez['pret'] > 0 ? $info_rez['pret'] : 0; ?>;
				<?php } else { ?>
				total = locuri_rez.length * <?php echo isset($rand['pret']) && $rand['pret'] > 0 ? $rand['pret'] : 0; ?>;
				<?php } ?>
				Swal.fire({
				  title: 'Ești sigur?',
				  <?php if(mysqli_num_rows($sql2)){ ?>
				  html: "<br>Locurile deja rezervate sunt <b><?php echo $info_rez['locuri']; ?></b> iar acum ai selectat <b>" + locuri_rez + "</b> si vei avea un total de plata de <b>" + total + " LEI</b>",
				  <?php } else { ?>
				  html: "<br>Ai selectat locurile <b>" + locuri_rez + "</b> si vei avea un total de plata de <b>" + total + " LEI</b>",
				  <?php } ?>
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Confirmă',
				  cancelButtonText: 'Anulează',
				  allowOutsideClick: false
				}).then((result) => {
				  if (result.value) {
					 $.ajax({   
						type: 'POST',
						url: 'rezervare/ajax/rezervare.php', 
						data: { id: <?php echo $_GET['id']; ?>, uid: <?php echo '"'.base64_encode($date_utilizator['id']).'"'; ?>, pret: total, locuri: locuri_rez},
						success: function(response) {							
							Swal.fire({
							  title: 'Rezervare efectuată!',
							  <?php if(mysqli_num_rows($sql2)){ ?>
							  html: "<h6><i>Rezervarea expiră cu 15 de minute înainte de începerea filmului. Pentru a vă păstra rezervarea achitați locurile cu 15 de minute înainte!</h6><p><b>Film: </b> <?php echo $rand['titlu']; ?></p><p><b>Locuri: </b><?php echo $info_rez['locuri']; ?>" + locuri_rez + "</</p><p><b>Preț:</b> " + total + " LEI</p>",
							  <?php } else { ?>
							  html: "<h6><i>Rezervarea expiră cu 15 de minute înainte de începerea filmului. Pentru a vă păstra rezervarea achitați locurile cu 15 de minute înainte!</h6><p><b>Film: </b> <?php echo $rand['titlu']; ?></p><p><b>Locuri: </b>" + locuri_rez + "</p><p><b>Preț:</b> " + total + " LEI</p>",
							  <?php } ?>
							  icon: 'success',
							  allowOutsideClick: false
							}).then(function (result) {
								if (result.value) {
									window.location = "profil";
								}
							})
							
						}
					});
				  }
				})
			} else 
				Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  text: 'Nu ai selectat niciun loc pentru a face rezervarea!',
				})
		});
		
		</script>
		
		<script src="rezervare/js/classie.js?v=0.1"></script>
		<script src="rezervare/js/main.js?v=0.1"></script>
	</body>

</html>