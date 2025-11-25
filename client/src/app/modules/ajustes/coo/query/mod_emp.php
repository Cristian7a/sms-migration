<?php 
require_once('../../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);


if(isset($_POST['baja'])){

$ideemp=$_POST['IDEEMP'];
$fecha=date('Y-m-d');
$update=sprintf("UPDATE PER SET FECFIN='$fecha' WHERE EMPPER=$ideemp");
$Result=mysqli_query($conex, $update) or die (mysqli_error($conex));
header("Location: ../ ");

}else{

$ideemp=$_POST['IDEEMP'];
$app = utf8_decode($_POST["app_emp_e"]);
$apm = utf8_decode($_POST["apm_emp_e"]);
$nom = utf8_decode($_POST["nom_emp_e"]);
$pue= $_POST["pue_emp_e"];
$ema = $_POST["ema_emp_e"];
$cel=$_POST["cel_emp_e"];
$cel2=$_POST["cel2_emp_e"];
$tel=$_POST["tel_emp_e"];
$tel2=$_POST["tel2_emp_e"];
$ext=$_POST["ext_emp_e"];

$update1=sprintf("UPDATE EMP SET APPEMP='$app', APMEMP='$apm', NOMEMP='$nom', EMAEMP='$ema', CELEMP='$cel', CEL2EMP='$cel2', TELOFIEMP='$tel', TELOFI2EMP='$tel2', EXTEMP='$ext' WHERE IDEEMP=$ideemp");
$Result1=mysqli_query($conex, $update1) or die (mysqli_error($conex));
header("Location: ../ ");

}
?> ")