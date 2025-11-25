<?php

 $idecap=$_GET['IDECAP'];

require_once '../dompdf1/lib/html5lib/Parser.php';
require_once '../dompdf1/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once '../dompdf1/lib/php-svg-lib/src/autoload.php';
require_once '../dompdf1/src/Autoloader.php';
Dompdf\Autoloader::register();

   require_once('../conex/conex.php');
 mysqli_select_db($conex, $database_conex);
        echo $idecap;
        $query_cap="SELECT * FROM CAP WHERE IDECAP='$idecap'";
        $cap = mysqli_query($conex, $query_cap) or die(mysqli_error($conex));
        $row_cap = mysqli_fetch_assoc($cap);
        $totalRows_cap = mysqli_num_rows($cap);
        if($totalRows_cap == 0) { ?>
            <h2 align="center">No hay capacitaciones en existencia aún</h2>
        <?php }?>
        <?php if($totalRows_cap > 0) {  
          $idecap=$row_cap['IDECAP'];
          $ncucap=$row_cap['NCUCAP'];
          $pobcap=$row_cap['POBCAP'];
          $hrtcap=$row_cap['HRTCAP'];
          $htecap=$row_cap['HTECAP'];
          $hprcap=$row_cap['HPRCAP'];
          $fincap=$row_cap['FINCAP'];
          $hincap=$row_cap['HINCAP'];
          $ffncap=$row_cap['FFNCAP'];
          $hfncap=$row_cap['HFNCAP'];
          $lugcap=$row_cap['LUGCAP'];
          }  

$codigoHTML='<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
*{font-size:12px;font-family:sans-serif;}
table{}
th{text-align:center;border:1px solid #000;}
td{border-bottom:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;
}
</style>

<table style="width:100%;">
<thead>
<tr>
<th width="60%">NOMBRE DEL PROGRAMA:</th>
<th style="empty-cells: hide; border: none"></th>
<th width="30%">DURACIÓN:</th>
</tr>
</thead>
<tbody>
<tr>
 <td width="60%" align="center">'.$ncucap.'</td>
 <th style="empty-cells: hide; border: none"></th>
 <td width="30%" align="center">'.$hrtcap.' HORAS</td>
</tr>
</tbody>
</table><br>


<table style="width:100%;">
<thead>
<tr>
<th width="60%">OBJETIVO GENERAL:</th>
<th width="40%" style="empty-cells: hide; border: none"></th>
</tr>
</thead>
<tbody>';
                  
                                    $query_cap2="SELECT IDEOBJ,TIPOBJ,DESOBJ FROM OBJ,CAP WHERE OBJCAP='$idecap' AND OBJCAP=IDECAP AND TIPOBJ='GENERAL'";
                                      $cap2 = mysqli_query($conex, $query_cap2) or die(mysqli_error($conex));
                                    $row_cap2 = mysqli_fetch_assoc($cap2);
                                    $totalRows_cap2 = mysqli_num_rows($cap2);
                                    if($totalRows_cap2 == 0) { ?>
                                    <tr>
                                      <td nowrap width="50%">NO HAY OBJETIVOS GENERALES AÚN</td>
                                    </tr>
                                    <?php } if($totalRows_cap2 > 0) { 
                                    do { 
                                      $desobj=$row_cap2["DESOBJ"];
                                      $ideobj=$row_cap2["IDEOBJ"];

                          $codigoHTML=$codigoHTML.'<tr>
                          <td nowrap width="50%">'.$desobj.'</td></tr>';

                        } while ($row_cap2 = mysqli_fetch_assoc($cap2)); }


$codigoHTML=$codigoHTML.'
</tbody>
</table><br>


<table style="width:100%;">
<thead>
<tr>
<th width="60%">CONTENIDO TEMÁTICO:</th>
<th style="empty-cells: hide; border: none"></th>
</tr>
</thead>
<tbody>';

                                     $pobcap=utf8_decode($pobcap);
                                     $query_cap3="SELECT NOMNOR,NOMTPO FROM CAP,NOR,TPO WHERE IDECAP=$idecap AND IDETPO=NORTPO AND NOMTPO='$pobcap'";
                                    $cap3 = mysqli_query($conex, $query_cap3) or die(mysqli_error($conex));
                                    $row_cap3 = mysqli_fetch_assoc($cap3); 
                                    $totalRows_cap3 = mysqli_num_rows($cap3);
                                    if($totalRows_cap3 == 0) {

                                    $codigoHTML=$codigoHTML.'';
                                    }
                                    if($totalRows_cap3 > 0) { 
                                    do { 
                                      $nomnor=$row_cap3["NOMNOR"];
                                      
                        $codigoHTML=$codigoHTML.'<tr><td nowrap width="50%">'.utf8_encode($nomnor).'</td></tr>';

                                    } while ($row_cap3 = mysqli_fetch_assoc($cap3)); 
                                    }

 
                                    $query_cap="SELECT IDENRO, NOMNRO FROM CAP, NRO WHERE IDECAP='$idecap' AND IDECAP=NROCAP";
                                    $cap = mysqli_query($conex, $query_cap) or die(mysqli_error($conex));
                                    $row_cap = mysqli_fetch_assoc($cap); 
                                    $totalRows_cap = mysqli_num_rows($cap);
                                    if($totalRows_cap == 0) { ?>

                                    <?php }?>
                                    <?php if($totalRows_cap > 0) { 
                                    do { 
                                      $idenro=$row_cap['IDENRO'];
                                      $nomnro=$row_cap['NOMNRO'];
                                     
                                     $codigoHTML=$codigoHTML.'<tr>
                                    <td nowrap width="50%">'.utf8_encode($nomnro).'</td>
                                     </tr>';

                                     } while ($row_cap = mysqli_fetch_assoc($cap)); 
                                    }


                      $codigoHTML=$codigoHTML.'
</tbody>
</table><br>

<table style="width:100%;">
<thead>
<tr>
<th width="60%">DIRIGIDO A:</th>
<th style="empty-cells: hide; border: none"></th>
</tr>
</thead>
<tbody>
<tr>
 <td nowrap width="60%">'.utf8_encode($pobcap).'</td>
 <th style="empty-cells: hide; border: none"></th>
</tr>
</tbody>
</table><br>

<table style="width:100%;">
<thead>
<tr>
<th width="60%">TEMA:</th>
<th style="empty-cells: hide; border: none"></th>
<th style="empty-cells: hide; border: none"></th>
</tr>
</thead>
<tbody>
<tr>
<td width="60%" ></td>
<td width="20%" style="border:1px solid #fff;"></td>
<td rowspan="3" colspan="2" style="border:1px solid #000;"><b>HORAS TEÓRICAS:</b>&nbsp;&nbsp;&nbsp; '.$htecap.' <br>
    <b>HORAS PRÁCTICAS:</b>&nbsp; '.$hprcap.'
</td>
</tr>

';

                   $query_cap="SELECT IDETEM, DESTEM FROM TEM,CAP WHERE TEMCAP=$idecap AND TEMCAP=IDECAP";
                                          $cap = mysqli_query($conex, $query_cap) or die(mysqli_error($conex));
                                        $row_cap = mysqli_fetch_assoc($cap);
                                        $totalRows_cap = mysqli_num_rows($cap);
                                        if($totalRows_cap == 0) {
                                        $codigoHTML=$codigoHTML.'<tr>
                                          <td nowrap width="50%">NO HAY TEMAS AÚN</td>
                                        </tr>';
                                            } if($totalRows_cap > 0) { 
                                        do { 
                                          $idetem=$row_cap["IDETEM"];
                                          $destem=$row_cap["DESTEM"];
                                       $codigoHTML=$codigoHTML.' <tr>
                               <td nowrap width="50%">'.utf8_encode($destem).'</td>
                            </tr>';
                           } while ($row_cap = mysqli_fetch_assoc($cap)); }
                          $codigoHTML=$codigoHTML.'
</tbody>
</table><br>




<table style="width:100%;">
<thead>
<tr>
<th width="100%">OBJETIVOS PARTICULARES:</th>
<th style="empty-cells: hide; border: none"></th>
</tr>
</thead>
<tbody>';
                     

  $query_cap4="SELECT  IDEOBJ, TIPOBJ,DESOBJ FROM OBJ, CAP  WHERE OBJCAP=$idecap AND OBJCAP=IDECAP AND TIPOBJ='PARTICULAR'";
                       $cap4 = mysqli_query($conex, $query_cap4) or die(mysqli_error($conex));
                                    $row_cap4 = mysqli_fetch_assoc($cap4);
                                    $totalRows_cap4 = mysqli_num_rows($cap4);
                                    if($totalRows_cap4 == 0) { 
$codigoHTML=$codigoHTML.'<tr><td nowrap width="50%">NO HAY OBJETIVOS PARTICULARES ASIGNADOS</td></tr>';}
                                    if($totalRows_cap4 > 0) { 
                                      do { 
                                        $ideobj=$row_cap4["IDEOBJ"];
                                        $desobj=$row_cap4["DESOBJ"];
                          $codigoHTML=$codigoHTML.'<tr>
                          <td nowrap width="50%">'.utf8_encode($desobj).'</td>
                        </tr>';
                      } while ($row_cap4 = mysqli_fetch_assoc($cap4)); }

                      $codigoHTML=$codigoHTML.'</tbody>
</table><br>


<table style="width:100%;">
<thead>
<tr>
<th width="100%">OBJETIVOS ESPECÍFICOS:</th>
<th style="empty-cells: hide; border: none"></th>
</tr>
</thead>
<tbody>'; 
                                       
                                          $query_cap="SELECT IDEOBJ,DESOBJ,TIPOBJ FROM CAP,OBJ WHERE OBJCAP=$idecap AND OBJCAP=IDECAP AND TIPOBJ='ESPECIFICO'";
                                          $cap = mysqli_query($conex, $query_cap) or die(mysqli_error($conex));
                                        $row_cap = mysqli_fetch_assoc($cap);
                                        $totalRows_cap = mysqli_num_rows($cap);
                                        if($totalRows_cap == 0) {
                                     $codigoHTML=$codigoHTML.'<tr>
                                          <td nowrap width="50%">NO HAY OBJETIVOS ESPECÍFICOS ASIGNADOS</td>
                                        </tr>';
                                        } if($totalRows_cap > 0) { 
                                        do { 
                                          $ideobj=$row_cap["IDEOBJ"];
                                          $desobj=$row_cap["DESOBJ"];
                                     $codigoHTML=$codigoHTML.'<tr>
                              <td nowrap width="50%">'.utf8_encode($desobj).'</td>
                            </tr>';
                           } while ($row_cap = mysqli_fetch_assoc($cap)); }

                          $codigoHTML=$codigoHTML.'</tbody>
</table><br>

<table style="width:50%;">
<thead>
<tr>
<th width="100%">ACTIVIDADES DE INSTRUCCIÓN:</th>
</tr>
</thead>
<tbody>';

                                          $query_cap="SELECT IDEACT,NOMACT FROM ACT WHERE ACTCAP=$idecap";
                                          $cap = mysqli_query($conex, $query_cap) or die(mysqli_error($conex));
                                        $row_cap = mysqli_fetch_assoc($cap);
                                        $totalRows_cap = mysqli_num_rows($cap);
                                        if($totalRows_cap == 0) {
                                        $codigoHTML=$codigoHTML.'<tr>
                                          <td nowrap width="50%" align="center">NO HAY ACTIVIDADES DE INSTRUCCIÓN ASIGNADAS</td>
                                        </tr>';
                                        } if($totalRows_cap > 0) { 
                                        do { 
                                          $ideact=$row_cap["IDEACT"];
                                          $nomact=$row_cap["NOMACT"];
                                        $codigoHTML=$codigoHTML.'<tr>
                              <td nowrap width="50%" align="center">'.utf8_encode($nomact).'</td>
                            </tr>';
                             } while ($row_cap = mysqli_fetch_assoc($cap)); }

                          $codigoHTML=$codigoHTML.'</tbody></table><br>

<table style="width:50%;">
<thead>
<tr>
<th width="100%">TÉCNICAS Y DINÁMICAS DE INSTRUCCIÓN:</th>
</tr>
</thead>
<tbody>';
                              $query_cap="SELECT IDETECCAP, IDETEC, NOMTEC FROM CAP,TEC,TECCAP WHERE TECCAPCAP=$idecap AND IDECAP=TECCAPCAP AND IDETEC=TECCAPTEC AND TIPTEC='TECNICAS INDIVIDUALES DE INSTRUCCION'";
                              $cap = mysqli_query($conex, $query_cap) or die(mysqli_error($conex));
                              $row_cap = mysqli_fetch_assoc($cap);
                              $totalRows_cap = mysqli_num_rows($cap);
                              if($totalRows_cap == 0) { 
                               $codigoHTML=$codigoHTML.'<tr>
                                <td nowrap width="50%" align="center">NO TÉCNICAS Y DINÁMICAS DE INSTRUCCIÓN ASIGNADAS</td>
                              </tr>';
                             } 
                              if($totalRows_cap > 0) { 
                                do { 
                                  $ideteccap=$row_cap['IDETECCAP'];
                                  $idetec=$row_cap['IDETEC'];
                                  $nomtec=$row_cap['NOMTEC'];
                               $codigoHTML=$codigoHTML.'<tr>
                              <td nowrap width="50%" align="center">'.utf8_encode($nomtec).'</td>
                            </tr>';
                              } while ($row_cap = mysqli_fetch_assoc($cap)); }
 $codigoHTML=$codigoHTML.'
</tbody>
</table><br>


<table style="width:50%;">
<thead>
<tr>
<th width="100%">TÉCNICAS GRUPALES:</th>
</tr>
</thead>
<tbody>';
                                $query_cap="SELECT IDETECCAP, IDETEC, NOMTEC FROM CAP,TEC,TECCAP WHERE TECCAPCAP=$idecap AND IDECAP=TECCAPCAP AND IDETEC=TECCAPTEC AND TIPTEC='TECNICAS GRUPALES DE INSTRUCCION'";
                                $cap = mysqli_query($conex, $query_cap) or die(mysqli_error($conex));
                                $row_cap = mysqli_fetch_assoc($cap);
                                $totalRows_cap = mysqli_num_rows($cap);
                                if($totalRows_cap == 0) { 
                                $codigoHTML=$codigoHTML.'<tr>
                                  
                                  <td nowrap width="50%" align="center">NO HAY TÉCNICAS GRUPALES ASIGNADAS</td>
                                  
                                </tr>';
                                } 
                                if($totalRows_cap > 0) { 
                                  do { 
                                    $ideteccap=$row_cap['IDETECCAP'];
                                    $idetec=$row_cap['IDETEC'];
                                    $nomtec=$row_cap['NOMTEC'];
                                $codigoHTML=$codigoHTML.'<tr>
                                
                                <td nowrap width="50%" align="center">'.utf8_encode($nomtec).'</td>
                                
                              </tr>';
                               } while ($row_cap = mysqli_fetch_assoc($cap)); }
$codigoHTML=$codigoHTML.'
</tbody>
</table><br>


<table style="width:50%;">
<thead>
<tr>
<th width="100%">RECURSOS DIDÁCTICOS: </th>
</tr>
</thead>
<tbody>';
                                $query_cap="SELECT IDETECCAP, IDETEC, NOMTEC FROM CAP,TEC,TECCAP WHERE TECCAPCAP=$idecap AND IDECAP=TECCAPCAP AND IDETEC=TECCAPTEC AND TIPTEC='RECURSOS DIDACTICOS'";
                                $cap = mysqli_query($conex, $query_cap) or die(mysqli_error($conex));
                                $row_cap = mysqli_fetch_assoc($cap);
                                $totalRows_cap = mysqli_num_rows($cap);
                                if($totalRows_cap == 0) { 
                                $codigoHTML=$codigoHTML.'<tr>     
                                  <td nowrap width="50%" align="center">NO HAY RECURSOS DIDÁCTICOS ASIGNADOS</td>
                                </tr>';
                               } 
                                if($totalRows_cap > 0) { 
                                  do { 
                                    $ideteccap=$row_cap['IDETECCAP'];
                                    $idetec=$row_cap['IDETEC'];
                                    $nomtec=$row_cap['NOMTEC'];
                                $codigoHTML=$codigoHTML.'<tr>
                                <td nowrap width="50%" align="center">'.utf8_encode($nomtec).'</td>
                              </tr>';
                             } while ($row_cap = mysqli_fetch_assoc($cap)); }
$codigoHTML=$codigoHTML.'
</tbody>
</table><br>

<table style="width:50%;">
<thead>
<tr>
<th width="100%">EVALUACIÓN:</th>
</tr>
</thead>
<tbody>';
$query_cap="SELECT IDETECCAP, IDETEC, NOMTEC FROM CAP,TEC,TECCAP WHERE TECCAPCAP=$idecap AND IDECAP=TECCAPCAP AND IDETEC=TECCAPTEC AND TIPTEC='EVALUACION'";
                                $cap = mysqli_query($conex, $query_cap) or die(mysqli_error($conex));
                                $row_cap = mysqli_fetch_assoc($cap);
                                $totalRows_cap = mysqli_num_rows($cap);
                                if($totalRows_cap == 0) { 
                                $codigoHTML=$codigoHTML.'<tr>    
                                  <td nowrap width="50%" align="center">NO HAY EVALUACIÓN ASIGNADA</td>
                                </tr>';
                                 } 
                                if($totalRows_cap > 0) { 
                                  do { 
                                    $ideteccap=$row_cap['IDETECCAP'];
                                    $idetec=$row_cap['IDETEC'];
                                    $nomtec=$row_cap['NOMTEC'];
                                $codigoHTML=$codigoHTML.'<tr>
                                <td nowrap width="50%" align="center">'.utf8_encode($nomtec).'</td>
                              </tr>';
                              } while ($row_cap = mysqli_fetch_assoc($cap)); }
                              $codigoHTML=$codigoHTML.'
</tbody>
</table><br>


<table style="width:60%;">
<thead>
<tr>
<th width="100%">BIBLIOGRAFÍA:</th>
</tr>
</thead>
<tbody>';
$query_cap="SELECT IDEBIB,TDOCBIB,NDOCBIB, date_format(FDOCBIB,'%d-%m-%Y') AS FDOCBIB,EDOCBIB,BIBCAP FROM CAP,BIB WHERE BIBCAP='$idecap' AND IDECAP=BIBCAP";
                              $cap = mysqli_query($conex, $query_cap) or die(mysqli_error($conex));
                              $row_cap = mysqli_fetch_assoc($cap);
                              $totalRows_cap = mysqli_num_rows($cap);
                              if($totalRows_cap == 0) { 
                               $codigoHTML=$codigoHTML.'<tr>
                                <td nowrap width="50%" align="center">NO HAY BIBLIOGRAFÍA ASIGNADA</td>
                              </tr>';
                                 } 
                              if($totalRows_cap > 0) { 
                                do { 
                                  $idebib=$row_cap['IDEBIB'];
                                  $tdocbib=$row_cap['TDOCBIB'];
                                  $ndocbib=$row_cap['NDOCBIB'];
                                  $fdocbib=$row_cap['FDOCBIB'];
                                  $edocbib=$row_cap['EDOCBIB']; 
                               $codigoHTML=$codigoHTML.'<tr>
                              <td nowrap width="50%" align="center">'
                              .$tdocbib.' </br>'
                              .$ndocbib.' </br>'
                              .$fdocbib.' </br>'
                              .$edocbib.' </br>
                              </td>
                            </tr>';
                             } while ($row_cap = mysqli_fetch_assoc($cap)); }
                             $codigoHTML=$codigoHTML.'
</tbody>
</table><br>


          </html>';
                


               
                      




$codigoHTML=utf8_decode($codigoHTML);

use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->load_html(utf8_encode($codigoHTML));
ini_set("memory_limit","128M");
$dompdf->set_paper('A4','landscape');
$dompdf->render();
$dompdf->stream("capacitacion.pdf",array('Attachment'=>0));

?>


