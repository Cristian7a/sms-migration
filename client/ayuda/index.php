<!-- Verifificar sesión --> 
<?php session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]==1){ 
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
 $theme=$_SESSION['theme'];
      if($theme==1){
        include("menu_index.html");
} else {
     include("menu_index_2.html"); }
    ?>
<!-- Inicio de cuerpo de la app --> 
    <body style="background-color:#eee;" >
      <div class="reporte">

        <!-- Ventanas modales importadas --> 
        <?php include("ventanas_modales/configuracion.html"); ?>

<!-- Consulta de la tabla principal --> 
<?php
//Consulta todos los reportes
$query_rep1="SELECT IDESUG,FECSUG,DESSUG,NOMEMP,APPEMP,APMEMP FROM SUGERENCIAS,PER,EMP WHERE IDEEMP=EMPPER && IDEPER=PERSUG ORDER BY IDESUG";

$rep = mysqli_query($conex, $query_rep1) or die(mysqli_error($conex));
$row_rep = mysqli_fetch_assoc($rep);
$totalRows_rep = mysqli_num_rows($rep);
 if ($totalRows_rep == 0) { ?>
    <BR>
    <h2 align="center">No hay nuevas sugerencias</h2>
    <?php }?>
    <?php if ($totalRows_rep > 0) {  ?>
       
                    
        <div class="tabla reportes">
            <div  style="height:92%;overflow-y: scroll;">
        <table id="tabla_rep"> 
            <thead><tr>
                <th>N°</th>
                <th>FECHA</th>
                <th>DESCRIPCIÓN</th>
                <th>REPORTANTE</th>
                <th>RESPONDER</th>
                <th></th>
            </tr></thead>
 <?php 
do { 
$idesug=$row_rep['IDESUG'];
$dessug=$row_rep['DESSUG'];
$fecsug=$row_rep['FECSUG'];
$fecsug=date("d-m-Y",strtotime($fecsug));?>

            <tr>
                <td  align="center"><?php echo $idesug; ?></td>
                <td align="center"><?php echo ($fecsug); ?></td>
                <td align="center"><?php echo mb_strtoupper(utf8_encode($dessug)); ?></td>
                <td align="center"><?php echo mb_strtoupper(utf8_encode($row_rep['NOMEMP']." ".$row_rep['APPEMP']." ".$row_rep['APMEMP'])); ?></td>
                <td align="center"><a href=""><img src="../imagenes/responder.png" width="30px"></a></td>
                <td align="center"><a href="query/baja_sug.php?IDESUG=<?php echo $idesug; ?>"><IMG title="Eliminar sugerencia" height="25px" SRC="../imagenes/eliminar.png"></a></td>
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
    