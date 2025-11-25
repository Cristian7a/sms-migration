<?php require_once("../../conex/conectar.php");
$con=conectar();
$ideten=$_GET['IDETEN'];

  $sql = sprintf("DELETE FROM TEN WHERE IDETEN=$ideten");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['IDETEN'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }
  header("Location:../");

?>
