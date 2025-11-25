<!-- Verifificar sesión --> 
<?php session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]<=2){ 
     $user=$_SESSION['user'];
     require_once("../conex/conex.php");
     mysqli_select_db($conex, $database_conex);?>

<html>

<header>
<!-- cabecera --> 
<?php include("header.html"); ?>
<!-- librerias de control --> 
<script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 
<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/validar_rep.js"></script>
<script src = "js/validar_lug.js"></script>

</header>

<!-- Selección de tema para la aplicación --> 
<?php
$theme = $_SESSION['theme'] ?? 0; // valor por defecto = 1
      if($theme==1){
        if($_SESSION["nivel"]==2){
         include("menus_directivo/menu_rep.html");
        }else{include("menu_rep.html");}
        
} else {
     include("menu_rep_2.html"); }
    ?>
<!-- Inicio de cuerpo de la app --> 
    <body style="background-color:#eee;" >
      <div class="reporte">

        <!-- Ventanas modales importadas --> 
        <?php include("ventanas_modales/n_rep.html"); 
              include("ventanas_modales/e_rep.html"); 
              include("ventanas_modales/n_lugar.html");
              include("ventanas_modales/ayuda.html");?>

<!-- Consulta de la tabla principal --> 
<?php
//Consulta todos los reportes
$query_rep1="SELECT IDEREP,CONREP,FECEVE,FECREP,FREREP,OBSREP,NOMLUG,CANREP,NOMEMP,APPEMP,APMEMP FROM REP,LUG,PER,EMP WHERE LUGREP=IDELUG AND PERREP=IDEPER AND EMPPER=IDEEMP ORDER BY IDEREP";
//Consulta solo reportes que no estan en gestión
$query_rep = "SELECT IDEREP,CONREP,FECEVE,FECREP,FREREP,OBSREP,NOMLUG,CANREP FROM REP INNER JOIN LUG ON LUGREP=IDELUG LEFT OUTER JOIN PEL ON REP.IDEREP = PEL.REPPEL where PEL.REPPEL is null ORDER BY IDEREP";

$rep = mysqli_query($conex, $query_rep1) or die(mysqli_error($conex));
$row_rep = mysqli_fetch_assoc($rep);
$totalRows_rep = mysqli_num_rows($rep);
 if ($totalRows_rep == 0) { ?>
    <BR>
    <h2 align="center">No hay nuevos reportes por gestionar</h2>
    <?php }?>
    <?php if ($totalRows_rep > 0) {  ?>
       
                    
        <div class="tabla reportes">
            <div  style="height:92%;overflow-y: scroll;">
        <table id="tabla_rep"> 
            <thead><tr>
                <th>MES</th>
                <th>N°</th>
                <th>FECHA DEL REPORTE</th>
                <th>FECHA DEL SUCESO</th>
                <th style="color:#fff000">LUGAR DEL SUCESO</th>
                <th style="color:#fff000">FRECUENCIA</th>
                <th>OBSERVACIONES</th>
                <th>REPORTANTE</th>
                <?php if($_SESSION["nivel"]<2){ ?>
                <th>EVIDENCIA</th> 
                <th>EDITAR</th> 
                <th>GESTIÓN</th> <?php } ?>
            </tr></thead>
 <?php 
do { 
$iderep=$row_rep['IDEREP'];
$fecrep=$row_rep['FECREP'];
$feceve=$row_rep['FECEVE'];
$fecrep=date("d-m-Y",strtotime($fecrep));
$feceve=date("d-m-Y",strtotime($feceve));
$mes=strftime("%B", strtotime($fecrep));
$mes = mb_strtoupper($mes);
//verificar si el reporte ha sido cancelado
$canrep=$row_rep['CANREP'];
if($canrep==1){
?>
<tbody style="color:red">
<?php } else { ?>
<tbody>    
<?php } ?>
            <tr>
                <td style="color:#fff; background-color:#2672EC" ><?php echo utf8_encode($mes); ?></td>
                <td  align="center"><?php echo utf8_encode($iderep); ?></td>
                <td align="center"><?php echo ($fecrep); ?></td>
                <td align="center"><?php echo $feceve; ?></td>
                <td align="center"><?php echo $row_rep['NOMLUG']; ?></td>
            
                <td align="center"><?php echo $row_rep['FREREP']; ?></td>
                <td align="center"><?php echo $row_rep['OBSREP']; ?></td>
                <td align="center"><?php echo mb_strtoupper(utf8_encode($row_rep['NOMEMP']." ".$row_rep['APPEMP']." ".$row_rep['APMEMP'])); ?></td>
                <!--EVIDENCIA -->
                <?php if($_SESSION["nivel"]<2){ ?>
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
                <!--EDITAR -->
                <td align="center" ><a href="javascript:openventana_var('.ventana_2',<?php echo $iderep; ?>,'IDREP',1);"><IMG height="20px" SRC="../imagenes/edit.png"></a></td>

                <?php 
                //verifica que el reporte ya estre en gestión
                $query_gestion = "SELECT REPPEL FROM PEL WHERE REPPEL=$iderep";
                $gestion = mysqli_query($conex, $query_gestion) or die(mysqli_error($conex));
                $totalRows_gestion = mysqli_num_rows($gestion);
                if ($totalRows_gestion == 0) { ?>
                <td align="center" ><a href="../gestion/ver_gestion.php?IDEREP=<?php echo $iderep;?>"><IMG height="20px" SRC="../imagenes/sin_gestion.png" title="Sin gestionar"></a></td> 
                <?php } else { ?>
                <td align="center" ><a href="../gestion/ver_gestion.php?IDEREP=<?php echo $iderep;?>"><IMG height="20px" SRC="../imagenes/gestion.png" title="En gestión"></a></td>    
                <?php } } ?> 
            </tr>
<?php } while ($row_rep = mysqli_fetch_assoc($rep)); ?>
</tbody>
        </table>
       


    </div>
    </div>
<?php } ?>



      </div>
    </body>
<!-- Termina cuerpo -->

<!-- Scrips de control de ventanas modales -->
    <script type="text/javascript">
        cargar_coo("area");
        cargar_lug();
        cargar_fac();
        filtro_rep();
    </script>
    </html>

<!-- Cierre de verificar sesión-->
    <?php }else{
    session_destroy();
    header("Location: ../" );}
    }else{ 
    header("Location: ../" );}?>
    