                       <?php

                         $query_rie = "SELECT IDETEM,DESTEM FROM TEM_JC WHERE JUNTEM=$idejun";
                        $rie = mysqli_query($conex, $query_rie) or die(mysqli_error());
                        $row_rie = mysqli_fetch_assoc($rie);
                        $totalRows_rie = mysqli_num_rows($rie);
                        if ($totalRows_rie == 0) {?>
                           
                           <?php } 
                           if ($totalRows_rie > 0) {
                            $count=1;
                   

                         do { $idetem=$row_rie['IDETEM']; ?>

                        <div id="<?php echo $idetem; ?>" class="tabcontent">
                        
                        <table>
                        
                        <TBODY>
                        <tr>
                        <td  height="auto"> <h2> <?php echo (($row_rie['DESTEM'])); ?></h2></td>
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
            
             <?php 
             $query_pro = "SELECT * FROM PRO_JC WHERE TEMPRO=$idetem";
                        $pro=mysqli_query($conex, $query_pro) or die(mysqli_error());
                        $row_pro = mysqli_fetch_assoc($pro);
                        $totalRows_pro = mysqli_num_rows($pro);
                        $contador=0;
                        $aceptado=0;
                        if ($totalRows_pro == 0) {?>
                        <h3>No existen propuestas aun </h3>
                        <?php }else{ 
                           do {
                            $aceptado=0;
                            $contador++;
                           ?>

                              <h2>Propuesta <?php echo $contador;?>:</h2>
                             <table><td><?php echo utf8_encode("<b>".$row_pro['DESPRO'].'</b><br><br>'); ?></td></table><br>

                            <?php
                            $idepro=$row_pro['IDEPRO'];
                           $query_rea ="SELECT NOMEMP,APPEMP,APMEMP FROM PRO_JC,PER,EMP WHERE IDEEMP=EMPPER && IDEPER=RESPRO && IDEPRO=$idepro";
                          $rea = mysqli_query($conex, $query_rea) or die(mysqli_error());
                          $row_rea = mysqli_fetch_assoc($rea);
                          $totalRows_rea = mysqli_num_rows($rea);
                           if ($totalRows_rea == 0) {?>
                            <b>Responsable : </b><a href=""><!--<IMG height='10px'  SRC='../imagenes/edit.png'>--></a> --<br> 
                           <?php }else { ?>
                            <b>Responsable :</b> <a href=""><!--<IMG height='10px'  SRC='../imagenes/edit.png'>--></a> 
                            <?php
                          echo utf8_encode(($row_rea['NOMEMP']." ".$row_rea['APPEMP']." ".$row_rea['APMEMP']));

                           }
                         
                        $query_com = "SELECT IDECOM,COMCOM,ASICOM,FECCOM FROM COM_JC,PRO_JC WHERE PROCOM=IDEPRO && PROCOM=$idepro ";
                        $com = mysqli_query($conex, $query_com) or die(mysqli_error());
                        $row_com = mysqli_fetch_assoc($com);
                        $totalRows_com = mysqli_num_rows($com);
                        
                        if ($totalRows_com == 0) {?>
                        
                        <?php }else{ ?>
                        <br>
                        <h3>Comentarios:</h3>
                        <br>
                        <div style='width:90%;height:150px;overflow-y: scroll;  border: 1px solid #000; border-radius:5px;'> 
                        <table>
                        
                        <?php
                        
                            do{ 
                                $idecom=$row_com['IDECOM'];
                                $nomcom=$row_com['ASICOM'];
                                $comentario=$row_com['COMCOM'];
                                $nombre=$_SESSION['user'];
                                $feccom=$row_com['FECCOM'];
                                $feccom=date("d-m-Y",strtotime($feccom));
                                if ($nomcom==$nombre && $comentario=="ACEPTO"){$aceptado=1;}
                                ?>


                             
                           <tr >
                            <td  style="border: 1px solid #ddd; background-color: #ebf1f1; "  align="left" width="100%"><div style="float:left;width:99%"><b> Comentado el <?php echo utf8_encode(($feccom)); ?> Por: <?php echo utf8_encode(($nomcom)); ?></b></div> <div align="right" style="float:left"><a style="color:#000;"  href="query/baja_com.php?IDEJUN=<?php echo $idejun; ?>&IDECOM=<?php echo $idecom; ?>">X</a></div></td>
                             </tr>
                             <tr>
                            <td  style="border: 1px solid #ddd; " height="50px"> <?php echo utf8_encode(($row_com['COMCOM'])); ?> </td>
                           </tr>
                      <?php } while ($row_com = mysqli_fetch_assoc($com)); ?>
                      </table>
                      </div>
                      <?php }?>

<!-- TERMINA SECCION DE COMENTARIOS -->
                          
                           <?php 
                           if ($_SESSION["nivel"]<>2){
                           if ($row_pro['ESTPRO']=="ABIERTO"){ ?>
                            <br><br>
                          <table>
                            <tr>
                              <td style="border-bottom:0px;"><form method="post" id="form_rechazar"  action="javascript:openventana_var('.ventana_4',<?php echo $idepro; ?>,'IDEPRO4');" name="form_rechazar">
                                  <input type="submit" class="boton"  value="Comentar" name="enviar_r" id="enviar_r">
                                  </form></td></tr>
                          </table>
                          
                          <?php } else { echo("<br><b>Nota:</b> Propuesta cerrada, no te es posible volver a comentar.");}} ?>
                          <br><br><hr><hr><hr><br>







<?php
                           } while ($row_pro = mysqli_fetch_assoc($pro));
                          } ?>
                          <br>



                      </div>
                      <br>
              <?php  } while ($row_rie = mysqli_fetch_assoc($rie)); }?>

