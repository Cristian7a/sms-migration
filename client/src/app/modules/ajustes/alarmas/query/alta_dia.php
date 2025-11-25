<?php require_once('../../../conex/conex.php'); 
mysqli_select_db($conex, $database_conex);


$per = $_POST["per"];
$fecini = $_POST["fecini"];
$fecfin = $_POST["fecfin"];
$fecha=date('y-m-d');
$exa=$_POST["exa"];


$query= "SELECT IDEDIA FROM DIA ORDER BY IDEDIA DESC LIMIT 1 ";
$con = mysqli_query($conex, $query) or die(mysqli_error($conex));
$row = mysqli_fetch_assoc($con);
$totalRows = mysqli_num_rows($con);
 if ($totalRows == 0) { 
$idedia=1;
 } else{
$idedia=$row['IDEDIA']+1;
 }

$insertSQL = sprintf("INSERT INTO DIA (IDEDIA,FECDIA,FECINI,FECFIN,PER_DIA) VALUES ($idedia,'$fecha', '$fecini', '$fecfin', '$per')");
$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
//header("Location:../preguntas.php?IDEEXA=$ideexa");

if($per=="POBLACIÓN EN GENERAL"){
	$query_per= "SELECT IDEPER FROM PER,CAR WHERE IDECAR=CARPER ORDER BY IDEPER";
}else {
	$query_per= "SELECT IDEPER FROM PER,CAR WHERE IDECAR=CARPER && ORGCAR='$per' ORDER BY IDEPER";
}

$con_per = mysqli_query($conex, $query_per) or die(mysqli_error($conex));
$row_per = mysqli_fetch_assoc($con_per);
$totalRows_per = mysqli_num_rows($con_per);
 if ($totalRows_per == 0) { 

 } else {
 	do {  
        $ideper=$row_per['IDEPER'];

	 	$query_val= "SELECT IDEVAL FROM VAL ORDER BY IDEVAL DESC LIMIT 1 ";
		$con_val = mysqli_query($conex, $query_val) or die(mysqli_error($conex));
		$row_val = mysqli_fetch_assoc($con_val);
		$totalRows_val = mysqli_num_rows($con_val);
 		if ($totalRows_val == 0) { 
		$ideval=1;
 		} else{
		$ideval=$row_val['IDEVAL']+1;
 		} 

 		//SE INSERTAN LOS REGISTROS EN VALORACIÓN

         
         $insert_per = sprintf("INSERT INTO VAL (IDEVAL,PERVAL,DIAVAL) VALUES ($ideval,$ideper,$idedia)");
         $Result2=mysqli_query($conex, $insert_per) or die (mysqli_error($conex));
         
         //SE CONSULTAN LAS PREGUNTAS DENTRO DEL EXÁMEN
         
         $query_pre= "SELECT IDEPRE FROM EXA,PRE WHERE IDEEXA=EXAPRE && IDEEXA=$exa ORDER BY IDEPRE ";
		$con_pre = mysqli_query($conex, $query_pre) or die(mysqli_error($conex));
		$row_pre = mysqli_fetch_assoc($con_pre);
		$totalRows_pre = mysqli_num_rows($con_pre);

 		if ($totalRows_pre == 0) { 
         echo "no deberia comenzar a insertar";

 		} else {

 		echo "deberia comenzar a insertar";
 			do { 

 				//SE INSERTAN LOS REGISTROS PARA LOS ACIERTOS
         $idepre=$row_pre['IDEPRE'];
         $insert_pre = sprintf("INSERT INTO CAL (VALCAL,PRECAL) VALUES ($ideval,$idepre)");
         $Result3=mysqli_query($conex, $insert_pre) or die (mysqli_error($conex));
         echo "cal insertado";

 		 } while ($row_pre = mysqli_fetch_assoc($con_pre));
 }

 		 } while ($row_per = mysqli_fetch_assoc($con_per));
 }





?>