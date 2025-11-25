<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$ini = $_POST["ini"];
$monpro = $_POST["monpro7"];

if($ini==''){$update = sprintf("UPDATE CIC SET FECINI=NULL WHERE MONCIC=$monpro");}else{
$update = sprintf("UPDATE CIC SET FECINI='$ini' WHERE MONCIC=$monpro");
}
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../" );
?>