<?php 
require_once("conex/conex.php"); 
mysqli_select_db($conex, $database_conex);?>
<html>
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<div class="barra_login">
<?php if ($_SESSION["foto"]==""){ ?>
<div class="loginimage"><a href="fotos"><IMG height="35px" SRC="imagenes/usuario.png"></a></div> <?php }else { ?>
<div class="loginimage"><a href="fotos"><IMG height="60px" SRC="fotos/<?php echo ($_SESSION["foto"]);?>"></a></div> 
<?php }?>
<div class="loginitem" align="right"><a href=""><?php echo utf8_encode($_SESSION["nombre"]); ?></a>
<br><a href="conex/logout.php" >Cerrar sesión</a></div>
<?php if(isset($_SESSION["user1"])){ ?>

<form id="sesion" name="sesion" action="conex/cambiar_sesion.php">
<select id="user" name="user" onchange='this.form.submit()'>
 <option selected="selected" value="<?php echo $_SESSION['user'].'-'.$_SESSION['cargo'].'-'.$_SESSION['nivel']; ?>"><?php echo $_SESSION['cargo']; ?></option>
 <option value="<?php echo $_SESSION['user1'].'-'.$_SESSION['cargo1'].'-'.$_SESSION['nivel1']; ?>"><?php echo $_SESSION['cargo1']; ?></option>
 </select>
 </form>
<?php }?>

        </div>
<?php $fondo=$_SESSION['fondo'];  ?>        
<body  BACKGROUND="<?php echo "ajustes/visual/".$fondo; ?>">

<div class="container js-isotope" data-isotope-options="{ "itemSelector": ".item", "layoutMod": "fitRows" }">
<div class="item item-blue"><a class="post-title" href="index.php"><IMG height="100px" SRC="imagenes/icono_inicio.png"><br>Pagina principal</a></div>
<div class="item item-blue" ><a class="post-title" href="reportes_i"><IMG height="100px" SRC="imagenes/menu_rep.png">Reportes</a></div>

<!--
<div class="item item-darkpurple"><a class="post-title" href="indicadores.html"><IMG height="100px" SRC="imagenes/menu_ind.png">Indicadores de seguridad</a></div>-->
<?php
$ide=$_SESSION['user'];
$query_i = "SELECT IDEINV FROM INV WHERE PERINV=$ide ";
$i = mysqli_query($conex, $query_i) or die(mysqli_error());
$totalRows_i = mysqli_num_rows($i);
if ($totalRows_i > 0) { 
	?>
<div class="item item-teal"><a class="post-title" href="inv"><IMG height="100px" SRC="imagenes/involucrado.png"><br>Involucrado en reunión</a></div>
<?php } 
$query_r = "SELECT IDERES,FECLIM FROM RES WHERE EMPRES=$ide order by FECLIM DESC LIMIT 1";
$r = mysqli_query($conex, $query_r) or die(mysqli_error());
$row_r = mysqli_fetch_assoc($r);
$totalRows_r = mysqli_num_rows($r);
if ($totalRows_r > 0) { 
	$feclim=$row_r['FECLIM'];
	$feclim=date("d-m-Y",strtotime($feclim));
    $hoy=date('d-m-Y');
    if($hoy>=$feclim){ ?>
    	<div class="item item-red_alert"><a class="post-title" href="res"><IMG height="100px" SRC="imagenes/responsable.png"><br>Responsable</a></div>
   <?php }else{ ?>
		<div class="item item-teal"><a class="post-title" href="res"><IMG height="100px" SRC="imagenes/responsable.png"><br>Responsable</a></div>
<?php } }?>
<div class="item item-green2"><a class="post-title" href="juntas/participante.php"><IMG height="100px" SRC="imagenes/menu_inv.png"><br>Juntas de Control</a></div>


<!--
<div class="item item-blue"><a class="post-title" href="Documentos_compartidos"><IMG height="100px" SRC="imagenes/icono_documentos_compartidos.png"><br>Documentos compartidos</a></div>
<div class="item item-marron"><a class="post-title" href="#link#"><IMG height="100px" SRC="imagenes/menu_inv.png">Investigaciones</a></div>
<div class="item item-skyblue"><a class="post-title" href="#link#"><IMG height="100px" SRC="imagenes/menu_cap.png">Capacitaci&#243;n S.M.S</a></div>
<div class="item item-teal"><a class="post-title" href="#link#"><IMG height="100px" SRC="imagenes/menu_enc.png">Encuestas y evaluaciones</a></div>
-->
<div class="item item-gray"><a class="post-title" href="ajustes"><IMG height="90%" SRC="imagenes/conf.png">Ajustes</a></div>
</div>
</body>
</body>
</html>
