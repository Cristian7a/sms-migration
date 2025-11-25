                       <?php
require_once("../../conex/conex.php"); 
mysqli_select_db($conex, $database_conex);
$tac=$_REQUEST['tac'];
                        $query_tac = "SELECT IDEEJM,DESEJM FROM EJM WHERE EJMTAC=$tac ";
                        $tac = mysqli_query($conex, $query_tac) or die(mysqli_error());
                        $row_tac = mysqli_fetch_assoc($tac);
                        $totalRows_tac = mysqli_num_rows($tac);
                        if ($totalRows_tac == 0) {?>
                             <option value="">No hay ejemplos disponibles</option>
                        <?php }
                        if ($totalRows_tac > 0) {
                        do { 
                        ?>
                        <option value="<?php echo utf8_encode($row_tac['DESEJM']); ?>"><?php echo utf8_encode($row_tac['DESEJM']); ?></option>
                        <?php } while ($row_tac = mysqli_fetch_assoc($tac)); }?>