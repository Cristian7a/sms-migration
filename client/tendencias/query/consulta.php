<?php
require_once("../../conex/conex.php");
mysqli_select_db($conex, $database_conex);


    	//$conta = ($_POST["cuenta"]);
    	$peli = mb_strtoupper($_POST["nombre_ten"]);
    	$todos=($_POST["checkbox"]);
		$insertSQL = sprintf("INSERT INTO TEN (NOMTEN,INCTEN) VALUES ('$peli',0)");
		$Result1=mysqli_query($conex, $insertSQL) or die (mysqli_error($conex));
		
        $consultaTEN = sprintf("SELECT IDETEN FROM TEN order by IDETEN DESC limit 1");
		$conTen=mysqli_query($conex, $consultaTEN) or die (mysqli_error($conex));
		$row_ideten = mysqli_fetch_assoc($conTen);
        $ideten=$row_ideten['IDETEN'];
        

		if ( !empty($_POST["checkbox"]) && is_array($_POST["checkbox"]) ) {
    		echo "<ul>";
			foreach ( $_POST["checkbox"] as $como ) {
				$insertCOPIA = sprintf("INSERT INTO INC (RIEINC,TENINC) VALUES('$como','$ideten')");
				$Result2=mysqli_query($conex, $insertCOPIA) or die (mysqli_error($conex));
				echo "<li>";
				echo $como;
				echo "</li>";
			}
			echo "</ul>";
		}
        $con_num = sprintf("SELECT RIEINC FROM INC WHERE TENINC=$ideten");
		$con_num_reg=mysqli_query($conex, $con_num) or die (mysqli_error($conex));
		$totalRows = mysqli_num_rows($con_num_reg);

        $update = sprintf("UPDATE `TEN` SET `INCTEN`='$totalRows' WHERE IDETEN=$ideten");
		$resu=mysqli_query($conex, $update) or die (mysqli_error($conex));



		header("Location:../");
?>
