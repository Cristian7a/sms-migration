<?php 
session_start();
if (isset($_SESSION["user"])){ 
     if ($_SESSION["nivel"]<=4){ 
$user=$_SESSION['user']; 
?>
<html>

<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 

<?php  
require_once("head.html"); 
$theme=$_SESSION['theme'];
      if($theme==1){
      include("menu_index.html");  } else { include("menus_2/menu_index.html"); }


    ?>


    <body style="background-color:;">
      <div class="reporte">

<?php require_once("../conex/conex.php");
mysqli_select_db($conex, $database_conex);
$query_pel = "SELECT * FROM JUN ";
$pel = mysqli_query($conex, $query_pel) or die(mysqli_error());
$row_pel = mysqli_fetch_assoc($pel);
$totalRows_pel = mysqli_num_rows($pel);
 if ($totalRows_pel == 0) { ?>
    <br>
    <h2 align="center">NO HAY JUNTAS DE CONTROL</h2>
    <?php }?>
    <?php if ($totalRows_pel > 0) {  ?>
       
                    
        <div class="tabla reportes">
            

        <table id="tabla_jcont"> 
           <thead>
           <tr>
                <th rowspan="2">MES</th>
                <th width="20px" rowspan="2">N°</th>
                <th rowspan="2">FECHA INICIO</th>
                <th rowspan="2">FECHA FIN</th>
                <th rowspan="2">PARTICIPAR</th>


            </tr>
            <tr></tr>

        </thead>
        
 <?php 
do { 
$idejun=$row_pel['IDEJUN'];
$fecjun=$row_pel['FECJUN'];
$fefjun=$row_pel['FEFJUN'];
$fecjun=date("d-m-Y",strtotime($fecjun));
$mes=strftime("%B", strtotime($fecjun));
$mes = mb_strtoupper($mes);
if(is_null($fefjun)){$fefjun="No ha terminado la junta";}
?>

<tbody>
            <tr>
                <td style="color:#fff;background-color:#2672EC" ><?php echo utf8_encode($mes); ?></td>
                <td align="center"><?php echo $idejun; ?></td>
                <td align="center"><?php echo $fecjun; ?></td>
                <td align="center"><?php echo $fefjun; ?></td>
                <td align="center"><a href="gestionar_p.php?IDEJUN=<?php echo $idejun; ?>"><img src="../imagenes/empleados.jpg" width="30px"></a></td>
                   
                  
                
            </tr>
<?php } while ($row_pel = mysqli_fetch_assoc($pel)); ?>
</tbody>
        </table>
        
    </div>
       
<?php } ?>
            
            
    

      </div>

    </body>
    <div class="ventana"><?php include("ventanas_modales/lugar.html"); ?></div>
    <div class="ventana_1"><?php include("ventanas_modales/diapositivas.html"); ?></div>

<script type="text/javascript"> filtro_jun(); </script>
    </html>

 <?php 
 }else{
    session_destroy();
    header("Location: ../" );
 }
}else{ 
    header("Location: ../" );}
 ?>
    