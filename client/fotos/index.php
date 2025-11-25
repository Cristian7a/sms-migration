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
        <title>Fotos</title>
        <link rel="shortcut icon" href="../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>



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
        <?php  include("opc_img.html"); ?>
     </div> 
     <?php
 }else {
    ?>  <div class="ventana">
        <?php  include("opc_img_n4.html"); ?>
     </div> 
     <?php
 }


 
     $res=verificar_tema();
    ?>
    <body style="background-color:#eee;">
    <div class="container">
     <h2> Vista previa</h2>
        <?php 
        include("../conex/conex.php");
     mysqli_select_db($conex, $database_conex);
   
$query_img = "SELECT FOTEMP,IDEEMP FROM EMP,PER WHERE IDEEMP=EMPPER && IDEPER=$user";
$img= mysqli_query($conex, $query_img) or die(mysqli_error($conex));
$row_img = mysqli_fetch_assoc($img);
$totalRows_img = mysqli_num_rows($img);
if ($totalRows_img == '') { ?> 
    <h4> NO TIENES FOTO  </h4>
 <?php   } else { 
 	 $ideemp=$row_img['IDEEMP'];
    do { 
        $href=$row_img['FOTEMP']; ?>
     <a href="<?php echo $href; ?>"><IMG height="100px" SRC="<?php echo $href; ?>"></a>  

       <?php } while ($row_img = mysqli_fetch_assoc($img));  } ?>
       
     <form method="post" id="form"  action="query/verificar_imagen.php" name="form" enctype="multipart/form-data">
        <table>
            <tr><td> <b>Actualizar foto: </b><input type="file" id="foto" name="foto" > </td>
            <td><input type="hidden" id="ideemp" name="ideemp" value="<?php echo $ideemp;?>"></td> </tr>
              <tr>
              <td>   <div class="buttons">
            <input type="submit" class="boton_blue"  value="Subir" name="enviar" id="enviar">
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
    