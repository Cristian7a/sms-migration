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
     $('#area_res').on('change', function(){
        if($('#area_res').val() == ""){
          $('#emp_res').empty();
          $('<option selected="selected" value="">--ELEGIR--</option>').appendTo('#emp_res');
          $('#emp_res').attr('disabled', 'disabled');
        }else{
          $('#emp_res').removeAttr('disabled', 'disabled');
          $('#emp_res').load('query/nombre_get.php?area=' + $('#area_res').val());
        }
    });
     $('#area_res_asignar').on('change', function(){
        if($('#area_res_asignar').val() == ""){
          $('#emp_res_asignar').empty();
          $('<option selected="selected" value="">--ELEGIR--</option>').appendTo('#emp_res_asignar');
          $('#emp_res_asignar').attr('disabled', 'disabled');
        }else{
          $('#emp_res_asignar').removeAttr('disabled', 'disabled');
          $('#emp_res_asignar').load('query/nombre_get.php?area=' + $('#area_res_asignar').val());
        }
    });




    //SECCION DE  TIPO DE ACTIVIDAD PARA TIPO DE OPERACION
     $('#top').on('change', function(){
        if($('#top').val() == ""){
          $('#tac').empty();
          $('<option selected="selected" value="">--ELEGIR--</option>').appendTo('#tac');
          $('#tac').attr('disabled', 'disabled');
        }else{
          $('#tac').removeAttr('disabled', 'disabled');
          $('#tac').load('query/tac_get.php?top=' + $('#top').val());
        }
    });
     //SECCION DE EJEMPLO PARA TIPO DE ACTIVIDAD
     $('#tac').on('click', function(){
        if($('#tac').val() == ""){
          $('#ide_gen').empty();
          $('<option selected="selected" value="">--ELEGIR--</option>').appendTo('#ide_gen');
          $('#ide_gen').attr('disabled', 'disabled');
        }else{
          $('#ide_gen').removeAttr('disabled', 'disabled');
          $('#ide_gen').load('query/ejemplo_taxo_get.php?tac=' + $('#tac').val());
          $('#agregar_taxo').attr('href', 'javascript:openventana_var(".ventana_19",'+$("#tac").val()+',"IDETAC_NUEVO");');
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


//----------------------------------------------------------------
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
    case 1:
        cargar_editar_reporte(x);
        break;
    case 2:
        cargar_editar_propuesta(x);
        break;
    case 3:
         cargar_com(x);
         cargar_pro_inicial(x);
         break;
    case 4:
         cargar_editar_sesion(x);
         break;
    case 5:
         cargar_editar_riesgo(x);
         break;
    case 6:
         desactivar_imagenes();
         break;
    case 7:
          cargar_inv(x);
        break;
    case 8:
        cargar_propuestas_iniciales(x);
        
        break;
    case 9:
        cargar_medidas_mitigacion(x);
        
        break;
    case 10:
        cargar_responsable_asignar(x);
        nuevo_id("IDEPRO_RES2",x);
        break;
    case 11:
        cargar_responsable_ejecutar(x);
        nuevo_id("IDEPRO_RES",x);
        break;
    case 18:
        cargar_editar_propuesta(x,"des_final");
        break;
    case 'g3':
        cargar_editar_gestion(x);
        break;
    case 'j':
        cargar_editar_lugar(x,"lugar");
        break;
    case 'j1':
        cargar_docs(x,"documentos");
        break;
    case 'j2':
        cargar_propuestas(x);
        break;
    case 'j5':
        cargar_editar_propuesta_juntas(x);
        break;









        break;
    default:
} 

}

//FUNCION PARA EVITAR QUE LAS IMAGENES SE SOBREPONGAN A LAS VENTANAS MODALES
function desactivar_imagenes(){
    var b = document.getElementsByClassName("image_wrapper"); 
    var i;
     for (i = 0; i < b.length; i++) {
    b[i].style.display = "none";
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
//---------------------------------------------------
//control carga TIPO DE OPERACIÓN 
function cargar_top(area){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_top.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="<option selected='selected' value=''>--ELEGIR--</option>";
            for (i = 0; i < array.length; i++) {
                out+="<option value='"+
                array[i].IDETOP+"'>"+
                array[i].NMTTOP+"/"+
                array[i].DESTOP+"</option>";
            }
            
           document.getElementById(area).innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//------------------------------------------------------------------------------------------------------
//FUNCIONES DE EDICIÓN
//FUNCION QUE CARGA EDITAR REPORTE
//------------------------------------------------------------
function cargar_editar_reporte(idrep){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/e_con_rep.php?IDEREP="+idrep;
    var iderep=idrep;
    var ideemp;
    var idelug;
    var idefac;
    var idecau;
    var idecoo;
    var canrep;
    var cancelar="NO";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
             ideemp=array[i].PERREP;   
             idelug=array[i].LUGREP;
             idecoo=array[i].COOCAR; 
             canrep=array[i].CANREP;
            }
            if(canrep==1){cancelar="SI";}
           out+="<option selected='selected' value="+canrep+">"+cancelar+"</option><option value=0>NO</option><option value=1>SI</option>";

            document.getElementById("canrep_e").innerHTML=out;         
            e_cargar_coo("area_e",idecoo);
            e_cargar_emp("emp_e",ideemp,idecoo);
            e_cargar_rep1(iderep);
            e_cargar_lug(idelug);
           
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//FUNCION QUE CARGA EDITAR PROPUESTA
//------------------------------------------------------------
function cargar_editar_propuesta(idpro,lugar){
    var destino="des_e";   
    if (lugar!=null){
      destino=lugar;
    }
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_pro.php?IDEPRO="+idpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out;
            for (i = 0; i < array.length; i++) {
             out=array[i].DESPRO;

            }
  
         document.getElementById(destino).innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//FUNCION QUE CARGA EDITAR GESTION O PELIGRO
//------------------------------------------------------------
function cargar_editar_gestion(idrep){
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_pel.php?IDEREP="+idrep;
    xmlhttp.onreadystatechange=function() { 
      
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out;
            var out2;
            var out3;
            var out4;
            var out5;
            var out6;
            var out7;

            for (i = 0; i < array.length; i++) {
              var cate=array[i].CATEPEL;
              var meto=array[i].METIDEPEL;
              var ries=array[i].RIEOPEPEL;
             out="<input type='text' id='ide_gen_e' name='ide_gen_e' value='"+array[i].GENPEL+"'/>";
             out2="<input type='text' id='con_e' name='con_e' value='"+array[i].CONPEL+"'/>";
             out3="<input type='text' id='obj_e' name='obj_e' value='"+array[i].OBJPEL+"'/>";
             out4="<input type='text' id='act_e' name='act_e' value='"+array[i].ACTPEL+"'/>";
             out5="<select id='cat_e' name='cat_e'><option selected='selected' value='"+cate+"'>"+cate+"</option><option value='NATURAL'>NATURAL</option><option value='TÉCNICO'>TÉCNICO</option><option value='ECONÓMICO'>ECONÓMICO</option> </select>";
             out6="<select id='met_ide_e' name='met_ide_e'> <option selected='selected' value='"+meto+"'>"+meto+"</option> <option value='REACTIVO'>REACTIVO</option><option value='PROACTIVO'>PROACTIVO</option> </select>";
             out7="<select id='rie_ope_e' name='rie_ope_e'><option selected='selected' value='"+ries+"'>"+ries+"</option><option value='SI'>SI</option><option value='NO'>NO</option></select>";

            }
         document.getElementById("iden").innerHTML=out;
         document.getElementById("cond").innerHTML=out2;
         document.getElementById("obje").innerHTML=out3;
         document.getElementById("acti").innerHTML=out4;
         document.getElementById("cate").innerHTML=out5;
         document.getElementById("meto").innerHTML=out6;
         document.getElementById("ries").innerHTML=out7;
      
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//CARGAR COO PARA EDITAR
function e_cargar_coo(area,idcoo){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_coo.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var id=array[i].IDECOO;
                if(id==idcoo){
                out+="<option selected='selected' value='"+
                array[i].IDECOO+"'>"+
                array[i].NOMCOO+"</option>";
                }else{
                out+="<option value='"+
                array[i].IDECOO+"'>"+
                array[i].NOMCOO+"</option>";
                }
                
            }
            
           document.getElementById(area).innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//CARGAR EMP PARA EDITAR
function e_cargar_emp(area,idemp,idcoo){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_emp.php?IDECOO="+idcoo;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var id=array[i].IDEPER;
                if(id==idemp){
                out+="<option selected='selected' value='"+
                array[i].IDEPER+"'>"+
                array[i].NOMEMP+" "+array[i].APPEMP+" "+array[i].APMEMP+"</option>";
                }else{
                out+="<option value='"+
                array[i].IDEPER+"'>"+
                array[i].NOMEMP+" "+array[i].APPEMP+" "+array[i].APMEMP+"</option>";
                }
                
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
//CARGAR CONFIDENCIALIDAD y FECHAS DEL REPORTE
function e_cargar_rep1(idrep){
    var xmlhttp = new XMLHttpRequest();
    var url="query/e_con_rep.php?IDEREP="+idrep;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            var out2="";
            var out3="";
            var out4="";
            var out5="";
            for (i = 0; i < array.length; i++) {
                var conf=array[i].CONREP;
                var frec=array[i].FREREP;
                var sino="NO";
                if(conf==1){ sino="SI"; }

                out+="<td>Confidencial:</td> <td> <select id='con_e' name='con_e'> <option selected='selected' value="+ conf+">"+sino+"</option><option value=1>SI</option> <option value=0>NO</option> </select></td>";
                out2+="<td>Fecha del suceso:</td><td> <input type='date' id='fecsus_e' name='fecsus_e' value='"+ array[i].FECEVE+"'/></td>"; 
                out3+="<td>Fecha del reporte:</td><td> <input type='date' id='fecrep_e' name='fecrep_e' value='"+array[i].FECREP+"'/></td>";
                out4+="<td>Descripción del evento:</td><td> <textarea rows='4' cols='50' id='obs_e' name='obs_e'>"+array[i].OBSREP+"</textarea></td>";
                out5+="<td>Frecuencia del evento:</td><td> <select id='freeve_e' name='freeve_e'><option selected='selected' value='"
                +frec+"'>"+frec+"</option><option value='ES LA PRIMERA VEZ'>ES LA PRIMERA VEZ</option><option value='EXTREMADAMENTE IMPROBABLE'>EXTREMADAMENTE IMPROBABLE</option><option value='IMPROBABLE'>IMPROBABLE</option><option value='REMOTO'>REMOTO</option><option value='OCASIONAL'>OCASIONAL</option><option value='FRECUENTE'>FRECUENTE</option><option value='PERMANENTE'>PERMANENTE</option> </select></td>";

            }
            
           document.getElementById("conf").innerHTML=out;
           document.getElementById("fece").innerHTML=out2;
           document.getElementById("fecr").innerHTML=out3;
           document.getElementById("obse").innerHTML=out4;
           document.getElementById("frec").innerHTML=out5;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//CARGAR LUGAR PARA EDITAR
function e_cargar_lug(idlug){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_lug.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                 var id=array[i].IDELUG;
                if(id==idlug){
                out+="<option selected='selected' value='"+
                array[i].IDELUG+"'>"+
                array[i].NOMLUG+"</option>";
                }else{
                out+="<option value='"+
                array[i].IDELUG+"'>"+
                array[i].NOMLUG+"</option>";
                }
            }
            
           document.getElementById("lugsus_e").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//CARGAR FACTOR PARA EDITAR
function e_cargar_fac(idfac){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_fac.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var id=array[i].IDEFAC;
                if(id==idfac){
                out+="<option selected='selected' value='"+
                array[i].IDEFAC+"'>"+
                array[i].TIPFAC+"</option>";
                }else{
                out+="<option value='"+
                array[i].IDEFAC+"'>"+
                array[i].TIPFAC+"</option>";
                }
            }
            
           document.getElementById("tipfac_e").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//CARGAR CAUSA PARA EDITAR
function e_cargar_cau(area,idcau,idfac){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_cau.php?IDEFAC="+idfac;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var id=array[i].IDECAU;
                if(id==idcau){
                out+="<option selected='selected' value='"+
                array[i].IDECAU+"'>"+
                array[i].TIPCAU+"</option>";
                }else{
                out+="<option value='"+
                array[i].IDECAU+"'>"+
                array[i].TIPCAU+"</option>";
                }
                
            }
            
           document.getElementById(area).innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//--------------------------------------------------------------------------------------------
function cargar_lug(){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_lug.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="<option selected='selected' value=''>--ELEGIR--</option>";
            for (i = 0; i < array.length; i++) {
                out+="<option value='"+
                array[i].IDELUG+"'>"+
                array[i].NOMLUG+"</option>";
            }
            
           document.getElementById("lugsus").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
function cargar_fac(){
 
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_fac.php";
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="<option selected='selected' value=''>--ELEGIR--</option>";
            for (i = 0; i < array.length; i++) {
                out+="<option value='"+
                array[i].IDEFAC+"'>"+
                array[i].TIPFAC+"</option>";
            }
            
           document.getElementById("tipfac").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
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
                out+="<tr><td width='30%'><b>Lugar del suceso:</b></td><td width='70%'>"+
                array[i].NOMLUG+"</td></tr><tr><td><b>Factor:</b></td><td>"+
                array[i].TIPFAC+"</td></tr><tr><td><b>Causa específica:</b></td><td>"+
                array[i].TIPCAU+"</td></tr><tr><td><b>Frecuencia:</b></td><td>"+
                array[i].FREREP+"</td></tr><tr><td><b>Observaciones:</b></td><td>"+
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
                out+="<tr><td width='120px'><b>Fecha del reporte: </b></td><td>"+
                fecrep+"</td></tr><tr><td><b>Fecha del suceso: </b></td><td>"+
                feceve+"</td></tr><tr><td><b>Lugar del suceso: </b></td><td>"+
                array[i].NOMLUG+"</td></tr><tr><td><b>Frecuencia: </b></td><td>"+
                array[i].FREREP+"</td></tr><tr><td><b>Observaciones: </b></td><td>"+
                array[i].OBSREP+"</td></tr>";
            }
            
           document.getElementById("dat_rep").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//FUNCION PARA CARGAR A EMPLEADO EN VER_GESTION
function cargarti_emp(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_emp.php?IDEREP="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                out+="<tr><td width='120px'><b>Nombre:</b></td><td width='auto'>"+
                array[i].NOMEMP+" "+array[i].APPEMP+" "+array[i].APMEMP+"</td></tr><tr><td><b>Email:</b> </td><td>"+
                array[i].EMAEMP+"</td></tr><tr><td ><b>Celular:</b></td><td>"+
                array[i].CELEMP+"/"+array[i].CEL2EMP+"</td></tr><tr><td><b>Telefono(s) Oficina:</b></td><td>"+
                array[i].TELOFIEMP+"/"+array[i].TELOFI2EMP+" Ext:"+array[i].EXTEMP+"</td></tr><tr><td><b>Coordinación: </b></td><td>"+
                array[i].NOMCAR+" / "+array[i].NOMCOO+"</td></tr>";
            }
            
           document.getElementById("dat_emp").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
function cargarti_pel(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_pel.php?IDEREP="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                out+="<tr><td><b>Peligro genérico: </b>"+
                array[i].GENPEL+"</td></tr><tr><td><b>Condición: </b>"+
                array[i].CONPEL+"</td></tr><tr><td><b>Objeto: </b>"+
                array[i].OBJPEL+"</td></tr><tr><td><b>Actividad: </b>"+
                array[i].ACTPEL+"</td></tr>";
            }
            
           document.getElementById("dat_pel").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
function cargar_rie(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_rie.php?IDEREP="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            var iderie;
            var ventana='.ventana_5';
            if (array.length==0){
               out+="<h4>NO EXISTEN COMPONENTES DEL PELIGRO AUN</h4>";
            }else{
            for (i = 0; i < array.length; i++) {
                iderie=array[i].IDERIE;
                riesgo=array[i].PROBRIE+array[i].GRARIE;
                color=obtener_color(riesgo);

                riesgo_rev=array[i].PROREV+array[i].GRAREV;
                color_rev=obtener_color(riesgo_rev);

                var color_fuente="#fff";
                var color_fuente_rev="#fff";

                if(color=="#ecde02"){color_fuente="#000"}
                if(color_rev=="#ecde02"){color_fuente_rev="#000"}
                if (riesgo_rev==''){riesgo_rev="SIN EVALUAR"; color_fuente_rev="#000";}
                out+="<tr><td>"+
                array[i].DESRIE+"</td><td>"+
                array[i].CESPRIE+"</td><td>"+
                array[i].CONRIE+"</td><td style='text-align:center;color:white; background-color:"+color+";color:"+color_fuente+";'><b> "+
                //riesgo+"<b></td><td align='center'><a href=javascript:openventana_var('.ventana_7',"+iderie+",'IDERIE_INV',7);><IMG height='25px'  SRC='../imagenes/empleados.jpg'></a></td><td align='center'><a href='../gestion/propuestas.php?IDEREP="+y+"&IDERIE="+iderie+"'><IMG height='25px' SRC='../imagenes/prop.png'></a></td><td align='center'><a href=javascript:openventana_var('"+ventana+"',"+iderie+",'iderie_e',5);><IMG height='25px' SRC='../imagenes/edit.png'></a></td><td align='center'><a href='../gestion/query/baja_com.php?IDERIE="+iderie+"&IDEREP="+y+"'><IMG height='25px' title='Eliminar' SRC='../imagenes/eliminar.png'></td></tr>";
                riesgo+"<b></td><td align='center'><a href=javascript:openventana_var('.ventana_9',"+iderie+",'IDERIE_PRO',8);><IMG height='30px' SRC='../imagenes/propuestas.png'></a></td><td align='center'><a href=javascript:openventana_var('.ventana_9_5',"+iderie+",'IDERIE_PRO',9);><IMG height='30px' SRC='../imagenes/icono_medida_mitigacion2.png'></a></td><td style='text-align:center;background-color:"+
                color_rev+";'><b><a style='color:"+color_fuente_rev+";' href=javascript:openventana_var('.ventana_14',"+iderie+",'IDRIEEVA');>"+
                riesgo_rev+"</a></b></td><td align='center'><a href=javascript:openventana_var('"+ventana+"',"+iderie+",'iderie_e',5);><IMG height='25px' SRC='../imagenes/edit.png'></a></td><td align='center'><a href='../gestion/query/baja_com.php?IDERIE="+iderie+"&IDEREP="+y+"'><IMG height='25px' title='Eliminar' SRC='../imagenes/eliminar.png'></td></tr>";

            }
        }
           document.getElementById("rie").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}


//-----------------------------------------------------------------------------------------------------
//INVOLUCRADOS EN LAS PROPUESTAS
function cargar_inv(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_inv.php?IDEPRO="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            var iderep;
            if (array.length==0){
              out="<br><h4>NO EXISTEN COORDINACIONES INVOLUCRADAS AUN</h4><br>"
             
            }else{
                out+="<thead style='color: #fff;'><tr><td style='background:#2672EC;'>NOMBRE</td><td style='background:#2672EC;'>CARGO / COORDINACIÓN</td><td align='center' style='background:#2672EC;'>NOTIFICAR</td><td style='background:#2672EC;'></td></tr></thead>";
            for (i = 0; i < array.length; i++) {
                var ideinv=array[i].IDEINV;
                var not=array[i].FECNOT;
                iderep=getParameterByName('IDEREP');
                if (not == null) {
                out+="<tr><td>"+array[i].NOMEMP+" "+array[i].APPEMP+" "+array[i].APMEMP+"</td><td>"+array[i].NOMCAR+" / "+array[i].NOMCOO+
                "</td><td align='center'><a href='query/correo_inv.php?ide="+ideinv+"&IDEREP="+iderep+"'><IMG height='25px' title='Notificar' SRC='../imagenes/correo.png'></td><td align='center'><a href='../gestion/query/baja_inv.php?IDEPRO="+y+"&IDEREP="+iderep+"&IDEINV="+ideinv+"'><IMG height='25px' title='Eliminar' SRC='../imagenes/eliminar.png'></td></tr>";
                }else{
                 out+="<tr><td>"+array[i].NOMEMP+" "+array[i].APPEMP+" "+array[i].APMEMP+"</td><td>"+array[i].NOMCAR+" / "+array[i].NOMCOO+
                "</td><td align='center'>Notificado el: "+not+" </td><td align='center'><a href='../gestion/query/baja_inv.php?IDERIE="+y+"&IDEREP="+iderep+"&IDEINV="+ideinv+"'><IMG height='25px' title='Eliminar' SRC='../imagenes/eliminar.png'></td></tr>";
                }
            }
            }
            
           document.getElementById("dat_inv").innerHTML=out;
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
//-----------------------------------------------------------
//--CHECA SI YA SE HA INSERTADO UN REGISTRO DE PELIGRO ANTES Y SI  NO, ABRE LA VENTANA EMERGENTE
function checar_reg_pel(x){
var y=x;
var i;
var res;
var xmlhttp = new XMLHttpRequest();
    var url="query/con_pel_existente.php?IDEREP="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var res=JSON.parse(xmlhttp.responseText);
            //window.alert(res);
            if(res==0){
              openventana(".ventana");
            }  
        } 
    
    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
   
 
}
//CONSULTA INDIVIDUAL DE RIESGOS
function cargarti_rie(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_rie.php?IDERIE="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var riesgo=array[i].PROBRIE+""+array[i].GRARIE;
                var color=obtener_color(riesgo);
                var color_fuente="#fff";
                if(color=="#ecde02"){color_fuente="#000"}
                out+="<tr><td><b>Peligro genérico:<br> </b>"+
                array[i].GENPEL+"</td><td><b>Componente específico:<br> </b>"+
                array[i].CESPRIE+"</td><td><b>Consecuencia:<br> </b>"+
                array[i].CONRIE+"</td><td style='width:150px;text-align:center;'><b>Periodo de tolerabilidad:<br> </b><div style='background-color:"+color+";color:"+color_fuente+";'><b>"+
                riesgo+"</b></div></td></tr>";
            }
            
           document.getElementById("dat_pel_rie").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//------------------------------------------------------------
//FILTROS PARALAS TABLAS
function filtro_rep(){
  var filtersConfig = {
  // instruct TableFilter location to import ressources from
  base_path: '../TableFilter-master/dist/tablefilter/',
  col_0: 'select',
  col_4: 'select',
  col_5: 'select',
   col_8: 'none',
  col_9: 'none',
  col_10: 'none',
  col_11: 'none',
  
  alternate_rows: true,
  rows_counter: true,
  btn_reset: true,
  loader: true,
  mark_active_columns: true,
  highlight_keywords: true,
  no_results_message: true,

  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_rep', filtersConfig);
tf.init();
}
//------------------------------------------------------------------------------
function filtro_emp(){
  var filtersConfig = {
  // instruct TableFilter location to import ressources from
  base_path: '../../TableFilter-master/dist/tablefilter/',
  col_0: 'select',
  col_1: 'select',
  col_4: 'none',
  col_5: 'none',
 
  
  alternate_rows: true,
  rows_counter: true,
  btn_reset: true,
  loader: true,
  mark_active_columns: true,
  highlight_keywords: true,
  no_results_message: true,
  col_types: [
    'string', 'string', 'number',
    'number', 'number', 'number',
    'number', 'number', 'number'
  ],
  col_widths: [
    '150px', '100px', '100px',
    '70px', '70px', '70px',
    '70px', '60px', '60px'
  ],
  extensions: [{
    name: 'sort',
    images_path: '../../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_emp', filtersConfig);
tf.init();
}

///-----------------------------------------------------------------
function filtro_ges(){
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
  
  col_0: 'select',
  col_5: 'select',
  col_6: 'select',
  col_7: 'select',
  col_8: 'select',
  col_10: 'select',
  col_11: 'select',
  col_12: 'none',
  watermark: ['', '', '', '', '' ,'','','','',''],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_ges', filtersConfig,2);
tf.init();
}
///////////////////////////////////////////////////////////////////////777
//CONSULTA DE COMENTRIOS DE UN PROPUESTA
//CONSULTA INDIVIDUAL DE RIESGOS
function cargar_com(idpro){
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_com.php?IDEPRO="+idpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var feccom= formato(array[i].FECCOM);
                out+="<tr><td style='background-color: #008299;color:#fff;' width='auto' height='10px' align='left'>Comentado el "+
                feccom+"</td></tr><tr><td style='border: 1px solid #ddd; background-color: #ebf1f1;'  align='left' width='80px'>"+
                array[i].NOMCOM+"</td></tr><tr><td style='border: 1px solid #ddd;'>"+
                array[i].COMCOM+"</td></tr>";
            }
            
           document.getElementById("dat_com").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//CONSULTA PROPUESTA INICIAL
//CONSULTA INDIVIDUAL DE PROPUESTA
function cargar_pro_inicial(idpro){
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_pro.php?IDEPRO="+idpro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                out+="<tr><td><b>Propuesta inicial:</b></td></tr><tr><td>"+
                array[i].PRIPRO+"</td></tr>";
            }
            
           document.getElementById("pro_pri").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}


//-------------------------------------------------------------
//FUNCION QUE CARGA EDITAR GESTION O PELIGRO
//------------------------------------------------------------
function cargar_editar_monitoreo(idrep){
    var id=idrep;
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_mon.php?IDEREP="+id;
    xmlhttp.onreadystatechange=function() { 
      
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out;
            var out2;
            var out3;
            var out4;
            var out5;
            var out6;
            var out7;

            for (i = 0; i < array.length; i++) {
                var fecha_cierre=formato(array[i].FECCIE);
                /*
             out="<input type='text' id='emsm' name='emsm' value='"+array[i].MSMMON+"'/>";
             out2="<input type='text' id='epsm' name='epsm' value='"+array[i].PSMMON+"'/>";
             out3="<input type='text' id='epso' name='epso' value='"+array[i].PSOMON+"'/>";
             */
             out4="<input type='text' id='edif' name='edif' value='"+array[i].DIFMON+"'/>";
             out5="<input type='text' id='emit' name='emit' value='"+array[i].MITMON+"'/>";
             out6="<select id='eest' name='eest'> <option selected='selected' value='"+array[i].ESTMON+"'>"+array[i].ESTMON+"</option> <option value='ABIERTO'>ABIERTO</option><option value='CERRADO'>CERRADO</option> </select>";
             if(fecha_cierre=="00/00/0000"){out7="Sin fecha de cierre"}else{ if(array[i].ESTMON=="ABIERTO"){out7="Ultima fecha de cierre: "+fecha_cierre;}else{out7=fecha_cierre;}}
             

            }
            /*
         document.getElementById("msm").innerHTML=out;
         document.getElementById("psm").innerHTML=out2;
         document.getElementById("pso").innerHTML=out3;
         */
         document.getElementById("dif").innerHTML=out4;
         document.getElementById("mit").innerHTML=out5;
         document.getElementById("est").innerHTML=out6;
         document.getElementById("fec").innerHTML=out7;
      
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//FILTROS PARALAS TABLAS
function filtro_rep_i(){
  var filtersConfig = {
  // instruct TableFilter location to import ressources from
  base_path: '../TableFilter-master/dist/tablefilter/',

  col_3: 'select',
  col_4: 'select',
  col_5: 'select',
  col_6: 'select',
  col_8: 'select',
  col_10: 'none',
  
  alternate_rows: true,
  rows_counter: true,
  btn_reset: true,
  loader: true,
  mark_active_columns: true,
  highlight_keywords: true,
  no_results_message: true,
  col_types: [
    'string', 'string'
  ],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_rep', filtersConfig);
tf.init();
}
//------------------------------------------------------------------------------
function cargar_editar_riesgo(idrie){
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_rie.php?IDERIE="+idrie;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out;
            var out2;
            var out3;
            var out4;
            var out5;

            for (i = 0; i < array.length; i++) {
             out="<input type='text' id='com' name='com' value='"+array[i].CESPRIE+"'/>";
             out2="<input type='text' id='des' name='des' value='"+array[i].DESRIE+"'/>";
             out3="<input type='text' id='con' name='con' value='"+array[i].CONRIE+"'/>";
             out4="<option selected='selected' value='"+array[i].PROBRIE+"'>"+array[i].PROBRIE+"</option><option value=1>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option><option value=5>5</option>";
             out5="<option selected='selected' value='"+array[i].GRARIE+"'>"+array[i].GRARIE+"</option><option value='A'>A</option><option value='B'>B</option><option value='C'>C</option><option value='D'>D</option><option value='E'>E</option>";
             out6="<input type='hidden' id='iderep5' name='iderep5' value='"+array[i].REPPEL+"'/>";
            }
         document.getElementById("comp_e").innerHTML=out;
         document.getElementById("desc_e").innerHTML=out2;
         document.getElementById("cons_e").innerHTML=out3;
         document.getElementById("prob_e").innerHTML=out4;
         document.getElementById("grav_e").innerHTML=out5;
         document.getElementById("idrep5").innerHTML=out6;
      
      
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//----------------------------------------------------------------------------
function verificar_comentarios(idpro){
    var xmlhttp = new XMLHttpRequest();
    var xmlhttp2 = new XMLHttpRequest();
    var url="query/con_com.php?IDEPRO="+idpro;
    var url2="query/con_inv2.php?IDEPRO="+idpro;
    var idepro=idpro;
    var nombre_com="";
    var nombre="";
    var n_involucrados;
    var n_participantes=0;

    xmlhttp2.onreadystatechange=function() { 
       if(xmlhttp2.readyState == 4 && xmlhttp2.status == 200){ 
            var array2=JSON.parse(xmlhttp2.responseText);
            var j;

            xmlhttp.onreadystatechange=function() { 
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
             n_involucrados=array2.length;
            for (j = 0; j < n_involucrados; j++) {
                nombre=array2[j].NOMEMP+" "+array2[j].APPEMP+" "+array2[j].APMEMP;

                                      var array=JSON.parse(xmlhttp.responseText);
                                      var i;
                                      var p=[];
                                      var com;
                                     for (i = 0; i < array.length; i++) {
                                      nombre_com=array[i].NOMCOM;
                                      com=array[i].COMCOM;
                                        if(nombre==nombre_com && com=="ACEPTO"){
                                            var x;
                                            var res;
                                            for (x = 0; x < p.length; x++) {
                                                if(p[x]==nombre){
                                                 res=true;
                                                }

                                            }
                                            if (res!=true){
                                              p[n_participantes]=nombre;
                                            n_participantes++; 
                                            
                                            }

                                         
                                        }
              
                                    }
                
            }

            if(n_involucrados==n_participantes){
                document.getElementById(idepro).innerHTML="<a href=javascript:openventana_var('.ventana_5',"+idepro+",'pro',3); >Concluida</a>";
                
            }else{
                document.getElementById(idepro).innerHTML="<a href=javascript:openventana_var('.ventana_5',"+idepro+",'pro',3); ><IMG height='25px' title='Reunión en curso' SRC='../imagenes/comentar_sin_revisar.png'></a>";
            }

            }}
           xmlhttp.open("GET",url,true);
           xmlhttp.send();
        }}   
    xmlhttp2.open("GET",url2,true);
    xmlhttp2.send();
}

//-------------------------------------------------------------------
function cargar_rev_eva(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_rie.php?IDERIE="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
                var pro=array[i].PROREV;
                var gra=array[i].GRAREV;
                if (pro==null){pro=''}
                if (gra==null){gra=''}
                var riesgo=pro+gra;
                var color=obtener_color(riesgo);
                var color_fuente="#fff";

                if(color=="#ecde02"){color_fuente="#000"}
                out+="<tr><td><b>Peligro genérico:<br> </b>"+
                array[i].GENPEL+"</td><td><b>Componente específico:<br> </b>"+
                array[i].CESPRIE+"</td><td><b>Consecuencia:<br> </b>"+
                array[i].CONRIE+"</td><td style='width:150px;text-align:center;'><b>Indice de riesgo:<br>";
                if (riesgo==''){riesgo="SIN EVALUAR"
                    out+="</b><div><b><a href=javascript:openventana_var('.ventana_8',"+y+",'IDRIEEVA'); >"+
                riesgo+"</a></b></div></td></tr>";
                    }else{
                       out+="</b><div style='background-color:"+color+";color:"+color_fuente+";'><b><a href=javascript:openventana_var('.ventana_8',"+y+",'IDRIEEVA');>"+
                riesgo+"</a></b></div></td></tr>";
            } 
                    }
            
           document.getElementById("dat_rev_eva").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
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

//---------------------------------------------------------------------------------------------------
//CARGAR PROPUESTAS EN TABLA
function cargar_propuestas_iniciales(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_propuestas.php?IDERIE="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            var idepro;
            var iderep;

            if (array.length==0){
               out+="<h4>NO EXISTEN PROPUESTAS DE MITIGACIÓN AUN</h4>";
            }else{
            for (i = 0; i < array.length; i++) {
                idepro=array[i].IDEPRO;
                iderep=array[i].PELRIE;
                out+="<tr><td style='border-bottom: 1px solid #000;width:400px;'>"+
                array[i].PRIPRO+"</td><td style='border-bottom: 1px solid #000;width:100px;' align='center'><a href=javascript:openventana_var('.ventana_7',"+idepro+",'IDEPRO_INV',7);><IMG height='25px'  SRC='../imagenes/empleados.jpg'></a></td><td align='center' style='border-bottom: 1px solid #000;width:30px;'><a href='../gestion/query/baja_pro.php?IDEPRO="+idepro+"&IDERIE="+y+"&IDEREP="+iderep+"'><IMG height='25px' title='Eliminar' SRC='../imagenes/eliminar.png'></td></tr>";

            }
        }
           document.getElementById("propuestas").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//---------------------------------------------------------------------------------------------------
//CARGAR PROPUESTAS EN TABLA
function cargar_medidas_mitigacion(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_propuestas.php?IDERIE="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            var idepro;
            var iderep;

            if (array.length==0){
               out+="<h4>NO EXISTEN PROPUESTAS DE MITIGACIÓN AUN</h4>";
            }else{
            for (i = 0; i < array.length; i++) {
                idepro=array[i].IDEPRO;
                iderep=array[i].PELRIE;
                estpro=array[i].ESTPRO;
                out+="<tr><td style='border-bottom: 1px solid #000;width:300px;'><a  style='color:black;' href=javascript:openventana_var('.ventana_12',"+idepro+",'IDPRO',2);>"+
                array[i].DESPRO+"</a></td><td style='border-bottom: 1px solid #000;width:80px;'><a  style='color:black;' href=javascript:openventana_var('.ventana_22',"+idepro+",'IDEPRO22',2);>"+
                array[i].ESTPRO+"</a></td><td align='center' style='border-bottom: 1px solid #000;' width='10%'><a href='../gestion/query/baja_pro.php?IDEPRO="+idepro+"&IDERIE="+y+"&IDEREP="+iderep+"'><IMG height='25px' title='Eliminar' SRC='../imagenes/eliminar.png'></td></tr>";

            }
        }
           document.getElementById("medidas_mitigacion").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-----------------------------------------------------------------------------------------------------
//CARGAR RESPONSABLE EN ASIGNAR
function cargar_responsable_asignar(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_res_asignar.php?IDEPRO="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            if (array.length==0){
              out2="<br><h4>NO HAY RESPONSABLE</h4><br>"
              document.getElementById("dat_responsable_asignar").innerHTML=out2;
            }else{
            for (i = 0; i < array.length; i++) {
                out+="<tr><td>"+
                array[i].NOMEMP+" "+
                array[i].APPEMP+" "+
                array[i].APMEMP+"</td><td>"+
                array[i].NOMCAR+" / "+array[i].NOMCOO+"</td></tr>";
            }
            
           document.getElementById("dat_responsable_asignar").innerHTML=out;
           }
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
//CARGAR RESPONSABLES DE EJECUTAR MEDIDAS DE MITIGACION
//----------------------------------------------------------------------
function cargar_responsable_ejecutar(x){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_res.php?IDEPRO="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            var boton_correo;
            if (array.length==0){
              out2="<br><h4>NO HAY RESPONSABLES</h4><br>"
              document.getElementById("dat_responsable_ejecutar").innerHTML=out2;
            }else{
            for (i = 0; i < array.length; i++) {
                var ideres=array[i].IDERES;
                var iderep=array[i].PELRIE;
                var iderie=array[i].IDERIE;
                var feclim=array[i].FECLIM;
                var fecnot=array[i].FECNOT;
                if (fecnot==null){
                    boton_correo="<td align='center'><a href='query/correo_res.php?ide="+ideres+"&IDERIE="+iderie+"&IDEREP="+iderep+
                "'><IMG height='25px' title='Notificar al responsable' SRC='../imagenes/correo.png'></td>";
                }else{
                    boton_correo="<td align='center'>"+fecnot+"</td>";
                }
                out+="<tr><td>"+
                array[i].NOMEMP+" "+
                array[i].APPEMP+" "+
                array[i].APMEMP+"</td><td>"+
                array[i].NOMCAR+" / "+array[i].NOMCOO+"</td><td align='center'>"+feclim+
                "</td>"+boton_correo+"<td align='center'><a href='../gestion/query/baja_res.php?IDERIE="+iderie+"&IDEREP="+iderep+"&IDERES="+ideres+"'><IMG height='25px' title='Eliminar' SRC='../imagenes/eliminar.png'></td></tr>";
            }
            
           document.getElementById("dat_responsable_ejecutar").innerHTML=out;
           }
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//FUNCIONES PARA ELIMINAR SIN CERRAR VENTANAS MODALES

function eliminar(){
var dataString = 'desc='+$('#desc').val()+'&IDERIE_PRO='+$('#IDERIE_PRO').val()+'&IDEREP_PRO='+$('#IDEREP_PRO').val();
            $.ajax({
                type: "POST",
                url:"query/alta_pro.php",
                data: dataString,
                success: function(data){
                  cerrarventana('.ventana_15');
                  cargar_propuestas_iniciales($('#IDERIE_PRO').val());
                  $(form).find("#enviar_pro").removeAttr("disabled").attr("value","Guardar");
                  //location.reload();
                   
                }
            });
}

// CHECKBOX PARA TAXONOMIA

function settaxonomia(id){
  if(this.checked) {
      cargar_top('top');
      
  }else{

     
  }
}

///-----------------------------------------------------------------
function filtro_jun(){
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
  
  col_0: 'select',
  col_4: 'none',
  col_5: 'none',
  col_6: 'none',
  col_7: 'none',
  col_8: 'none',
  col_9: 'none',
  watermark: ['', '', '', '', '' ,'','','','',''],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_jcont', filtersConfig,2);
tf.init();
}
///-----------------------------------------------------------------
function filtro_par(){
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
  

  col_1: 'none',
  col_2: 'none',
  watermark: ['', '', '', '', '' ,'','','','',''],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_jcont', filtersConfig,2);
tf.init();
}

function cargar_editar_lugar(idejun){
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_lug.php?IDEJUN="+idejun;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out;

            for (i = 0; i < array.length; i++) {
             out=array[i].LUGJUN;
            }
         document.getElementById("lugar").innerHTML=out;

      
      
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//CARGAR DOCUMENTOS
function cargar_docs(idjun,idtable){
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_doc.php?IDEJUN="+idjun;
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
//---------------------------------------------------------------------------------------------------
//CARGAR PROPUESTAS EN TABLA
function cargar_propuestas(x){
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_propuestas.php?IDETEM="+x;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            var despro;
            var tiepro;
            var estpro;
            var respro;
            var idepro;
            var idetem;

            if (array.length==0){
               out+="<h4>NO EXISTEN PROPUESTAS</h4>";
            }else{
            for (i = 0; i < array.length; i++) {
                despro=array[i].DESPRO;
                tiepro=array[i].TIEPRO;
                estpro=array[i].ESTPRO;
                respro=array[i].NOMEMP+" "+array[i].APPEMP+" "+array[i].APMEMP;
                idepro=array[i].IDEPRO;
                idetem=array[i].TEMPRO;
                out+="<tr><td style='border-bottom: 1px solid #000;width:400px;'>"+
                despro+"</td><td style='border-bottom: 1px solid #000;width:100px;' align='center'>"+
                respro+"</td><td align='center' style='border-bottom: 1px solid #000;width:30px;'>"+
                tiepro+"</td><td align='center' style='border-bottom: 1px solid #000;width:30px;'><a style='color:black;' href=javascript:openventana_var('.ventana_3',"+idepro+",'IDEPRO3'); >"+
                estpro+"</a></td><td align='center' style='border-bottom: 1px solid #000;width:30px;'><a href='query/baja_pro.php?IDEPRO="+idepro+"&IDETEM="+idetem+"' ><IMG height='20px' SRC='../imagenes/eliminar.png'></a></td></tr>";

            }
        }
           document.getElementById("propuestas").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

function cargar_editar_propuesta_juntas(idepro){
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_pro.php?IDEPRO="+idepro;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out;

            for (i = 0; i < array.length; i++) {
             out=array[i].DESPRO;
            }
         document.getElementById("propuesta5").innerHTML=out;

      
      
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}