<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$nom = $_POST["nom"];
$nom = mb_strtoupper($nom);

$insertSQL = sprintf("INSERT INTO LUG (NOMLUG) VALUES ( '$nom')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
?>