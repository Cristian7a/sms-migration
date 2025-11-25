<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Administrador</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="theme_2/css/fuente.css">
        <link rel="stylesheet" href="theme_2/css/bootstrap.min.css">
        <link rel="stylesheet" href="theme_2/css/font-awesome.min.css">
        <link rel="stylesheet" href="theme_2/css/style.css">
        
    </head>
<body >
		 <!-- start preloader -->
        <div id="loader-wrapper">
            <div class="logo"></div>
            <div id="loader">
            </div>
        </div>
        <!-- end preloader -->
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		
<!-- Start Header Section -->
<header class="main_menu_sec navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="lft_hd">
					<a href="index.php"><img src="imagenes/heli.png" alt=""/></a>
				</div>
			</div>			
			<div class="col-lg-9 col-md-9 col-sm-12">
				<div class="rgt_hd">					
					<div class="main_menu">
						<nav id="nav_menu">
							
						
						<div id="navbar">
							<ul>
								<li><a class="page-scroll" href="conex/logout.php">Cerrar sesión</a></li>
							</ul>
						</div>		
						</nav>			
					</div>					
						
				</div>
			</div>	
		</div>	
	</div>	
</header>
<!-- End Header Section -->

<!-- start Service Section -->
<section id="serv_sec" style="margin-top: 10%">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs12 ">
				<div class="title_sec" >
					<h1>Bienvenido <?php echo utf8_encode($_SESSION["nombre"]); ?></h1>
				</div>			
			</div>		
		    	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="reportes_i"><div class="service">						
					<i class="fa fa-list-alt"></i>  <!--folder-open-o      file-o-->
					<h2>Reportes</h2>
					<div class="service_hoverly">
						<i class="fa fa-list-alt"></i>
						<h2>Reportes</h2>
						<p>Consulta tus reportes o levanta un reporte.</p>
					</div>
				</div></a>
			</div>
			<?php
require_once("conex/conex.php"); 
mysqli_select_db($conex, $database_conex);
$ide=$_SESSION['user'];
$query_i = "SELECT IDEINV FROM INV WHERE PERINV=$ide ";
$i = mysqli_query($conex, $query_i) or die(mysqli_error());
$row_i = mysqli_fetch_assoc($i);
$totalRows_i = mysqli_num_rows($i);
if ($totalRows_i > 0) { 
	?>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="inv"><div class="service">						
					<i class="fa fa-users"></i>
					<h2>Involucrado en reunión</h2>
					<div class="service_hoverly">
						<i class="fa fa-users"></i>
						<h2>Involucrado en reunión</h2>
						<p>Participa como involucrado en la evaluación de una o mas propuestas de medidas de mitigación.</p>
					</div>
				</div></a>
			</div>
<?php } 
$query_r = "SELECT IDERES FROM RES WHERE EMPRES=$ide ";
$r = mysqli_query($conex, $query_r) or die(mysqli_error());
$row_r = mysqli_fetch_assoc($r);
$totalRows_r = mysqli_num_rows($r);
if ($totalRows_r > 0) { 

?>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="res"><div class="service">						
					<i class="fa fa-user"></i>
					<h2>Responsable</h2>
					<div class="service_hoverly">
						<i class="fa fa-user"></i>
						<h2>Responsable</h2>
						<p>Participa como responsable de una medida de mitigación puede subir el documento referente a la medida implementada.</p>
					</div>
				</div></a>
			</div>							
<?php } ?>

			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="dgac"><div class="service">						
					<i class="fa fa-envelope"></i>
					<h2>DGAC</h2>
					<div class="service_hoverly">
						<i class="fa fa-envelope"></i>
						<h2>DGAC</h2>
						<p>Ver sistemas de reportes voluntarios</p>
					</div>
				</div></a>
			</div>		
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="ajustes"><div class="service">						
					<i class="fa fa-gears"></i>
					<h2>Ajustes</h2>
					<div class="service_hoverly">
						<i class="fa fa-gears"></i>
						<h2>Ajustes</h2>
						<p>Ajustes visuales y de registros de la aplicación. </p>
					</div>
				</div></a>
			</div>			
		</div>
	</div>
</section>
<!-- End Service Section -->


<?php include("theme_2/pie.html"); ?>

<script type="text/javascript" src="theme_2/js/jquery-1.9.1.min.js"></script>
<script src="theme_2/js/isotope.pkgd.min.js"></script>
<script src="theme_2/js/owl.carousel.min.js"></script>
<script src="theme_2/js/jquery.nicescroll.min.js"></script>
<script src="theme_2/js/main.js"></script>
<script src="theme_2/js/carga_index.js"></script>







    </body>
</html>
