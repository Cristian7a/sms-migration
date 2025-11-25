<?php require_once('../../conex/conex.php');
mysqli_select_db($conex, $database_conex);

$tema=$_POST['tem'];
$idejun=$_POST['IDEJUN'];

$insertSQL = sprintf("INSERT INTO TEM_JC (DESTEM,JUNTEM) VALUES ('$tema',$idejun)");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
//header("Location:../participantes.php?IDEJUN=$idejun");	












?>