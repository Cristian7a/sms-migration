<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$cau = $_POST["cau"];
$cau=mb_strtoupper($cau);
$monpro = $_POST["monpro9"];

$update = sprintf("UPDATE CIC SET CAUCIC='$cau' WHERE MONCIC=$monpro");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../" );
?>