<?php
include("../conex/conex.php");
mysqli_select_db($conex, $database_conex);
session_start();
$id_usu=$_SESSION['user'];
$ruta=$_POST['url'];
$update = sprintf("UPDATE `asp` SET img_asp='$ruta' WHERE ide_usu=$id_usu ");
$resultado=mysqli_query($conex, $update) or die (mysqli_error($conex));
$_SESSION['fondo']=$ruta;
header("Location: ../" );
?>