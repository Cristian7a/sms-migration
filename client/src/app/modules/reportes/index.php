<?php session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]<=2){ 
     $user=$_SESSION['user'];
     require_once("../../config/conex.php");
     mysqli_select_db($conex, $database_conex);?>

<html>

<header>
    <?php include("header.html"); ?>
    
    <script type="text/javascript" language="javascript" src="../TableFilter-master/dist/tablefilter/tablefilter.js"></script> 
    <script src="../../scripts/jquery-3.3.1.min.js"></script>
    
    <script src="../../scripts/control.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/validar_lug.js"></script>

    <script src="../../../../public/assets/js/api/config.js"></script>
    <script src="../../../../public/assets/js/api/reportes.service.js"></script>

    <script src="js/validar_rep.js?v=2"></script>

</header>

<?php
$theme = $_SESSION['theme'] ?? 0; 
      if($theme==1){
        if($_SESSION["nivel"]==2){
         include("menus_directivo/menu_rep.html");
        }else{
            include("menu_rep.html");
        }
} else {
     include("menu_rep_2.html"); 
}
?>

<body style="background-color:#eee;">
  <div class="reporte">

    <?php include("ventanas_modales/n_rep.html"); 
          include("ventanas_modales/e_rep.html"); 
          include("ventanas_modales/n_lugar.html");
          include("ventanas_modales/ayuda.html");?>

    <?php
    //Consulta todos los reportes
    $query_rep1="SELECT IDEREP,CONREP,FECEVE,FECREP,FREREP,OBSREP,NOMLUG,CANREP,NOMEMP,APPEMP,APMEMP FROM REP,LUG,PER,EMP WHERE LUGREP=IDELUG AND PERREP=IDEPER AND EMPPER=IDEEMP ORDER BY IDEREP";
    

    $rep = mysqli_query($conex, $query_rep1) or die(mysqli_error($conex));
    $row_rep = mysqli_fetch_assoc($rep);
    $totalRows_rep = mysqli_num_rows($rep);

    if ($totalRows_rep == 0) { ?>
        <BR>
        <h2 align="center">No hay nuevos reportes por gestionar</h2>
    <?php } ?>

    <?php if ($totalRows_rep > 0) { ?>     
        <div class="tabla reportes">
            <div style="height:92%; overflow-y: scroll;">
                <table id="tabla_rep"> 
                    <thead>
                        <tr>
                            <th>MES</th>
                            <th>N°</th>
                            <th>FECHA DEL REPORTE</th>
                            <th>FECHA DEL SUCESO</th>
                            <th style="color:#fff000">LUGAR DEL SUCESO</th>
                            <th style="color:#fff000">FRECUENCIA</th>
                            <th>OBSERVACIONES</th>
                            <th>REPORTANTE</th>
                            <?php if($_SESSION["nivel"]<2){ ?>
                            <th>EVIDENCIA</th> 
                            <th>EDITAR</th> 
                            <th>GESTIÓN</th> 
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    do { 
                        $iderep=$row_rep['IDEREP'];
                        $fecrep=$row_rep['FECREP'];
                        $feceve=$row_rep['FECEVE'];
                        
                        // Formateo de fechas
                        $fecrep_f = date("d-m-Y", strtotime($fecrep));
                        $feceve_f = date("d-m-Y", strtotime($feceve));
                        
                        // Obtener nombre del mes
                        $mes = strftime("%B", strtotime($fecrep));
                        $mes = mb_strtoupper($mes);
                        
                        // Verificar si el reporte ha sido cancelado
                        $canrep=$row_rep['CANREP'];
                        $style_row = ($canrep == 1) ? 'style="color:red"' : '';
                    ?>
                        <tr <?php echo $style_row; ?>>
                            <td style="color:#fff; background-color:#2672EC"><?php echo utf8_encode($mes); ?></td>
                            <td align="center"><?php echo utf8_encode($iderep); ?></td>
                            <td align="center"><?php echo $fecrep_f; ?></td>
                            <td align="center"><?php echo $feceve_f; ?></td>
                            <td align="center"><?php echo $row_rep['NOMLUG']; ?></td>
                            <td align="center"><?php echo $row_rep['FREREP']; ?></td>
                            <td align="center"><?php echo $row_rep['OBSREP']; ?></td>
                            <td align="center"><?php echo mb_strtoupper(utf8_encode($row_rep['NOMEMP']." ".$row_rep['APPEMP']." ".$row_rep['APMEMP'])); ?></td>
                            
                            <?php if($_SESSION["nivel"]<2){ ?>
                            <td align="center">
                                <?php 
                                $query_repevi = "SELECT IDEEVI FROM EVI WHERE REPEVI=$iderep";
                                $repevi = mysqli_query($conex, $query_repevi) or die(mysqli_error($conex));
                                $totalRows_repevi = mysqli_num_rows($repevi);
                                
                                if ($totalRows_repevi > 0) { ?>
                                    <a href="evidencias.php?IDEREP=<?php echo $iderep;?>"><IMG height="20px" SRC="../../../../public/assets/images/evidencia.png"></a>
                                <?php } else { ?>
                                    <a href="evidencias.php?IDEREP=<?php echo $iderep;?>"><IMG height="20px" SRC="../../../../public/assets/images/folder_vacio.png"></a>
                                <?php } ?> 
                            </td>

                            <td align="center">
                                <a href="javascript:openventana_var('.ventana_2',<?php echo $iderep; ?>,'IDREP',1);">
                                    <IMG height="20px" SRC="../../../../public/assets/images/edit.png"> </a>
                            </td>

                            <?php 
                            $query_gestion = "SELECT REPPEL FROM PEL WHERE REPPEL=$iderep";
                            $gestion = mysqli_query($conex, $query_gestion) or die(mysqli_error($conex));
                            $totalRows_gestion = mysqli_num_rows($gestion);
                            
                            if ($totalRows_gestion == 0) { ?>
                                <td align="center">
                                    <a href="../gestion/ver_gestion.php?IDEREP=<?php echo $iderep;?>">
                                        <IMG height="20px" SRC="../../../../public/assets/images/sin_gestion.png" title="Sin gestionar">
                                    </a>
                                </td> 
                            <?php } else { ?>
                                <td align="center">
                                    <a href="../gestion/ver_gestion.php?IDEREP=<?php echo $iderep;?>">
                                        <IMG height="20px" SRC="../../../../public/assets/images/gestion.png" title="En gestión">
                                    </a>
                                </td>    
                            <?php } 
                            } // Fin if nivel < 2
                            ?> 
                        </tr>
                    <?php } while ($row_rep = mysqli_fetch_assoc($rep)); ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>

  </div>
</body>

<script type="text/javascript">
    filtro_rep();
</script>

</html>

<?php 
    } else {
        session_destroy();
        header("Location: ../../../" );
    }
} else { 
    header("Location: ../../../" );
}
?>