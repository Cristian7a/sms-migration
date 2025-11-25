<!-- Verifificar sesión --> 
<?php session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]<=2){ 
     $user=$_SESSION['user'];
     require_once("../../conex/conex.php");
     mysqli_select_db($conex, $database_conex);?>

<html>

<header>
<!-- cabecera --> 
<?php include("header.html"); ?>
<!-- librerias de control --> 
<script type="text/javascript" language="javascript" src="../TableFilter-master/dist/tablefilter/tablefilter.js"></script> 
<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/validar_dia.js"></script>

</header>

<!-- Selección de tema para la aplicación --> 
<?php
 $theme=$_SESSION['theme'];
      if($theme==1){
      include("menu.html");  
} else {
     include("menu_2.html"); }
    ?>
<!-- Inicio de cuerpo de la app --> 
    <body style="background-color:#eee;" >
      <div class="reporte">

        <!-- Ventanas modales importadas --> 
        <?php include("ventanas_modales/n_dia.html"); 
              include("ventanas_modales/e_dia.html"); 
             
              ?>

<!-- Consulta de la tabla principal --> 
<?php
//Consulta todos los EXAMENES
$query_rep1="SELECT IDEDIA,PER_DIA,FECDIA,FECINI,FECFIN FROM DIA"; 

$rep = mysqli_query($conex, $query_rep1) or die(mysqli_error($conex));
$row_rep = mysqli_fetch_assoc($rep);
$totalRows_rep = mysqli_num_rows($rep);
 if ($totalRows_rep == 0) { ?>
    <h2 align="center">No hay evaluaciones diagnosticas</h2>
    <?php }?>
    <?php if ($totalRows_rep > 0) {  ?>
       
                    
        <div class="tabla reportes">
            <div  style="height:92%;overflow-y: scroll;">
        <table id="tabla_rep"> 
            <thead><tr>
                <th>No.</th>
                <th>PERSONAL</th>
                <th>FECHA DIAGNOSTICO</th>
                <th>FECHA INICIO</th>
                <th>FECHA FIN</th> 
                <th>VALORACIÓN</th> 
                <th></th> 
            </tr></thead>
 <?php 
do { 
$idedia=$row_rep['IDEDIA'];
$fecdia=$row_rep['FECDIA'];
$fecdia=date("d-m-Y",strtotime($fecdia));

?>
            <tr>
                <td  align="center"><?php echo utf8_encode($idedia); ?></td>
                <td align="center"><?php echo $row_rep['PER_DIA']; ?></td>
                <td align="center"><?php echo $row_rep['FECDIA']; ?></td>
                <td align="center"><?php echo $row_rep['FECINI']; ?></td>
                <td align="center"><?php echo $row_rep['FECFIN']; ?></td>
                <!--EDITAR -->
                <td align="center" ><a href="valoracion.php?IDEDIA=<?php echo $idedia; ?>"><IMG height="20px" SRC="../../imagenes/edit.png"></a></td>
                <td align="center" ><a href="query/baja_dia.php?IDEDIA=<?php echo $idedia; ?>"><IMG height="20px" SRC="../../imagenes/eliminar.png"></a></td>
               
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
        cargar_exa('exa');
        filtro_rep();
    </script>
    </html>

<!-- Cierre de verificar sesión-->
    <?php }else{
    session_destroy();
    header("Location: ../" );}
    }else{ 
    header("Location: ../" );}?>
    