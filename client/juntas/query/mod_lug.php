<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$lugar=$_POST['lugar'];
$idejun=$_POST['IDEJUN'];


$update=sprintf("UPDATE JUN SET LUGJUN='$lugar' WHERE IDEJUN='$idejun' ");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location:../index.php");

?>