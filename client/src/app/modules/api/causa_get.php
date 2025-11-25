<?php
require_once("../conex/conex.php"); 
mysqli_select_db($conex, $database_conex);
$idefac=intval($_REQUEST['tipfac']);
                        $query_cau = "SELECT IDECAU,TIPCAU FROM CAU WHERE FACCAU='$idefac'";
                        $cau = mysqli_query($conex, $query_cau) or die(mysqli_error());
                        $row_cau = mysqli_fetch_assoc($cau);
                        $totalRows_cau = mysqli_num_rows($cau);
                        if ($totalRows_cau == 0) {?>
                             <option value="">Es necesario agregar una causa</option>
                        <?php }
                        if ($totalRows_cau > 0) {
                        do { 
                        ?>
                        <option value="<?php echo ($row_cau['IDECAU']); ?>"><?php echo utf8_encode($row_cau['TIPCAU']); ?></option>
                        <?php } while ($row_cau = mysqli_fetch_assoc($cau)); }?>
                    
