<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['IDEREP'];
$SQL = "SELECT IDERIE,DESRIE,CESPRIE,CONRIE,PROBRIE,GRARIE,PROREV,GRAREV FROM RIE WHERE PELRIE=$ide";
$stmt=$con->prepare($SQL);
$result=$stmt->execute();
$rows=$stmt->fetchAll(\PDO::FETCH_OBJ);
echo(json_encode($rows));?>