                       <?php
require_once("../conex/conex.php"); 
mysqli_select_db($conex, $database_conex);
$coo=$_REQUEST['area'];
                        $query_emp = "SELECT APPEMP,APMEMP,NOMEMP,EMPPER FROM PER,EMP,CAR WHERE EMPPER=IDEEMP && CARPER=IDECAR && COOCAR='$coo' && FECFIN IS NULL  ORDER BY NOMEMP";
                        $emp = mysqli_query($conex, $query_emp) or die(mysqli_error());
                        $row_emp = mysqli_fetch_assoc($emp);
                        $totalRows_emp = mysqli_num_rows($emp);
                        if ($totalRows_emp == 0) {?>
                             <option value="">No hay empleados disponibles</option>
                        <?php }
                        if ($totalRows_emp > 0) {
                        do { 
                        ?>
                        <option value="<?php echo ($row_emp['EMPPER']); ?>"><?php echo utf8_encode(($row_emp['NOMEMP'].' '.$row_emp['APPEMP'].' '.$row_emp['APMEMP'])); ?></option>
                        <?php } while ($row_emp = mysqli_fetch_assoc($emp)); }?>
