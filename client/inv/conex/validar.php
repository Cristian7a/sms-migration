<?php
require_once("conex.php");

mysqli_select_db($conex, $database_conex);
	if(isset($_POST['enviar'])){
		$usuario = $_POST['user'];
		$pw = $_POST['pw'];
		$log = mysqli_query($conex,"SELECT IDEEMCO,NOMEMP,APPEMP,APMEMP FROM EMP,EMCO,PUE WHERE EMPEMCO=IDEEMP && EMAEMP='$usuario' && PASEMP='$pw' && PUEEMCO=IDEPUE && IDEPUE<18") or die(mysqli_error($conex));
		if (mysqli_num_rows($log)>0) {
			$row = mysqli_fetch_array($log);
			session_start();
            $_SESSION["user"] = $row['IDEEMCO'];
            $_SESSION["nivel"] =3;
			$_SESSION["nombre"] = $row['NOMEMP'].' '.$row['APPEMP'].' '.$row['APMEMP']; 

		  	
		  	header("Location: ../" );
			
		}
		else{

			header("Location: ../index.php?USU=X" );
			
			
		}
	}
?>