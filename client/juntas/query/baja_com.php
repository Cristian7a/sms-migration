<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['IDECOM'];
$idejun=$_GET['IDEJUN'];

  $sql = sprintf("DELETE FROM COM_JC WHERE IDECOM=$ide");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['IDECOM'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }
  header("Location:../gestionar.php?IDEJUN=$idejun");

?>
