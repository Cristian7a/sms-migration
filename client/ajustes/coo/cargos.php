<?php 
session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]<=2){ 
     $user=$_SESSION['user'];
 $idecoo=$_GET['car'];    
?>
<html>
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<script src = "../../js/jquery-3.3.1.min.js"></script>
<script src = "js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/validar_cau.js"></script>
<script type="text/javascript" language="javascript" src="../../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 

<?php  $theme=$_SESSION['theme'];
      if($theme==1){
      include("menu_car.html");  
} else {
     include("menu2_car.html"); }
    ?>
<div class="ventana_2">
            <?php include("n_car.html"); ?>
        </div>
        


    <body style="background-color:#eee;">
      

<?php require_once("../../conex/conex.php");
mysqli_select_db($conex, $database_conex);

$query_fac = "SELECT IDECAR,NOMCAR FROM COO,CAR WHERE IDECOO=COOCAR && COOCAR='$idecoo'";
$fac = mysqli_query($conex, $query_fac) or die(mysqli_error());
$row_fac = mysqli_fetch_assoc($fac);
$totalRows_fac = mysqli_num_rows($fac);
 if ($totalRows_fac == 0) { ?>
    <h4 align="center">NO HAY CARGOS EXISTENTES</h4>
    <?php }?>
    <?php if ($totalRows_fac > 0) {  ?>
       
                    
        <div class="tabla reportes">
           

        <table id="tabla_coor"> 
           <thead>
           <tr>
                <th rowspan="2" style="background-color: #AC193D">N°</th>
                <th rowspan="2" style="background-color: #AC193D">CAUSA</th>
            </tr>
        </thead>
        
 <?php 
do { 
$idecar=$row_fac['IDECAR'];
$nomcar=$row_fac['NOMCAR'];
?>

<tbody>
            <tr>
                <td><?php echo $row_fac['IDECAR']; ?></td>
                <td><?php echo $row_fac['NOMCAR']; ?></td>
            </tr>
<?php } while ($row_fac = mysqli_fetch_assoc($fac)); ?>
</tbody>
        </table>
        
    </div>
       
<?php } ?>
            
            
    

      
    </body>
<script type="text/javascript"> filtro_coor2(); </script>
    </html>

 <?php 
 }else{
    session_destroy();
    header("Location: ../" );
 }
}else{ 
    header("Location: ../" );}
 ?>
    