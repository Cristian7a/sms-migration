<?php require_once("../../conex/conectar.php");
$con=conectar();
$ide=$_GET['IDEREP'];
$SQL = "SELECT IDEREP,CONREP,FECEVE,FECREP,LUGREP,CAUREP,OBSREP,FREREP,FACCAU,PERREP,COOCAR FROM REP,PER,CAR,CAU WHERE PERREP=IDEPER && CARPER=IDECAR && CAUREP=IDECAU && IDEREP=$ide";
$stmt=$con->prepare($SQL);
$result=$stmt->execute();
$rows=$stmt->fetchAll(\PDO::FETCH_OBJ);
echo(json_encode($rows));?>