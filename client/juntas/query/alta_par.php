<?php require_once('../../conex/conex.php');
mysqli_select_db($conex, $database_conex);

if(isset($_POST['emp']) && isset($_POST['ide'])){
$idejun=$_POST['ide'];
$ideper=$_POST['emp'];

$insertSQL = sprintf("INSERT INTO ASI (PERASI,JUNASI) VALUES ('$ideper',$idejun)");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
//header("Location:../participantes.php?IDEJUN=$idejun");	


}









?>