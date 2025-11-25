<?php require_once('../../conex/conex.php');
mysqli_select_db($conex, $database_conex);
session_start();
$usu=$_SESSION['nombre'];
$ide_usu=$_SESSION['user'];

$propuesta_final = mb_strtoupper($_POST["des_final"]);
$propuesta_final = utf8_decode($propuesta_final);

$iderep=$_POST['IDEREP_FINAL'];
$idepro=$_POST['IDEPRO_FINAL'];

$fec=date("y-m-d");

//AGREGAR COMENTARIO
$query= "SELECT IDECOM FROM COM ORDER BY IDECOM DESC LIMIT 1 ";
$con = mysqli_query($conex, $query) or die(mysqli_error($conex));
$row = mysqli_fetch_assoc($con);
$totalRows = mysqli_num_rows($con);
 if ($totalRows == 0) { 
$idecom=1;
 } else{
$idecom=$row['IDECOM']+1;
 }

$insertSQL = sprintf("INSERT INTO COM (IDECOM,COMCOM,PROCOM,FECCOM,NOMCOM) VALUES ($idecom,'ACEPTO', $idepro ,'$fec','$usu') ");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error());


//EDICION DE LA PROPUESTA

$update=sprintf("UPDATE PRO SET DESPRO='$propuesta_final' , FINPRO='$fec' WHERE IDEPRO=$idepro");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));

$update2 = sprintf("UPDATE INV SET FIRINV='SI' WHERE PERINV='$user' AND PROINV=$idepro");
$Res=mysqli_query($conex, $update2) or die (mysqli_error($conex));	


header("Location:../ver_gestion.php?IDEREP=$iderep");	



?>