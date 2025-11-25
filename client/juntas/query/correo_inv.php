<?php


require_once("../../conex/conex.php");
mysqli_select_db($conex, $database_conex);

$ide=$_GET['ide'];
$query = "SELECT CESPRIE,NOMEMP,APPEMP,APMEMP,EMAEMP,IDERIE FROM RIE,PRO,INV,PER,EMP WHERE RIEPRO=IDERIE && IDEEMP=EMPPER && IDEPER=PERINV && IDEPRO=PROINV && IDEINV=$ide";
$rie = mysqli_query($conex, $query) or die(mysqli_error());
$row = mysqli_fetch_assoc($rie);
$totalRows = mysqli_num_rows($rie);

 if ($totalRows > 0) {

$email=$row['EMAEMP'];
$nombre=$row['NOMEMP']." ". $row['APPEMP']." ". $row['APMEMP'];
$nombre=utf8_encode($nombre);
$nombre=mb_strtoupper($nombre);
$mail = "BUEN DIA ".$nombre." SE REQUIERE SU PARTICIPACIÓN COMO INVOLUCRADO(A) EN EL PELIGRO ESPECIFICO: ". $row['CESPRIE']."\n FAVOR DE ENTRAR AL SISTEMA S.M.S CON SU CUENTA EN ESTA DIRECCIÓN: http://smspuebla.ddns.net/";
$mail=utf8_decode($mail);

//Titulo
$titulo = "NOTIFICACION DE INVOLUCRADO EN REUNION";
//cabecera
$headers = "smssistema@gmail.com";
//Enviamos el mensaje a tu_dirección_email 
$bool = mail($email,$titulo,$mail,"From: $headers");

$fecha_not=date("y-m-d H:i:s");
$update=sprintf("UPDATE INV SET FECNOT='$fecha_not' WHERE IDEINV='$ide' ");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));

$rie=$row['IDERIE'];
$rep=$_GET['IDEREP'];
header("Location:../ver_gestion.php?IDEREP=".$rep);

 }

?>
