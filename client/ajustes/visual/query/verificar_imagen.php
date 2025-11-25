<?php
require_once('../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);
session_start();
$x=$_SESSION['user'];
$file=$_FILES['img']['name'];
$ruta=$_FILES['img']['tmp_name'];
$destino="../img/".$file;
$destinoi="img/".$file;
copy($ruta,$destino);

$insertSQL = sprintf("INSERT INTO img (asp_img,img) VALUES ($x,'$destinoi') ");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
header("Location: ../" );

?>