<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['IDEASI'];
$idejun=$_GET['IDEJUN'];

  $sql = sprintf("DELETE FROM ASI WHERE IDEASI=$ide");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['IDEASI'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }
  header("Location:../participantes.php?IDEJUN=$idejun");

?>
