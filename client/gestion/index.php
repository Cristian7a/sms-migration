<?php 
session_start();
if (isset($_SESSION["user"])){ 
     if ($_SESSION["nivel"]<=2){ 
$user=$_SESSION['user']; 
?>
<html>

<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 

<?php  
require_once("head.html"); 



$theme = $_SESSION['theme'] ?? 0;
      if($theme==1){
      include("menu_index.html");  
} else {
     include("menus_2/menu_index.html"); }
    ?>


<div class="ventana_3">
            <?php include("ventanas_modales/e_ges.html"); ?>
        </div>



    <body style="background-color:#eee;">
    <div  style="height:92%;overflow-y: scroll;">
      <div class="reporte">

<?php require_once("../conex/conex.php");
mysqli_select_db($conex, $database_conex);
$query_pel = "SELECT IDEREP,FECREP,CONPEL,OBJPEL,ACTPEL,CATEPEL,FECPEL,GENPEL,NOMGESPEL,ESTMON,FECCIE,METIDEPEL FROM REP,PEL,MON WHERE IDEREP=REPPEL && PELMON=REPPEL ";
$pel = mysqli_query($conex, $query_pel) or die(mysqli_error());
$row_pel = mysqli_fetch_assoc($pel);
$totalRows_pel = mysqli_num_rows($pel);
 if ($totalRows_pel == 0) { ?>
    <br>
    <h2 align="center">NO HAY REPORTES EN GESTIÓN </h2>
    <?php }?>
    <?php if ($totalRows_pel > 0) {  ?>
       
                    
        <div class="tabla reportes">
            

        <table id="tabla_ges"> 
           <thead>
           <tr>
                <th rowspan="2">MES</th>
                <th width="20px" rowspan="2">N°</th>
                <th rowspan="2">FECHA DE REPORTE</th>
                <th rowspan="2">FECHA INICIO GESTIÓN</th>
                <th rowspan="2">QUIEN GESTIONA</th>
                <th colspan="3" bgcolor="red">PELIGRO</th>
                <th rowspan="2">CATEGORÍA DEL PELIGRO</th>
                <th bgcolor="green" colspan="1">A</th>
                <th rowspan="2">MÉTODO DE IDENTIFICACIÓN DEL PELIGRO</th>     
                <th rowspan="2">ESTATUS</th>       
                <th rowspan="2">VER GESTIÓN</th>
                <th rowspan="2"></th>

                

            </tr>
                <tr>
         
                <th style="color:#fff000">CONDICIÓN</th>
                <th style="color:#fff000">OBJETO</th>
                <th style="color:#fff000">ACTIVIDAD</th>
                <th bgcolor="#ccc" style="color:#000">PELIGRO GENÉRICO</th>
              
                
               
               

            </tr>

        </thead>
        
 <?php 
do { 
$iderep=$row_pel['IDEREP'];
$fecrep=$row_pel['FECREP'];
$fecpel=$row_pel['FECPEL'];
$fecrep=date("d-m-Y",strtotime($fecrep));
$fecpel=date("d-m-Y",strtotime($fecpel));
$mes=strftime("%B", strtotime($fecrep));
$mes = mb_strtoupper($mes);
?>

<tbody>
            <tr>
                <td style="color:#fff; background-color:#2672EC" ><?php echo utf8_encode($mes); ?></td>
                <td align="center"><?php echo utf8_encode($iderep); ?></td>
                <td align="center"><?php echo ($fecrep); ?></td>
                <td align="center"><?php echo $fecpel; ?></td>
                <td align="center"><?php echo utf8_encode($row_pel['NOMGESPEL']); ?></td>
                <td align="center"><?php echo $row_pel['CONPEL']; ?></td>
                <td align="center"><?php echo $row_pel['OBJPEL']; ?></td>
                <td align="center"><?php echo $row_pel['ACTPEL']; ?></td>
                <td align="center"><?php echo $row_pel['CATEPEL'];?></td>
                <td align="center"><?php echo $row_pel['GENPEL']; ?></td>
                <td align="center"><?php echo $row_pel['METIDEPEL']; ?></td>
                <td align="center"><?php echo $row_pel['ESTMON']; ?></td>
                <td align="center"><a href="ver_gestion.php?IDEREP=<?php echo $iderep;?>"><IMG height="20px" SRC="../imagenes/gestion.png"></a></td>
                <td><?php if($_SESSION["nivel"]<>2) { ?>
 <a href="javascript:openventana_var('.ventana_3',<?php echo $iderep; ?>,'IDREP','g3');"><IMG height='20px' SRC='../imagenes/edit.png'></a>
<?php } ?>
</td>
                   
                   
                  
                
            </tr>
<?php } while ($row_pel = mysqli_fetch_assoc($pel)); ?>
</tbody>
        </table>
        
    </div>
       
<?php } ?>
            
            
    

      </div>
      </div>
        
    </body>
<script type="text/javascript"> filtro_ges(); </script>
    </html>

 <?php 
 }else{
    session_destroy();
    header("Location: ../" );
 }
}else{ 
    header("Location: ../" );}
 ?>
    