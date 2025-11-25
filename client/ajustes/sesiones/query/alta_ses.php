<?php
require_once('../../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$emp=$_POST['emp'];
$pri=$_POST['pri'];
$pass=$_POST['pass'];

$query_idetip = "SELECT IDESES FROM SES WHERE IDESES=$emp ";
$idetip  = mysqli_query($conex, $query_idetip) or die(mysqli_error($conex));
$totalRows = mysqli_num_rows($idetip);
 if ($totalRows == 0) { 

$insertSQL = sprintf("INSERT INTO SES (IDESES,PRISES,PASSES) VALUES ($emp,'$pri','$pass') ");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
//header("Location: ../" ); 
}

?>