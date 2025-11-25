<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['IDERIE'];
$iderep=$_GET['IDEREP'];

  $sql = sprintf("DELETE FROM RIE WHERE IDERIE=$ide");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['IDERIE'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }
  header("Location:../ver_gestion.php?IDEREP=$iderep");

?>
