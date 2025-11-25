<?php require_once('../../conex/conex.php');
mysqli_select_db($conex, $database_conex);



$des=mb_strtoupper($_POST['ejemplo_taxonomia']);
$des=utf8_decode($des);
$idetac=$_POST['IDETAC_NUEVO'];

echo($idetac);

$insertSQL = sprintf("INSERT INTO EJM (DESEJM,EJMTAC) VALUES ('$des',$idetac)");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));

echo "registro exitoso";



?>