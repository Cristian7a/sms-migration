                       <?php
require_once("../../../conex/conex.php"); 
mysqli_select_db($conex, $database_conex);
$coo=$_REQUEST['area'];
                        $query_emp = "SELECT DISTINCT NOMCAR,COOCAR,IDECAR FROM CAR,COO WHERE COOCAR='$coo' ORDER BY NOMCAR";
                        $emp = mysqli_query($conex, $query_emp) or die(mysqli_error());
                        $row_emp = mysqli_fetch_assoc($emp);
                        $totalRows_emp = mysqli_num_rows($emp);
                        if ($totalRows_emp == 0) {?>
                             <option value="">No hay puestos disponibles</option>
                        <?php }
                        if ($totalRows_emp > 0) {
                        do { 
                        ?>
                        <option value="<?php echo ($row_emp['IDECAR']); ?>"><?php echo utf8_encode($row_emp['NOMCAR']); ?></option>
                        <?php } while ($row_emp = mysqli_fetch_assoc($emp)); }?>