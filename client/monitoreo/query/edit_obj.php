<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$obj = $_POST["obj"];
$obj=mb_strtoupper($obj);
$monpro = $_POST["monpro4"];

$update = sprintf("UPDATE CIC SET OBJCIC='$obj' WHERE MONCIC=$monpro");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../" );
?>