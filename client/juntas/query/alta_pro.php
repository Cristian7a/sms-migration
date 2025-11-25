<?php require_once('../../conex/conex.php');
mysqli_select_db($conex, $database_conex);


$pro=$_POST['des'];
$tie=$_POST['tie'];
$est="ABIERTO";
$tem=$_POST['IDETEM2'];
$emp=$_POST['emp'];

$insertSQL = sprintf("INSERT INTO PRO_JC (DESPRO,TIEPRO,ESTPRO,TEMPRO,RESPRO) VALUES ('$pro',$tie,'$est',$tem,$emp)");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
//header("Location:../participantes.php?IDEJUN=$idejun");	











?>