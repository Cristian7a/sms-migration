<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$confidencial = $_POST["con"];
$fecsus = $_POST["fecsus"];
$fecrep = $_POST["fecrep"];
$lugsus = $_POST["lugsus"];
$obs = $_POST["obs"];
$obs = mb_strtoupper($obs);
$freeve=$_POST["freeve"];
$emp=$_POST["emp"];
$fecha1=date('Y-m-d H:i:s');

$query= "SELECT IDEREP FROM REP ORDER BY IDEREP DESC LIMIT 1 ";
$con = mysqli_query($conex, $query) or die(mysqli_error($conex));
$row = mysqli_fetch_assoc($con);
$totalRows = mysqli_num_rows($con);
 if ($totalRows == 0) { 
$iderep=1;
 } else{
$iderep=$row['IDEREP']+1;
 }

$insertSQL = sprintf("INSERT INTO REP (IDEREP,CONREP,FECEVE,FECREP,FREREP,OBSREP,LUGREP,PERREP,CANREP) VALUES ($iderep,'$confidencial', '$fecsus', '$fecrep', '$freeve','$obs', '$lugsus','$emp',0)");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
//header("Location:../index.php");

?>