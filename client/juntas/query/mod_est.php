<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$estatus=$_POST['est3'];
$idepro=$_POST['IDEPRO3'];
$idejun=$_POST['IDEJUN3'];


$update=sprintf("UPDATE PRO_JC SET ESTPRO='$estatus' WHERE IDEPRO='$idepro' ");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location:../gestionar.php?IDEJUN=$idejun");

?>