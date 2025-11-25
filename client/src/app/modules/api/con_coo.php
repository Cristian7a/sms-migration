<?php require_once("../conex/conectar.php");
$con=conectar();
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$consulta="SELECT IDECOO,NOMCOO FROM COO ORDER BY NOMCOO";
 $sql = $con->prepare($consulta);
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
