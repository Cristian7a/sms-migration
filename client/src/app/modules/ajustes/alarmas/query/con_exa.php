<?php require_once("../../../conex/conectar.php");
$con=conectar();
$SQL = "SELECT DISTINCT IDEEXA,FECEXA,NOMEXA,TIPEXA FROM EXA,PRE WHERE TIP2EXA='DIAGNOSTICO' && IDEEXA=EXAPRE ";
$stmt=$con->prepare($SQL);
$result=$stmt->execute();
$rows=$stmt->fetchAll(\PDO::FETCH_OBJ);
echo(json_encode($rows));?>