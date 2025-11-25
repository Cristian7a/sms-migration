<?php 
session_start();
if (isset($_SESSION["user"])){
    if ($_SESSION["nivel"]<=5){ 


$user=$_SESSION['user'];?>

<html>
<head>
   
     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Responsable</title>
        <link rel="shortcut icon" href="../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="../notification_menu/css/style_light.css">
    <script src = "../js/jquery-3.3.1.min.js"></script> 
    <script src = "../js/jquery.min.js"></script>   
    <script src="../notification_menu/js/jquery-ui-1.8.14.custom.min.js" type="text/javascript"></script>
    <script src="../notification_menu/js/ttw-notification-menu.min.js" type="text/javascript"></script>
    <script src="demo.js" type="text/javascript"></script>
   
    <link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
    <script src = "../js/control_res.js"></script>
    <script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 
    

</head>

 <?php
 
      $theme = $_SESSION['theme'] ?? 0;
             if($theme==1){
                 include("menu_index.html");  
                    } else {
                include("menus_2/menu_index.html"); }
        ?>


<div class="ventana">
<?php include("documentos.html"); ?>
</div>


    <body style="background-color:#eee;">
         <div  style="height:88%;overflow-y: scroll;">





      <div class="reporte">


<?php require_once("../conex/conex.php");
mysqli_select_db($conex, $database_conex);

$query_pel = "SELECT IDEREP,FECREP,CONREP,GENPEL,IDERIE,CESPRIE,CONRIE,DESPRO,IDERES,FECLIM FROM REP,PEL,RIE,PRO,RES WHERE IDEREP=REPPEL && REPPEL=PELRIE && IDERIE=RIEPRO && IDEPRO=PRORES && EMPRES=$user ORDER BY IDEREP";
$pel = mysqli_query($conex, $query_pel) or die(mysqli_error($conex));
$row_pel = mysqli_fetch_assoc($pel);
$totalRows_pel = mysqli_num_rows($pel);
 if ($totalRows_pel == 0) { ?>
 	<br>
    <h3 align="center">NO TIENES REPORTES COMO RESPONSABLE </h3>
    <?php }?>
    <?php if ($totalRows_pel > 0) {  ?>
       
                    
        <div class="tabla reportes">
           

        <table id="tabla_ges"> 
           <thead>
           <tr>
                <th rowspan="2">MES</th>
                <th rowspan="2">NO</th>
                <th rowspan="2">FECHA DEL REPORTE</th>
                <th bgcolor="green">A</th> 
                <th  bgcolor="green">B</th>    
                <th bgcolor="green">C</th>
                <th rowspan="2">PROPUESTA DE LA MEDIDA DE MITIGACIÓN</th> 
                <th rowspan="2">FECHA LIMITE</th>         
                <th rowspan="2">SUBIR DOCUMENTOS</th>
                

            </tr>
                <tr>
         

                <th bgcolor="#ccc" style="color:#000">PELIGRO GENERICO</th>
                 <th bgcolor="#ccc" style="color:#000">PELIGRO ESPECIFICO</th>
                  <th bgcolor="#ccc" style="color:#000">CONSECUENCIAS DEL PELIGRO ESPECIFICO</th>
              
                
               
               

            </tr>

        </thead>
        
 <?php 
do { 
$iderep=$row_pel['IDEREP'];
$ideres=$row_pel['IDERES'];
$fecrep=$row_pel['FECREP'];
$feclim=$row_pel['FECLIM'];
$fecrep=date("d-m-Y",strtotime($fecrep));
$feclim=date("d-m-Y",strtotime($feclim));
$conrep=$row_pel['CONREP'];
$iderie=$row_pel['IDERIE'];
$mes=strftime("%B", strtotime($fecrep));
$mes = mb_strtoupper($mes);
?>

<tbody>
            <tr>
                <td style="color:#fff; background-color:#2672EC" ><?php echo utf8_encode($mes); ?></td>
                <td align="center"><?php echo utf8_encode($iderep); ?></td>
                <td align="center"><?php echo ($fecrep); ?></td>
                <td align="center"><?php echo $row_pel['GENPEL']; ?></td>
                <td align="center"><?php echo $row_pel['CESPRIE']; ?></td>

                <td align="center"><?php echo $row_pel['CONRIE']; ?></td>
                <td align="center"><?php echo utf8_encode($row_pel['DESPRO']); ?></td>
                <td align="center"><?php echo ($feclim); ?></td>
                <td align="center"><a  href="javascript:openventana_var('.ventana',<?php echo $ideres; ?>,'IDERES',1);"><IMG height="30px" SRC="../imagenes/documentos.jpg"></a></td>
                   
                   
                  
                
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
    filtro_res();
    
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
    