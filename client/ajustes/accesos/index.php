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
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<script src = "../../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 


</header>

<!-- Selección de tema para la aplicación --> 
<?php
 $theme=$_SESSION['theme'];
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

<!-- Consulta de la tabla principal --> 
<?php
//Consulta todos los reportes
$query_rep1="SELECT DIRACC,FECACC,BROACC,USEACC FROM ACCESOS ";

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
        <table id="tabla_ses"> 
            <thead><tr>
                <th>DIRECCION IP</th>
                <th>FECHA DE ACCESO</th>
                <th>SISTEMA USADO</th>
                <th>USUARIO</th>
            </tr></thead>
 <?php 
do { 
$ip=$row_rep['DIRACC'];
$fecha=$row_rep['FECACC'];
$sistema=$row_rep['BROACC'];
$usuario=$row_rep['USEACC'];
$fecha=date("d-m-Y H:i",strtotime($fecha)); ?>

            <tr>
                <td align="center"><a href="https://www.elhacker.net/geolocalizacion.html?host=<?php echo $ip; ?>"><?php echo $ip; ?></a></td>
                <td align="center"><?php echo $fecha; ?></td>
            
                <td align="center"><?php echo $sistema; ?></td>
                <td align="center"><?php 
                if ($usuario){
                    $query="SELECT NOMEMP,APPEMP,APMEMP FROM EMP,PER WHERE IDEEMP=EMPPER && IDEPER=$usuario ";
        $con = mysqli_query($conex, $query) or die(mysqli_error($conex));
        $row = mysqli_fetch_assoc($con);
        echo utf8_encode($row['NOMEMP'].' '.$row['APPEMP'].' '.$row['APMEMP']); 
                }?>
        </td>

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
        filtro_ses();
    </script>
    </html>

<!-- Cierre de verificar sesión-->
    <?php }else{
    session_destroy();
    header("Location: ../" );}
    }else{ 
    header("Location: ../" );}?>
    