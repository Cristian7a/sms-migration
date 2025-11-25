<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['IDETEM'];
$idejun=$_GET['IDEJUN'];

  $sql = sprintf("DELETE FROM TEM_JC WHERE IDETEM=$ide");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['IDETEM'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }
  header("Location:../gestionar.php?IDEJUN=$idejun");

?>
