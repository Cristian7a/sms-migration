<?php 
session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]<=2){ 
     $user=$_SESSION['user'];
     require_once("../../conex/conex.php");
     mysqli_select_db($conex, $database_conex);
?>

<html>
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<script src = "../../js/jquery-3.3.1.min.js"></script>
<script src = "js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 

<?php
 $theme=$_SESSION['theme'];
      if($theme==1){
      include("menu_coo.html");  
} else {
     include("menu_emp_2.html"); }
    ?>

<div class="ventana_2"> 
    <?php include("n_coor.html"); ?>
</div>

    <body style="background-color:#eee;">

  
        
        

<?php
$query_rep = "SELECT IDECOO,NOMCOO FROM COO ";
$rep = mysqli_query($conex, $query_rep) or die(mysqli_error($conex));
$row_rep = mysqli_fetch_assoc($rep);
$totalRows_rep = mysqli_num_rows($rep);
 if ($totalRows_rep == 0) { ?>
    <h2 align="center">No hay registros disponibles</h2>
    <?php }?>
    <?php if ($totalRows_rep > 0) {  ?>
       
                    
        <div class="tabla">
            <div  style="height:88%;overflow-y:scroll;width: 100%;">
        <table id="tabla_coor" > 
            <thead style="background:#AC193D;color: #fff;"><tr>
                <th>ID.</th>
                <th>COORDINACIÓN</th>
                <th></th>
            </tr></thead>
 <?php 
do { 
$ide=$row_rep['IDECOO'];
$nom=$row_rep['NOMCOO'];
?>

<tbody>
            <tr>
                <td align="center"><?php echo utf8_encode($ide); ?></td>
                <td align="center"><?php echo utf8_encode($nom); ?></td>
                
                <td align="center"><a  href="cargos.php?car=<?php echo $ide;?>"><IMG height="20px" SRC="../../imagenes/gestion.png"></a></td>
            </tr>
<?php } while ($row_rep = mysqli_fetch_assoc($rep)); ?>
</tbody>
        </table>
       
    </div>
    </div>
<?php } ?>



      
    </body>
    <script type="text/javascript">
        filtro_coor2();
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
    