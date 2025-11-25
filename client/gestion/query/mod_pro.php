<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);
session_start();
$user=$_SESSION['user'];
$idepro=$_POST['IDPRO'];
$iderep=$_POST['IDREP_PRO'];
$iderie=$_POST['IDRIE_PRO'];
$des = mb_strtoupper($_POST["des_e"]);
$des = utf8_decode($des);



$update=sprintf("UPDATE PRO SET DESPRO='$des' WHERE IDEPRO=$idepro");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));

$update2 = sprintf("UPDATE `INV` SET `FIRINV`='SI' WHERE PERINV='$user' && RIEINV='$iderie'");
$Res=mysqli_query($conex, $update2) or die (mysqli_error($conex));	

header("Location:../ver_gestion.php?IDEREP=$iderep");

?>