<?php
require_once("../../conex/conex.php");
mysqli_select_db($conex, $database_conex);


    	$todos=($_POST["checkbox"]);
        $ideten=($_POST["IDETEN"]);
        

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



		header("Location:../tendencia.php?ten=$ideten");
?>