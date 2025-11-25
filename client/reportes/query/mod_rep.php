<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

if(isset($_POST['eliminar'])){
	$iderep=$_POST['IDREP'];
	$eliminar1=sprintf("DELETE FROM `PEL` WHERE REPPEL=$iderep");
	$resultado1=mysqli_query($conex, $eliminar1) or die (mysqli_error($conex));
	$eliminar2=sprintf("DELETE FROM `REP` WHERE IDEREP=$iderep");
	$resultado2=mysqli_query($conex, $eliminar2) or die (mysqli_error($conex));

	echo "	Reporte eliminado";
	header("Location:../index.php");
    
} else {

$iderep=$_POST['IDREP'];
$confidencial = $_POST["con_e"];
$fecsus = $_POST["fecsus_e"];
$fecrep = $_POST["fecrep_e"];
$lugsus = $_POST["lugsus_e"];
$obs = $_POST["obs_e"];
$obs = mb_strtoupper($obs);
$freeve=$_POST["freeve_e"];
$canrep=$_POST["canrep_e"];
$emp=$_POST["emp_e"];

$update=sprintf("UPDATE REP SET CONREP='$confidencial', FECEVE='$fecsus' ,FECREP='$fecrep', OBSREP='$obs',FREREP='$freeve',PERREP=$emp, CANREP=$canrep WHERE IDEREP=$iderep");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location:../index.php");

}

?>