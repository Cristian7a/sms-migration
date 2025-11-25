<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$msm=mb_strtoupper($_POST['emsm']);
$psm=mb_strtoupper($_POST['epsm']);
$pso=mb_strtoupper($_POST['epso']);
$mit=mb_strtoupper($_POST['emit']);
$est=$_POST['eest'];
$idrep=$_POST['PELMON'];


$query_mon= "SELECT FECCIE,ESTMON FROM MON WHERE PELMON=$idrep";
$mon = mysqli_query($conex, $query_mon) or die(mysqli_error($conex));
$row_mon= mysqli_fetch_assoc($mon);
$fecc=$row_mon['FECCIE'];
$estc=$row_mon['ESTMON'];

if($estc=="ABIERTO" && $est=="CERRADO" ){
$fec=date("Y-m-d");
$update=sprintf("UPDATE MON SET MSMMON='$msm', PSMMON='$psm', PSOMON='$pso',  MITMON='$mit', ESTMON='$est', FECCIE='$fec' WHERE PELMON='$idrep' ");
}elseif ($estc=="ABIERTO" && $est=="ABIERTO" && $fecc==null) {
$update=sprintf("UPDATE MON SET MSMMON='$msm', PSMMON='$psm', PSOMON='$pso', MITMON='$mit', ESTMON='$est' WHERE PELMON='$idrep' ");

}elseif ($estc=="CERRADO" && $est=="CERRADO") {
	$fec=$fecc;
$update=sprintf("UPDATE MON SET MSMMON='$msm', PSMMON='$psm', PSOMON='$pso', MITMON='$mit', ESTMON='$est', FECCIE='$fec' WHERE PELMON='$idrep' ");
}elseif ($estc=="CERRADO" && $est=="ABIERTO") {
    $fec=$fecc;
$update=sprintf("UPDATE MON SET MSMMON='$msm', PSMMON='$psm', PSOMON='$pso', MITMON='$mit', ESTMON='$est', FECCIE='$fec' WHERE PELMON='$idrep' ");
}elseif ($estc=="ABIERTO" && $est=="ABIERTO" && $fecc!=null) {
$fec=$fecc;
$update=sprintf("UPDATE MON SET MSMMON='$msm', PSMMON='$psm', PSOMON='$pso', MITMON='$mit', ESTMON='$est', FECCIE='$fec' WHERE PELMON='$idrep' ");
}



$Result=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location:../ver_gestion.php?IDEREP=$idrep");

?>