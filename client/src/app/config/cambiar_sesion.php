<?php
$user=$_GET['user'];
$datos = explode("-", $user);
$user=$datos[0];
$cargo=$datos[1];
$nivel=$datos[2];
session_start();
$_SESSION['user1']=$_SESSION['user'];
$_SESSION['user']=$user;
$_SESSION['cargo1']=$_SESSION['cargo'];
$_SESSION['cargo']=$cargo;
$_SESSION['nivel1']=$_SESSION['nivel'];
$_SESSION['nivel']=$nivel;
header("Location: ../app.php" );
?>