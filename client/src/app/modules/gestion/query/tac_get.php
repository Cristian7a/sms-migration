                       <?php
require_once("../../conex/conex.php"); 
mysqli_select_db($conex, $database_conex);
$top=$_REQUEST['top'];
                        $query_tac = "SELECT IDETAC,DESTAC FROM TAC WHERE TACTOP=$top ";
                        $tac = mysqli_query($conex, $query_tac) or die(mysqli_error());
                        $row_tac = mysqli_fetch_assoc($tac);
                        $totalRows_tac = mysqli_num_rows($tac);
                        if ($totalRows_tac == 0) {?>
                             <option value="">No hay tipos de actividades disponibles</option>
                        <?php }
                        if ($totalRows_tac > 0) {
                        do { 
                        ?>
                        <option value="<?php echo ($row_tac['IDETAC']); ?>"><?php echo utf8_encode($row_tac['DESTAC']); ?></option>
                        <?php } while ($row_tac = mysqli_fetch_assoc($tac)); }?>