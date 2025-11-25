<?php

require_once("../../conex/conex.php");
mysqli_select_db($conex, $database_conex);

$ide=$_GET['ide'];
$query = "SELECT NOMEMP,APPEMP,APMEMP,EMAEMP,DESPRO FROM PRO,RES,PER,EMP WHERE IDEEMP=EMPPER && IDEPER=EMPRES && PRORES=IDEPRO && IDERES=$ide";
$rie = mysqli_query($conex, $query) or die(mysqli_error());
$row = mysqli_fetch_assoc($rie);
$totalRows = mysqli_num_rows($rie);

 if ($totalRows > 0) {

$email=$row['EMAEMP'];
$nombre=$row['NOMEMP']." ". $row['APPEMP']." ". $row['APMEMP'];
$nombre=utf8_encode($nombre);
$nombre=mb_strtoupper($nombre);
$mail = "BUEN DIA ".$nombre." HA SIDO ASIGNADO(A) COMO RESPONSABLE EN LA PROPUESTA: ". $row['DESPRO']."\n FAVOR DE ENTRAR AL SISTEMA S.M.S CON SU CUENTA EN ESTA DIRECCIÓN: http://smspuebla.ddns.net/";
$mail=utf8_decode($mail);
//Titulo
$titulo = "NOTIFICACION DE RESPONSABLE EN PROPUESTA";
//cabecera
$headers = "smssistema@gmail.com";
//Enviamos el mensaje a tu_dirección_email 
$bool = mail($email,$titulo,$mail,"From: $headers");

$fecha_not=date("y-m-d H:i:s");
$update=sprintf("UPDATE RES SET FECNOT='$fecha_not' WHERE IDERES='$ide' ");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));

$rep=$_GET['IDEREP'];
header("Location:../ver_gestion.php?IDEREP=".$rep."&IDERES=");

 }
?>
