<?php require_once("../../conex/conectar.php");
$con=conectar();
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$idepro=$_GET['IDEPRO'];
 $consulta="SELECT IDERES,NOMEMP,APPEMP,APMEMP,NOMCAR,EMAEMP,NOMCOO,IDERIE,PELRIE,FECLIM,FECNOT FROM EMP,CAR,COO,PER,RES,RIE,PRO WHERE PRORES=$idepro && IDEPER=EMPRES && IDECAR=CARPER && COOCAR=IDECOO && IDEEMP=EMPPER && RIEPRO=IDERIE && IDEPRO=PRORES";
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