
<script src = "js/tendencias.js"></script>

    <div class="ven_modal_2">
    <div class="cerrar"><a href="javascript:cerrarventana('.ventana_2');">x</a></div>
    <h2>Agregar a tendencia seleccionando</h2>
    <hr>
    <?php
    //LEFT JOIN COPIA ON IDERIE=RIECOP WHERE RIECOP IS NULL
    $query_rep = "SELECT IDERIE,CESPRIE FROM RIE LEFT JOIN INC ON IDERIE=RIEINC WHERE RIEINC IS NULL";
    //$query_rep = "SELECT IDEREP,CONREP,FECEVE,FECREP,FREREP,OBSREP,NOMLUG,TIPFAC,TIPCAU FROM REP,LUG,CAU,FAC WHERE LUGREP=IDELUG && CAUREP=IDECAU && FACCAU=IDEFAC";
    $rep = mysqli_query($conex, $query_rep) or die(mysqli_error($conex));
    $row_rep = mysqli_fetch_assoc($rep);
    $totalRows_rep = mysqli_num_rows($rep);
    if ($totalRows_rep == 0) { ?>
    <h2 align="center">No hay componentes para agregar</h2>
    <?php }?>
    <?php if ($totalRows_rep > 0) {  ?>
    <form name="enviar" id="enviar" method="post" action="query/consulta.php" >
        <div class="tabla reportes">
            <div style='width:700px;height:200px;overflow-y: scroll;'>
        <table id="tabla_rep" > 
            <thead><tr>
                <th width="350px">Componente específico del peligro</th>
                <th width="25px" ></th>
            </tr><tr></tr></thead>
    <?php 
    do{ 
        $idrie=$row_rep['IDERIE'];
        $cesrie=$row_rep['CESPRIE'];
    ?>
    <tbody>
            <tr>
                <td><?php echo ($cesrie); ?></td>
                <td><input type="checkbox" name="checkbox[]" id="checkbox" value="<?=$idrie?>"/></td>
            </tr>
<?php } while ($row_rep = mysqli_fetch_assoc($rep)); ?>
</tbody>
        </table>
    </div>
</div>
    <?php } ?>
    <br>
        <label>Nombre del componente: </label><input type="text" name="nombre_ten" id="nombre_ten">
        <input type="hidden" id="cuenta" name="cuenta" value="0">
        <input  type="submit" name="enviar" id="enviar"  value="Guardar" class="boton">
    </form>

</div>




