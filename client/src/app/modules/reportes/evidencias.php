<?php 
session_start();
if (isset($_SESSION["user"]) && $_SESSION["nivel"] <= 2){ 
    $user = $_SESSION['user'];
    // Solo necesitamos el ID para pasarlo a JS
    $iderep = $_GET['IDEREP']; 
?>
<html>
<header>
    <?php include("header.html"); ?>
    <script src="../../scripts/jquery-3.3.1.min.js"></script>
    
    <script src="../../../../public/assets/js/api/config.js"></script>
    <script src="../../../../public/assets/js/api/reportes.service.js"></script>

    <script src="js/evidencias.js"></script> 
    
    <link href="css/plantilla.css" rel="stylesheet" type="text/css">
</header>

<body style="background-color:#eee;">
    
    <input type="hidden" id="IDEREP_GLOBAL" value="<?php echo $iderep; ?>">

    <div style="height:92%;overflow-y: scroll; margin:1em;margin-left:2.5em;">
        
        <div class="f2"> 
            <h1>Reporte (Escaneo del reporte físico)</h1>
            <br>
            
            <div id="lista-reporte-fisico" style="display:flex; flex-wrap:wrap; gap:10px;"></div>
            
            <h3 id="mensaje-sin-scan" style="display:none;">No existen scans</h3>
            <br>

            <form class="form-upload">
                <input type="hidden" name="nom" value="REPORTE">
                <input type="hidden" name="tip" value="FISICA">
                
                <table>
                    <tr>
                        <td><input type="file" name="archivo" accept="application/pdf, image/*"></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="buttons">
                                <input type="submit" class="boton" value="Subir Scan">
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            <div style="margin-top:1em;"><b>Nota:</b> Máx 10MB, PDF o Imagen.</div>
        </div>

        <div class="f2" style="margin-top: 20px;"> 
            <h1>Evidencias adicionales</h1>
            <br>
            
            <div id="lista-adicionales" style="display:flex; flex-wrap:wrap; gap:10px;"></div>
            <br>

            <form class="form-upload">
                <input type="hidden" name="nom" value="ADICIONAL">
                
                <table>
                    <tr>
                        <td>
                            <b>Tipo: </b>
                            <select name="tip" style="width:100px" required>
                                <option value="" disabled selected>--ELEGIR--</option>
                                <option value="FISICA">FISICA</option>
                                <option value="TESTIMONIAL">TESTIMONIAL</option>
                                <option value="DOCUMENTAL">DOCUMENTAL</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="file" name="archivo" accept="application/pdf, .jpg, .png" required></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="buttons">
                                <input type="submit" class="boton" value="Subir Evidencia">
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </div>
</body>
</html>

<?php 
} else {
    session_destroy();
    header("Location: ../" );
}
?>