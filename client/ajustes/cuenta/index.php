<?php 
session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]<=4){ 
     $user=$_SESSION['user'];
    
?>

<html>
<head>
     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ajustes de cuenta</title>
        <link rel="shortcut icon" href="../../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<script src = "../../js/jquery-3.3.1.min.js"></script>
<script src = "../../js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/validar_pass.js"></script>




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
     
    ?>
    <body style="background-color:#eee;">
    <div class="container">
     <form method="post" id="form_pass"  action="" name="form_pass">
        <table>
            <tr><td>
          <h2> Cambiar contraseña </h2> </td> </tr>
              <tr><td> Nueva contraseña <input type="password" name="pass" id="pass"> </td></tr>
              <tr><td> Confirmar contraseña <input type="password" name="pass2" id="pass2"> </td></tr>
              <tr><td>   <div class="buttons">
            <input type="submit" class="boton_blue"  value="Cambiar" name="enviar" id="enviar">
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
    