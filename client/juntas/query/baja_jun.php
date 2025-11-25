<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['IDEJUN'];

  $sql = sprintf("DELETE FROM JUN WHERE IDEJUN=$ide");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['IDEJUN'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }
  header("Location:../index.php");

?>
