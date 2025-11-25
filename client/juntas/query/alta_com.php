<?php require_once('../../conex/conex.php');
mysqli_select_db($conex, $database_conex);

session_start();
$ideper=$_SESSION["user"];
$comentario=$_POST['comentario'];
$idejun=$_POST['IDEJUN4'];
$idepro=$_POST['IDEPRO4'];
$fecha=date("Y-m-d H:i:s");


$query_qa =sprintf("SELECT IDEASI FROM ASI WHERE JUNASI=$idejun && PERASI=$ideper");
$qa = mysqli_query($conex, $query_qa) or die(mysqli_error());
$row_qa = mysqli_fetch_assoc($qa);
$ideasi = $row_qa['IDEASI'];
$totalRows_qa = mysqli_num_rows($qa);
if($totalRows_qa>0){
$insertSQL = sprintf("INSERT INTO COM_JC (COMCOM,FECCOM,PROCOM,ASICOM) VALUES ('$comentario','$fecha',$idepro,$ideasi)");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
}
header("Location:../gestionar.php?IDEJUN=$idejun");	











?>