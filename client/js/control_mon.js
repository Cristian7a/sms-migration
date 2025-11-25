function formato(texto){
  return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
}

//FUNCION PARA OBTENER COLOR DE RIESGO
function obtener_color(riesgo){
  switch(riesgo) {
    case '1A':
        return '#ecde02';
        break;
    case '1B':
        return 'green';
        break;
    case '1C':
         return 'green';
         break;
    case '1D':
         return 'green';
         break;
    case '1E':
         return 'green';
         break;
     case '2A':
        return  '#ecde02';
        break;
    case '2B':
        return '#ecde02';
        break;
    case '2C':
         return '#ecde02';
         break;
    case '2D':
         return 'green';
         break;
    case '2E':
         return 'green';
         break;
     case '3A':
        return  'red';
        break;
    case '3B':
        return '#ecde02';
        break;
    case '3C':
         return '#ecde02';
         break;
    case '3D':
         return '#ecde02';
         break;
    case '3E':
         return 'green';
         break;
    case '4A':
        return  'red';
        break;
    case '4B':
        return 'red';
        break;
    case '4C':
         return '#ecde02';
         break;
    case '4D':
         return '#ecde02';
         break;
    case '4E':
         return '#ecde02';
         break;
    case '5A':
        return  'red';
        break;
    case '5B':
        return 'red';
        break;
    case '5C':
         return 'red';
         break;
    case '5D':
         return '#ecde02';
         break;
    case '5E':
         return '#ecde02';
         break;

        break;
    default:
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
    case 2:
        cargar_responsables(x,'responsables');
        break;
    case 3:
        cargar_documentos(x,'documentos');
        break;
    case 1:
         e_cargar_estatus(x);
        break;
    case 4:
         e_cargar_objetivo(x);
        break;
    case 5:
         e_cargar_planificar(x);
        break;
    case 6:
         e_cargar_verificar(x);
        break;
    case 7:
         e_cargar_fecini(x);
        break;
    case 8:
         e_cargar_fecent(x);
        break;
    case 9:
         e_cargar_causas(x);
        break;
    case 10:
         e_cargar_actuar(x);
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
//CONTROL DE CMBIO DE COLOR
function nuevo_color(id,valor){
    var doc= document.getElementById(id);
      doc.setAttribute('style','color:#fff; background-color:'+valor+';');
    }     
//-------------------------------------------------------------
//CARGAR EVALUACION PARA EDITAR
function e_cargar_evaluacion(ideva){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_eva.php?IDEEVA="+ideva;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var outgra="";
            var outpro="";
            for (i = 0; i < array.length; i++) {
                var gra=array[i].GRAEVA;
                var pro=array[i].PROBEVA;
                
                outgra+="<option selected='selected' value='"+
                gra+"'>"+
                gra+"</option><option value='A'>A</option><option value='B'>B</option> <option value='C'>C</option><option value='D'>D</option><option value='E'>E</option>";
                outpro+="<option selected='selected' value='"+
                pro+"'>"+
                pro+"</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option>";
                
            }
            
           document.getElementById("egra").innerHTML=outgra;
           document.getElementById("epro").innerHTML=outpro;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//CARGAR RESPONSABLES EN PROPUESTAS
//----------------------------------------------------------------------
function cargar_res(x,rie,rep){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_res.php?IDEPRO="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            if (array.length==0){
              out2="<h4>NO EXISTEN RESPONSABLES AUN</h4>"
              document.getElementById("res").innerHTML=out2;
            }
            for (i = 0; i < array.length; i++) {
                var ideres=array[i].IDERES;
                out+="<tr><td>"+
                array[i].NOMEMP+" "+
                array[i].APPEMP+" "+
                array[i].APMEMP+"</td><td>"+
                array[i].NOMCAR+" / "+array[i].NOMCOO+"</td><td align='center'><a href='../gestion/query/baja_res.php?IDERIE="+rie+"&IDEREP="+rep+"&IDEINV="+ideres+"'><IMG height='25px' title='Eliminar' SRC='../imagenes/eliminar.png'></td></tr>";
            }
            
           document.getElementById("data_res").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//------------------------------------------------------------
//FILTROS PARALAS TABLAS
function filtro_mon(){
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

  col_1: 'select',
  col_2: 'select',
  col_4: 'none',
  col_5: 'select',
  col_11: 'none',
  col_15: 'none',
  col_16: 'none',

  watermark: ['', 'PROPUESTA', '', 'Propuesta' ],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('table_mon', filtersConfig,2);
tf.init();
}

///////////////////////////////////////////////////////////////////////
//-----------------------------------------------------------------------------
//CARGAR DOCUMENTOS
function cargar_documentos(mondoc,idtable){
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_doc.php?mondoc="+mondoc;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            if (array.length==0){
                 out+="<tr><td width='300px'>No existen documentos aun</td></tr>";
            }else{
                 out+="<thead><tr><td><b>Nombre del documento:</b></td><td></td><td></td></tr></thead>";
            for (i = 0; i < array.length; i++) {                
                var fecdoc= formato(array[i].FECDOC);
                var idedoc=array[i].IDEDOC;
                var dirdoc=array[i].DIRDOC;
                   out+="<tr><td><a href='../"+dirdoc+"'>"+array[i].NOMDOC+"</a></td><td><a href='query/baja_doc.php?idedoc="+idedoc+"&dirdoc="+dirdoc+"'><IMG title='Eliminar documento' height='25px' SRC='../imagenes/eliminar.png'></a></td></tr>";
            }
            }
            
           document.getElementById(idtable).innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//-----------------------------------------------------------------------------
//CARGAR DOCUMENTOS
function cargar_responsables(idpro,idtable){
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_res.php?IDEPRO="+idpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            if (array.length==0){
                 out+="<tr><td width='300px'>No existen responsables aún</td></tr>";
            }else{
                 out+="<thead><tr><td><b>NOMBRE DEL RESPONSABLE</b></td><td><b>CARGO</b></td><td><b>COORDINACIÓN</b></td></tr></thead>";
            for (i = 0; i < array.length; i++) {
                var nomres=array[i].NOMEMP+' '+array[i].APPEMP+' '+array[i].APMEMP;               
                out+="<td>"+
                nomres+"</td><td>"+
                array[i].NOMCAR+"</td><td>"+array[i].NOMCOO+"</td></tr>";
                
            }
            }
            
           document.getElementById(idtable).innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//-------------------------------------------------------------
//CARGAR ESTATUS PARA EDITAR
function e_cargar_estatus(monpro){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_est.php?monpro="+monpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var outest="";
            var outpor="";
            var outdes="";
            for (i = 0; i < array.length; i++) {
                var est=array[i].ESTMON;
                var por=array[i].POREST;
                var des=array[i].DESEST;
                
                outest+="<option selected='selected' value='"+
                est+"'>"+
                est+"</option><option value='NO HAN SIDO IMPLEMENTADAS'>NO HAN SIDO IMPLEMENTADAS</option><option value='YA NO SON FUNCIONALES Y DEBEN DESECHARSE'>YA NO SON FUNCIONALES Y DEBEN DESECHARSE</option> <option value='FUNCIONAN PARCIALMENTE'>FUNCIONAN PARCIALMENTE</option><option value='FUNCIONAN CORRECTAMENTE'>FUNCIONAN CORRECTAMENTE</option>";
                outpor+="<input id='por' name='por' type='number' min='0' max='100' list='tickmarks' value='"+
                por+"'> %";
                outdes+="<textarea id='des' name='des' cols='40px' rows='3' />"+
                des+" </textarea>";
                
                
            }
            
           document.getElementById("est").innerHTML=outest;
           document.getElementById("porc").innerHTML=outpor;
           document.getElementById("desc").innerHTML=outdes;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//CARGAR CAUSAS PARA EDITAR
function e_cargar_causas(monpro){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_cau.php?monpro="+monpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var cau=array[i].CAUCIC;
                out+="<textarea id='cau' name='cau' cols='40px' rows='3' />"+
                cau+" </textarea>";    
            }
           document.getElementById("caus").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//CARGAR OBJETIVO PARA EDITAR
function e_cargar_objetivo(monpro){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_obj.php?monpro="+monpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var obj=array[i].OBJCIC;
                out+="<textarea id='obj' name='obj' cols='40px' rows='3' />"+
                obj+" </textarea>";    
            }
           document.getElementById("obje").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//CARGAR PLANIFICAR PARA EDITAR
function e_cargar_planificar(monpro){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_pla.php?monpro="+monpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var pla=array[i].PLACIC;
                out+="<textarea id='pla' name='pla' cols='40px' rows='3' />"+
                pla+" </textarea>";    
            }
           document.getElementById("plan").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//-------------------------------------------------------------
//CARGAR VERIFICAR PARA EDITAR
function e_cargar_verificar(monpro){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_ver.php?monpro="+monpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            var out2="";
            for (i = 0; i < array.length; i++) {
                var ver=array[i].VERCIC;
                var log=array[i].LOGCIC;
                if((log==null) ||(log=='')){out2+=" <option  value='' selected='selected'>--ELEGIR--</option><option value='SI' >SI</option><option value='NO'>NO</option>";}
                else{
                out2+=" <option  value='"+log+"' selected='selected'>"+log+"</option><option value='SI' >SI</option><option value='NO'>NO</option>";      
                }                
                out+="<textarea id='ver' name='ver' cols='40px' rows='3' />"+
                ver+" </textarea>";
                
            }
           document.getElementById("veri").innerHTML=out;
           document.getElementById("logr").innerHTML=out2;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//CARGAR ACTUAR PARA EDITAR
function e_cargar_actuar(monpro){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_act.php?monpro="+monpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var act=array[i].ACTCIC;
                out+="<textarea id='act' name='act' cols='40px' rows='3' />"+
                act+" </textarea>";    
            }
           document.getElementById("actu").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//CARGAR FECHA INICIO PARA EDITAR
function e_cargar_fecini(monpro){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_ini.php?monpro="+monpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var ini=array[i].FECINI;
                out+="<input type='date' id='ini' name='ini' value='"+ini+"'>";   
            }
           document.getElementById("inic").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//CARGAR FECHA ENTREGA PARA EDITAR
function e_cargar_fecent(monpro){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_ent.php?monpro="+monpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var ent=array[i].FECENT;
                out+="<input type='date' id='ent' name='ent' value='"+ent+"'>";    
            }
           document.getElementById("entr").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}