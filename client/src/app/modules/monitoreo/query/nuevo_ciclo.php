<?php require_once('../../conex/conex.php');
mysqli_select_db($conex, $database_conex);

$monpro=$_GET['monpro'];

$insertSQL2 = sprintf("INSERT INTO CIC (MONCIC,CAUCIC,OBJCIC,PLACIC,VERCIC,LOGCIC,ACTCIC) 
  VALUES ($monpro,'','','','','','') ");
$Result2=mysqli_query($conex, $insertSQL2) or die (mysqli_error($conex));

header("Location:../");	



?>
