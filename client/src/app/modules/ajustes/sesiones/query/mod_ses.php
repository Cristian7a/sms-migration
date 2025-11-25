<?php require_once('../../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$ide=$_POST['ID'];
$emp=$_POST["emp_e"];
$pri=$_POST["pri_e"];
$pass=$_POST["pass_e"];


$update=sprintf("UPDATE SES SET PRISES='$pri', PASSES='$pass' WHERE IDESES=$ide");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location:../index.php");

?>