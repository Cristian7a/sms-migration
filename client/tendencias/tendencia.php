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
        <title>Tendencia</title>
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
      include("menu_ten.html");  
} else {
     include("menus_2/menu_ten.html"); }
    ?>  


    <body style="background-color:#eee;">
      <div class="tendencias" style="margin:50px;">

<?php
$ideten=$_GET['ten'];
$query_ten = "SELECT NOMTEN,INCTEN FROM TEN WHERE IDETEN=$ideten";
$ten = mysqli_query($conex, $query_ten) or die(mysqli_error($conex));
$row_ten = mysqli_fetch_assoc($ten);
$nom=$row_ten['NOMTEN'];
$inc=$row_ten['INCTEN']; ?>
<center>
<h2>NOMBRE DEL COMPONENTE: <?php echo $nom;?></h2>
<h3>INCIDENCIAS: <?php echo $inc;?></h3>


</center>
<?php
$query_inc = "SELECT IDERIE,CESPRIE FROM INC,RIE WHERE IDERIE=RIEINC && TENINC=$ideten";
//$query_rep = "SELECT IDEREP,CONREP,FECEVE,FECREP,FREREP,OBSREP,NOMLUG,TIPFAC,TIPCAU FROM REP,LUG,CAU,FAC WHERE LUGREP=IDELUG && CAUREP=IDECAU && FACCAU=IDEFAC";
$inc = mysqli_query($conex, $query_inc) or die(mysqli_error($conex));
$row_inc = mysqli_fetch_assoc($inc);
$totalRows_inc = mysqli_num_rows($inc);
 if ($totalRows_inc == 0) { ?>
    <h4 align="center"><b>NOTA:</b>SI SE AGREGA ALGUN COMPONENTE EL NUMERO DE INCIDENCIAS CAMBIARA AL NUMERO DE COMPONENTES SELECCIONADOS</h4>
    <?php }?>
    <?php if ($totalRows_inc > 0) {  ?>
 <h3>COMPONENTES ESPECIFICOS DEL PELIGRO INCLUIDOS </h3>     
                    
        <div class="tabla reportes">
            <div  style="overflow: auto">
        <table id="tabla_rep"> 
            <thead><tr>
                <th>ID. RIESGO</th>
                <th>COMPONENTE ESPECIFICO DEL PELIGRO</th>
                <th>QUITAR</th>
            </tr></thead>
 <?php 
do { 
$iderie=$row_inc['IDERIE'];
$comrie=$row_inc['CESPRIE'];
?>

<tbody>
            <tr>
                <td><?php echo ($iderie); ?></td>
                <td><?php echo $comrie; ?></td>
                <td width="5%" align="center" ><a href="query/baja_inc.php?RIEINC=<?php echo $iderie."&IDETEN=".$ideten; ?>"><IMG title="Eliminar " height="25px" SRC="../imagenes/eliminar.png"></a></td>   
            </tr>
<?php } while ($row_inc = mysqli_fetch_assoc($inc)); ?>
</tbody>
        </table>
       


    </div>
    </div>
<?php } ?>



     




  

 <?php
    //LEFT JOIN COPIA ON IDERIE=RIECOP WHERE RIECOP IS NULL
    $query_rep = "SELECT IDERIE,CESPRIE FROM RIE LEFT JOIN INC ON IDERIE=RIEINC WHERE RIEINC IS NULL";
    //$query_rep = "SELECT IDEREP,CONREP,FECEVE,FECREP,FREREP,OBSREP,NOMLUG,TIPFAC,TIPCAU FROM REP,LUG,CAU,FAC WHERE LUGREP=IDELUG && CAUREP=IDECAU && FACCAU=IDEFAC";
    $rep = mysqli_query($conex, $query_rep) or die(mysqli_error($conex));
    $row_rep = mysqli_fetch_assoc($rep);
    $totalRows_rep = mysqli_num_rows($rep);
    if ($totalRows_rep == 0) { ?>
    <h4 align="center">NO HAY COMPONENTES PARA AGREGAR</h4>
    <?php }?>
    <?php if ($totalRows_rep > 0) {  ?>
     <h3>AGREGAR AL COMPONENTE </h3>  
    <form name="enviar" id="enviar" method="post" action="query/edit_ten.php" >
        <div class="tabla reportes">
            <div style='width:100%;height:150px;overflow-y: scroll;'>
        <table id="tabla_rep" > 
            <thead><tr>
                <th width="350px">COMPONENTE ESPECIFICO DEL PELIGRO </th>
                <th width="25px" ></th>
            </tr><tr></tr></thead>
    <?php 
    do{ 
        $idrie=$row_rep['IDERIE'];
        $cesrie=$row_rep['CESPRIE'];
    ?>
    <tbody>
            <tr>
                <td><?php echo ($cesrie); ?></td>
                <td><input type="checkbox" name="checkbox[]" id="checkbox" value="<?=$idrie?>"/></td>
            </tr>
<?php } while ($row_rep = mysqli_fetch_assoc($rep)); ?>
</tbody>
        </table>
    </div>
</div>
<input type="hidden" name="IDETEN" id="IDETEN" value="<?php echo $ideten; ?>" >
        <input  type="submit" name="enviar" id="enviar"  value="AGREGAR" class="boton">
    </form>
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
    