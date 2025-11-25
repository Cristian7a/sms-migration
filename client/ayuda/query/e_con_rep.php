<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['IDEREP'];
$SQL = "SELECT IDEREP,CONREP,FECEVE,FECREP,LUGREP,OBSREP,FREREP,PERREP,COOCAR,CANREP FROM REP,PER,CAR WHERE PERREP=IDEPER && CARPER=IDECAR  && IDEREP=$ide";
$stmt=$con->prepare($SQL);
$result=$stmt->execute();
$rows=$stmt->fetchAll(\PDO::FETCH_OBJ);
echo(json_encode($rows));?>