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
function openventana_var(ventana,x,iddestino,funcion){
   $(ventana).slideDown("slow");
   if(iddestino!=""){
      nuevo_id(iddestino,x);
   }
   switch(funcion) {
    case 1:
       cargar_docs(x,"documentos");
        break;
    case 2:
       // cargar_editar_propuesta(x);

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
//CARGAR DOCUMENTOS
function cargar_docs(idres,idtbody){
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_doc.php?IDERES="+idres;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="<tr>";
            for (i = 0; i < array.length; i++) {
                var fecverdoc= formato(array[i].FECVERDOC);
                if (fecverdoc=="00/00/0000"){
                 out+="<td><a target='_blank' href='../"+
                array[i].DIRDOC+"'>"+
                array[i].NOMDOC+"</a></td><td>Sin revisar</td></tr>";
                }else{
                  if (array[i].VERDOC!="APROBADO"){res="RECHAZADO: "+array[i].VERDOC;}else{res="APROBADO";}
                out+="<td><a target='_blank' href='../"+
                array[i].DIRDOC+"'>"+
                array[i].NOMDOC+"</a></td><td> Revisado el: "+
                fecdoc+"</td><td>"+res+"</td></tr>";
                }
            }
            
           document.getElementById(idtbody).innerHTML=out;
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
  col_3: 'select',
  col_4: 'select',
  col_5: 'select',
  col_6: 'select',
  col_7: 'none',
  watermark: ['', 'No.', 'Fecha', '', '', '', '','' ],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_ges', filtersConfig,2);
tf.init();
}
