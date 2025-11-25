<?php require_once("../../conex/conectar.php");
$con=conectar();
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$ide=$_GET['IDEREP'];
$sql = $con->prepare("SELECT NOMEMP,APPEMP,APMEMP,EMAEMP,CELEMP,CEL2EMP,TELOFIEMP,TELOFI2EMP,EXTEMP,NOMCAR,NOMCOO
FROM PER,COO,CAR,EMP,REP 
WHERE IDEREP=$ide && PERREP=IDEPER && EMPPER=IDEEMP && CARPER=IDECAR && COOCAR=IDECOO");
$sql->execute();
 $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
        }
    });
 
    return $array;
}
$r2=utf8_converter($resultado);

echo json_encode($r2,JSON_UNESCAPED_UNICODE);
?>

