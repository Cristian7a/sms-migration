<?php 
session_start();
if (isset($_SESSION["user"])){ 
     if ($_SESSION["nivel"]<=2){  
$user=$_SESSION['user'];
if (isset($_GET['ven'])){
	$ventana=$_GET['ven']; ?>
<?php
} 
?>
<html>
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/validar_compo.js"></script>
<script src = "js/validar_inv.js"></script>
<script src = "js/validar_pro.js"></script>
<script src = "js/validar_res.js"></script>
<script src = "js/validar_res_asignar.js"></script>
<script src = "js/validar_ejemplo_taxonomia.js"></script>
<!--<script src = "js/validar_comen.js"></script>-->
<script src = "js/validar_eva.js"></script>
<script src = "../js/jquery-migrate-1.2.1.min.js"></script>

<?php
require_once("head.html"); 

 $theme = $_SESSION['theme'] ?? 0;
 $org=$_SESSION["org"];
 if($org=="EJECUTIVO RESPONSABLE"){
      if($theme==1){include("menu_visualizacion/menu_ver_gestion.html");  
} else {include("menu_visualizacion/menu_ver_gestion_2.html"); }
 }else{
if($theme==1){include("menu_ver_gestion.html");}else{include("menus_2/menu_ver_gestion.html");}
 }
      
    ?>
    



    <body>
    <div style="height:92%;overflow-y: scroll; margin-left:1.5em;"> 
  

   <div class="f2"> 
    <br>
    <div style="width:33%;float:left;height:100px;">

       <h2><a href="#" id="boton_o" style="text-decoration:none;">-</a> Datos del reportante:</h2>              
                        <div id="mostrar" >
                        <div class="campo">    
                        <table id="dat_emp">

                        </table>
                        </div></div>
    </div>
    <div style="width:33%;float:left;height:100px;">
      <h2><a href="#" id="boton_o2" style="text-decoration:none;">-</a> Datos del reporte:</h2>
                    <div id="mostrar2" >   
                    <div class="campo">
                        <table id="dat_rep">
                        </table>
                     </div>
                     </div>  
    </div>
    <div style="width:34%;float:left;height:120px;">
      <h2>Peligro:</h2>
                     <div class="campo">
                     <table id="dat_pel">
                     </table>   
                     </div> 

    </div>
 
            <div style="margin-top:5em">
            	<h2 >Componentes específicos del peligro y consecuencias potenciales específicas del peligro</h2>
            </div>
            
       
        
            <div  style="overflow: auto">
            <table >
               <thead style="background:#16365C;color: #fff;"><tr>
                <th colspan="2" bgcolor="green">B</th>
                <th bgcolor="green">C</th>
                <th bgcolor="#FFF000"></th>
                
    

            </tr>
                <tr>
                  
                <th bgcolor="#ccc" style="color:#000">DESCRIPCIÓN DETALLADA DEL EVENTO</th>
                <th bgcolor="#ccc" style="color:#000">PELIGRO ESPECÍFICO</th>
                <th bgcolor="#ccc" style="color:#000">CONSECUENCIAS DEL PELIGRO ESPECÍFICO</th>
                <th>PERIODO DE TOLERABILIDAD</th>
                <th>PROPUESTAS</th>
                <th>MEDIDAS DE MITIGACIÓN</th>
                <th>REEVALUACIÓN DEL RIESGO</th>
                <th></th>
                <th></th>
               
               

            </tr></thead>

            <TBODY id="rie">

            </TBODY>

            </table>
             </div> 
         <?php
          if($_SESSION["nivel"]<>2){ ?>
            <form method="get"  action="javascript:openventana('.ventana_2');"><button class="boton" type="submit">AGREGAR COMPONENTE</button></form>
          <?php  } ?>     
            
            <br>
            <br>
            
        </div>          
<?php
            require_once("../conex/conex.php"); 
            mysqli_select_db($conex, $database_conex);
            $iderep=$_GET['IDEREP'];

            $query_reunion = "SELECT IDEPRO FROM PRO,RIE WHERE PELRIE=$iderep && IDERIE=RIEPRO && FINPRO IS NULL";
            $reunion = mysqli_query($conex, $query_reunion) or die(mysqli_error($conex));
            $row_reunion = mysqli_fetch_assoc($reunion);
            $totalRows_reunion = mysqli_num_rows($reunion);
            if($totalRows_reunion==0){ ?>
            <h2>Reunión del reporte: Reunión concluida</h2>

            <?php }else { ?>

            <h2>Reunión del reporte: En curso</h2>

            <?php }

                        $query_idpro = "SELECT IDERIE,DESRIE,CONRIE FROM RIE WHERE PELRIE=$iderep";
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
              
              $iderie=$row_idpro['IDERIE']; 
              $desrie=$row_idpro['DESRIE'];
              $conrie=$row_idpro['CONRIE'];?>
  <button class="tablinks" onclick="openTab(event, '<?php echo $iderie; ?>')" id="defaultOpen">CONSECUENCIA<br><?php echo $count.".-".$conrie; ?></button>
          <?php 
        $count=$count+1;
        } while ($row_idpro = mysqli_fetch_assoc($idpro)); }?>
</div>
<?php include("pestaña.php");  ?>







        
   </div> 

    </body>
         <div class="ventana">
            <?php include("ventanas_modales/n_ges.html"); ?>
        </div>
        <div class="ventana_2">
            <?php include("ventanas_modales/n_com.html"); ?>
        </div>

         <div class="ventana_4">
            <?php include("ventanas_modales/e_mon.html"); ?>
        </div>
        <div class="ventana_5">
            <?php include("ventanas_modales/e_rie.html"); ?>
        </div>
        <div class="ventana_6">
            <?php include("ventanas_modales/e_dif.html"); ?>
        </div>
        <div class="ventana_9">
            <?php include("ventanas_modales/propuestas.html"); ?>
        </div>
         <div class="ventana_9_5">
            <?php include("ventanas_modales/medidas_mitigacion.html"); ?>
        </div>
          <div class="ventana_7">
            <?php include("ventanas_modales/involucrados.html"); ?>
        </div>
        <div class="ventana_8">
            <?php include("ventanas_modales/n_inv.html"); ?>
        </div>
        <div class="ventana_10">
            <?php include("ventanas_modales/responsable_asignar.html"); ?>
        </div>
        <div class="ventana_11">
            <?php include("ventanas_modales/responsable_ejecutar.html"); ?>
        </div>
        <div class="ventana_12">
            <?php include("ventanas_modales/e_pro.html"); ?>
        </div>
         <div class="ventana_13">
            <?php include("ventanas_modales/comen.html"); ?>
        </div>
         <div class="ventana_14">
            <?php include("ventanas_modales/eva.html"); ?>
        </div>
        <div class="ventana_15">
            <?php include("ventanas_modales/n_pro.html"); ?>
        </div>
        <div class="ventana_16">
            <?php include("ventanas_modales/n_res_asignar.html"); ?>
        </div>
         <div class="ventana_17">
            <?php include("ventanas_modales/n_res.html"); ?>
        </div>
        <div class="ventana_18">
            <?php include("ventanas_modales/cerrar_propuesta.html"); ?>
        </div>
        <div class="ventana_19">
            <?php include("ventanas_modales/nuevo_ejemplo_taxonomia.html"); ?>
        </div>
         <div class="ventana_20">
            <?php include("ventanas_modales/minut.html"); ?>
        </div>
        <div class="ventana_21">
            <?php include("ventanas_modales/lista.html"); ?>
        </div>
        <div class="ventana_22">
            <?php include("ventanas_modales/e_est.html"); ?>
        </div>
         



<script type="text/javascript">

boton_toggle('boton_o','mostrar');
boton_toggle('boton_o2','mostrar2');
<?php $ide=$_GET['IDEREP'];?>
cargari_rep(<?php echo($ide);?>);
cargari_rep2(<?php echo($ide);?>);
cargarti_emp(<?php echo($ide);?>);
cargarti_pel(<?php echo($ide);?>);
cargar_rie(<?php echo($ide);?>);
checar_reg_pel(<?php echo($ide);?>);
cargar_coo("area1");
cargar_coo("area_res");
cargar_coo("area_res_asignar");
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
    
