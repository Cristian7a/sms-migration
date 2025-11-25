<?php require_once('../../conex/conex.php');
mysqli_select_db($conex, $database_conex);
session_start();
$usu=$_SESSION['nombre'];

$com=$_POST['comentario'];
if(isset($_POST['enviar_comen_aceptar'])){
$com="ACEPTO";
}
$iderep=$_POST['IDEREP3'];
$idepro=$_POST['IDEPRO3'];
if(isset($_POST['IDEREP4'])){
$iderep=$_POST['IDEREP4'];
}
if(isset($_POST['IDEPRO4'])){
$idepro=$_POST['IDEPRO4'];
}
$fec=date("y-m-d");

$query= "SELECT IDECOM FROM COM ORDER BY IDECOM DESC LIMIT 1 ";
$con = mysqli_query($conex, $query) or die(mysqli_error($conex));
$row = mysqli_fetch_assoc($con);
$totalRows = mysqli_num_rows($con);
 if ($totalRows == 0) { 
$idecom=1;
 } else{
$idecom=$row['IDECOM']+1;
 }


$insertSQL = sprintf("INSERT INTO COM (IDECOM,COMCOM,PROCOM,FECCOM,NOMCOM) VALUES ($idecom,'$com',$idepro,'$fec','$usu')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));


header("Location:../ver_gestion.php?IDEREP=$iderep");	



?>