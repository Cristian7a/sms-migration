<?php 
session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]<=2){ 
     $user=$_SESSION['user'];
     require_once("../../conex/conex.php");
     mysqli_select_db($conex, $database_conex);
?>

<html>
<head>
     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Empleados</title>
        <link rel="shortcut icon" href="../../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<link rel='stylesheet' id='plantilla'  href='css/plantilla.css' type='text/css' media='all' />
<script src = "js/jquery-3.3.1.min.js"></script>
<script src = "js/control.js"></script>
<script src = "js/jquery.validate.min.js"></script>
<script src = "js/validar_emp.js"></script>
<script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 

<?php
$theme = $_SESSION['theme'] ?? 0;
      if($theme==1){
      include("menu_index.html");  
} else {
     include("menu_emp_2.html"); }
    ?>



    <body style="background-color:#eee;">
<div class="ventana">
<?php include("n_emp.html"); ?>
</div>
<div class="ventana_3"> 
    <?php include("e_emp.html"); ?>
</div>      
        
        

<?php
$query_rep = "SELECT IDEEMP,APPEMP,APMEMP,NOMEMP,EMAEMP,CELEMP,CEL2EMP,TELOFIEMP,TELOFI2EMP,EXTEMP,FOTEMP,EMPPER,CARPER,IDECAR,NOMCAR,COOCAR,IDECOO,NOMCOO,FECFIN FROM COO,CAR,EMP,PER WHERE IDEEMP=EMPPER && CARPER=IDECAR && COOCAR=IDECOO order by NOMCOO";
$rep = mysqli_query($conex, $query_rep) or die(mysqli_error($conex));
$row_rep = mysqli_fetch_assoc($rep);
$totalRows_rep = mysqli_num_rows($rep);
 if ($totalRows_rep == 0) { ?>
    <h2 align="center">No hay registros disponibles</h2>
    <?php }?>
    <?php if ($totalRows_rep > 0) {  ?>
       
                    
        <div class="tabla">
            <div  style="height:88%;overflow-y:scroll;width: 99%;">
        <table id="tabla_coor" > 
            <thead style="background:#AC193D;color: #fff;"><tr>
                <th>Departamento</th>
                <th>Puesto</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Nombre</th>
                <th>E-mail</th>
                <th>Celular</th>
                <th>Celular 2</th>
                <th>Teléfono de Oficina</th>
                <th>Teléfono de Oficina 2</th>
                <th>Extensión</th>
                <th>Foto</th>
                <th>Editar</th>
                <th></th>
            </tr></thead>
 <?php 
do { 
$ideemp=$row_rep['IDEEMP'];
$nomcoo=$row_rep['NOMCOO'];
$nomcar=$row_rep['NOMCAR'];
$appemp=$row_rep['APPEMP'];
$apmemp=$row_rep['APMEMP'];
$nomemp=$row_rep['NOMEMP'];
$emaemp=$row_rep['EMAEMP'];
$celemp=$row_rep['CELEMP'];
$cel2emp=$row_rep['CEL2EMP'];
$telemp=$row_rep['TELOFIEMP'];
$tel2emp=$row_rep['TELOFI2EMP'];
$extemp=$row_rep['EXTEMP'];
$fotemp=$row_rep['FOTEMP'];

?>

<tbody>
<?php	if( $row_rep['FECFIN']==null){ ?>
	<tr> 
<?php } else { ?>
    <tr style="color:red;">
<?php } ?>
            
                <td align="center"><?php echo utf8_encode($nomcoo); ?></td>
                <td align="center"><?php echo utf8_encode($nomcar); ?></td>
                <td align="center"><?php echo utf8_encode($appemp); ?></td>
                <td align="center"><?php echo utf8_encode($apmemp); ?></td>
                <td align="center"><?php echo utf8_encode($nomemp); ?></td>
                <td align="center"><?php echo utf8_encode($emaemp); ?></td>
                <td align="center"><?php echo utf8_encode($celemp); ?></td>
                <td align="center"><?php echo utf8_encode($cel2emp); ?></td>
                <td align="center"><?php echo utf8_encode($telemp); ?></td>
                <td align="center"><?php echo utf8_encode($tel2emp); ?></td>
                <td align="center"><?php echo utf8_encode($extemp); ?></td>
                <?php if($fotemp==null){ ?>
                 <td align="center">Sin foto</td>
                <?php }else { ?>
                 <td align="center"><img src="<?php echo '../../fotos/'.$fotemp; ?>" width="50px"></td>
                <?php } ?>
                
                
                <td><a href="javascript:openventana_var('.ventana_3',<?php echo $ideemp; ?>,'IDEEMP',5);"><IMG height="20px" SRC="../../imagenes/edit.png"></a></td> 
                <td align="center"><a href="query/baja_emp.php?ide=<?php echo $ideemp;?>"><IMG height="20px" title="Eliminar registro" SRC="../../imagenes/eliminar.png"></a></td>
            </tr>
<?php } while ($row_rep = mysqli_fetch_assoc($rep)); ?>
</tbody>
        </table>
       
    </div>
    </div>
<?php } ?>



      
    </body>
    <script type="text/javascript">
        cargar_coo("area");
        cargar_fac();
        filtro_coor();
    </script>
    </html>


    <?php 
 }else{
    session_destroy();
    header("Location: ../" );
 }
}else{ 
    header("Location: ../" );}
 ?>
    