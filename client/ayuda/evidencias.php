<!-- Verifificar sesión --> 
<?php session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]<=2){ 
     $user=$_SESSION['user'];
     require_once("../conex/conex.php");
     mysqli_select_db($conex, $database_conex);
     $iderep=$_GET['IDEREP'];?>


<html>

<header>
<!-- cabecera --> 
<?php include("header.html"); ?>
<!-- librerias de control --> 
<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/validar_rep.js"></script>
<script src = "js/validar_lug.js"></script>
<script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 
</header>

<!-- Selección de tema para la aplicación --> 
<?php
 $theme=$_SESSION['theme'];
      if($theme==1){
      include("menu_evi.html");  
} else {
     include("menu_evi_2.html"); }
    ?>

 <?php include("ventanas_modales/b_evi.html"); 
       include("ventanas_modales/e_rep.html"); 
       include("ventanas_modales/n_lugar.html");?>

<!-- Inicio de cuerpo de la app --> 
    <body style="background-color:#eee;" >
      
      <div style="height:92%;overflow-y: scroll; margin:1em;margin-left:2.5em;"> 

        <!-- Ventanas modales importadas --> 
       
<div class="f2"> 
<!-- SECCION DE SCAN DEL REPORTE -->
<h1>Reporte(Escaneo del reporte fisico)</h1>
<br>
        <?php 
        include("conex/conex.php");
     mysqli_select_db($conex, $database_conex);
   
$query_evi = "SELECT IDEEVI,RUTEVI,FILEVI,TIPEVI FROM EVI WHERE NOMEVI='REPORTE' && REPEVI=$iderep";
$evi= mysqli_query($conex, $query_evi) or die(mysqli_error($conex));
$row_evi = mysqli_fetch_assoc($evi);
$totalRows_evi = mysqli_num_rows($evi);
if ($totalRows_evi == 0) { ?> 
    <h3> No existen scans </h3><br>
   <form method="post" id="form"  action="query/alta_evi.php" name="form" enctype="multipart/form-data">
        <table>
        <input type="hidden" id="IDEREP" name="IDEREP"  value=<?php echo $_GET['IDEREP'];?> > 
        <input type="hidden" id="tip" name="tip"  value="FISICA" >
        <input type="hidden" id="nom" name="nom"  value="REPORTE" >

            <tr><td> <input type="file" id="evi" name="evi"  accept="application/pdf">  </td> </tr>
              <tr><td></tr></td>
              <tr><td>   <div class="buttons">
            <input type="submit" class="boton"  value="Subir" name="enviar" id="enviar">
        </div></td> </tr>
        </table>
     </form>
     <div style="margin-top:1em;">
<b>Nota:</b>Tamaño maximo por archivo 10MB, solo es valido el archivo en formato PDF
</div>

 <?php   } else { 
    do { 
        $href=$row_evi['RUTEVI'].$row_evi['FILEVI'];
        $pos = strpos($href,".pdf");
         if ($pos == false){ ?>
<div class="image_wrapper" id="<?php echo $row_evi['IDEEVI']; ?>">
<a href="<?php echo $href; ?>"> <IMG  title="<?php echo 'Tipo de evidencia: '.$row_evi['TIPEVI'] ?>" class="image" height="100px" width="100px" SRC="<?php echo $href; ?>" style="max-width:100px;">  </a>
<a href="javascript:openventana_var('.ventana',<?php echo $row_evi['IDEEVI']; ?>,'IDEVI',6);">
<img src="../imagenes/eliminar_cuadro.jpg" title="eliminar" class="remove"></a>
</div>
       <?php } else { ?>
<div class="image_wrapper" id="<?php echo $row_evi['IDEEVI']; ?>">
<a href="<?php echo $href; ?>"> <IMG title="<?php echo 'Tipo de evidencia: '.$row_evi['TIPEVI'] ?>" class="image" height="150px" width="150px" SRC="../imagenes/icono_pdf.png" style="max-width:150px;">  </a> 
<a href="javascript:openventana_var('.ventana',<?php echo $row_evi['IDEEVI']; ?>,'IDEVI',6);">
<img src="../imagenes/eliminar_cuadro.jpg" title="eliminar" class="remove"></a>
</div>    
 <?php }
  } while ($row_evi = mysqli_fetch_assoc($evi));  } ?>

</div>
  

<div class="f2"> 
<!-- SECCION DE EVIDENCIAS ADICIONALES -->

     <br><br>
     
     <h1>Evidencias adicionales</h1>
     <br>
        <?php 

   
$query_evia = "SELECT IDEEVI,RUTEVI,FILEVI,TIPEVI FROM EVI WHERE NOMEVI!='REPORTE' && REPEVI=$iderep " ;
$evia= mysqli_query($conex, $query_evia) or die(mysqli_error($conex));
$row_evia = mysqli_fetch_assoc($evia);
$totalRows_evia = mysqli_num_rows($evia);
if ($totalRows_evia == 0) { ?> 
    <h3> No existen evidencias </h3><br>
 <?php   } else { 
    do { 
        $href=$row_evia['RUTEVI'].$row_evia['FILEVI'];
        $pos = strpos($href,".pdf");
         if ($pos == false){ ?>
         <div class="image_wrapper" id="<?php echo $row_evia['IDEEVI']; ?>">
<a href="<?php echo $href; ?>"> <IMG  title="<?php echo 'Tipo de evidencia: '.$row_evia['TIPEVI'] ?>" class="image" height="150px" width="150px" SRC="<?php echo $href; ?>" style="max-width:150px;">  </a>
<a href="javascript:openventana_var('.ventana',<?php echo $row_evia['IDEEVI']; ?>,'IDEVI',6);">
<img src="../imagenes/eliminar_cuadro.jpg" title="eliminar" class="remove"></a>
</div>
       <?php } else { ?>
       <div class="image_wrapper" id="<?php echo $row_evia['IDEEVI']; ?>">
<a href="<?php echo $href; ?>"> <IMG title="<?php echo 'Tipo de evidencia: '.$row_evia['TIPEVI'] ?>" class="image" height="150px" width="150px" SRC="../imagenes/icono_pdf.png" style="max-width:150px;">  </a> 
<a href="javascript:openventana_var('.ventana',<?php echo $row_evia['IDEEVI']; ?>,'IDEVI',6);">
<img src="../imagenes/eliminar_cuadro.jpg" title="eliminar" class="remove"></a>
</div>  
 <?php }
  } while ($row_evia = mysqli_fetch_assoc($evia));  } ?>

     <form method="post" id="form"  action="query/alta_evi.php" name="form" enctype="multipart/form-data">
        <table>
        <input type="hidden" id="IDEREP" name="IDEREP"  value=<?php echo $iderep;?> > 
        <input type="hidden" id="nom" name="nom"  value="ADICIONAL" >

        <tr><td> <b>Tipo de evidencia: </b><select id="tip" name="tip" style="width:100px">
                            <option selected="selected" >--ELEGIR--</option>
                             <option value="FISICA">FISICA</option>
                             <option value="TESTIMONIAL">TESTIMONIAL</option>
                             <option value="DOCUMENTAL">DOCUMENTAL</option>
                          </select> </td> </tr>
            <tr><td> <b></b><input type="file" id="evi" name="evi"  accept="application/pdf, .jpg, .png">  </td> </tr>
              <tr><td></tr></td>
              <tr><td>   <div class="buttons">
            <input type="submit" class="boton"  value="Subir" name="enviar" id="enviar">
        </div></td> </tr>
        </table>
     </form>
     <div style="margin-top:1em;">

<b>Nota:</b>Tamaño maximo por archivo 10MB
</div>
</div>



      </div>
    </body>
<!-- Termina cuerpo -->

<!-- Scrips de control de ventanas modales -->
    <script type="text/javascript">
        cargar_coo("area");
        cargar_lug();
        cargar_fac();
        filtro_rep();
    </script>
    </html>

<!-- Cierre de verificar sesión-->
    <?php }else{
    session_destroy();
    header("Location: ../" );}
    }else{ 
    header("Location: ../" );}?>
    