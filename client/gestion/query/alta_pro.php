<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);
session_start();
$user=$_SESSION['user'];

$iderie=$_POST['IDERIE_PRO'];

$des = mb_strtoupper($_POST["desc"]);
$des = utf8_decode($des);

echo $iderie;

$query= "SELECT IDEPRO FROM PRO ORDER BY IDEPRO DESC LIMIT 1 ";
$con = mysqli_query($conex, $query) or die(mysqli_error($conex));
$row = mysqli_fetch_assoc($con);
$totalRows = mysqli_num_rows($con);
 if ($totalRows == 0) { 
$pro=1;
 } else{
$pro=$row['IDEPRO']+1;
 }

$insertSQL = sprintf("INSERT INTO PRO (IDEPRO,DESPRO,PRIPRO,RIEPRO,ESTPRO) VALUES ( $pro, '$des','$des',$iderie,'ABIERTO')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));

$query= "SELECT IDEPRO FROM PRO order by IDEPRO DESC limit 1 ";
$pro  = mysqli_query($conex, $query) or die(mysqli_error($conex));
$row = mysqli_fetch_assoc($pro);
$pro=$row['IDEPRO'];

$insertSQL2 = sprintf("INSERT INTO MONPRO (MONPRO,ESTMON,POREST,DESEST,FECMON,MEDMON) VALUES ($pro,'NO HAN SIDO IMPLEMENTADAS',0,'',NULL,'')");
$Result2=mysqli_query($conex, $insertSQL2) or die (mysqli_error($conex));

$update = sprintf("UPDATE `INV` SET `FIRINV`='SI' WHERE PERINV='$user' && RIEINV='$iderie'");
$Res=mysqli_query($conex, $update) or die (mysqli_error($conex));	
//header("Location:../propuestas.php?IDEREP=$iderep&IDERIE=$iderie");	




?>