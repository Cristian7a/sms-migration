<?php 
require_once("../../conex/conex.php"); 
mysqli_select_db($conex, $database_conex);

$ide= $_POST["IDREPEVA"];
$iderie = $_POST["IDRIEEVA"];
$pro = $_POST["pro_rev"];
$gra = $_POST["gra_rev"];


if( $pro!='' || $gra!=''){

//echo $id;
$insertSQL = sprintf("UPDATE RIE SET PROREV=$pro, GRAREV='$gra' WHERE IDERIE=$iderie ");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
}

//header("Location:../propuestas.php?IDEREP=$ide&IDERIE=$iderie");
?>