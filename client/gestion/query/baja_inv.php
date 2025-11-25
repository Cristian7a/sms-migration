<?php require_once("../../conex/conectar.php");
$con=conectar();

$iderep=$_GET['IDEREP'];
$ideinv=$_GET['IDEINV'];

  $sql = sprintf("DELETE FROM INV WHERE IDEINV=$ideinv");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['IDEREP'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }
  header("Location:../ver_gestion.php?IDEREP=$iderep");

?>
