function formato(texto){
	if (texto==null){
        return ('00/00/0000');
	}else{
		return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
	}
  
}
//-----------------------------------------------------------
/* control de boton toggle +/- con div que se oculta */
function boton_toggle(id_boton,id_div){
  $(document).ready(function(){ 
 
                          $('#'+id_boton).toggle( 

                              function(){ 
                                $('#'+id_div).slideUp();
                                 $(this).text('+ ');
                                 e.preventDefault();
                                }, // Separamos las dos funciones con una coma
                                function(){ 
                                 $('#'+id_div).slideDown();
                                 $(this).text('- ');
                                 e.preventDefault();
                                    });
                      });
}

/*control ventanas modales */
//las variable ventana se llena con campos (".ventana")
function openventana(ventana){
    $(ventana).slideDown("slow");
}
function cerrarventana(ventana){
    $(ventana).slideUp("fast");
}
//ABRIR VENTANA ENVIANDO VARIABLE PARA POST Y/O FUNCION
function openventana_var(ventana,x,iddestino,funcion){
   $(ventana).slideDown("slow");
   if(iddestino!=""){
      nuevo_id(iddestino,x);
   }
   switch(funcion) {
    case 1:
        cargar_editar_reporte(x);
        break;
    case 2:
        cargar_editar_propuesta(x);

        break;
    default:
} 


}


//----------------------------------------------------
//OBTENER PARAMETROS GET POR ID
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
//---------------------------------------------------
//CONTROL DE ALTA DE REGISTROS CON ID
function nuevo_id(id,valor){
    var doc= document.getElementById(id);
      doc.setAttribute('value',valor);
    }   


//.-----------------------------------------------------------------------------
//CARGAR REPORTES
function cargari_rep(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_rep.php?IDEREP="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var feceve= formato(array[i].FECEVE);
                var fecrep= formato(array[i].FECREP);
                out+="<tr><td width='200px'><b>Fecha del reporte:</b></td><td width='500px'>"+
                fecrep+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Fecha del suceso:</b>&nbsp;&nbsp;&nbsp;"+
                feceve+"</td></tr><tr><td><b>Lugar del suceso:</b></td><td>"+
                array[i].NOMLUG+"</td></tr><tr><td><b>Frecuencia:</b></td><td>"+
                array[i].FREREP+"</td></tr><tr><td><b>Descripción del evento:</b></td><td>"+
                array[i].OBSREP+"</td></tr>";
            }
            
           document.getElementById("dat").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

function cargari_rep2(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_rep.php?IDEREP="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var feceve= formato(array[i].FECEVE);
                var fecrep= formato(array[i].FECREP);
                out+="<tr><td><b>Fecha del reporte: </b><br>"+
                fecrep+"</td></tr><tr><td><b>Fecha del suceso: </b><br>"+
                feceve+"</td></tr><tr><td><b>Lugar del suceso: </b><br>"+
                array[i].NOMLUG+"</td></tr><tr><td><b>Frecuencia: </b><br>"+
                array[i].FREREP+"</td></tr><tr><td><b>Descripción del evento: </b><br><p id='des_eve'>"+
                array[i].OBSREP+"</p></td></tr>";
            }
            
           document.getElementById("dat_rep").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//FUNCION PARA CARGAR A EMPLEADO EN VER_GESTION
function cargarti_emp(idrep,confidencial){

    if (confidencial==0){
        var xmlhttp = new XMLHttpRequest();
    var url="query/coni_emp.php?IDEREP="+idrep;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                out+="<tr><td><b>Nombre:<br> </b>"+
                array[i].NOMEMP+" "+array[i].APPEMP+" "+array[i].APMEMP+"</td><td><b>Coordinación:<br> </b>"+
                array[i].NOMCAR+" / "+array[i].NOMCOO+"</td></tr>";
            }
            
           document.getElementById("dat_emp").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();

    }else{
        var out="Esta información es confidencial";
        document.getElementById("dat_emp").innerHTML=out;
    }
    
}
function cargarti_pel(idrep,idrie){

    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_pel.php?IDEREP="+idrep+"&IDERIE="+idrie;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                out+="<tr><td width='25%'><b>Peligro genérico: </b>"+
                array[i].GENPEL+"</td></tr></tr><td width='25%' ><b>Condición: </b>"+
                array[i].CONPEL+"</td></tr></tr><td width='25%'><b>Objeto: </b>"+
                array[i].OBJPEL+"</td></tr></tr><td width='25%'><b>Actividad: </b>"+
                array[i].ACTPEL+"</td></tr><tr><td><b>Componente especifico: </b>"+
                array[i].CESPRIE+"</td></tr></tr><td><b>Descripcion exacta: </b>"+
                array[i].DESRIE+"</td></tr></tr><td><b>Consecuencia: </b>"+
                array[i].CONRIE+"</td></tr><br>";
            }
            
           document.getElementById("dat_pel").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}


///-----------------------------------------------------------------
function filtro_inv(){
  var filtersConfig = {
  // instruct TableFilter location to import ressources from
  base_path: '../TableFilter-master/dist/tablefilter/',
  filters_row_index: 0,
  headers_row_index: 2,

  alternate_rows: true,
  rows_counter: true,
  btn_reset: true,
  loader: true,
  highlight_keywords: true,
  no_results_message: true,
  col_types: [
        'string', 'number', 'date',
        'date', 'string', 'string', 'string'
    ],

  col_0: 'select',
  col_4: 'select',
  col_5: 'select',
  col_6: 'select',
  col_7: 'select',
  col_8: 'none',
  watermark: ['', 'No.', 'Fecha', 'Fecha', '' ],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_ges', filtersConfig,2);
tf.init();
}


/////////////////////////////////////////////////////////////////////////////////////////////////////7
function openTab(evt, idpro) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(idpro).style.display = "block";
    evt.currentTarget.className += " active";
} 

//////////////////////////////////////////////////////////////////////////////////////////////////////7
function ayuda_menuinterfaz_involucrado(){
window.alert("Selecciona un reporte(Click en el icono de VER REPORTE) para ayudar a la evaluación de las propuestas de medidas de mitigación");
}
function ayuda_interfazreporte_involucrado(){
window.alert("Analiza las propuestas que vienen en las pestañas,(Click en 'Aceptar propuesta' si estas de acuerdo) si rechazas una propuesta solo debes comentar tu propuesta o plantear en que estas en desacuerdo");
}

