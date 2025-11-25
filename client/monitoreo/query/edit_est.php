<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$est = $_POST["est"];
$por = $_POST["por"];
$des = $_POST["des"];
$des=mb_strtoupper($des);
$monpro = $_POST["monpro"];

if($est=="NO HAN SIDO IMPLEMENTADAS"){$por=0;}
if($est=="NO HAN SIDO IMPLEMENTADAS"){$por=0;}
if($est=="YA NO SON FUNCIONALES Y DEBEN DESECHARSE"){$por=0;}
if(is_null($por)){$por=0;}

$update = sprintf("UPDATE MONPRO SET ESTMON='$est',POREST=$por, DESEST='$des' WHERE MONPRO=$monpro");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../" );
?>