<?php
$ide=$_GET['ide'];
require_once("../../../conex/conex.php");
mysqli_select_db($conex, $database_conex);
 $sql = sprintf("DELETE FROM SES WHERE IDESES=$ide");
 $Result1=mysqli_query($conex, $sql) or die (mysqli_error($conex));
 
header("Location: ../" );
?>