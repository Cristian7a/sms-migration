                       <?php
require_once("../../../conex/conex.php"); 
mysqli_select_db($conex, $database_conex);
$ext=$_REQUEST['pue_emp'];
                        $query_emp = "SELECT APPEMP,APMEMP,NOMEMP,EMPPER,EXTEMP FROM PER,EMP,CAR,COO WHERE EMPPER=IDEEMP && CARPER='$ext' && COOCAR=IDECOO;";
                        $emp = mysqli_query($conex, $query_emp) or die(mysqli_error());
                        $row_emp = mysqli_fetch_assoc($emp);
                        $totalRows_emp = mysqli_num_rows($emp);
                        if ($totalRows_emp == 0) {?>
                             <option value="">No hay puestos disponibles</option>
                        <?php }
                        if ($totalRows_emp > 0) {
                        do { 
                        ?>
                        <option value="<?php echo ($row_emp['IDEEMP']); ?>"><?php echo utf8_encode($row_emp['EXTEMP']); ?></option>
                        <?php } while ($row_emp = mysqli_fetch_assoc($emp)); }?>