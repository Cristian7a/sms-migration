<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$peli = mb_strtoupper($_POST["nombre"]);
$inci = $_POST["y"];

$insertSQL = sprintf("INSERT INTO TEN (NOMTEN,INCTEN) VALUES ('$peli','$inci')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));

//header("Location:../index.php");

?>