<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$propuesta=$_POST['propuesta5'];
$idepro=$_POST['IDEPRO5'];
$idejun=$_POST['IDEJUN5'];


$update=sprintf("UPDATE PRO_JC SET DESPRO='$propuesta', ESTPRO='EN PROCESO' WHERE IDEPRO='$idepro' ");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location:../gestionar.php?IDEJUN=$idejun");

?>