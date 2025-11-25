<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$ent = $_POST["ent"];

$monpro = $_POST["monpro8"];

if($ent==''){$update = sprintf("UPDATE CIC SET FECENT=NULL WHERE MONCIC=$monpro");}
else {
$update = sprintf("UPDATE CIC SET FECENT='$ent' WHERE MONCIC=$monpro");	
}
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../" );
?>