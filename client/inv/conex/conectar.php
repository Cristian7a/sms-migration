<?php
function Conectar(){
	$conexion= null;
	$host='localhost';
	$db='sms';
	$user='sms';
	$pwd='smseio2018';
	try{
		$conexion=new 
		PDO('mysql:host='.$host.';dbname='.$db,$user,$pwd);
		
	}catch(PDOException $e){
		echo "No se puede conectar";
		exit;
	}
	return $conexion;
}

?>
