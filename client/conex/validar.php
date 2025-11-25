<script src = "../js/control.js"></script>
<?php
require_once("conex.php");
include("acceso.php");


mysqli_select_db($conex, $database_conex);
	if(isset($_POST['enviar'])){
		$usuario = $_POST['user'];
		$pw = $_POST['pw'];
		$log = mysqli_query($conex,"SELECT IDEPER,NOMEMP,APPEMP,APMEMP,PRISES,FOTEMP,NOMCAR,ORGCAR FROM EMP,PER,CAR,SES WHERE IDEPER=IDESES && EMPPER=IDEEMP && EMAEMP='$usuario' && PASSES='$pw' && CARPER=IDECAR ") or die(mysqli_error($conex));

	    $row = mysqli_fetch_assoc($log);
		if (mysqli_num_rows($log)>0) {
			$contador=0;
			do { 
			
				if($contador>0){ 
				$_SESSION["user".$contador] = $row['IDEPER'];  
				$_SESSION["nivel".$contador] =$row['PRISES'];
			    $_SESSION["cargo".$contador] =$row['NOMCAR'];
			    $_SESSION["org".$contador] = $row['ORGCAR'];
			}else{
			$_SESSION["user"] = $row['IDEPER'];
            $user=$_SESSION["user"];
            $_SESSION["nivel"] =$row['PRISES'];
            $_SESSION["org"] = $row['ORGCAR'];
            $_SESSION["cargo"] =$row['NOMCAR'];
			$_SESSION["nombre"] = $row['NOMEMP'].' '.$row['APPEMP'].' '.$row['APMEMP'];
			$_SESSION["foto"]=$row['FOTEMP'];
			}
            $contador++;
        } while ($row = mysqli_fetch_assoc($log)); 

            $insertSQL = sprintf("INSERT INTO ACCESOS (DIRACC,FECACC,BROACC,USEACC) VALUES ( '$ip', '$fecha', '$yourbrowser',$user)");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));


			if ($_SESSION["nivel"]<=4){
			
		  	header("Location: ../" );
		 require_once("../ajustes/visual/conex/conex.php");
		 mysqli_select_db($conex, $database_conex);
		$log2 = mysqli_query($conex,"SELECT tip_asp,img_asp FROM asp WHERE ide_usu=$user") or die(mysqli_error($conex));

		if (mysqli_num_rows($log2)>0) { $row2 = mysqli_fetch_array($log2);
		  $_SESSION["theme"] = $row2['tip_asp'];
          $_SESSION["fondo"] = $row2['img_asp'];
		}else{
          $_SESSION["theme"]=1;
          $_SESSION["fondo"]="img/fondo.jpg";
		}

		}	
		} 
		else{

			header("Location: ../index.php?USU=X" );
			
			
		}
	}
?>