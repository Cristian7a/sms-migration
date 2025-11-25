<?php 
session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]<=4){ 
     $user=$_SESSION['user'];
     include("query/consulta.php");
    
?>

<html>
<head>
     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ajustes visuales</title>
        <link rel="shortcut icon" href="../../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<script src = "../../js/jquery-3.3.1.min.js"></script>
<script src = "../../js/control.js"></script>



<?php
 $theme=$_SESSION['theme'];
      if($theme==1){
      include("menu.html");?>
       
<?php
} else {
     include("menu_2.html");
     ?>
      
<?php 
}
$nivel=$_SESSION["nivel"];
 if($nivel<=3){
    ?> <div class="ventana">
        <?php  include("ventanas_modales/opc_img.html"); ?>
     </div> 
     <?php
 }else {
    ?>  <div class="ventana">
        <?php  include("ventanas_modales/opc_img_n4.html"); ?>
     </div> 
     <?php
 }


 
     $res=verificar_tema();
    ?>
    <body style="background-color:#eee;">
    <div class="container">
     <form method="post" id="form"  action="query/cambiar_tema.php" name="form">
        <table>
            <tr><td>
          <h2> Elegir tema </h2> </td> </tr>
              <tr><td>   <select id="tema" name="tema">
                            <option selected="selected" value="<?php echo $res; ?>">Tema <?php echo $res; ?> </option>
                             <option value="1">Tema 1</option>
                             <option value="2">Tema 2</option>
                          </select></td> </tr>
              <tr><td>   <div class="buttons">
            <input type="submit" class="boton"  value="Cambiar tema" name="enviar" id="enviar">
        </div></td> </tr>
        </table>
     </form>
     
    <br><br>
     <h2> Galeria</h2>
        <?php 
        include("conex/conex.php");
     mysqli_select_db($conex, $database_conex);
   
$query_img = "SELECT img FROM img WHERE asp_img=$user";
$img= mysqli_query($conex, $query_img) or die(mysqli_error($conex));
$row_img = mysqli_fetch_assoc($img);
$totalRows_img = mysqli_num_rows($img);
if ($totalRows_img == 0) { ?> 
    <h3> Aún no hay imágenes disponibles </h3>
 <?php   } else { 
    do { 
        $href=$row_img['img']; ?>
     <a href="javascript:openventana_var('.ventana','<?php echo $href; ?>','url');"> <IMG height="100px" SRC="<?php echo $href; ?>">  </a> 
 <?php } while ($row_img = mysqli_fetch_assoc($img));  } ?>

     <form method="post" id="form"  action="query/verificar_imagen.php" name="form" enctype="multipart/form-data">
        <table>
            <tr><td> <b>Cargar imagen: </b><input type="file" id="img" name="img" accept=".jpg, .png, .jpeg"> </td> </tr>
              <tr><td><b>Nota:</b> Usar imagenes obscuras de preferencia</tr></td>
              <tr><td>   <div class="buttons">
            <input type="submit" class="boton"  value="Subir" name="enviar" id="enviar">
        </div></td> </tr>
        </table>
     </form>


    </div>

    </body>
    </html>

    <?php 
 }else{
    session_destroy();
    header("Location: ../" );
 }
}else{ 
    header("Location: ../" );}
 ?>
    