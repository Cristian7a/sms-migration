<?php require_once('../../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$ide = $_POST["ide"];
$nom = $_POST["nom"];

$insertSQL = sprintf("INSERT INTO COO (IDECOO,NOMCOO) VALUES ( '$ide', '$nom')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
header("Location: ../");

?>