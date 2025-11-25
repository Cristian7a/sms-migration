<?php 
session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]<=2){ 
$user=$_SESSION['user'];
require_once("../conex/conex.php");
mysqli_select_db($conex, $database_conex);

?>
<html>
<head>
     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Tendencias</title>
        <link rel="shortcut icon" href="../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/valida_ten.js"></script>


<?php  $theme = $_SESSION['theme'] ?? 0;
      if($theme==1){
      include("menu_index.html");  
} else {
     include("menus_2/menu_index.html"); }
    ?>  

        <div class="ventana">
            <?php include("n_ten.html"); ?>
        </div>
        <div class="ventana_2"> 
            <?php include("listado.php"); ?>
            </div>

    <body style="background-color:#eee;">
      <div class="tendencias" style="margin:50px;">

<?php
$query_rep = "SELECT * FROM TEN order by INCTEN DESC limit 10";
//$query_rep = "SELECT IDEREP,CONREP,FECEVE,FECREP,FREREP,OBSREP,NOMLUG,TIPFAC,TIPCAU FROM REP,LUG,CAU,FAC WHERE LUGREP=IDELUG && CAUREP=IDECAU && FACCAU=IDEFAC";
$rep = mysqli_query($conex, $query_rep) or die(mysqli_error($conex));
$row_rep = mysqli_fetch_assoc($rep);
$totalRows_rep = mysqli_num_rows($rep);
 if ($totalRows_rep == 0) { ?>
    <h4 align="center">NO HAY TENDENCIAS QUE MOSTRAR</h4>
    <?php }?>
    <?php if ($totalRows_rep > 0) {  ?>
       
                    
        <div class="tabla reportes">
            <div  style="overflow: auto">
        <table id="tabla_rep"> 
            <thead><tr>
                <th>COMPONENTES</th>
                <th>INCIDENCIAS</th>
                <th>DETALLES</th>
                <th>ELIMINAR</th>
            </tr></thead>
 <?php 
do { 
$ideten=$row_rep['IDETEN'];
$comten=$row_rep['NOMTEN'];
$incten=$row_rep['INCTEN'];
?>

<tbody>
            <tr>
                <td><?php echo ($comten); ?></td>
                <td align="center"><?php echo $incten; ?></td>
                <td align="center"><a href="tendencia.php?ten=<?php echo $ideten; ?>"><img title="TENDENCIA" width="30px" src="../imagenes/tendencia.png"></a></td>
                <td width="5%" align="center" ><a href="query/baja_ten.php?<?php echo "IDETEN=".$ideten; ?>"><IMG title="Eliminar tendencia" height="25px" SRC="../imagenes/eliminar.png"></a></td>    
            </tr>
<?php } while ($row_rep = mysqli_fetch_assoc($rep)); ?>
</tbody>
        </table>
       


    </div>
    </div>
<?php } ?>



      </div>
    </body>
    
    </html>

    <?php 
 }else{
    session_destroy();
    header("Location: ../" );
 }
}else{ 
    header("Location: ../" );}
 ?>
    