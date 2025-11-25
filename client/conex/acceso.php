<?php


if (!isset($_COOKIE["acceso"])) {
    setcookie("acceso","hoy",time()+450);
}

$acceso = $_COOKIE['acceso'] ?? null;
$user   = $_SESSION['user'] ?? null;

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
 $ip=$_SERVER['HTTP_CLIENT_IP'];}
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
 $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];} else {
 $ip=$_SERVER['REMOTE_ADDR'];}

 //echo $ip."<br>";

function getBrowser() {
$u_agent     = $_SERVER['HTTP_USER_AGENT'];
$bname         = 'n/i';
$platform     = 'n/i';
$version    = 'none';

// En primer lugar obtener la plataforma.
if (preg_match('/linux/i', $u_agent)) {
    $platform = 'Linux';
}
elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'Mac';
}
elseif (preg_match('/firefox/i', $u_agent)) {
    $platform = 'Firefox';
}
elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'Windows';
}
elseif (preg_match('/samsung/i', $u_agent)) {
    $platform = 'Samsung';
}
elseif (preg_match('/android/i', $u_agent)) {
    $platform = 'Android';
}

// Siguiente obtener el nombre del agente de usuario por separado.

if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
{
    $bname = 'Internet Explorer';
    $ub = "MSIE";
}
elseif(preg_match('/Firefox/i',$u_agent))
{
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
}
elseif(preg_match('/Chrome/i',$u_agent))
{
    $bname = 'Google Chrome';
    $ub = "Chrome";
}
elseif(preg_match('/Safari/i',$u_agent))
{
    $bname = 'Apple Safari';
    $ub = "Safari";
}
elseif(preg_match('/Opera/i',$u_agent))
{
    $bname = 'Opera';
    $ub = "Opera";
}
elseif(preg_match('/Netscape/i',$u_agent))
{
    $bname = 'Netscape';
    $ub = "Netscape";
}
elseif(preg_match('/Android/i',$u_agent))
{
    $bname = 'Andriod';
    $ub = "Andriod";
}
elseif(preg_match('/Samsung/i',$u_agent))
{
    $bname = 'Samsung';
    $ub = "Samsung";
}

// Finalmente obtener el número de versión correcto.
$known = array('Version', $ub, 'other');
$pattern = '#(?<browser>'.join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
if (!preg_match_all($pattern, $u_agent, $matches)) {
    // No tenemos el número correspondiente sólo seguir
}

// see how many we have
$i = count($matches['browser']);
if ($i != 1) {
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
        $version= $matches['version'][0];
    }
    else {
        $version= $matches['version'][1];
    }
}
else {
    $version= $matches['version'][0];
}

// check if we have a number
if ($version==null || $version=="") {$version="?";}

return array(
    'userAgent' => $u_agent,
    'name'      => $bname,
    'version'   => $version,
    'platform'  => $platform,
    'pattern'   => $pattern
);
}

//now try it
$ua = getBrowser();
$yourbrowser = $ua['name'] . " " . $ua['version'] . " on " .   $ua['platform'] . " " . $ua['userAgent']."";
// echo $yourbrowser;

require_once('conex.php'); 
mysqli_select_db($conex, $database_conex);
$fecha=date("Y-m-d h:i");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (is_null($_COOKIE["acceso"]) && is_null($_SESSION["user"])){
    $insertSQL = sprintf("INSERT INTO ACCESOS (DIRACC,FECACC,BROACC) VALUES ( '$ip', '$fecha', 
    '$yourbrowser')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));

}


// echo $_COOKIE["acceso"];
?>
