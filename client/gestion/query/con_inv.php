<?php require_once("../../conex/conectar.php");
$con=conectar();
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$idepro=$_GET['IDEPRO'];
 $consulta="SELECT IDEINV,NOMEMP,APPEMP,APMEMP,NOMCAR,NOMCOO,FECNOT FROM EMP,CAR,COO,PER,INV,PRO WHERE PROINV=$idepro && IDEPRO=PROINV && IDECAR=CARPER && COOCAR=IDECOO && IDEEMP=EMPPER && IDEPER=PERINV ";
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
//$json = html_entity_decode(json_encode($array));
///------------------------------------------------------------------------


?>