<?php 
session_start();
if (isset($_SESSION["user"])){
     if ($_SESSION["nivel"]<=4){ 

$user=$_SESSION['user'];?>

<html>
<head>
     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Involucrado</title>
        <link rel="shortcut icon" href="../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<header>
    <link rel='stylesheet' id='plantilla'  href='css/plantilla_inv.css' type='text/css' media='all' />
    <script src = "../js/jquery-3.3.1.min.js"></script>
    <script src = "../js/control_inv.js"></script>
    <script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 

        <?php
        
          $theme = $_SESSION['theme'] ?? 0;
             if($theme==1){
                 include("menu_index.html");  
                    } else {
                include("menus_2/menu_index.html"); }
           
        ?>

</header>

    <body style="background-color:#eee;">
         <div  style="height:88%;overflow-y: scroll;">
      <div class="reporte">
       

<?php require_once("../conex/conex.php");
mysqli_select_db($conex, $database_conex);

$query_pel = "SELECT DISTINCT IDEREP,FECREP,FECEVE,CONREP,GENPEL,IDERIE,CESPRIE,CONRIE,DESRIE FROM REP,PEL,PRO,INV,RIE WHERE IDERIE=RIEPRO && IDEREP=REPPEL && REPPEL=PELRIE  && IDEPRO=PROINV && PERINV=$user";
$pel = mysqli_query($conex, $query_pel) or die(mysqli_error($conex));
$row_pel = mysqli_fetch_assoc($pel);
$totalRows_pel = mysqli_num_rows($pel);
 if ($totalRows_pel == 0) { ?>
    <h4 align="center">NO TIENES REPORTES COMO INVOLUCRADO </h4>
    <?php }?>
    <?php if ($totalRows_pel > 0) {  ?>
       
                    
        <div class="tabla reportes">
           

        <table id="tabla_ges"> 
           <thead>
           <tr>
                <th rowspan="2">MES</th>
                <th rowspan="2">N°</th>
                <th rowspan="2">FECHA DE REPORTE</th>
                <th rowspan="2">FECHA DEL SUCESO</th>
                <th bgcolor="green">A</th> 
                <th colspan="2" bgcolor="green">B</th>    
                <th bgcolor="green">C</th>           
                <th rowspan="2">VER REPORTE</th>
                

            </tr>
                <tr>
         

                <th bgcolor="#ccc" style="color:#000">PELIGRO GENERICO</th>
                 <th bgcolor="#ccc" style="color:#000">DESCRIPCIÓN DETALLADA DEL EVENTO</th>
                 <th bgcolor="#ccc" style="color:#000">PELIGRO ESPECIFICO</th>
                  <th bgcolor="#ccc" style="color:#000">CONSECUENCIAS DEL PELIGRO ESPECIFICO</th>
              
                
               
               

            </tr>

        </thead>
        
 <?php 
do { 
$iderep=$row_pel['IDEREP'];
$fecrep=$row_pel['FECREP'];
$feceve=$row_pel['FECEVE'];
$fecrep=date("d-m-Y",strtotime($fecrep));
$feceve=date("d-m-Y",strtotime($feceve));
$conrep=$row_pel['CONREP'];
$iderie=$row_pel['IDERIE'];
$idepro=$row_pel['IDEPRO'];
$mes=strftime("%B", strtotime($fecrep));
$mes = mb_strtoupper($mes);
?>

<tbody>
            <tr>
                <td style="color:#fff; background-color:#2672EC" ><?php echo utf8_encode($mes); ?></td>
                <td align="center"><?php echo utf8_encode($iderep); ?></td>
                <td align="center"><?php echo ($fecrep); ?></td>
                <td align="center"><?php echo $feceve; ?></td>
                <td align="center"><?php echo $row_pel['GENPEL']; ?></td>
                <td align="center"><?php echo $row_pel['DESRIE']; ?></td>
                <td align="center"><?php echo $row_pel['CESPRIE']; ?></td>
                <td align="center"><?php echo $row_pel['CONRIE']; ?></td>
                <td align="center"><a  href="ver_reporte.php?IDEREP=<?php echo ($iderep).'&CONREP='.($conrep).'&IDERIE='.$iderie;?>"><IMG height="30px" SRC="../imagenes/reporte.png"></a></td>
                   
                   
                  
                
            </tr>
<?php } while ($row_pel = mysqli_fetch_assoc($pel)); ?>
</tbody>
        </table>
        </div>
    
       
<?php } ?>
            
            
    

      </div>
      </div>
    </body>

<script type="text/javascript"> 
filtro_inv();
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
    