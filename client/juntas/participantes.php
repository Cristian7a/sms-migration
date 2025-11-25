<?php 
session_start();
if (isset($_SESSION["user"])){ 
     if ($_SESSION["nivel"]<=2){ 
$user=$_SESSION['user'];
$idejun=$_GET['IDEJUN'];
?>
<html>

<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/validar_par.js"></script>
<script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 

<?php  
require_once("head.html"); 
$theme=$_SESSION['theme'];
      if($theme==1){
      include("menu_participantes.html");  } else { include("menus_2/menu_participantes.html"); }
    ?>


    <body style="background-color:;">
      <div class="reporte">

<?php require_once("../conex/conex.php");
mysqli_select_db($conex, $database_conex);

$query_pel = "SELECT IDEASI,PERASI,NOMEMP,APPEMP,APMEMP FROM ASI,PER,EMP WHERE IDEEMP=EMPPER && IDEPER=PERASI && JUNASI=$idejun";
$pel = mysqli_query($conex, $query_pel) or die(mysqli_error());
$row_pel = mysqli_fetch_assoc($pel);
$totalRows_pel = mysqli_num_rows($pel);
 if ($totalRows_pel == 0) { 

$query_asi = "SELECT IDEPER FROM PER,EMP,CAR WHERE (ORGCAR='PERSONAL DIRECTIVO' || ORGCAR='EJECUTIVO RESPONSABLE' ) && IDECAR=CARPER && IDEEMP=EMPPER && FECFIN IS NULL";
$asi = mysqli_query($conex, $query_asi) or die(mysqli_error());
$row_asi = mysqli_fetch_assoc($asi);
$totalRows_asi = mysqli_num_rows($asi);
 if ($totalRows_asi > 0) { 
  do {
    $ideper=$row_asi['IDEPER'];
    $insert=sprintf("INSERT INTO ASI (PERASI,JUNASI) VALUES ($ideper,$idejun)");
    $Result=mysqli_query($conex, $insert) or die (mysqli_error($conex));
    } while ($row_asi = mysqli_fetch_assoc($asi));?>
<script type="text/javascript">location.reload();</script>
 <?php }

 }
  if ($totalRows_pel > 0) {  ?>
       
                    
        <div class="tabla reportes">
            

        <table id="tabla_jcont"> 
           <thead>
           <tr>
                <th rowspan="2">NOMBRE</th>
                <th rowspan="2">FIRMA</th>
                <th rowspan="2"></th>    

            </tr>
            <tr></tr>

        </thead>
        
 <?php 
do { 
$ideasi=$row_pel['IDEASI'];
$nombre=$row_pel['NOMEMP'].' '.$row_pel['APPEMP'].' '.$row_pel['APMEMP'];
if(isset($row_pel['FIRASI'])){
  $firma=$row_pel['FIRASI'];
}else{
  $firma="NO";
}

?>

<tbody>
            <tr>
                <td align="center"><?php echo utf8_encode($nombre); ?></td>
                <td align="center"><?php 
                if($row_inv['FIRINV']=='SI'){?>
                <img src="img/verificacion.png" width="15px">
              <?php }?> </td>
                <td align="center"><a href="query/baja_par.php?IDEASI=<?php echo $ideasi;?>&IDEJUN=<?php echo $idejun;?>"><IMG height="20px" SRC="../imagenes/eliminar.png"></a></td>
                   
                   
                   
                  
                
            </tr>
<?php } while ($row_pel = mysqli_fetch_assoc($pel)); ?>
</tbody>
        </table>
        
    </div>
       
<?php } ?>
            
            
    

      </div>

    </body>

    <div class="ventana"><?php include("ventanas_modales/n_par.html"); ?></div>


<script type="text/javascript"> cargar_coo("area");filtro_par(); </script>
    </html>

 <?php 
 }else{
    session_destroy();
    header("Location: ../" );
 }
}else{ 
    header("Location: ../" );}
 ?>
    