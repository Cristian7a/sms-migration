<?php 
session_start();
if (isset($_SESSION["user"])){
    if ($_SESSION["nivel"]<=2){ 

$user=$_SESSION['user'];?>

<html>
<head>
    
     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Monitoreo de las medidas de mitigación</title>
        <link rel="shortcut icon" href="../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <script src = "../js/jquery-3.3.1.min.js"></script> 
    <script src = "../js/control_mon.js"></script> 
  
    <script src = "js/jquery.validate.min.js"></script>
    <script src = "js/validar_eva.js"></script>
    <link rel='stylesheet' id='plantilla'  href='css/plantilla_mon.css' type='text/css' media='all' />
    <script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 
</head>

<?php  $theme=$_SESSION['theme'];
      if($theme==1){
      include("menu_index.html");  
} else {
     include("menus_2/menu_index.html"); }
    ?>   

    <body style="background-color:#eee;">
     <div  style="height:88%;overflow-y: scroll;">
      
   

<div class="ventana_5"><?php include("estatus.html"); ?></div>
<div class="ventana_4"><?php include("e_eva.html"); ?></div>
<div class="ventana_3"><?php include("n_eva.html"); ?></div>
<div class="ventana_2"><?php include("responsables.html"); ?></div>
<div class="ventana"><?php include("documentos.html"); ?></div>


      <div>

<?php require_once("../conex/conex.php");
mysqli_select_db($conex, $database_conex);

$query_pel = "SELECT IDEPRO,IDEREP,IDERIE,PROBRIE,GRARIE,DESPRO,ESTMON FROM REP,PEL,RIE,PRO,MONPRO WHERE IDEREP=REPPEL && REPPEL=PELRIE && IDERIE=RIEPRO && IDEPRO=MONPRO ORDER BY IDEREP";
$pel = mysqli_query($conex, $query_pel) or die(mysqli_error($conex));
$row_pel = mysqli_fetch_assoc($pel);
$totalRows_pel = mysqli_num_rows($pel);
 if ($totalRows_pel == 0) { ?>
    <h4 align="center">NO TIENES PROPUESTAS EN MONITOREO </h4>
    <?php }?>
    <?php if ($totalRows_pel > 0) {  ?>
       
                    
        <div class="reportes">
           

        <table id="table_mon" > 
            <thead><tr>
                <th rowspan="2">N° REPORTE</th>
                <th rowspan="2">PROPUESTA DE MEDIDA DE MITIGACION  ELABORADA POR  LA OFICINA DE SEGURIDAD OPERACIONAL  LA CUAL ES APLICADA AL PELIGRO REPORTADO EN CONJUNTO CON LA CAUSA RAIZ.</th>
                <th bgcolor="#FFF000" style="color:#000" rowspan="2">RIESGO</th>
                <th bgcolor="#16365C " rowspan="2">RESPONSABLES</th>
                <th bgcolor="#16365C" rowspan="2">EVALUACIÓN DEL RIESGO DESPUES DE LAS MEDIDAS IMPLEMENTADAS</th>
                <th bgcolor="#16365C" rowspan="2">DOCUMENTOS,ACCIONES QUE PERMITEN DEMOSTRAR EL MONITOREO DE LAS MEDIDAS DE MITIGACIÓN</th>
                <th bgcolor="#16365C" rowspan="2">ESTATUS</th>
                
                
            </tr>
            <tr>
            </tr>
        </thead>

        
        
 <?php 
do { 
$idepro=$row_pel['IDEPRO'];
$iderep=$row_pel['IDEREP'];
$iderie=$row_pel['IDERIE'];
$riesgo=$row_pel['PROBRIE'].$row_pel['GRARIE'];
$tdriesgo=$idepro.'33';
?>


<tbody>
            <tr>
                <td align="center"><?php echo utf8_encode($iderep); ?></td>
                <td ><?php echo utf8_encode($row_pel['DESPRO']); ?></td>
                <td align="center" id="<?php echo $tdriesgo; ?>"><b><?php echo $riesgo; ?></b></td>
                 <script type="text/javascript"> 
                  var color_r=obtener_color('<?php echo $riesgo; ?>');
                  nuevo_color(<?php echo $tdriesgo; ?>,color_r);
                  </script>
                <td align="center" ><a href="javascript:openventana_var('.ventana_2',<?php echo $idepro; ?>,'',1);"><IMG height="50px" title="Ver responsables" SRC="../imagenes/coordinacion.jpg"></a></td>
                 
                 <?php $query_eva = "SELECT IDEEVA,PROBEVA,GRAEVA FROM EVA WHERE IDEEVA=$idepro";
                 $eva = mysqli_query($conex, $query_eva) or die(mysqli_error($conex));
                 $row_eva = mysqli_fetch_assoc($eva);
                 $totalRows_eva = mysqli_num_rows($eva);
                  if ($totalRows_eva == 0) { ?>
                  <td align="center"><input type="submit" value="Evaluar" class="boton" onclick="javascript:openventana_var('.ventana_3',<?php echo $idepro; ?>,'IDEPRO');" /></td>
                  <?php }else { 
                    $eva=$row_eva['PROBEVA'].$row_eva['GRAEVA'];
                    $ideeva=$row_eva['IDEEVA'];?>
                  <td align="center" id='<?php echo $ideeva;?>'  ><b><a href="javascript:openventana_var('.ventana_4',<?php echo ($row_eva['IDEEVA']); ?>,'IDEEVA',3);" ><?php echo($eva);?></a></b></td>
                 <script type="text/javascript"> 
                  var color=obtener_color('<?php echo $eva; ?>');
                  nuevo_color(<?php echo $ideeva; ?>,color);
                  </script>
                 <?php }?>
                <td align="center"><a href="javascript:openventana_var('.ventana',<?php echo $idepro; ?>,'docmon',2);"><IMG height="40px" title="Ver documentos" SRC="../imagenes/documento.jpg"></a></td>
                 <td><a style="text-decoration:none;" href="javascript:openventana_var('.ventana_5',<?php echo $idepro; ?>,'monpro',4);"><?php echo $row_pel['ESTMON']; ?></a></td>
                
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
filtro_mon();
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
    