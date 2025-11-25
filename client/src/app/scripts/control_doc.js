function formato(texto){
	if (texto==null){
        return ('00/00/0000');
	}else{
		return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
	}
  
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
function openventana_var(ventana,x,funcion){
   $(ventana).slideDown("slow");
       cargar_docs(x,"documentos");

}
function openventana_varx(ventana,x,iddestino){
   $(ventana).slideDown("slow");
   if(iddestino!=""){
      nuevo_id(iddestino,x);
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
//CARGAR DOCUMENTOS
function cargar_docs(idres,idtable){
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_doc.php?IDERES="+idres;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            if (array.length==0){
                 out+="<tr><td width='300px'>No existen documentos aun</td></tr>";
            }else{
                 out+="<thead><tr><td><b>Fecha de anexado&nbsp;</b></td><td><b> Nombre del documento</b></td><td></td><td></td></tr></thead>";
            for (i = 0; i < array.length; i++) {                
                var fecverdoc= formato(array[i].FECVERDOC);
                var fecdoc= formato(array[i].FECDOC);
                var dirdoc= array[i].DIRDOC;
                if (fecverdoc=="00/00/0000"){
                  idedoc=array[i].IDEDOC;
                   out+="<tr><td>"+fecdoc+"</td><td><a target='_blank' href='../"+dirdoc+"'>"
                +array[i].NOMDOC+"</a></td><td><input type='submit' value='Aprobar' class='boton' onclick=location.href='query/validar_doc.php?IDEDOC="+idedoc+"'; /></td>"
                +"<td><input type='submit' value='Rechazar' class='boton' onclick=openventana_varx('.ventana_2',"+idedoc+",'iddoc'); /></td><td><a href='query/baja_doc.php?idedoc="+idedoc+"&dirdoc="+dirdoc+"'><IMG title='Eliminar documento' height='25px' SRC='../imagenes/eliminar.png'></a></td></tr>";
                }else{
                  var res="";
                if (array[i].VERDOC!="APROBADO"){res="RECHAZADO";}else{res="APROBADO";}
                out+="<tr><td>"+fecdoc+"</td><td><a target='_blank' href='../"+
                dirdoc+"'>"+
                array[i].NOMDOC+"</a></td><td> Revisado el: "+
                fecverdoc+"</td><td>&nbsp;"+res+"</td></tr>";
                }
            }
            }
            
           document.getElementById(idtable).innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

///-----------------------------------------------------------------
function filtro_res(){
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

  col_10: 'none',
  watermark: ['', '', '', '', '', '', '', ],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_ges', filtersConfig,2);
tf.init();
}
