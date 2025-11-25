<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);
session_start();

$ide=$_POST['IDEREP1'];
$fecha_gestion=date("y/m/d");
$obj = mb_strtoupper($_POST["obj"]);
$act = mb_strtoupper($_POST["act"]);
$con = mb_strtoupper($_POST["con"]);
$cat = $_POST["cat"];
$rie_ope= $_POST["rie_ope"];

$ide_gen=utf8_encode($_POST["ide_gen"]);
$ide_gen=mb_strtoupper($ide_gen);
$ide_gen=utf8_decode($ide_gen);

$met_ide=$_POST["met_ide"];
$nomges=utf8_encode($_SESSION["nombre"]);
$nomges= mb_strtoupper($nomges);
$nomges=utf8_decode($nomges);

$insertSQL = sprintf("INSERT INTO PEL (REPPEL,FECPEL,OBJPEL,ACTPEL,CONPEL,CATEPEL,RIEOPEPEL,GENPEL,METIDEPEL,NOMGESPEL) VALUES ( '$ide','$fecha_gestion','$obj','$act','$con','$cat','$rie_ope','$ide_gen','$met_ide','$nomges')");
$Result=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
$insertSQL2 = sprintf("INSERT INTO MON (PELMON,MSMMON,PSMMON,PSOMON,DIFMON,MITMON,ESTMON) VALUES ( $ide,'','','','','','ABIERTO')");
$Result2=mysqli_query($conex, $insertSQL2) or die (mysqli_error($conex));
//header("Location:../ver_gestion.php?IDEREP=$ide");

?>
