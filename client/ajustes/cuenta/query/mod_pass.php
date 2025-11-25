<?php 
require_once('../../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

session_start();
$user=$_SESSION['user'];
$pass=$_POST['pass'];

$update=sprintf("UPDATE SES SET PASSES='$pass'  WHERE IDESES=$user");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../ ");

?> ")