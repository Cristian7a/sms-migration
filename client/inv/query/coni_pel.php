
<?php require_once("../../conex/conectar.php");
$con=conectar();
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$ide=$_GET['IDEREP'];
$idrie=$_GET['IDERIE'];
 $consulta="SELECT GENPEL,CONPEL,OBJPEL,ACTPEL,FECPEL,CATEPEL,RIEOPEPEL,METIDEPEL,DESRIE,CESPRIE,CONRIE,PROBRIE,GRARIE FROM PEL,RIE WHERE REPPEL=$ide && IDERIE=$idrie &&PELRIE=REPPEL";
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
?>