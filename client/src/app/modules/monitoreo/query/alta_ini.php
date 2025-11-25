<?php require_once('../../conex/conex.php');
mysqli_select_db($conex, $database_conex);


$medio_monitoreo=$_POST['med_mon_i'];
$monpro=$_POST['mondoc_i'];
$nombre_doc=$_POST['nom_i'];
$fecha=date("Y-m-d");

if ($_FILES['doc_i']["error"] > 0)
  {
  echo "Error: " . $_FILES['doc_i']['error'] . "<br>";
  $destino_filei="";
  }
else
  {
  $file=$_FILES['doc_i']['name'];
  $ruta_file=$_FILES['doc_i']['tmp_name'];
  $destino_file="../../docs/".$file;
  $destino_filei="docs/".$file;
  copy($ruta_file,$destino_file);
  }

$updateSQL = sprintf("UPDATE MONPRO SET MEDMON='$medio_monitoreo', FECMON='$fecha' WHERE MONPRO=$monpro");
$Result=mysqli_query($conex, $updateSQL) or die (mysqli_error($conex));

$insertSQL = sprintf("INSERT INTO DOCMON (NOMDOC,DIRDOC,FECDOC,MONDOC) VALUES ( '$nombre_doc','$destino_filei','$fecha',$monpro)");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));

$insertSQL2 = sprintf("INSERT INTO CIC (MONCIC,CAUCIC,OBJCIC,PLACIC,VERCIC,LOGCIC,ACTCIC) VALUES ($monpro,'','','','','','')");
$Result2=mysqli_query($conex, $insertSQL2) or die (mysqli_error($conex));


header("Location:../");	



?>
