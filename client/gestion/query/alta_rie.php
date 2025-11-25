<?php require_once("../../conex/conex.php"); 
mysqli_select_db($conex, $database_conex);

$id = $_POST["IDEREP2"];
$com = mb_strtoupper($_POST["com"]);
$des = mb_strtoupper($_POST["des"]);
$con = mb_strtoupper($_POST["cons"]);
$pro = $_POST["pro"];
$gra = $_POST["gra"];


//echo $id;
$insertSQL = sprintf("INSERT INTO RIE (CESPRIE,DESRIE,CONRIE,PROBRIE,GRARIE,PELRIE) VALUES ('$com','$des','$con','$pro','$gra','$id') ");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));



//header("Location:../ver_gestion.php?IDEREP=$id");
?>