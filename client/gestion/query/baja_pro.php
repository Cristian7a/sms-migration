<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['IDERIE'];
$iderep=$_GET['IDEREP'];
$idepro=$_GET['IDEPRO'];

  $sql = sprintf("DELETE FROM PRO WHERE IDEPRO=$idepro");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['IDERIE'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }
  header("Location:../ver_gestion.php?IDEREP=$iderep&IDERIE=$ide");

?>
