<?php 
session_start();
if (isset($_SESSION["user"])){
    if ($_SESSION["nivel"]<=2){ 
$user=$_SESSION['user'];
$monpro=$_GET['monpro'];?>

<html>
<head>
    
     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Monitoreo de las medidas de mitigación</title>
        <link rel="shortcut icon" href="../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <script src = "../js/jquery-3.3.1.min.js"></script> 
    <script src = "../js/control_mon.js"></script> 
  
    <script src = "js/jquery.validate.min.js"></script>
    <script src = "js/validar_eva.js"></script>
    <link rel='stylesheet' id='plantilla'  href='css/plantilla_mon.css' type='text/css' media='all' />
    <script type="text/javascript" language="javascript" src="../TableFilter-master\dist\tablefilter/tablefilter.js"></script> 
</head>

<?php  $theme=$_SESSION['theme'];
      if($theme==1){
      include("menu_historial.html");  
} else {
     include("menus_2/menu_historial.html"); }
    ?>   

    <body style="background-color:#eee;">
     <div  style="height:88%;overflow-y: scroll;">
      
      <div>

<?php require_once("../conex/conex.php");
mysqli_select_db($conex, $database_conex);?>


       
                    
        <div class="reportes">
           

        <table id="table_mon" > 
            <thead><tr>
                <th></th>
                <th></th>
                <th bgcolor="#16365C" >CICLO DEMING PHVA</th>
                <th></th>
                <th></th>
                <th bgcolor="#16365C" >CICLO DEMING PHVA</th>
                <th bgcolor="#16365C" >CICLO DEMING PHVA</th>
                <th bgcolor="#16365C" >CICLO DEMING</th>



                
            </tr>
            <tr>
             <th bgcolor="#16365C" rowspan="2">CAUSAS QUE PROVOCARON ESTE BAJO RENDIMIENTO</th>
             <th bgcolor="#16365C" rowspan="2">OBJETIVO A ALCANZAR</th>
              <th bgcolor="#16365C">PLANIFICAR</th>
              <th bgcolor="#16365C" rowspan="2">FECHA DE INICIO</th>
              <th bgcolor="#16365C" rowspan="2">FECHA DE ENTREGA</th>
              <th bgcolor="#16365C" >VERIFICAR</th>
               <th bgcolor="#16365C" >¿SE LOGRO EL OBJETIVO DESEADO? SI/NO</th>
               <th bgcolor="#16365C" >ACTUAR CON BASE A LOS RESULTADOS / ACTUAR EN CONSECUENCIA A LOS RESULTADOS </th>
            </tr>
        </thead>

<tbody>
            

                <?php
                $query = "SELECT * FROM CIC WHERE MONCIC=$monpro ORDER by IDECIC ASC";
                $cic = mysqli_query($conex, $query) or die(mysqli_error($conex));
                $row_cic = mysqli_fetch_assoc($cic);
                $totalRows_cic = mysqli_num_rows($cic);
                if ($totalRows_cic == 0) { ?>
                    <tr>

               <td align="center">SIN CAUSAS</td>
                <td align="center">NO HAY OBJETIVO A ALCANZAR</td>
                <td align="center">NO HA SIDO PLANIFICADO</td>
                <td align="center" >NO HAY FECHA DE INICIO</td>
                <td align="center" >NO HAY FECHA DE ENTREGA</td>
                <td align="center" >SIN RESPONSABLE</td>
                <td>NO HA SIDO VERIFICADO</td>
                <td>NO HA SIDO VERIFICADO</td>
                <td>SIN ACCIONES</td>
            </tr>

                <?php }else { 
                do{

                $caucic=$row_cic['CAUCIC'];
                $objcic=$row_cic['OBJCIC'];
                $placic=$row_cic['PLACIC'];
                $fecini=$row_cic['FECINI'];
                $fecent=$row_cic['FECENT'];
                $vercic=$row_cic['VERCIC'];
                $logcic=$row_cic['LOGCIC'];
                $actcic=$row_cic['ACTCIC']; 

                ?>
                <tr>
        
                <td align="center"><?php if($caucic==''){echo 'SIN CAUSAS';}else{ echo $caucic;} ?></td>

                <td align="center"><?php if($objcic==''){echo 'SIN OBJETIVO';}else{ echo $objcic;} ?></td>

                <td align="center"><?php if($placic==''){echo 'SIN PLANIFICAR';}else{ echo $placic;} ?></td>

                <td align="center" ><?php if($fecini==''){echo 'SIN FECHA DE INICIO';}else{ 
                    echo $fecini=date("d-m-Y",strtotime($fecini));} ?></td>

                <td align="center" ><?php if($fecent==''){echo 'SIN FECHA DE ENTREGA';}else{ 
                    echo $fecent=date("d-m-Y",strtotime($fecent));} ?></td>
                
                
                <td align="center"><?php if($vercic==''){echo 'SIN VERIFICAR';}else{ echo $vercic;} ?></td>

                <td align="center"><?php if($logcic==''){echo 'SIN VERIFICAR';}else{ echo $logcic;} ?></td>
                
                <td align="center"><?php if($actcic==''){echo 'SIN ACCIONES';}else{ echo $actcic;} ?></td>

                 </tr>

               <?php } while ($row_cic = mysqli_fetch_assoc($cic)); }?>

                
    
    
</tbody>
        </table>
        
    </div>
       

            
            
    

      </div>
      </div>
    </body>

<script type="text/javascript"> 
filtro_mon();
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
    