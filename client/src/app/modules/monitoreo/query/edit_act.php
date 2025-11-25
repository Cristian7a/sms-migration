<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$act = $_POST["act"];
$act=mb_strtoupper($act);
$monpro = $_POST["monpro10"];

$update = sprintf("UPDATE CIC SET ACTCIC='$act' WHERE MONCIC=$monpro");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../" );
?>