
<!doctype html>
<html class="no-js" lang="">
   
<?php 

ob_start();

// Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("head_index.html"); ?>		 
<style type="text/css">
	*{font-family:sans-serif;}
</style>		
<!-- Start Header Section -->
<header class="main_menu_sec navbar navbar-default navbar-fixed-top">
	<div style="margin-right:1em; margin-left:2em;">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="lft_hd" >
					<a href="index.php" ><img src="imagenes/heli.png"  /></a>
				</div>
			</div>			
			<div class="col-lg-9 col-md-9 col-sm-12">
				<div class="rgt_hd" >					
					<div class="main_menu">
						<nav id="nav_menu">
							<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>	
						<div id="navbar">
							<ul>
								<li><a href="#">Nosotros <i class="fa fa-angle-down"></i></a>
									<ul>
										<li><a class="page-scroll" href="#tm_sec">Equipo</a></li>
										<li><a class="page-scroll" href="#miss_sec">Misión</a></li>
										<li><a class="page-scroll" href="#viss_sec">Visión</a></li>
									</ul>
								</li>
								<?php 
								if (isset($_SESSION["user"])){ ?>
                                <li><a class="page-scroll" href="app.php">S.M.S</a></li>
                                <li><a class="page-scroll" href="conex/logout.php">Cerrar sesión</a></li>
								<?php }else{ ?>
								<li><a class="page-scroll" href="javascript:openventana('.ventana');">Iniciar sesión</a></li>
								<?php } ?>
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

<?php 
include("contenido_index.html"); 
if(isset($_GET['USU'])){echo '<script> alert("Usuario o contraseña incorrectos.");</script>';}
require_once("conex/acceso.php"); 
?>

</html>

