<?php 
session_start();
if (isset($_SESSION["user"])){
    if ($_SESSION["nivel"]<=2){ 

$user=$_SESSION['user'];?>

<html>

    <script src = "../js/jquery-3.3.1.min.js"></script> 
    <script src = "../js/control_doc.js"></script>
    <script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 


<?php  
include("head.html");  

$theme = $_SESSION['theme'] ?? 0;
      if($theme==1){
      include("menu_index.html");  
} else {
     include("menus_2/menu_index.html"); }
    ?>


<div class="ventana"><?php include("ventanas_modales/documentos.html"); ?></div>
<div class="ventana_2"><?php include("ventanas_modales/rechazar.html"); ?></div>

    <body style="background-color:#eee;">
    <div  style="height:91%;overflow-y: scroll;">



      <div class="reporte">

<?php require_once("../conex/conex.php");
mysqli_select_db($conex, $database_conex);

$query_pel = "SELECT IDEREP,FECREP,CONREP,GENPEL,IDERIE,CESPRIE,CONRIE,DESRIE,DESPRO,IDERES,NOMEMP,APPEMP,APMEMP,RESPRO,FECLIM FROM REP,PEL,RIE,PRO,RES,PER,EMP WHERE IDEREP=REPPEL && REPPEL=PELRIE && IDERIE=RIEPRO && IDEPRO=PRORES && EMPRES=IDEPER && EMPPER=IDEEMP ORDER BY IDEREP";
$pel = mysqli_query($conex, $query_pel) or die(mysqli_error($conex));
$row_pel = mysqli_fetch_assoc($pel);
$totalRows_pel = mysqli_num_rows($pel);
 if ($totalRows_pel == 0) { ?>
  <br>
    <h2 align="center">No hay casos para verificar </h2>
    <?php }?>
    <?php if ($totalRows_pel > 0) {  ?>
       
                    
        <div class="tabla reportes">
            

        <table id="tabla_ges"> 
           <thead>
           <tr>
                <th rowspan="2">MES</th>
                <th rowspan="2">NO.</th>
                <th rowspan="2">FECHA DEL REPORTE</th>
                <th bgcolor="green">A</th> 
                <th colspan="2" bgcolor="green">B</th>    
                <th bgcolor="green">C</th>
                <th rowspan="2">MEDIDA DE MITIGACIÓN</th>
                <th rowspan="2">RESPONSABLE DE EMITIR/ORDENAR LA MEDIDA DE MITIGACIÓN</th>   
                <th rowspan="2">RESPONSABLE DE EJECUTAR LA MEDIDA DE MITIGACIÓN</th>          
                <th rowspan="2">VERIFICAR DOCUMENTOS</th>
                

            </tr>
                <tr>
         

                <th bgcolor="#ccc" style="color:#000">PELIGRO GENÉRICO</th>
                <th bgcolor="#ccc" style="color:#000">DESCRIPCIÓN DETALLADA DEL EVENTO</th>
                 <th bgcolor="#ccc" style="color:#000">PELIGRO ESPECÍFICO</th>
                  <th bgcolor="#ccc" style="color:#000">CONSECUENCIAS DEL PELIGRO ESPECÍFICOS</th>
                  </tr>
                 </thead>

        
        
 <?php 
do { 
$iderep=$row_pel['IDEREP'];
$ideres=$row_pel['IDERES'];
$fecrep=$row_pel['FECREP'];
$fecrep=date("d-m-Y",strtotime($fecrep));
$conrep=$row_pel['CONREP'];
$iderie=$row_pel['IDERIE'];
$mes=strftime("%B", strtotime($fecrep));
$mes = mb_strtoupper($mes);
$respro=$row_pel['RESPRO'];
if($row_pel['RESPRO']<>null){
$query_nomr = "SELECT NOMEMP,APPEMP,APMEMP FROM PER,EMP WHERE IDEEMP=EMPPER && IDEPER=$respro";
$nomr = mysqli_query($conex, $query_nomr) or die(mysqli_error($conex));
$row_nomr = mysqli_fetch_assoc($nomr);
$respro=$row_nomr['NOMEMP'].' '.$row_nomr['APPEMP'].' '.$row_nomr['APMEMP'];
}else{
$respro="No hay responsable asignado";
}
?>

<tbody>
            <tr>
                <td style="color:#fff; background-color:#2672EC" ><?php echo utf8_encode($mes); ?></td>
                <td><?php echo utf8_encode($iderep); ?></td>
                <td><?php echo utf8_encode($fecrep); ?></td>
                <td><?php echo $row_pel['GENPEL']; ?></td>
                <td><?php echo $row_pel['DESRIE']; ?></td>
                <td><?php echo $row_pel['CESPRIE']; ?></td>
                <td><?php echo $row_pel['CONRIE']; ?></td>
                <td><?php echo utf8_encode($row_pel['DESPRO']); ?></td>
                <td><?php echo mb_strtoupper(utf8_encode($respro)); ?></td>
                <td><?php echo mb_strtoupper(utf8_encode($row_pel['NOMEMP'].' '.$row_pel['APPEMP'].' '.$row_pel['APMEMP'])); ?></td>
                <?php
                
                $query_docs = "SELECT VERDOC FROM DOC WHERE RESDOC=$ideres  ORDER BY IDEDOC desc LIMIT 1";
                $docs = mysqli_query($conex, $query_docs) or die(mysqli_error($conex));
                $row_docs = mysqli_fetch_assoc($docs);
                $totalRows_docs = mysqli_num_rows($docs);
                if ($totalRows_docs == 0) { ?>

                <td align="center"><b>SIN DOCUMENTOS</b></td>

                 <?php } else { 
                  if($row_docs['VERDOC']=="APROBADO"){ ?>

                     <td align="center"><a  href="javascript:openventana_var('.ventana',<?php echo $ideres; ?>);"><IMG height="30px" SRC="../imagenes/verificar_doc.png"></a></td>

                   <?php } else { ?>
                     <td align="center"><a  href="javascript:openventana_var('.ventana',<?php echo $ideres; ?>);"><IMG height="30px" SRC="../imagenes/sin_verificar_doc.png"></a></td>
                 
                 <?php } }
                  ?>

                

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
    