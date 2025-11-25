<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['RIEINC'];
$ideten=$_GET['IDETEN'];

  $sql = sprintf("DELETE FROM INC WHERE RIEINC=$ide");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['RIEINC'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }
  require_once('../../conex/conex.php'); 
  mysqli_select_db($conex, $database_conex);
  $update = sprintf("UPDATE `TEN` SET `INCTEN`=(INCTEN-1) WHERE IDETEN=$ideten");
  $res=mysqli_query($conex, $update) or die (mysqli_error($conex));

  header("Location:../tendencia.php?ten=$ideten");

?>
