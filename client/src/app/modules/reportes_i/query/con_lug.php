<?php require_once("../../conex/conectar.php");
$con=conectar();
$SQL = "SELECT IDELUG,NOMLUG FROM LUG";
$stmt=$con->prepare($SQL);
$result=$stmt->execute();
$rows=$stmt->fetchAll(\PDO::FETCH_OBJ);
echo(json_encode($rows));?>