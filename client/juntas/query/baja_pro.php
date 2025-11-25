<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['IDEPRO'];
$idetem=$_GET['IDETEM'];

  $sql = sprintf("DELETE FROM PRO_JC WHERE IDEPRO=$ide");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['IDEPRO'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }


  require_once("../../conex/conex.php"); 
  mysqli_select_db($conex, $database_conex);
  $query = "SELECT JUNTEM FROM TEM_JC WHERE IDETEM=$idetem ";
  $tem = mysqli_query($conex, $query) or die(mysqli_error($conex));
  $row= mysqli_fetch_assoc($tem);

  $idejun=$row['JUNTEM'];

  header("Location:../gestionar.php?IDEJUN=$idejun");

?>
