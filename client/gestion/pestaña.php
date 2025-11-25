                       <?php

                         $query_rie = "SELECT IDERIE,DESRIE FROM RIE WHERE PELRIE=$iderep";
                        $rie = mysqli_query($conex, $query_rie) or die(mysqli_error());
                        $row_rie = mysqli_fetch_assoc($rie);
                        $totalRows_rie = mysqli_num_rows($rie);
                        if ($totalRows_rie == 0) {?>
                           
                           <?php } 
                           if ($totalRows_rie > 0) {
                            $count=1;
                   

                         do { $iderie=$row_rie['IDERIE']; ?>

                        <div id="<?php echo $iderie; ?>" class="tabcontent">
                        
                        <table>
                        
                        <TBODY>
                        <tr>
                        <td  height="auto"> <h2>PELIGRO ESPECIFICO: <?php echo (($row_rie['DESRIE'])); ?></h2></td>
                       </tr>
                       </TBODY>
                        </table>
                        <!--
                        <div class="subtabla">
                          <hr>
                          
            <table id="data_res" >
                AQUI HIBA LA TABLA DE EMPLEADOS RESPONSABLES
              </table> 
            </div> -->
            <br>
            
             <?php $query_pro = "SELECT * FROM PRO WHERE RIEPRO=$iderie";
                        $pro=mysqli_query($conex, $query_pro) or die(mysqli_error());
                        $row_pro = mysqli_fetch_assoc($pro);
                        $totalRows_pro = mysqli_num_rows($pro);
                        $contador=0;
                        $aceptado=0;
                        if ($totalRows_pro == 0) {?>
                        <h3>No existen propuestas de mitigación para este riesgo </h3>
                        <?php }else{ 
                           do {
                            $aceptado=0;
                            $contador++;
                           ?>

                              <h2>Propuesta <?php echo $contador;?>:</h2>
                             <table><td><?php echo utf8_encode("<b>".$row_pro['DESPRO'].'</b><br><br>'); ?></td></table><br>

                            <?php
                            $idepro=$row_pro['IDEPRO'];
                           $query_rea ="SELECT NOMEMP,APPEMP,APMEMP,NOMCAR,NOMCOO FROM EMP,CAR,COO,PER,PRO WHERE RESPRO=IDEPER && IDECAR=CARPER && COOCAR=IDECOO && IDEEMP=EMPPER && IDEPRO=$idepro";
                          $rea = mysqli_query($conex, $query_rea) or die(mysqli_error());
                          $row_rea = mysqli_fetch_assoc($rea);
                          $totalRows_rea = mysqli_num_rows($rea);
                           if ($totalRows_rea == 0) {?>
                            <b>Responsable de asignar: </b><a href="javascript:openventana_var('.ventana_10',<?php echo $idepro; ?>,'',10);"><IMG height='10px'  SRC='../imagenes/edit.png'></a> --<br> 
                           <?php }else { ?>
                            <b>Responsable de asignar:</b> <a href="javascript:openventana_var('.ventana_10',<?php echo $idepro; ?>,'',10);""><IMG height='10px'  SRC='../imagenes/edit.png'></a> 
                            <?php
                          echo utf8_encode(($row_rea['NOMEMP']." ".$row_rea['APPEMP']." ".$row_rea['APMEMP'])); 
                          echo utf8_encode((" ".$row_rea['NOMCAR']." / ".$row_rea['NOMCOO']."<br>"));

                           }
                          $query_res ="SELECT IDERES,NOMEMP,APPEMP,APMEMP,NOMCAR,NOMCOO FROM EMP,CAR,COO,PER,RES WHERE PRORES=$idepro && IDEPER=EMPRES && IDECAR=CARPER && COOCAR=IDECOO && IDEEMP=EMPPER ";
                          $res = mysqli_query($conex, $query_res) or die(mysqli_error());
                          $row_res = mysqli_fetch_assoc($res);
                          $totalRows_res = mysqli_num_rows($res);
                          if ($totalRows_res == 0) {?>
                          <br>

                           <b>Responsable de ejecutar propuesta:</b> <a href="javascript:openventana_var('.ventana_11',<?php echo $idepro; ?>,'',11);"><IMG height='10px' SRC='../imagenes/edit.png'></a>--
                           
                           <br>
                           <br>
                           <?php }else{ ?>
                           <br>
                           <b>Responsable(s) de ejecutar propuesta:</b><a href="Javascript:openventana_var('.ventana_11',<?php echo $idepro; ?>,'',11);"><IMG height='10px' SRC='../imagenes/edit.png'></a><br>
                           <?php
                            do { 
                          
                          $ideres=$row_res['IDERES'];
                          echo utf8_encode(($row_res['NOMEMP']." ".$row_res['APPEMP']." ".$row_res['APMEMP'])); 
                          echo utf8_encode((" ".$row_res['NOMCAR']." / ".$row_res['NOMCOO']."<br>"));
                        
                         } while ($row_res = mysqli_fetch_assoc($res)); } 
                         echo "<br>"; ?>

<!-- SECCION DE COMENTARIOS -->
                          
                              <?php $query_com = "SELECT IDECOM,COMCOM,NOMCOM,FECCOM FROM COM,PRO WHERE PROCOM=IDEPRO && PROCOM=$idepro ";
                        $com = mysqli_query($conex, $query_com) or die(mysqli_error());
                        $row_com = mysqli_fetch_assoc($com);
                        $totalRows_com = mysqli_num_rows($com);
      
                        if ($totalRows_com == 0) {?>
                        
                        <?php }else{ ?>
                        <h3>Comentarios:</h3>
                        <br>
                        <div style='width:90%;height:150px;overflow-y: scroll;  border: 1px solid #000; border-radius:5px;'> 
                        <table>
                        
                        <?php
                        
                            do{ 
                                $idecom=$row_com['IDECOM'];
                                $nomcom=$row_com['NOMCOM'];
                                $comentario=$row_com['COMCOM'];
                                $nombre=$_SESSION['nombre'];
                                $feccom=$row_com['FECCOM'];
                                $feccom=date("d-m-Y",strtotime($feccom));
                                if ($nomcom==$nombre && $comentario=="ACEPTO"){$aceptado=1;}
                                ?>


                             
                           <tr >
                            <td  style="border: 1px solid #ddd; background-color: #ebf1f1; "  align="left" width="100%"><div style="float:left;width:99%"><b> Comentado el <?php echo utf8_encode(($feccom)); ?> Por: <?php echo utf8_encode(($nomcom)); ?></b></div> <div align="right" style="float:left"><a style="color:#000;"  href="query/baja_comentario.php?IDEREP=<?php echo $iderep; ?>&IDECOM=<?php echo $idecom; ?>">X</a></div></td>
                             </tr>
                             <tr>
                            <td  style="border: 1px solid #ddd; " height="50px"> <?php echo utf8_encode(($row_com['COMCOM'])); ?> </td>
                           </tr>
                      <?php } while ($row_com = mysqli_fetch_assoc($com)); ?>
                      </table>
                      </div>
                      <?php } ?>

<!-- TERMINA SECCION DE COMENTARIOS -->
                          
                           <?php
                           if ($_SESSION["nivel"]<>2){
                           if ($row_pro['FINPRO']==NULL){ ?>
                          <table>
                            <tr><td width="100px"><form method="post" id="form_aceptar"  action="javascript:openventana_var('.ventana_18',<?php echo $idepro; ?>,'IDEPRO_FINAL',18);" name="form_aceptar">
                              <input type="submit" class="boton"  value="Cerrar propuesta" name="enviar_comen_aceptar" id="enviar_comen_aceptar">
                              </form></td>
                              <td style="border-bottom:0px;"><form method="post" id="form_rechazar"  action="javascript:openventana_var('.ventana_13',<?php echo $idepro; ?>,'IDEPRO4');" name="form_rechazar">
                                  <input type="submit" class="boton"  value="Comentar" name="enviar_r" id="enviar_r">
                                  </form></td></tr>
                          </table>
                          
                          <?php } else { echo("<br><b>Nota:</b> Propuesta cerrada, no te es posible volver a comentar.");}}?>
                          <br><br><hr><hr><hr><br>







<?php
                           } while ($row_pro = mysqli_fetch_assoc($pro));
                          } ?>
                          <br>
<!--
<hr>

<form method="post" id="form_comentar"  action="javascript:openventana_var('.ventana_13',<?php echo $iderie; ?>,'IDERIE3');" name="form_comentar">
   <input type="submit" class="boton"  value="COMENTAR" name="enviar_comentario" id="enviar_comentario">
</form>

<br> --->


                      </div>
                      <br>
              <?php  } while ($row_rie = mysqli_fetch_assoc($rie)); }?>

