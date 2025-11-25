<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['IDEREP'];
$SQL = "SELECT FECREP,FECEVE,NOMLUG,FREREP,OBSREP FROM REP,LUG WHERE LUGREP=IDELUG &&  IDEREP=$ide";
$stmt=$con->prepare($SQL);
$result=$stmt->execute();
$rows=$stmt->fetchAll(\PDO::FETCH_OBJ);
echo(json_encode($rows));?>