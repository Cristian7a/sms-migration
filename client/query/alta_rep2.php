<?php require_once('../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$confidencial = $_POST["con"];
$fecsus = $_POST["fecsus"];
$fecrep = $_POST["fecrep"];
$lugsus = $_POST["lugsus"];
$cauesp= $_POST["cauesp"];
$obs = $_POST["obs"];
$obs = mb_strtoupper($obs);
$freeve=$_POST["freeve"];
$emp=$_POST["emp"];
$fecha1=date('y-m-d');

$insertSQL = sprintf("INSERT INTO REP (CONREP,FECEVE,FECREP,FREREP,CAUREP,OBSREP,LUGREP,PERREP) VALUES ( '$confidencial', '$fecsus', 
	'$fecha1', '$freeve','$cauesp','$obs', '$lugsus','$emp')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
//header("Location:../index.php");

?>
