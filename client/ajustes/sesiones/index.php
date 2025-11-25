<?php 
session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]==1){ 
     $user=$_SESSION['user'];
     require_once("../../conex/conex.php");
     mysqli_select_db($conex, $database_conex);
?>

<html>
<head>
     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Sesiones</title>
        <link rel="shortcut icon" href="../../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<script src = "../../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/validar_ses.js"></script>
<script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 

<?php
 $theme = $_SESSION['theme'] ?? 0;
      if($theme==1){
      include("menu_rep.html");  
} else {
     include("menu_rep_2.html"); }
    ?>

    <body style="background-color:#eee;">
     <div  style="height:88%;overflow-y: scroll;"> 
      <div class="reporte">
        <div class="ventana">
            <?php include("n_ses.html"); ?>
        </div>
        <div class="ventana_2"> 
    <?php include("e_ses.html"); ?>
    </div>

<?php
$query_tip = "SELECT IDESES,PRISES,PASSES,NOMEMP,APPEMP,APMEMP,EMAEMP,NOMPRI,NOMCOO FROM SES,PER,EMP,PRI,CAR,COO WHERE IDEPRI=PRISES && IDESES=IDEPER && EMPPER=IDEEMP && CARPER=IDECAR && COOCAR=IDECOO && FECFIN IS NULL ORDER BY IDESES";
$tip = mysqli_query($conex, $query_tip) or die(mysqli_error($conex));
$row_tip = mysqli_fetch_assoc($tip);
$totalRows_tip = mysqli_num_rows($tip);
 if ($totalRows_tip == 0) { ?>
    <h2 align="center">ADVERTENCIA, SI CIERRA SESION SIN NINGUN USUARIO NO PODRA ACCESAR A LA APLICACIÓN CONTACTE AL ENCARGADO</h2>
    <?php }?>
    <?php if ($totalRows_tip > 0) {  ?>
       
                   
        <div class="tabla reportes">
       
        <table id="tabla_ses"> 
            <thead><tr>
                <th width="5%">ID.</th>
                <th width="40%">COORDINACIÓN</th>
                <th width="40%">USUARIO</th>
                <th width="20%">NIVEL DE PRIVILEGIOS</th>
                <th width="20%">CORREO</th>

                <th width="5%">EDITAR</th>
                <th width="5%">ELIMINAR</th>

            </tr></thead>
 <?php 
do { 
$ide=$row_tip['IDESES'];
$nom=$row_tip['NOMEMP']." ".$row_tip['APPEMP']." ".$row_tip['APMEMP'];
$coo=$row_tip['NOMCOO'];
$privilegio=$row_tip['NOMPRI'];
$email=$row_tip['EMAEMP'];


?>

<tbody>
            <tr>
                <td style="color:#fff; background-color:#AC193D" ><?php echo $ide; ?></td>
                <td><?php echo utf8_encode($coo); ?></td>
                <td><?php echo utf8_encode($nom); ?></td>
                <td><?php echo ($privilegio); ?></td>
                <td><?php echo utf8_encode($email); ?></td>

                <td align="center"><a href="javascript:openventana_var('.ventana_2',<?php echo $ide; ?>,'ID',4);"><IMG height="20px" title="Editar" SRC="../../imagenes/edit.png"></a></td>    
                <td align="center"><a href="query/baja_ses.php?ide=<?php echo $ide;?>&URL=<?php echo $img;?>"><IMG height="20px" title="Eliminar sesión" SRC="../../imagenes/eliminar.png"></a></td>     
                  
                
            </tr>
<?php } while ($row_tip = mysqli_fetch_assoc($tip)); ?>
</tbody>
        </table>
        
       


    
    </div>
<?php } ?>



      </div>
      </div>
    </body>
<script type="text/javascript">
    cargar_coo("area");
    filtro_ses();
</script>
    </html>

    <?php 
 }else{
    session_destroy();
    header("Location: ../" );
 }
}else{ 
    header("Location: ../" );}
 ?>
    