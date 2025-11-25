<?php 
session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]>=3){ 
     $user=$_SESSION['user'];
     require_once("../conex/conex.php");
     mysqli_select_db($conex, $database_conex);
?>

<html>
<?php include("head.html"); ?>


<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/validar_rep.js"></script>
<script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 

<?php
 $theme=$_SESSION['theme'];
      if($theme==1){
      include("menu_rep.html");  
} else {
     include("menu_rep_2.html"); }
    ?>

    <body style="background-color:#eee;">
    <h2 align="center"> </h2>
    <div  style="height:92%;overflow-y: scroll;">
      <div>
        <div class="ventana">
            <?php include("ventanas_modales/n_rep.html");
            include("ventanas_modales/ayuda.html"); ?>
        </div>


<?php
$query_rep = "SELECT IDEREP,CONREP,FECEVE,FECREP,FREREP,OBSREP,NOMLUG FROM REP,LUG WHERE LUGREP=IDELUG && PERREP=$user ";
//$query_rep = "SELECT IDEREP,CONREP,FECEVE,FECREP,FREREP,OBSREP,NOMLUG,TIPFAC,TIPCAU FROM REP,LUG,CAU,FAC WHERE LUGREP=IDELUG && CAUREP=IDECAU && FACCAU=IDEFAC";
$rep = mysqli_query($conex, $query_rep) or die(mysqli_error($conex));
$row_rep = mysqli_fetch_assoc($rep);
$totalRows_rep = mysqli_num_rows($rep);
 if ($totalRows_rep == 0) { ?>
 <br>
    <h3 align="center">NO HAS LEVANTADO NINGUN REPORTE</h3>
    <?php }?>
    <?php if ($totalRows_rep > 0) {  ?>
       
                    
        <div class="tabla reportes">
            
        <table id="tabla_rep"> 
            <thead><tr>
                <th width="10px">FOLIO</th>
                <th width="120px">FECHA DEL REPORTE</th>
                <th width="120px">FECHA DEL SUCESO</th>
                <th style="color:#fff000">LUGAR DEL SUCESO</th>
                <th style="color:#fff000">FRECUENCIA</th>
                <th>OBSERVACIONES</th>
                <th>EVIDENCIA</th>
                <th>ESTATUS</th>
               
            </tr></thead>
 <?php 
do { 
$iderep=$row_rep['IDEREP'];
$fecrep=$row_rep['FECREP'];
$feceve=$row_rep['FECEVE'];
$fecrep=date("d-m-Y",strtotime($fecrep));
$feceve=date("d-m-Y",strtotime($feceve));
$estatus='';
$query= "SELECT FECPEL FROM PEL WHERE REPPEL=$iderep";
$cons = mysqli_query($conex, $query) or die(mysqli_error($conex));
$rowc = mysqli_fetch_assoc($cos);
$totalRowsc = mysqli_num_rows($cons);
if ($totalRowsc > 0){
$estatus='EN GESTIÓN'.$rowc['FECPEL'];
}else{
$estatus='SIN GESTIONAR';    
} 

?>

<tbody>
            <tr>
                <td align="center"><?php echo utf8_encode($iderep); ?></td>
                <td align="center"><?php echo ($fecrep); ?></td>
                <td align="center"><?php echo $feceve; ?></td>
                <td align="center"><?php echo $row_rep['NOMLUG']; ?></td>
                <td align="center"><?php echo $row_rep['FREREP']; ?></td>
                <td align="center"><?php echo $row_rep['OBSREP']; ?></td>
                <td align="center">
                <?php $query_repevi = "SELECT IDEEVI FROM EVI WHERE REPEVI=$iderep";
                      $repevi = mysqli_query($conex, $query_repevi) or die(mysqli_error($conex));
                      $totalRows_repevi = mysqli_num_rows($repevi);
                      if ($totalRows_repevi > 0) { ?>
                <a href="evidencias.php?IDEREP=<?php echo $iderep;?>"><IMG height="20px" SRC="../imagenes/evidencia.png"></a>
                <?php }else{ ?>
                <a href="evidencias.php?IDEREP=<?php echo $iderep;?>"><IMG height="20px" SRC="../imagenes/folder_vacio.png"></a>
                <?php } ?> 
                </td>
                <td align="center"><?php echo $estatus; ?></td>  
                  
                
            </tr>
<?php } while ($row_rep = mysqli_fetch_assoc($rep)); ?>
</tbody>
        </table>
       


    </div>
    
<?php } ?>



      </div>
      </div>
    </body>
    <script type="text/javascript">
        cargar_coo("area");
        cargar_lug();
        cargar_fac();
        filtro_rep_i();
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
    