<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$idedoc=$_GET['IDEDOC'];
$fecha=date('y-m-d');

$update=sprintf("UPDATE DOC SET FECVERDOC='$fecha', VERDOC='APROBADO'  WHERE IDEDOC='$idedoc' ");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../");
