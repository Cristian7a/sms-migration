<?php 
session_start();
if (isset($_SESSION["user"])){ 
     if ($_SESSION["nivel"]<=4){  
$user=$_SESSION['user'];
require_once("../conex/conex.php"); 
mysqli_select_db($conex, $database_conex);
$idejun=$_GET['IDEJUN'];

?>
<html>
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/validar_pro.js"></script>
<script src = "js/validar_tem.js"></script>
<script src = "../js/jquery-migrate-1.2.1.min.js"></script>


<?php
require_once("head.html"); 

 $theme=$_SESSION['theme'];
 $org=$_SESSION["org"];
 if($org=="EJECUTIVO RESPONSABLE"){
      if($theme==1){include("menu_visualizacion/menu_ver_gestion.html");  
} else {include("menu_visualizacion/menu_ver_gestion_2.html"); }
 }else{
if($theme==1){include("menu_gestionar_p.html");}else{include("menus_2/menu_gestionar_p.html");}
 }
      
    ?>
    



    <body>
    <div style="height:92%;overflow-y: scroll; margin-top:1em;margin-left:1.5em;"> 
  

   <div class="f2"> 

<?php

          if($_SESSION["nivel"]<>2){ 
            
            $query_tem = "SELECT * FROM TEM_JC WHERE JUNTEM=$idejun";
            $tem = mysqli_query($conex, $query_tem) or die(mysqli_error($conex));
            $row_tem = mysqli_fetch_assoc($tem);
            $totalRows_tem = mysqli_num_rows($tem);
            if($totalRows_tem==0){ ?>

            <h2>No hay temas tratados aun</h2>

            <?php }else { ?>
           <div style="margin-top:1em">
              <h1 >Temas tratados</h1>
              <br>
            </div>
            <div  style="overflow: auto">
            <table >
               <thead style="background:#16365C;color: #fff;">
                <tr>
                <th>TEMA</th>

            </tr></thead>

            <TBODY>
<?php do { 
              
              $idetem=$row_tem['IDETEM'];
              $destem=$row_tem['DESTEM']; 
?>
<tr>
<td style="font-size:12px;"><?php echo $destem; ?></td>

</tr>

          <?php 
        } while ($row_tem = mysqli_fetch_assoc($tem));  ?>
            </TBODY>

            </table>
             </div> 
             <?php }  } ?>     
            
            <br>
            <br>

            
        </div>          
<?php

                        $query_idpro = "SELECT IDETEM,DESTEM FROM TEM_JC WHERE JUNTEM=$idejun";
                        $idpro = mysqli_query($conex, $query_idpro) or die(mysqli_error($conex));
                        $row_idpro = mysqli_fetch_assoc($idpro);
                        $totalRows_idpro = mysqli_num_rows($idpro);
                        if ($totalRows_idpro == 0) {?>
                           <h3>  No hay elementos suficientes para iniciar una reunión </h3>
                           <?php } 
                           if ($totalRows_idpro > 0) {
                            $count=1;
                            ?>
          <div class="tab">
            <?php do { 
              
              $idetem=$row_idpro['IDETEM']; 
              $destem=$row_idpro['DESTEM'];?>
  <button class="tablinks" onclick="openTab(event, '<?php echo $idetem; ?>')" id="defaultOpen">TEMA <?php echo $count; ?></button>
          <?php 
        $count=$count+1;
        } while ($row_idpro = mysqli_fetch_assoc($idpro)); } ?>
</div>
<?php include("pestaña_p.php");  ?>







        
   </div> 

    </body>
     <div class="ventana">
            <?php include("ventanas_modales/n_tem.html"); ?>
        </div>
    <div class="ventana_1">
            <?php include("ventanas_modales/propuestas.html"); ?>
        </div>
     <div class="ventana_2">
            <?php include("ventanas_modales/n_pro.html"); ?>
        </div>
    <div class="ventana_3">
            <?php include("ventanas_modales/e_est.html"); ?>
        </div>
    <div class="ventana_4">
            <?php include("ventanas_modales/comentar.html"); ?>
        </div>
    <div class="ventana_5">
            <?php include("ventanas_modales/cerrar_propuesta.html"); ?>
        </div>




<script type="text/javascript">
cargar_coo("area");
document.getElementById("defaultOpen").click();



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
    
