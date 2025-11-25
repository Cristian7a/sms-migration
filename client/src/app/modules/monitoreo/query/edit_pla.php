<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$pla = $_POST["pla"];
$pla=mb_strtoupper($pla);
$monpro = $_POST["monpro5"];

$update = sprintf("UPDATE CIC SET PLACIC='$pla' WHERE MONCIC=$monpro");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../" );
?>