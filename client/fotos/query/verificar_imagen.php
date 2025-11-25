<?php
session_start();
$user=$_SESSION['user'];
require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);
$ide=$_POST['ideemp'];
$file="base/".$user.".jpg";
$ruta=$_FILES['foto']['tmp_name'];
$destino="../".$file;

if (!copy($ruta, $destino)) {
	$errors= error_get_last();
    echo "Error al copiar $fichero...\n";
      echo "COPY ERROR: ".$errors['type'];
    echo "<br />\n".$errors['message'];
}


$actualizar = sprintf("UPDATE EMP SET FOTEMP='$file' WHERE IDEEMP=$ide ");
$Result1=mysqli_query($conex, $actualizar) or die (mysqli_error($conex));
$_SESSION['foto']=$file;
header("Location: ../" );

?>