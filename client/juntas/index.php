<?php 
session_start();
if (isset($_SESSION["user"])){ 
     if ($_SESSION["nivel"]<=2){ 
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
$fecha=date('Y-m-d H:i:s');
$dia=date('d');
$mes=date('m');
$año=date('Y');
function nueva_junta($fecha,$conex) {
    $fecha_final=date("Y-m-d H:i:s",strtotime($fecha."+ 4 days")); 
    $insertSQL = sprintf("INSERT INTO JUN (FECJUN,FEFJUN,LUGJUN) VALUES ('$fecha','$fecha_final','En linea')");
    $Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
}

function comparar_fechas($dia,$mes,$fecha,$conex) {

        if ($dia>24){
switch ($mes) {
    case 1:
        if ($dia>27){nueva_junta($fecha,$conex);}
        break;
    case 2:
        if ($dia>24){nueva_junta($fecha,$conex);}
        break;
    case 3:
        if ($dia>27){nueva_junta($fecha,$conex);}
        break;
    case 4:
        if ($dia>26){nueva_junta($fecha,$conex);}
        break;
    case 5:
        if ($dia>27){nueva_junta($fecha,$conex);}
        break;
    case 6:
        if ($dia>26){nueva_junta($fecha,$conex);}
        break;
    case 7:
        if ($dia>27){nueva_junta($fecha,$conex);}
        break;
    case 8:
        if ($dia>27){nueva_junta($fecha,$conex);}
        break;
    case 9:
        if ($dia>26){nueva_junta($fecha,$conex);}
        break;
    case 10:
        if ($dia>27){nueva_junta($fecha,$conex);}
        break;
    case 11:
        if ($dia>26){nueva_junta($fecha,$conex);}
        break;
    case 12:
        if ($dia>24){nueva_junta($fecha,$conex);}
        break;
}
}
}

$query = "SELECT IDEJUN,FECJUN,FEFJUN FROM JUN ORDER BY IDEJUN DESC LIMIT 1 ";
$q = mysqli_query($conex, $query) or die(mysqli_error());
$row_q = mysqli_fetch_assoc($q);
$totalRows_q = mysqli_num_rows($q);
if ($totalRows_q > 0) {
    $fei_j=$row_q['FECJUN'];
    $fef_j=$row_q['FEFJUN'];
    if($fecha>$fei_j || $fecha<$fef_j){}else{
    comparar_fechas($dia,$mes,$fecha,$conex);}
    }else{comparar_fechas($dia,$mes,$fecha,$conex);}


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
                <th rowspan="2">LUGAR DE REUNIÓN</th>
                <th rowspan="2">PARTICIPANTES</th>
                <th rowspan="2">GESTIONAR</th>
                <th rowspan="2"></th>    

            </tr>
            <tr></tr>

        </thead>
        
 <?php 
do { 
$idejun=$row_pel['IDEJUN'];
$fecjun=$row_pel['FECJUN'];
$fefjun=$row_pel['FEFJUN'];
$lugjun=$row_pel['LUGJUN'];
$minjun=$row_pel['MINJUN'];
$fecjun=date("d-m-Y",strtotime($fecjun));
$mes=strftime("%B", strtotime($fecjun));
$mes = mb_strtoupper($mes);

if($fefjun>$hoy){}
if(is_null($fefjun)){$fefjun="No ha terminado la junta";}
?>

<tbody>
            <tr>
                <td style="color:#fff;background-color:#2672EC" ><?php echo utf8_encode($mes); ?></td>
                <td align="center"><?php echo utf8_encode($idejun); ?></td>
                <td align="center"><?php echo $fecjun; ?></td>
                <td align="center"><?php echo $fefjun; ?></td>
                <td align="center"><a href="javascript:openventana_var('.ventana',<?php echo $idejun; ?>,'IDEJUN','j');"><?php echo $lugjun; ?></a></td>
                <td align="center"><a href="participantes.php?IDEJUN=<?php echo $idejun; ?>"><IMG height="35px" SRC="../imagenes/coordinacion.jpg"></a></td>
                 <td align="center"><a href="gestionar.php?IDEJUN=<?php echo $idejun; ?>"><IMG height="20px" SRC="../imagenes/gestion.png"></a></td>
                <td align="center"><a href="query/baja_jun.php?IDEJUN=<?php echo $idejun;?>"><IMG height="20px" SRC="../imagenes/eliminar.png"></a></td>
                   
                   
                   
                  
                
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
    header("participante.php" );
 }
}else{ 
    header("Location: ../" );}
 ?>
    