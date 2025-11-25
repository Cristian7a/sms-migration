<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);
$ideemp=$_POST['emp_res'];
$idepro=$_POST['IDEPRO_RES'];
$feclim=$_POST['feclim_res'];

$query_res = "SELECT IDERES FROM RES WHERE EMPRES=$ideemp && PRORES=$idepro";
$res = mysqli_query($conex, $query_res) or die(mysqli_error());
$row_res = mysqli_fetch_assoc($res);
$totalRows_res = mysqli_num_rows($res);
if ($totalRows_res == 0) { 

$insertSQL = sprintf("INSERT INTO RES (EMPRES,PRORES,FECLIM) VALUES ( '$ideemp','$idepro','$feclim')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
	echo $idepro; 

}

//header("Location:../propuestas.php?IDEREP=$iderep&IDERIE=$iderie");	



?>