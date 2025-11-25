<?php require_once("../../conex/conectar.php");
$con=conectar();
$SQL = "SELECT IDEREP,FECREP,FECEVE,NOMLUG,TIPFAC,TIPCAU,FREREP,OBSREP FROM REP,LUG,FAC,CAU WHERE LUGREP=IDELUG && CAUREP=IDECAU && FACCAU=IDEFAC ";
$stmt=$con->prepare($SQL);
$result=$stmt->execute();
$rows=$stmt->fetchAll(\PDO::FETCH_OBJ);
echo(json_encode($rows));?>