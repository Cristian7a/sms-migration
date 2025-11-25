<?php require_once('../../conex/conex.php');
mysqli_select_db($conex, $database_conex);

$ideres=$_POST['IDERES'];
$nom=$_POST['nom'];
$fec=date("y-m-d");

if ($_FILES['doc']["error"] > 0)
  {
  echo "Error: " . $_FILES['doc']['error'] . "<br>";
  $destino_filei="";
  }
else
  {
  $file=$_FILES['doc']['name'];
  $ruta_file=$_FILES['doc']['tmp_name'];
  $destino_file="../../docs/".$file;
  $destino_filei="docs/".$file;
  copy($ruta_file,$destino_file);
  }


$insertSQL = sprintf("INSERT INTO DOC (NOMDOC,DIRDOC,RESDOC,FECDOC) VALUES ( '$nom','$destino_filei',$ideres,'$fec')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));


header("Location:../");	



?>
