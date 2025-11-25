
<?php
session_start();
if($_SESSION['nivel']<=2){
  $sesion=true;
  
}else{
  $sesion=false;
}

?>
<?php if ($sesion):?>

<?php 
  $idrep=$_POST['IDEREP_min'];
  $fol_min=$_POST['fol_min'];
  $fec_min=$_POST['fec_min'];
  $ini_min=$_POST['ini_min'];
  $cie_min=$_POST['cie_min'];
  $fec_min=date("d-m-Y",strtotime($fec_min));
  $fec_anno=date("Y");

  require_once("../dompdf/dompdf_config.inc.php");
   require_once('../conex/conex.php');
 mysqli_select_db($conex, $database_conex);

 $query_tem = sprintf("SELECT GENPEL FROM PEL WHERE REPPEL=$idrep ");
$tem = mysqli_query($conex, $query_tem) or die(mysqli_error());
$row_tem = mysqli_fetch_assoc($tem);
$contador2=1;

$codigoHTML='<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style type="text/css">
 table{border-collapse:collapse;font-family:sans-serif;font-size:12px;}
td {border:1px solid #000;}
.body{font-family:Segoe UI,Arial,sans-serif;font-size:.7em;height:900px; width:100%;}
.pie{ top:50%;}
  </style>

<table width="635px" align="center" >
<tr><td align="center" width="60%" style="background-color: #98c7eb;color:#fff;" >DIRECCIÓN DE SERVICIOS LOGÍSTICOS DE APOYO AL EJECUTIVO</td></tr>
</table>

<table width="635px"  align="center" >
 <tr><td align="center" width="33%" >MINUTA S.M.S NO./'.$fol_min.'/'.$fec_anno.'</td><td align="left"  width="15%">TEMA A TRATAR:</td><td colspan="2" align="left"  width="68%">'.$row_tem['GENPEL'].'</td></tr>
 <tr><td align="left">FECHA: '.$fec_min.'</td><td align="left" colspan="2">HORA INICIO: '.$ini_min.'</td><td align="left">HORA CIERRE: '.$cie_min.'</td></tr>

 </table>

 <table width="635px" align="center">
 <tr><td align="center" colspan="2" style="background-color: #98c7eb;color:#fff;">TIPO DE MINUTA</td><td width="33%" style="border-right-color:#d0d3d4 ;border-bottom-color:#d0d3d4;"></td><td width="33%" style="border-right-color:#d0d3d4;border-bottom-color:#d0d3d4;"></td></tr>
 <tr><td align="left" width="28%" style="background-color: #98c7eb ;color:#fff;"> REUNION DE REPORTE: </td><td >x</td><td style="border-top-color:#d0d3d4;border-right-color:#d0d3d4;border-bottom-color:#d0d3d4;"></td><td style="border-top-color:#d0d3d4;border-right-color:#d0d3d4;border-bottom-color:#d0d3d4;"></td></tr>
 <tr><td align="left" style="background-color: #98c7eb ;color: #fff;"> JUNTA DE CONTROL: </td><td></td><td style="border-top-color:#d0d3d4;border-right-color:#d0d3d4;border-bottom-color:#d0d3d4;"></td><td style="border-top-color:#d0d3d4;border-right-color:#d0d3d4;border-bottom-color:#d0d3d4;"></td></tr>
 <tr><td align="left" style="background-color: #98c7eb ;color:#fff;"> JUNTA EXTRAORDINARIA: </td><td ></td><td style="border-top-color:#d0d3d4;border-right-color:#d0d3d4;border-bottom-color:#d0d3d4;"></td><td style="border-top-color:#d0d3d4;border-right-color:#d0d3d4;border-bottom-color:#d0d3d4;"></td></tr>
</table>

<table width="635px"  align="center" >
 <tr><td colspan="3" align="center" style="background-color:#98c7eb;color:#fff;">ASISTENTES:</td></tr>';

  $query_inv = sprintf("SELECT DISTINCT NOMEMP,APPEMP,APMEMP,PERINV,FIRINV FROM PRO,RIE,INV,PER,EMP WHERE PERINV=IDEPER && EMPPER=IDEEMP && PROINV=IDEPRO && RIEPRO=IDERIE && PELRIE=$idrep");
$inv = mysqli_query($conex, $query_inv) or die(mysqli_error());
$row_inv = mysqli_fetch_assoc($inv);
$totalRows_inv = mysqli_num_rows($inv);
$contador1=1;
do{
  $nom_inv=utf8_encode($row_inv['NOMEMP'].' '.$row_inv['APPEMP'].' '.$row_inv['APMEMP']);
  if($row_inv['FIRINV']=='SI'){
$codigoHTML=$codigoHTML.'<tr><td  width="5%">'.$contador1.'</td><td width="45%">'.$nom_inv.'</td><td  width="50%">FIRMA: <img src="img/verificacion.png" width="15px"></td></tr>';
}else{
  $codigoHTML=$codigoHTML.'<tr><td  width="5%">'.$contador1.'</td><td width="45%">'.$nom_inv.'</td><td  width="50%"></td></tr>';
}

$contador1++;
}while($row_inv = mysqli_fetch_assoc($inv));


$codigoHTML=$codigoHTML.'
</table>
<table width="635px"  align="center" >
<tr><td colspan="2" align="center" style="background-color:#98c7eb;color:#fff;">TEMAS TRATADOS:</td></tr> 
 <tr><td width="2%">'.$contador2.'</td><td width="97%">'.$row_tem['GENPEL'].'</td></tr> 
</table><br> 


<table width="635px"  align="center" >
 <tr><td colspan="5" align="center" style="background-color:#98c7eb;color:#fff;">SOLUCIONES Y PROPUESTAS DE MEJORA:</td></tr>
 <tr><td colspan="2" align="center" style="background-color:#98c7eb;color:#fff;" >PROPUESTA:</td><td  align="center" width="30%" style="background-color: #3498db  ;color:#fff;"
>RESPONSABLE:</td><td  align="center"  width="10%" style="background-color: #7d8080 ;color:#fff;">TIEMPO DE ATENCION: </td><td  align="center"  width="15%" style="background-color: #7d8080 ;color:#fff;">ESTATUS:</td></tr>';

 
  $query_inv = sprintf("SELECT IDEPRO,DESPRO,ESTPRO FROM PRO,RIE WHERE RIEPRO=IDERIE && PELRIE=$idrep");
$inv = mysqli_query($conex, $query_inv) or die(mysqli_error());
$row_inv = mysqli_fetch_assoc($inv);
$totalRows_inv = mysqli_num_rows($inv);
$contador1=1;
do{
  $ide=$row_inv['IDEPRO'];
  $des=utf8_encode($row_inv['DESPRO']);
  $est=utf8_encode($row_inv['ESTPRO']);
$codigoHTML=$codigoHTML.'<tr><td width="5px">'.$contador1.'</td><td>'.$des.'</td><td>';

$query_res = sprintf("SELECT NOMEMP,APPEMP,APMEMP FROM RES,PER,EMP WHERE IDEEMP=EMPPER && IDEPER=EMPRES && PRORES=$ide");
$res = mysqli_query($conex, $query_res) or die(mysqli_error());
$row_res = mysqli_fetch_assoc($res);

do{
  $resp=utf8_encode($row_res['NOMEMP'].' '.$row_res['APPEMP'].' '.$row_res['APMEMP']);
  $codigoHTML=$codigoHTML.$resp.'<br>';
  }while($row_res = mysqli_fetch_assoc($res));

$codigoHTML=$codigoHTML.'
</td><td>';

$query_res = sprintf("SELECT FECLIM FROM RES WHERE PRORES=$ide");
$res = mysqli_query($conex, $query_res) or die(mysqli_error());
$row_res = mysqli_fetch_assoc($res);

do{
  $fec=$row_res['FECLIM'];
  $codigoHTML=$codigoHTML.$fec.'<br>';
  }while($row_res = mysqli_fetch_assoc($res));



$codigoHTML=$codigoHTML.'
</td><td>'.$est.'</td></tr>';

$contador1++;
}while($row_inv = mysqli_fetch_assoc($inv));

 
 
//-------IMPRESION DE RESPONSABLES
//----------------------------------


$codigoHTML=$codigoHTML.'</table><br></html>';

$codigoHTML=utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html(utf8_encode($codigoHTML));
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("minuta.pdf",array('Attachment'=>0));
?>

<?php else:
 header("Location:../");
endif; ?>

