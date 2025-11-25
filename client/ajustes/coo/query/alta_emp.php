<?php require_once('../../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);

$app = $_POST["app_emp"];
$apm = $_POST["apm_emp"];
$nom = $_POST["nom_emp"];
$pue= $_POST["pue_emp"];
$ema = $_POST["ema_emp"];
$cel=$_POST["cel_emp"];
$cel2=$_POST["cel2_emp"];
$tel=$_POST["tel_emp"];
$tel2=$_POST["tel2_emp"];
$ext=$_POST["ext_emp"];

$insertSQL = sprintf("INSERT INTO EMP (APPEMP,APMEMP,NOMEMP,EMAEMP,CELEMP,CEL2EMP,TELOFIEMP,TELOFI2EMP,EXTEMP) VALUES ( '$app', '$apm', '$nom', '$ema','$cel','$cel2','$tel','$tel2', '$ext')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));

$query = "SELECT IDEEMP FROM EMP ORDER BY IDEEMP DESC LIMIT 1";
$con= mysqli_query($conex, $query) or die(mysqli_error($conex));
$row = mysqli_fetch_assoc($con);
$ideemp=$row['IDEEMP'];

$insertSQL2 = sprintf("INSERT INTO PER (EMPPER,CARPER) VALUES ( $ideemp, $pue )");
$Result2=mysqli_query($conex, $insertSQL2) or die (mysqli_error($conex));

//header("Location:../");

?>