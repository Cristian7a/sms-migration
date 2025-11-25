<?php require_once('../../conex/conex.php');
session_start(); 
$user=$_SESSION['user'];
$usu=$_SESSION['nombre'];
mysqli_select_db($conex, $database_conex);

$iderep=$_POST['IDEREP'];
$idepro=$_POST['IDEPRO'];
$iderie=$_POST['IDERIE'];
$com=utf8_decode($_POST['com']);
$fec=date("y/m/d");

$query= "SELECT IDECOM FROM COM ORDER BY IDECOM DESC LIMIT 1 ";
$con = mysqli_query($conex, $query) or die(mysqli_error($conex));
$row = mysqli_fetch_assoc($con);
$totalRows = mysqli_num_rows($con);
 if ($totalRows == 0) { 
$idecom=1;
 } else{
$idecom=$row['IDECOM']+1;
 }


$insertSQL = sprintf("INSERT INTO COM (IDECOM,COMCOM,PROCOM,FECCOM,NOMCOM) VALUES ($idecom,'$com','$idepro','$fec','$usu')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));

$update = sprintf("UPDATE `INV` SET `FIRINV`='SI' WHERE PERINV='$user' && PROINV='$idepro'");
$Res=mysqli_query($conex, $update) or die (mysqli_error($conex));	


header("Location:../ver_reporte.php?IDEREP=$iderep&IDERIE=$iderie");	



?>