<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);
$ideemp=$_POST['emp_res_asignar'];
$idepro=$_POST['IDEPRO_RES2'];
$notpro=date("y-m-d");

$updateSQL = sprintf("UPDATE PRO SET RESPRO=$ideemp, NOTPRO='$notpro' WHERE IDEPRO=$idepro");
$Result1=mysqli_query($conex, $updateSQL) or die (mysqli_error($conex));
	echo $idepro; 


//header("Location:../propuestas.php?IDEREP=$iderep&IDERIE=$iderie");	



?>