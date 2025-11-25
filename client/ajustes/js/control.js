function formato(texto){
	if (texto==null){
        return ('00/00/0000');
	}else{
		return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
	}
  
}
//----------------------------------------------------
//control de cajas seleccion reactivas de reportes
  $(document).ready(function(){
    $('#tipfac_e').on('change', function(){
        if($('#tipfac_e').val() == ""){
          $('#cauesp_e').empty();
          $('<option selected="selected" value="">--ELEGIR--</option>').appendTo('#cauesp_e');
          $('#cauesp_e').attr('disabled', 'disabled');
        }else{
          $('#cauesp_e').removeAttr('disabled', 'disabled');
          $('#cauesp_e').load('query/causa_get.php?tipfac=' + $('#tipfac_e').val());
        }
    });
    $('#tipfac').on('change', function(){
        if($('#tipfac').val() == ""){
          $('#cauesp').empty();
          $('<option selected="selected" value="">--ELEGIR--</option>').appendTo('#cauesp');
          $('#cauesp').attr('disabled', 'disabled');
        }else{
          $('#cauesp').removeAttr('disabled', 'disabled');
          $('#cauesp').load('query/causa_get.php?tipfac=' + $('#tipfac').val());
        }
    });

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
    $('#area1').on('change', function(){
        if($('#area1').val() == ""){
          $('#emp1').empty();
          $('<option selected="selected" value="">--ELEGIR--</option>').appendTo('#emp1');
          $('#emp1').attr('disabled', 'disabled');
        }else{
          $('#emp1').removeAttr('disabled', 'disabled');
          $('#emp1').load('query/nombre_get_inv.php?area=' + $('#area1').val());
        }
    });
     $('#area_e').on('change', function(){
        if($('#area_e').val() == ""){
          $('#emp_e').empty();
          $('<option selected="selected" value="">--ELEGIR--</option>').appendTo('#emp_e');
          $('#emp_e').attr('disabled', 'disabled');
        }else{
          $('#emp_e').removeAttr('disabled', 'disabled');
          $('#emp_e').load('query/nombre_get.php?area=' + $('#area_e').val());
        }
    });
  });
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
    case 3:
         cargar_com(x);
    case 4:
         cargar_editar_sesion(x);

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
//---------------------------------------------------
//control carga de cajas de seleccion normales 
function cargar_coo(area){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_coo.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="<option selected='selected' value=''>--ELEGIR--</option>";
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

//FUNCION QUE CARGA EDITAR SESION
//------------------------------------------------------------
function cargar_editar_sesion(idses){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/e_con_ses.php?ide="+idses;
    var ideses=idses;
    var ideemp;
    var nomcoo;
    var priv;
    var privilegio;
    var password;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            var out2="";
            var out3="";
            for (i = 0; i < array.length; i++) { 
             nomcoo=array[i].NOMCOO;
             nomemp=array[i].NOMEMP+" "+array[i].APPEMP+" "+array[i].APMEMP;
             priv=array[i].PRISES;
             privilegio=array[i].NOMPRI;
             password=array[i].PASSES;
             out+="<option selected='selected' value='"+priv+"'>"+privilegio+"</option><option value='1'>ADMINISTRADOR</option><option value='2'>USUARIO SMS</option><option value='3'>DIFUSIÓN</option><option value='4'>USUARIO NORMAL</option>";    
            }
            document.getElementById("area_e").innerHTML=nomcoo;
            document.getElementById("emp_e").innerHTML=nomemp;
            document.getElementById("pri_e").innerHTML=out;
            nuevo_id("pass_e",password);
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------

//------------------------------------------------------------
//FILTROS PARALAS TABLAS

///-----------------------------------------------------------------
function filtro_fac(){
  var filtersConfig = {
  // instruct TableFilter location to import ressources from
  base_path: '../TableFilter-master/dist/tablefilter/',
  filters_row_index: 0,
  headers_row_index: 1,

  alternate_rows: true,
  rows_counter: true,
  btn_reset: true,
  loader: true,
  highlight_keywords: true,
  no_results_message: true,
  
  col_2: 'none',
  watermark: ['No.'],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_fac', filtersConfig);
tf.init();
}
///-----------------------------------------------------------------
function filtro_ses(){
  var filtersConfig = {
  // instruct TableFilter location to import ressources from
  base_path: '../TableFilter-master/dist/tablefilter/',
  filters_row_index: 0,
  headers_row_index: 1,

  alternate_rows: true,
  rows_counter: true,
  btn_reset: true,
  loader: true,
  highlight_keywords: true,
  no_results_message: true,
  
  col_1: 'select',
  col_3: 'select',
  col_5: 'none',
  col_6: 'none',
  col_7: 'none',
  watermark: ['No.'],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_ses', filtersConfig);
tf.init();
}

