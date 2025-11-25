<?php require_once('../../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$ide = $_GET["idecoo"];
$nom = $_POST["nom"];
$nom=mb_strtoupper($nom);

$insertSQL = sprintf("INSERT INTO CAR (COOCAR,NOMCAR) VALUES ( '$ide', '$nom')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
header("Location: ../");

?>