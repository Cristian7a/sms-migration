<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);
session_start();
$user=$_SESSION['user'];

$ideemp=$_POST['emp1'];
$idepro=$_POST['IDEPRO_INV'];
$ide=$_POST['IDEREP'];

$query_inv = "SELECT PERINV FROM INV WHERE PERINV=$ideemp && PROINV=$idepro ";
$inv = mysqli_query($conex, $query_inv) or die(mysqli_error());
$row_inv = mysqli_fetch_assoc($inv);
$totalRows_inv = mysqli_num_rows($inv);
if ($totalRows_inv == 0) { 

if($user==$ideemp){
$insertSQL = sprintf("INSERT INTO INV (PROINV,PERINV,FIRINV) VALUES ( '$idepro','$ideemp','SI')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
}else{
$insertSQL = sprintf("INSERT INTO INV (PROINV,PERINV) VALUES ( '$idepro','$ideemp')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
}

}


//header("Location:../propuestas.php?IDEREP=$ide&IDERIE=$iderie");	



?>
