<?php 
require_once("../../../conex/conectar.php");
$con=conectar();

$ideexa=$_GET['IDEEXA'];
  $sql = sprintf("DELETE FROM EXA WHERE IDEEXA=$ideexa");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['IDEEXA'])); 
  $error = $stmt->errorInfo();

   header("Location:../index.php");



?>
