<?php require_once("../../conex/conectar.php");
$con=conectar();
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$idetem=$_GET['IDETEM'];
 $consulta="SELECT IDEPRO,DESPRO,NOMEMP,APPEMP,APMEMP,TIEPRO,ESTPRO,TEMPRO FROM PRO_JC,PER,EMP WHERE IDEEMP=EMPPER && IDEPER=RESPRO && TEMPRO=$idetem";
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