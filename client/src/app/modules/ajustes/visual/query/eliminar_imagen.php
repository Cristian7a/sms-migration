<?php
session_start();
$id=$_SESSION['user'];
$href=$_POST['url'];
$ruta="../".$href;
unlink($ruta);
require_once("../conex/conex.php");
mysqli_select_db($conex, $database_conex);
 $sql = sprintf("DELETE FROM img WHERE img='$href' and asp_img=$id");
 $Result1=mysqli_query($conex, $sql) or die (mysqli_error($conex));
header("Location: ../" );
?>