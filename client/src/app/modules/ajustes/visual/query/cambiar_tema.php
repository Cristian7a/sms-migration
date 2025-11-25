<?php
require_once('../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);
session_start();
$user=$_SESSION['user'];
$nt = $_POST['tema'];
$insertSQL = sprintf("UPDATE asp SET tip_asp=$nt WHERE ide_usu=$user ");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
$_SESSION['theme']=$nt;
header("Location: ../" );

?>