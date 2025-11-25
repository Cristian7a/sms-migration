<?php require_once("../../conex/conectar.php");
$con=conectar();
$iderep=$_GET['IDEREP'];
$idecom=$_GET['IDECOM'];


  $sql = sprintf("DELETE FROM COM WHERE IDECOM=$idecom");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['IDERIE'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }
  header("Location:../ver_gestion.php?IDEREP=$iderep");

?>
