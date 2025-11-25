 //----------------------------------------------------
//control de cajas seleccion reactivas de reportes
$('#area').on('change', function(){
        if($('#area').val() == ""){
          $('#emp').empty();
          $('<option selected="selected" value="">--ELEGIR--</option>').appendTo('#emp');
          $('#emp').attr('disabled', 'disabled');
        }else{
          $('#emp').removeAttr('disabled', 'disabled');
          $('#emp').load('query/nombre_get.php?area=' + $('#area').val());
        }
    });
//FUNCION QUE CARGA EDITAR PUBLICACION
//------------------------------------------------------------
function cargar_editar_publicacion(idpub){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/e_con_pub.php?IDEPUB="+idpub;
    var idtip;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            var out2="";
            var out3="";
            var out4="";
            var out5="";
            var out6="";
            for (i = 0; i < array.length; i++) {  
             idtip=array[i].MEDPUB;
                out+="<input type='text' id='tit' name='tit' value='"+ array[i].NOMPUB+"'/>";
                out4+="<textarea id='con' name='con' cols='36px'>"+ array[i].CONPUB+"</textarea>";
                out5+="<input type='hidden' id='doc' name='doc' value='"+array[i].DOCPUB+"'/>";
                out6+="<input type='hidden' id='IDEPUB_E' name='IDEPUB_E' value='"+ idpub+"'/>";
        
            }
            document.getElementById("titulo").innerHTML=out;
           document.getElementById("contenido").innerHTML=out4;
           document.getElementById("archivo").innerHTML=out5;
           document.getElementById("identificador").innerHTML=out6;
           e_cargar_tip("tippub",idtip);
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//CARGAR MED PARA EDITAR
function e_cargar_tip(area,idtip){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_tip.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var id=array[i].IDEMED;
                if(id==idtip){
                out+="<option selected='selected' value='"+
                array[i].IDEMED+"'>"+
                array[i].NOMMED+"</option>";
                }else{
                out+="<option value='"+
                array[i].IDEMED+"'>"+
                array[i].NOMMED+"</option>";
                }
                
            }
            
           document.getElementById(area).innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//------------------------------------------------------
//FUNCION CAMBIO FORMATO DE FECHA
function formato(texto){
  return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
}
//control carga de cajas de seleccion normal (TIPO DE PUBLICACION)
function cargar_tip(area){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_tip.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="<option selected='selected' value=''>--ELEGIR--</option>";
            for (i = 0; i < array.length; i++) {
                out+="<option value='"+
                array[i].IDEMED+"'>"+
                array[i].NOMMED+"</option>";
            }
            
           document.getElementById(area).innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//---------------------------------------------------
//control carga de cajas de seleccion normales 
function cargar_coo(area){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_coo.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="<option selected='selected' value=''>--ELEGIR--</option><option value='TODAS'>TODAS</option>";
            for (i = 0; i < array.length; i++) {
                out+="<option value='"+
                array[i].IDECOO+"'>"+
                array[i].NOMCOO+"</option>";
            }
            
           document.getElementById(area).innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
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
//---------------------------------------------------
//CARGAR PUBLICACIONES LEIDAS
function cargar_alcance(area){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_alcance.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var res=JSON.parse(xmlhttp.responseText);
            var out="<b>"+res+"</b>";
           document.getElementById(area).innerHTML=out;

        } 
    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//---------------------------------------------------
//CARGAR NUMERO DE PUBLICACIONES HECHAS
function cargar_publicaciones(area){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_totaldepublicaciones.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var res=JSON.parse(xmlhttp.responseText);
            var out="<b>"+res+"</b>";
           document.getElementById(area).innerHTML=out;

        } 
    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
///-----------------------------------------------------------------
function filtro_doc(){
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
  col_6: 'none',
  watermark: ['', 'No.', 'Fecha', 'Propuesta' ],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_ges', filtersConfig,2);
tf.init();
}



function consulta_vistos(idecoo,idepub){
   var dataString = 'IDECOO='+idecoo+'&IDEPUB='+idepub;
            $.ajax({
                type: "POST",
                url:"query/con_vistos.php",
                data: dataString,
                success: function(data){
                 $("#vistos").attr('value',data);
                   
                }
            });}




//FUNCIONES PARA LOS EXAMENES

function consulta_novistos(idecoo,idepub){
   var dataString = 'IDECOO='+idecoo+'&IDEPUB='+idepub;
            $.ajax({
                type: "POST",
                url:"query/con_novistos.php",
                data: dataString,
                success: function(data){
                  $("#novistos").attr('value',data);
                }
            });

          }




