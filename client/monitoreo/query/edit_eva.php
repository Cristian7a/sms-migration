<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$gra = $_POST["egra"];
$pro = $_POST["epro"];
$ide = $_POST["IDEEVA"];

$update = sprintf("UPDATE `EVA` SET `PROBEVA`='$pro',`GRAEVA`='$gra' WHERE IDEEVA=$ide");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../" );
?>