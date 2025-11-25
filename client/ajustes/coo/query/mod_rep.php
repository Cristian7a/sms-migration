<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$iderep=$_POST['IDREP'];
$confidencial = $_POST["con_e"];
$fecsus = $_POST["fecsus_e"];
$fecrep = $_POST["fecrep_e"];
$lugsus = $_POST["lugsus_e"];
$cauesp= $_POST["cauesp_e"];
$obs = $_POST["obs_e"];
$freeve=$_POST["freeve_e"];
$emp=$_POST["emp_e"];

$update=sprintf("UPDATE REP SET CONREP='$confidencial', FECEVE='$fecsus' ,FECREP='$fecrep', CAUREP=$cauesp, OBSREP='$obs',FREREP='$freeve',PERREP=$emp WHERE IDEREP=$iderep");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location:../index.php");

?>