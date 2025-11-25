<?php require_once("../../conex/conex.php"); 
mysqli_select_db($conex, $database_conex);

$iderep = $_POST["iderep5"];
$id = $_POST["iderie_e"];
$com = mb_strtoupper($_POST["com"]);
$des = mb_strtoupper($_POST["des"]);
$con = mb_strtoupper($_POST["con"]);
$pro = $_POST["prob_e"];
$gra = $_POST["grav_e"];


//echo $id;
$insertSQL = sprintf("UPDATE RIE SET DESRIE='$des', CESPRIE='$com', CONRIE='$con', PROBRIE=$pro, GRARIE='$gra' WHERE IDERIE=$id ");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));


header("Location:../ver_gestion.php?IDEREP=$iderep");
?>