
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
  $idejun=$_GET['IDEJUN'];

  require_once("../dompdf/dompdf_config.inc.php");
   require_once('../conex/conex.php');
 mysqli_select_db($conex, $database_conex);

 $query_tem = sprintf("SELECT * FROM JUN WHERE IDEJUN=$idejun");
$tem = mysqli_query($conex, $query_tem) or die(mysqli_error());
$row_tem = mysqli_fetch_assoc($tem);
$fecha = explode(" ", $row_tem["FECJUN"]);

$codigoHTML='<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style type="text/css">
 table{border-collapse:collapse;}
td {border:1px solid #000;}
.body{font-family:Segoe UI,Arial,sans-serif;font-size:.7em;height:890px; width:100%;}
.pie{ top:50%;}
  </style>
<div class="body"><center>
<h4 align="left" style="margin-left:50px;"> V.7 FORMATO DE LA LISTA DE ASISTENCIA REUNIÓN DE REPORTE.</h4>
<br>
<h4> REUNIÓN DE REPORTE S.M.S.</h4>
<p align="left" style="margin-left:50px;">Tema: Junta de control</p>
<p align="left" style="margin-left:50px;">Fecha: '.$fecha[0].'&nbsp;&nbsp;&nbsp; Lugar: '.$row_tem["LUGJUN"].' </p>
<p align="left" style="margin-left:50px;">Hora de Inicio: '.$fecha[1].'</p>


<table width="635px"  align="center" >
 <tr><td align="center" style="background-color:#16365C;color:#fff;">Nombre</td><td align="center" style="background-color:#16365C;color:#fff;">Firma</td></tr>';
 $query_inv = sprintf("SELECT IDEASI,PERASI,FIRASI,NOMEMP,APPEMP,APMEMP FROM ASI,PER,EMP WHERE IDEEMP=EMPPER && IDEPER=PERASI && JUNASI=$idejun");
$inv = mysqli_query($conex, $query_inv) or die(mysqli_error());
$row_inv = mysqli_fetch_assoc($inv);
$totalRows_inv = mysqli_num_rows($inv);
do{
	$nom_inv=utf8_encode($row_inv['NOMEMP'].' '.$row_inv['APPEMP'].' '.$row_inv['APMEMP']);
if($row_inv['FIRASI']=='SI'){
$codigoHTML=$codigoHTML.'<tr><td width="70%">'.$nom_inv.'</td><td  width="30%">FIRMA: <img src="img/verificacion.png" width="15px"></td></tr>';
}else{
$codigoHTML=$codigoHTML.'<tr><td width="70%">'.$nom_inv.'</td><td  width="30%"></td></tr>';
}

}while($row_inv = mysqli_fetch_assoc($inv));


$codigoHTML=$codigoHTML.'</table><br>
</center></div></html>';

$codigoHTML=utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html(utf8_encode($codigoHTML));
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("lista.pdf",array('Attachment'=>0));
?>

<?php else:
 header("Location:../");
endif; ?>

