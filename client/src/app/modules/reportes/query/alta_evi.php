<?php
require_once('../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$nombre_archivo = $_FILES['evi']['name'];
$tipo_archivo = $_FILES['evi']['type'];
$tamano_archivo = $_FILES['evi']['size'];
$ruta_temporal=$_FILES['evi']['tmp_name'];
$iderep=$_POST['IDEREP'];
$tipevi=$_POST['tip'];
$nomevi=$_POST['nom'];

//verifica que el tamaño del archivo sea menor a 12MB
if ($tamano_archivo< 12000000){ 
switch ($tipo_archivo) {
    case "image/png":
        $tipo_archivo=".png";
        break;
    case "application/pdf":
        $tipo_archivo=".pdf";
        break;
    case "image/jpeg":
        $tipo_archivo=".jpg";
        break;
}

//Se remplazan los espacios vacios por guiones bajos
$patron='';
$reemplazo='_';
$nombre_archivo= str_replace(' ', '_', $nombre_archivo);

//Verificar si ya existe archivo con ese nombre
mysqli_select_db($conex, $database_conex);
$query_filevi = "SELECT FILEVI FROM EVI WHERE FILEVI='$nombre_archivo'  ";
$filevi= mysqli_query($conex, $query_filevi) or die(mysqli_error($conex));
$totalRows_filevi = mysqli_num_rows($filevi);
if ($totalRows_filevi > 0) {
$formatos = array(".png", ".PNG", ".pdf", ".PDF", ".jpg", ".JPG");
$nombre_archivo= str_replace($formatos, '(1)'.$tipo_archivo, $nombre_archivo);
echo $nombre_archivo;
}

//Guardar la evidencia en el servidor---crea carpeta donde guardar archivos
mkdir("../evidencias/".$iderep, 0700);
$folder_destino="evidencias/".$iderep."/";
$destino="../".$folder_destino.$nombre_archivo;
copy($ruta_temporal,$destino);

//Inserta el registro del archivo en la base de datos
$insertSQL = sprintf("INSERT INTO EVI (NOMEVI,FILEVI,RUTEVI,TIPEVI,REPEVI) VALUES ('$nomevi','$nombre_archivo','$folder_destino','$tipevi',$iderep) ");
$Result=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
header("Location: ../evidencias.php?IDEREP=$iderep" );

}else{
	echo "Archivo muy pesado";
	header("Location: ../evidencias.php?IDEREP=$iderep&error=1" );
}


//LOG DE ERRORES
//error 1 - Error por peso excesivo de archivo
?>

