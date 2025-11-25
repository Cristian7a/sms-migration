<?php 
session_start();
$iderep=$_GET['IDEREP'];
$iderie=$_GET['IDERIE'];
$idepro=$_GET['IDEPRO'];
$conf=1;
if (isset($_SESSION["user"])){ 
  if ($_SESSION["nivel"]<=4){ 
  $user=$_SESSION['user'];
  ?>

<html>
<head>
     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Involucrado</title>
        <link rel="shortcut icon" href="../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<link rel='stylesheet' id='plantilla'  href='css/plantilla_inv.css' type='text/css' media='all' />
<link rel='stylesheet' id='plantilla'  href='../icomoon/style.css' type='text/css' media='all' />
<script src = "../js/jquery-3.3.1.min.js"></script>
<script src = "../js/control_inv.js"></script>
<header>
  <?php
  $theme=$_SESSION['theme'];
        if($theme==1){
                 include("menu_ver_reporte.html");  
                    } else {
                include("menus_2/menu_ver_reporte.html"); }
            ?>
    </header>
    <body>
  
                  
   <div class="f2"> 
   <br>
 <h2>Detalles del Peligro:</h2> 
                     <table id="dat_pel">
                     </table>   
                
 <hr><br>            
             <?php require_once("../conex/conex.php"); 
            mysqli_select_db($conex, $database_conex);

             $query_reunion = "SELECT IDEPRO FROM PRO,RIE WHERE PELRIE=$iderep && IDERIE=RIEPRO && FINPRO IS NULL";
            $reunion = mysqli_query($conex, $query_reunion) or die(mysqli_error($conex));
            $row_reunion = mysqli_fetch_assoc($reunion);
            $totalRows_reunion = mysqli_num_rows($reunion);
            if($totalRows_reunion==0){ ?>
            <h2>Reunión del reporte: Reunión concluida</h2>

            <?php }else { ?>

            <h2>Reunión del reporte: En curso</h2>

            <?php }





            $query_pro = "SELECT * FROM PRO,INV WHERE RIEPRO=$iderie && PERINV=$user && IDEPRO=PROINV ";
                        $pro=mysqli_query($conex, $query_pro) or die(mysqli_error());
                        $row_pro = mysqli_fetch_assoc($pro);
                        $totalRows_pro = mysqli_num_rows($pro);
                        $contador=0;
                        if ($totalRows_pro == 0) {?>
                        <h3>No existen propuestas de mitigación para este riesgo </h3>
                        <?php }else{ 
                           do {

                            $contador++;
                            $idepro=$row_pro['IDEPRO'];?>
                            <br>
                            <h2>Propuesta <?php echo $contador;?></h2><hr>
                            
                            <table><td><?php echo utf8_encode("<b>".$row_pro['DESPRO'].'</b><br><br>'); ?></td></table>

                            <?php
                           $query_rea ="SELECT NOMEMP,APPEMP,APMEMP,NOMCAR,NOMCOO FROM EMP,CAR,COO,PER,PRO WHERE RESPRO=IDEPER && IDECAR=CARPER && COOCAR=IDECOO && IDEEMP=EMPPER && IDEPRO=$idepro";
                          $rea = mysqli_query($conex, $query_rea) or die(mysqli_error());
                          $row_rea = mysqli_fetch_assoc($rea);
                          $totalRows_rea = mysqli_num_rows($rea);
                           if ($totalRows_rea == 0) {?>
                            <b>Responsable de asignar:</b> --<br>
                           <?php }else { 
                            echo  "<b>Responsable de asignar:</b> ";
                          echo utf8_encode(($row_rea['NOMEMP']." ".$row_rea['APPEMP']." ".$row_rea['APMEMP'])); 
                          echo utf8_encode((" ".$row_rea['NOMCAR']." / ".$row_rea['NOMCOO']."<br>"));

                           }
                          $query_res ="SELECT IDERES,NOMEMP,APPEMP,APMEMP,NOMCAR,NOMCOO FROM EMP,CAR,COO,PER,RES WHERE PRORES=$idepro && IDEPER=EMPRES && IDECAR=CARPER && COOCAR=IDECOO && IDEEMP=EMPPER ";
                          $res = mysqli_query($conex, $query_res) or die(mysqli_error());
                          $row_res = mysqli_fetch_assoc($res);
                          $totalRows_res = mysqli_num_rows($res);
                          if ($totalRows_res == 0) {?>
                          <br>

                           <b>Responsable de ejecutar propuesta:</b> --
                           
                           <br>
                           <br>
                           <?php }else{ ?>
                           <br>
                           <b>Responsable(s) de ejecutar propuesta:</b><br>
                           <?php
                            do { 
                          
                          $ideres=$row_res['IDERES'];
                          echo utf8_encode(($row_res['NOMEMP']." ".$row_res['APPEMP']." ".$row_res['APMEMP'])); 
                          echo utf8_encode((" ".$row_res['NOMCAR']." / ".$row_res['NOMCOO']."<br>"));
                        
                         } while ($row_res = mysqli_fetch_assoc($res)); } 
                         echo "<br>"; ?>


                            
       
        <?php $query_com = "SELECT COMCOM,NOMCOM,FECCOM FROM COM,PRO WHERE PROCOM=IDEPRO && PROCOM=$idepro ";
                        $com = mysqli_query($conex, $query_com) or die(mysqli_error());
                        $row_com = mysqli_fetch_assoc($com);
                        $totalRows_com = mysqli_num_rows($com);
      
                        if ($totalRows_com == 0) {?>
                        <br>
                        <?php }else{ ?>
                        <h2>Comentarios</h2><br>
            <div style='width:90%;height:150px;overflow-y: scroll; border: 1px solid #000; border-radius:5px;'> 
                        <table>
                        
                        <?php
                        
                            do{
                                $nomcom=$row_com['NOMCOM'];
                                $comentario=$row_com['COMCOM'];
                                $nombre=$_SESSION['nombre'];
                                $feccom=$row_com['FECCOM'];
                                $feccom=date("d-m-Y",strtotime($feccom));
                                if ($nomcom==$nombre && $comentario=="ACEPTO"){$aceptado=1;}?>

                           <tr >
                            <td  style="border: 1px solid #ddd; background-color: #ebf1f1; "  align="left" width="80px"><b>Comentado el <?php echo utf8_encode(($feccom)); ?> Por: <?php echo utf8_encode(($nomcom)); ?></b></td>
                             </tr>
                             <tr>
                            <td  style="border: 1px solid #ddd; " height="50px"> <?php echo utf8_encode(($row_com['COMCOM'])); ?> </td>
                           </tr>
                      <?php } while ($row_com = mysqli_fetch_assoc($com)); ?>
</table>
</div>
<?php } ?>
                          
                          
                            <?php if ($row_pro['FINPRO']!=NULL || $aceptado==1){ 
                              echo("<br><b>Nota:</b>Ya has aceptado la propuesta, no te es posible volver a comentar."); ?>
 
                              <?php } else {  ?>

                                <table>
                            <tr><td width="100px"><form method="post" id="form_aceptar"  action="query/alta_com.php" name="form_aceptar">
                             <input type="hidden" id="com" name="com" value="ACEPTO"/> 
                             <input type="hidden" id="IDEREP" name="IDEREP" value="<?php echo $iderep;?>"/>
                              <input type="hidden" id="IDEPRO" name="IDEPRO" value="<?php echo $idepro;?>"/>
                              <input type="hidden" id="IDERIE" name="IDERIE" value="<?php echo $iderie;?>"/>
                              <input type="submit" class="boton"  value="ACEPTAR" name="enviar" id="enviar">
                              </form></td>
                              <td><form method="post" id="form_rechazar"  action="javascript:openventana('.ventana_2');" name="form_rechazar">
                                  <input type="submit" class="boton"  value="RECHAZAR" name="enviar_r" id="enviar_r">
                                  </form></td></tr>
                          </table>
                          <br>



<?php

  } ?>
                          <br><br><hr><hr><hr><br>



                          <?php
                           } while ($row_pro = mysqli_fetch_assoc($pro));
                          } ?>
                          

                         

<div class="ventana_2">
            <?php include("n_com.html"); ?>
        </div>



            </div>




       
      </div>     
   
    </body>
         <div class="ventana">
            <?php include("mas_reporte.html"); ?>
        </div>


<script type="text/javascript">
//boton_toggle('boton_o','mostrar');
//boton_toggle('boton_o2','mostrar2');
cargarti_pel(<?php echo($iderep);?>,<?php echo($iderie);?>);
cargari_rep2(<?php echo($iderep);?>);

//document.getElementById("defaultOpen").click();
//boton_toggle('boton_o','mostrar');
</script>

</html>

<?php 
 }else{
    session_destroy();
    header("Location: ../" );
 }
 }else{ 
header("Location: index.php" );}
 ?>