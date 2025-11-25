<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$idepro=$_POST['IDEPRO22'];
$iderep=$_POST['IDREP_PRO22'];
$iderie=$_POST['IDRIE_PRO22'];
$des = mb_strtoupper($_POST["est22"]);
$des = utf8_decode($des);



$update=sprintf("UPDATE PRO SET ESTPRO='$des' WHERE IDEPRO=$idepro");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));

header("Location:../ver_gestion.php?IDEREP=$iderep");

?>