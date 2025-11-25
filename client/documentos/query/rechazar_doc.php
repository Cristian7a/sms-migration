<?php require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$idedoc=$_POST['iddoc'];
$razon=$_POST['rec'];
$fecha=date('Y-m-d');
$razon = mb_strtoupper($razon);

$update=sprintf("UPDATE DOC SET FECVERDOC='$fecha', VERDOC='$razon'  WHERE IDEDOC='$idedoc' ");
$Result1=mysqli_query($conex, $update) or die (mysqli_error($conex));

$query = "SELECT NOMEMP,APPEMP,APMEMP,EMAEMP FROM DOC,PRO,RES,PER,EMP WHERE RESDOC=IDERES && IDEEMP=EMPPER && IDEPER=EMPRES && PRORES=IDEPRO && IDEDOC=$idedoc";
$rie = mysqli_query($conex, $query) or die(mysqli_error());
$row = mysqli_fetch_assoc($rie);
$totalRows = mysqli_num_rows($rie);

if ($totalRows > 0) {

$email=$row['EMAEMP'];

$mail = "EL DOCUMENTO FUE RECHAZADO DEBIDO A LA SIGUIENTE RAZÓN: ".$razon."\n\nFAVOR DE CORREGIR Y VOLVER A SUBIR EL DOCUMENTO. ";
//Titulo
$titulo = "DOCUMENTO RECHAZADO";
//cabecera
$headers = "smssistema@gmail.com";
//Enviamos el mensaje a tu_dirección_email 
$bool = mail($email,$titulo,$mail,"From: $headers");

}
header("Location: ../");
