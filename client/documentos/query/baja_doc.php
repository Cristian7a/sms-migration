<?php
$href=$_GET['dirdoc'];
$idedoc=$_GET['idedoc'];
$ruta="../../".$href;
unlink($ruta);
require_once("../../conex/conex.php");
mysqli_select_db($conex, $database_conex);
 $sql = sprintf("DELETE FROM DOC WHERE IDEDOC='$idedoc'");
 $Result1=mysqli_query($conex, $sql) or die (mysqli_error($conex));
header("Location: ../" );
?>