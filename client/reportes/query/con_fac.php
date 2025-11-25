<?php require_once("../../conex/conectar.php");
$con=conectar();
$SQL = "SELECT IDEFAC,TIPFAC FROM FAC";
$stmt=$con->prepare($SQL);
$result=$stmt->execute();
$rows=$stmt->fetchAll(\PDO::FETCH_OBJ);
echo(json_encode($rows));?>