                       <?php
                       
                         $query_pro = "SELECT IDEPRO,DESPRO FROM PRO WHERE RIEPRO=$iderie";
                        $pro = mysqli_query($conex, $query_pro) or die(mysqli_error($conex));
                        $row_pro = mysqli_fetch_assoc($pro);
                        $totalRows_pro = mysqli_num_rows($pro);
                        if ($totalRows_pro == 0) {?>
                           
                           <?php } 
                           if ($totalRows_pro > 0) {
                            $count=1;
                   

                         do { $idepro2=$row_pro['IDEPRO']; ?>

                        <div id="<?php echo $idepro2; ?>" class="tabcontent">
                        
                        <table>
                        
                        <TBODY>
                        <tr>
                        <td  height="auto"> <h3><?php echo utf8_encode(($row_pro['DESPRO'])); ?></h3></td>
                       </tr>
                       </TBODY>
                        </table>
                        <div class="subtabla">
                          <hr>
            <table id="data_res" >
                 <?php
                  $query_res ="SELECT IDERES,NOMEMP,APPEMP,APMEMP,NOMCAR,NOMCOO FROM EMP,CAR,COO,PER,RES WHERE PRORES=$idepro2 && IDEPER=EMPRES  && IDECAR=CARPER && COOCAR=IDECOO && IDEEMP=EMPPER ";
                        $res = mysqli_query($conex, $query_res) or die(mysqli_error());
                        $row_res = mysqli_fetch_assoc($res);
                        $totalRows_res = mysqli_num_rows($res);
                        if ($totalRows_res == 0) {?>
                           <h3>  Aún no hay responsables asignados </h3>
            <TBODY>

                        <?php } 
                         if ($totalRows_res > 0) {?>
                         <tr><td><h3>Responsable(s) propuesto(s)</h3></td></tr>
                        <?php do { 
                          $ideres=$row_res['IDERES'];
                        ?>
                        
                        <tr style="background-color: #fff;color:#000;">
                        <td><?php echo utf8_encode(($row_res['NOMEMP']." ".$row_res['APPEMP']." ".$row_res['APMEMP'])); ?></td>
                        <td><?php echo utf8_encode(($row_res['NOMCAR']." / ".$row_res['NOMCOO'])); ?></td>
                       
                        </tr> 
              <?php } while ($row_res = mysqli_fetch_assoc($res)); }?>

            </TBODY>


              </table>
            </div>
            <hr>
             <?php $query_com = "SELECT COMCOM,NOMCOM,FECCOM FROM COM,RIE WHERE RIECOM=IDERIE && RIECOM=$idepro2 ";
                        $com = mysqli_query($conex, $query_com) or die(mysqli_error());
                        $row_com = mysqli_fetch_assoc($com);
                        $totalRows_com = mysqli_num_rows($com);
                        $aceptado=0;
                        if ($totalRows_com == 0) {?>
                        <h3>Nadie ha aceptado la propuesta </h3>
                        <?php }else{ ?>
            <div style='height:250px;overflow-y: scroll;'> 
                        <table>
                        <tr>
                       <H3>Comentarios</H3>
                       </tr> 
                        <?php
                        
                            do{
                                $nomcom=$row_com['NOMCOM'];
                                $comentario=$row_com['COMCOM'];
                                $nombre=$_SESSION['nombre'];
                                $feccom=$row_com['FECCOM'];
                                $feccom=date("d-m-Y",strtotime($feccom));
                                if ($nomcom==$nombre && $comentario=="ACEPTO"){$aceptado=1;}?>

                             <tr>
                             <td  style="background-color: #008299;color:#fff;" width="auto" height="10px" align="left">Comentado el <?php echo utf8_encode(($feccom)); ?> </td>
                           </tr>
                           <tr >
                            <td  style="border: 1px solid #ddd; background-color: #ebf1f1; "  align="left" width="80px"><b> <?php echo utf8_encode(($nomcom)); ?></b></td>
                             </tr>
                             <tr>
                            <td  style="border: 1px solid #ddd; " height="50px"> <?php echo utf8_encode(($row_com['COMCOM'])); ?> </td>
                           </tr>
                      <?php } while ($row_com = mysqli_fetch_assoc($com)); ?>
</table>
</div>
<?php } ?>
        <div class="ventana_2">
            <?php include("n_com.html"); ?>
        </div>
<?php if ($aceptado==0){ ?>
<hr>
<form method="post" id="form_aceptar"  action="query/alta_com.php" name="form_aceptar">
   <input type="hidden" id="com" name="com" value="ACEPTO"/> 
   <input type="hidden" id="pro" name="pro" value="<?php echo $idepro2;?>"/>
   <input type="hidden" id="IDEREP" name="IDEREP" value="<?php echo $iderep;?>"/>
   <input type="hidden" id="IDERIE" name="IDERIE" value="<?php echo $iderie;?>"/>
   <input type="hidden" id="conf" name="conf" value="<?php echo $confidencial;?>"/>
   <input type="submit" class="boton"  value="ACEPTAR PROPUESTA" name="enviar" id="enviar">
</form>
<form method="post" id="form_rechazar"  action="javascript:openventana('.ventana_2');" name="form_rechazar">
   <input type="submit" class="boton"  value="RECHAZAR PROPUESTA" name="enviar_r" id="enviar_r">
</form>
<?php } ?>

                      </div>
              <?php  } while ($row_pro = mysqli_fetch_assoc($pro)); }?>

