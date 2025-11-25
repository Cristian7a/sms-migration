<?php 
session_start();
if (isset($_SESSION["user"])){ 
    if ($_SESSION["nivel"]<=2){ 
$user=$_SESSION['user'];
require_once("../../conex/conex.php");
mysqli_select_db($conex, $database_conex);

?>
<!doctype html>
<html class="no-js" lang="">
    <head>

     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Grafica tendencias</title>
        <link rel="shortcut icon" href="../../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel='stylesheet' id='plantilla'  href='../css/plantilla.css' type='text/css' media='all' />
        <script type="text/javascript">
            window.onload = function () {
                var dataLength = 0;
                var data = [];
                var chart = new CanvasJS.Chart("chart", {
                    title: {
                        text: "TENDENCIA"
                    },
                    axisX: {
                        title: "COMPONENTES ESPECIFICOS DEL PELIGRO",
                        labelFontSize:11,
                    },
                    axisY: {
                        title: "INCIDENCIA",
                    },
                    data: [{type: "column", dataPoints: data}],
                });
                

                function createPareto(){
                    var dps = [];
                    var yTotal = 0, yPercent = 0;
                    var yValue = 0.00;
                    

                    for(var i = 0; i < chart.data[0].dataPoints.length; i++){
                        yValue = ((1.7751)*((Math.E)*(Math.pow(0.0436,chart.data[0].dataPoints[i].x))));
                        yPercent += (yValue / yTotal * 25);
                        dps.push({label: chart.data[0].dataPoints[i].label, y: yValue});
                    }
    
                    chart.addTo("data",{type:"line", yValueFormatString: "0.##", dataPoints: dps});
                }

                $.getJSON("data.php", function (result) {
                    dataLength = result.length;
                    for (var i = 0; i < dataLength; i++) {
                        data.push({
                            label: (result[i].valorp),
                            y: parseInt(result[i].valory)
                        });
                        chart.render();
                        
                       // createPareto();
                    }
                });
            }
        </script>
        <script type="text/javascript" src="js/canvasjs.min.js"></script>
        <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
    </head>
    
    <?php  $theme = $_SESSION['theme'] ?? 0;
      if($theme==1){
      include("menu_grafica.html");  
} else {
     include("../menus_2/menu_grafica.html"); }
    ?>  

    <body style="background-color:#eee;">
        <div class="tendencias" style="margin:50px;">
        <div id="chart" ></div>
        <?php
        $query = "SELECT * FROM TEN order by INCTEN DESC limit 10";
        $res = mysqli_query($conex, $query) or die(mysqli_error($conex));
        $row_res = mysqli_fetch_assoc($res);
        $totalRows_res = mysqli_num_rows($res);
        if ($totalRows_res == 0) { ?>
        <h2 align="center">NO HAY DATOS QUE GRAFICAR</h2>
        <?php }?>
        </div>
    </body>
</html>

<?php 
 }else{
    session_destroy();
    header("Location: ../" );
 }
}else{ 
    header("Location: ../" );}
 ?>
