<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$gra = $_POST["gra"];
$pro = $_POST["pro"];
$ide = $_POST["IDEPRO"];

$insertSQL = sprintf("INSERT INTO EVA (IDEEVA,GRAEVA,PROBEVA) VALUES ( $ide,'$gra','$pro')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
?>