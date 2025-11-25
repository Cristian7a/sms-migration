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

<?php  $theme = $_SESSION['theme'] ?? 0;
      if($theme==1){
      include("menu_index.html");  
} else {
     include("menus_2/menu_index.html"); }
    ?>   

    <body style="background-color:#eee;">
     <div  style="height:88%;overflow-y: scroll;">
      
   

<div class="ventana"><?php include("ventanas_modales/estatus.html"); ?></div>
<div class="ventana_2"><?php include("ventanas_modales/responsables.html"); ?></div>
<div class="ventana_3"><?php include("ventanas_modales/documentos.html"); ?></div>
<div class="ventana_4"><?php include("ventanas_modales/o_alc.html"); ?></div>
<div class="ventana_5"><?php include("ventanas_modales/cd_pla.html"); ?></div>
<div class="ventana_6"><?php include("ventanas_modales/cd_ver.html"); ?></div>
<div class="ventana_7"><?php include("ventanas_modales/fec_ini.html"); ?></div>
<div class="ventana_8"><?php include("ventanas_modales/fec_ent.html"); ?></div>
<div class="ventana_9"><?php include("ventanas_modales/causas.html"); ?></div>
<div class="ventana_10"><?php include("ventanas_modales/actuar.html"); ?></div>
<div class="ventana_11"><?php include("ventanas_modales/iniciar.html"); ?></div>


      <div>

<?php require_once("../conex/conex.php");
mysqli_select_db($conex, $database_conex);

$query_pel = "SELECT IDEPRO,IDEREP,IDERIE,PROBRIE,GRARIE,DESPRO,MEDMON,FECMON,ESTMON,PROREV FROM REP,PEL,RIE,PRO,MONPRO WHERE IDEREP=REPPEL && REPPEL=PELRIE && IDERIE=RIEPRO && IDEPRO=MONPRO ORDER BY IDEREP";
$pel = mysqli_query($conex, $query_pel) or die(mysqli_error($conex));
$row_pel = mysqli_fetch_assoc($pel);
$totalRows_pel = mysqli_num_rows($pel);
 if ($totalRows_pel == 0) { ?>
    <h2 align="center">NO TIENES NADA EN MONITOREO </h2>
    <?php }?>
    <?php if ($totalRows_pel > 0) {  ?>
       
                    
        <div class="reportes">
           

        <table id="table_mon" > 
            <thead><tr>
                <th rowspan="2">N° REPORTE</th>
                <th bgcolor="#16365C" rowspan="2">MEDIO DE MONITOREO</th>
                <th bgcolor="#16365C" rowspan="2">FECHA DE MONITOREO</th>
                <th bgcolor="#16365C" rowspan="2">PROPUESTA DE MEDIDA DE MITIGACION QUE SE APLICARÁ A LA CONSECUENCIA DERIVADA DEL PELIGRO</th>
                <th bgcolor="#16365C" rowspan="2">DOCUMENTO(S) SOPORTE DEL MONITOREO</th>
                <th bgcolor="#16365C" rowspan="2">AQUELLAS MEDIDAS DE MITIGACIÓN O PROCEDIMIENTOS QUE ...</th>
                <th></th>
                <th></th>
                <th bgcolor="#16365C" >CICLO DEMING PHVA</th>
                <th></th>
                <th></th>
                <th bgcolor="#16365C" >CICLO DEMING PHVA</th>
                <th bgcolor="#16365C" >CICLO DEMING PHVA</th>
                <th bgcolor="#16365C" >CICLO DEMING PHVA</th>
                <th bgcolor="#16365C" >CICLO DEMING</th>
                <th bgcolor="#16365C" rowspan="2">NUEVO CICLO</th>
                <th bgcolor="#16365C" rowspan="2">HISTORIAL</th>


                
            </tr>
            <tr>
             <th bgcolor="#16365C" rowspan="2">CAUSAS QUE PROVOCARON ESTE BAJO RENDIMIENTO</th>
             <th bgcolor="#16365C" rowspan="2">OBJETIVO A ALCANZAR</th>
              <th bgcolor="#16365C">PLANIFICAR</th>
              <th bgcolor="#16365C" rowspan="2">FECHA DE INICIO</th>
              <th bgcolor="#16365C" rowspan="2">FECHA DE ENTREGA</th>
              <th bgcolor="#16365C" >HACER (PERSONA RESPONSABLE DE EJECUTAR)</th>
              <th bgcolor="#16365C" >VERIFICAR</th>
               <th bgcolor="#16365C" >¿SE LOGRO EL OBJETIVO DESEADO? SI/NO</th>
               <th bgcolor="#16365C" >ACTUAR CON BASE A LOS RESULTADOS / ACTUAR EN CONSECUENCIA A LOS RESULTADOS </th>
            </tr>
        </thead>

        
        
 <?php 
do { 
$idepro=$row_pel['IDEPRO'];
$iderep=$row_pel['IDEREP'];

$medmon=$row_pel['MEDMON'];
$fecmon=$row_pel['FECMON'];

?>


<tbody>
            <tr>
                <td align="center"><?php echo utf8_encode($iderep); ?></td>
                 <td><?php if((is_null($medmon))||($medmon=='')){ ?> <a href="javascript:openventana_var('.ventana_11',<?php echo $idepro; ?>,'mondoc_i');"><b>ELEGIR MONITOREO</b></a><?php }else{ echo $medmon;} ?></td>
                <td><?php if((is_null($fecmon))||($fecmon=='')){ echo 'SIN FECHA'; }else{ echo $fecmon=date("d-m-Y",strtotime($fecmon));} ?></td>
                <td ><?php echo utf8_encode($row_pel['DESPRO']); ?></td>
                <td align="center"><a href="javascript:openventana_var('.ventana_3',<?php echo $idepro; ?>,'docmon',3);"><IMG height="40px" title="Ver documentos" SRC="../imagenes/documento.jpg"></a></td>
                <td><a  href="javascript:openventana_var('.ventana',<?php echo $idepro; ?>,'monpro',1);"><?php
                $color='black';
                if ($row_pel['ESTMON']=="NO HAN SIDO IMPLEMENTADAS"){$color='red';}
                if ($row_pel['ESTMON']=="FUNCIONAN PARCIALMENTE"){$color='orange';}
                if ($row_pel['ESTMON']=="FUNCIONAN CORRECTAMENTE"){$color='green';} 
                if ($row_pel['ESTMON']=="YA NO SON FUNCIONALES Y DEBEN DESECHARSE"){$color='grey';}   
                 echo '<b style="color:'.$color.';">'.$row_pel['ESTMON'].'</b>';?></a></td>
                <?php
                $query = "SELECT * FROM CIC WHERE MONCIC=$idepro ORDER by IDECIC DESC LIMIT 1";
                $cic = mysqli_query($conex, $query) or die(mysqli_error($conex));
                $row_cic = mysqli_fetch_assoc($cic);
                $totalRows_cic = mysqli_num_rows($cic);
                if ($totalRows_cic == 0) { ?>

               <td align="center">SIN CAUSAS</td>
                <td align="center">NO HAY OBJETIVO A ALCANZAR</td>
                <td align="center">NO HA SIDO PLANIFICADO</td>
                <td align="center" >NO HAY FECHA DE INICIO</td>
                <td align="center" >NO HAY FECHA DE ENTREGA</td>
                <td align="center" >SIN RESPONSABLE</td>
                <td>NO HA SIDO VERIFICADO</td>
                <td>NO HA SIDO VERIFICADO</td>
                <td>SIN ACCIONES</td>

                <?php }else { 

                $caucic=$row_cic['CAUCIC'];
                $objcic=$row_cic['OBJCIC'];
                $placic=$row_cic['PLACIC'];
                $fecini=$row_cic['FECINI'];
                $fecent=$row_cic['FECENT'];
                $vercic=$row_cic['VERCIC'];
                $logcic=$row_cic['LOGCIC'];
                $actcic=$row_cic['ACTCIC']; 

                ?>

        
                <td align="center"><a href="javascript:openventana_var('.ventana_9',<?php echo $idepro; ?>,'monpro9',9);"><b><?php if($caucic==''){echo 'SIN CAUSAS';}else{ echo $caucic;} ?></b></a></td>

                <td align="center"><a href="javascript:openventana_var('.ventana_4',<?php echo $idepro; ?>,'monpro4',4);"><b><?php if($objcic==''){echo 'SIN OBJETIVO';}else{ echo $objcic;} ?></b></a></td>

                <td align="center"><a href="javascript:openventana_var('.ventana_5',<?php echo $idepro; ?>,'monpro5',5);"><b><?php if($placic==''){echo 'SIN PLANIFICAR';}else{ echo $placic;} ?></b></a></td>

                <td align="center" ><a href="javascript:openventana_var('.ventana_7',<?php echo $idepro;?>,'monpro7',7);"><b><?php if($fecini==''){echo 'SIN FECHA DE INICIO';}else{ 
                    echo $fecini=date("d-m-Y",strtotime($fecini));} ?></b></a></td>

                <td align="center" ><a href="javascript:openventana_var('.ventana_8',<?php echo $idepro;?>,'monpro8',8);"><b><?php if($fecent==''){echo 'SIN FECHA DE ENTREGA';}else{ 
                    echo $fecent=date("d-m-Y",strtotime($fecent));} ?></b></a></td>
                
             
                <td align="center" ><a href="javascript:openventana_var('.ventana_2',<?php echo $idepro; ?>,'',2);"><IMG height="50px" title="Ver responsables" SRC="../imagenes/coordinacion.jpg"></a></td>
                
                <td align="center"><a href="javascript:openventana_var('.ventana_6',<?php echo $idepro; ?>,'monpro6',6);"><b><?php if($vercic==''){echo 'SIN VERIFICAR';}else{ echo $vercic;} ?></b></a></td>

                <td><?php if($logcic==''){echo 'SIN VERIFICAR';}else{ echo $logcic;} ?></td>
                
                <td align="center"><a href="javascript:openventana_var('.ventana_10',<?php echo $idepro; ?>,'monpro10',10);"><b><?php if($actcic==''){echo 'SIN ACCIONES';}else{ echo $actcic;} ?></b></a></td>


                <?php }?>

                
                
                <td align="center"><a href="query/nuevo_ciclo.php?monpro=<?php echo $idepro; ?>"><IMG height="50px" title="Nuevo ciclo" SRC="../imagenes/nuevo_ciclo.jpg"></a></td>


                <td align="center"><a href="historial.php?monpro=<?php echo $idepro; ?>"><IMG height="40px" title="Nuevo ciclo" SRC="../imagenes/historial.png"></a></td>
                 
                
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
    