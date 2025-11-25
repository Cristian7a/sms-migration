<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$peli=mb_strtoupper($_POST['ide_gen_e']);
$cond=mb_strtoupper($_POST['con_e']);
$obje=mb_strtoupper($_POST['obj_e']);
$acti=mb_strtoupper($_POST['act_e']);
$cate=$_POST['cat_e'];
$meto=$_POST['met_ide_e'];
$ries=$_POST['rie_ope_e'];
$idrep=$_POST['IDREP'];


$update=sprintf("UPDATE PEL SET GENPEL='$peli', CONPEL='$cond', OBJPEL='$obje', ACTPEL='$acti', CATEPEL='$cate', METIDEPEL='$meto', RIEOPEPEL='$ries' WHERE REPPEL='$idrep' ");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location:../index.php");

?>