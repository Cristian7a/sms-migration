<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$ver = $_POST["ver"];
$log = $_POST["logr"];
$ver=mb_strtoupper($ver);
$monpro = $_POST["monpro6"];

$update = sprintf("UPDATE CIC SET VERCIC='$ver', LOGCIC='$log' WHERE MONCIC=$monpro");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../" );
?>