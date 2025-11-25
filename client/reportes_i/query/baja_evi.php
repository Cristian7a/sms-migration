<?php 
require_once("../../conex/conectar.php");
require_once("../../conex/conex.php");
mysqli_select_db($conex, $database_conex);
$con=conectar();
$ideevi=$_POST['IDEVI'];

if (isset($_POST['enviar_si'])){
	$res=$_POST['enviar_si'];
}else{
	$res=$_POST['enviar_no'];
}

$query = "SELECT REPEVI,RUTEVI,FILEVI FROM EVI WHERE IDEEVI=$ideevi ";
$evi= mysqli_query($conex, $query) or die(mysqli_error($conex));
$row = mysqli_fetch_assoc($evi);
$iderep=$row['REPEVI'];
$ruta="../../reportes/".$row['RUTEVI'].$row['FILEVI'];

if ($res=="Si"){
  $sql = sprintf("DELETE FROM EVI WHERE IDEEVI=$ideevi");
  $stmt = $con->prepare($sql);
  $OK = $stmt->execute(array($_GET['REPEVI'])); 
  $error = $stmt->errorInfo();
  if (!$OK) {
    echo $error[2];
  }else{
  	unlink($ruta);
  }
   header("Location:../evidencias.php?IDEREP=$iderep");
} else {
	header("Location:../evidencias.php?IDEREP=$iderep");
}


?>
