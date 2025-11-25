<?php

function verificar_tema(){
require_once("../conex/conex.php");
     mysqli_select_db($conex, $database_conex);
$ideusu=$_SESSION['user'];

$query_asp = "SELECT FOTEMP FROM EMP,PER WHERE IDEEMP=EMPPER ";
$asp= mysqli_query($conex, $query_asp) or die(mysqli_error($conex));
$row_asp = mysqli_fetch_assoc($asp);
$totalRows_asp = mysqli_num_rows($asp);

if ($totalRows_asp == 0) { 

$insertSQL = sprintf("INSERT INTO asp (ide_usu,tip_asp,img_asp) VALUES ( '$ideusu',1,'img/fondo.jpg')");
$Result2=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));

}else{

//$tema=$row_asp['tip_asp'];

//return $tema;
}
}


?>