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
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            for (i = 0; i < array.length; i++) {
             ideemp=array[i].EMCOREP;   
             idelug=array[i].LUGREP;
             idefac=array[i].FACCAU;  
             idecau=array[i].CAUREP;
             idecoo=array[i].COOPUE;    
            }
            
            e_cargar_coo("area_e",idecoo);
            e_cargar_emp("emp_e",ideemp,idecoo)
            e_cargar_rep1(iderep);
            e_cargar_lug(idelug);
            e_cargar_fac(idefac);
            e_cargar_cau("cauesp_e",idecau,idefac);
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//FUNCION QUE CARGA EDITAR PROPUESTA
//------------------------------------------------------------
function cargar_editar_propuesta(idpro){
 
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
  
         document.getElementById("des_e").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-------------------------------------------------------------
//FUNCION QUE CARGA EDITAR GESTION O PELIGRO
//------------------------------------------------------------
function cargar_editar_gestion(idrep){
    var id=idrep;
    var xmlhttp = new XMLHttpRequest();
    var url="query/coni_pel.php?IDEREP="+id;
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
             out5="<select id='cat_e' name='cat_e'><option selected='selected' value='"+cate+"'>"+cate+"</option><option value='NATURAL'>NATURAL</option><option value='TECNICO'>TECNICO</option><option value='ECONOMICO'>ECONOMICO</option> </select>";
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
                var id=array[i].IDEEMCO;
                if(id==idemp){
                out+="<option selected='selected' value='"+
                array[i].IDEEMCO+"'>"+
                array[i].NOMEMP+" "+array[i].APPEMP+" "+array[i].APMEMP+"</option>";
                }else{
                out+="<option value='"+
                array[i].IDEEMCO+"'>"+
                array[i].NOMEMP+" "+array[i].APPEMP+" "+array[i].APMEMP+"</option>";
                }
                
            }
            
           document.getElementById(area).innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
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
                if(con=1){ sino="SI"; }

                out+="<td>Confidencial:</td> <td> <select id='con_e' name='con_e'> <option selected='selected' value='"+ conf+"'>"+sino+"</option><option value='1'>SI</option> <option value='0'>NO</option> </select></td>";
                out2+="<td>Fecha del suceso:</td><td> <input type='date' id='fecsus_e' name='fecsus_e' value='"+ array[i].FECEVE+"'/></td>"; 
                out3+="<td>Fecha del reporte:</td><td> <input type='date' id='fecrep_e' name='fecrep_e' value='"+array[i].FECREP+"'/></td>";
                out4+="<td>Observaciones:</td><td> <input type='text' id='obs_e' name='obs_e' value='"+array[i].OBSREP+"'/></td>";
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
                out+="<tr><td width='200px'><b>Fecha del reporte:</b></td><td width='500px'>"+
                array[i].FECREP+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Fecha del suceso:</b>&nbsp;&nbsp;&nbsp;"+
                array[i].FECEVE+"</td></tr><tr><td><b>Lugar del suceso:</b></td><td>"+
                array[i].NOMLUG+"</td></tr><tr><td><b>Factor:</b></td><td>"+
                array[i].TIPFAC+"</td></tr><tr><td><b>Causa especifica:</b></td><td>"+
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
                out+="<tr><td><b>Fecha del reporte: </b>"+
                array[i].FECREP+"</td><td><b>Fecha del suceso: </b>"+
                array[i].FECEVE+"</td><td><b>Lugar del suceso: </b>"+
                array[i].NOMLUG+"</td><td><b>Factor: </b>"+
                array[i].TIPFAC+"</td></tr><tr><td colspan='2'><b>Causa especifica: </b>"+
                array[i].TIPCAU+"</td><td><b>Frecuencia: </b>"+
                array[i].FREREP+"</td><td><b>Observaciones: </b>"+
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
                out+="<tr><td><b>Nombre:<br> </b>"+
                array[i].NOMEMP+" "+array[i].APPEMP+" "+array[i].APMEMP+"</td><td><b>Email:<br> </b>"+
                array[i].EMAEMP+"</td><td><b>Celular:<br> </b>"+
                array[i].CELEMP+"/"+array[i].CEL2EMP+"</td><td><b>Telefono Oficina:<br> </b>"+
                array[i].TELOFIEMP+"/"+array[i].TELOFI2EMP+"</td><td><b>Ext:<br> </b>"+
                array[i].EXTEMP+"</td><td><b>Coordinación:<br> </b>"+
                array[i].NOMPUE+" / "+array[i].NOMCOO+"</td></tr>";
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
                out+="<tr><td><b>Peligro genérico:<br> </b>"+
                array[i].GENPEL+"</td><td><b>Condición:<br> </b>"+
                array[i].CONPEL+"</td><td><b>Objeto:<br> </b>"+
                array[i].OBJPEL+"</td><td><b>Actividad:<br> </b>"+
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
            for (i = 0; i < array.length; i++) {
                iderie=array[i].IDERIE;
                out+="<tr><td>"+
                array[i].CESPRIE+"</td><td>"+
                array[i].DESRIE+"</td><td>"+
                array[i].CONRIE+"</td><td style='text-align: center;'> "+
                array[i].PROBRIE+array[i].GRARIE+"</td><td align='center'><a href='../gestion/propuestas.php?IDEREP="+y+"&IDERIE="+iderie+"'><IMG height='25px'  SRC='../imagenes/prop.png'></a></td>"+
                "<td align='center'><a href='../gestion/query/baja_com.php?IDERIE="+iderie+"&IDEREP="+y+"'><IMG height='25px' title='Eliminar' SRC='../imagenes/eliminar.png'></td></tr>";
            }
            
           document.getElementById("rie").innerHTML=out;
        } 

    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

//-----------------------------------------------------------------------------------------------------
//INVOLUCRADOS EN LAS PROPUESTAS
function cargar_inv(x,rep){
    var y=x;
    var xmlhttp = new XMLHttpRequest();
    var url="query/con_inv.php?IDERIE="+y;
    xmlhttp.onreadystatechange=function() { 
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200){ 
            var array=JSON.parse(xmlhttp.responseText);
            var i;
            var out="";
            if (array.length==0){
              out2="<h4>NO EXISTEN COORDINACIONES INVOLUCRADAS AUN</h4>"
              document.getElementById("inv").innerHTML=out2;
            }
            for (i = 0; i < array.length; i++) {
                out+="<thead style='color: #fff;'><tr><td style='background:#2672EC;'>NOMBRE</td><td style='background:#2672EC;'>PUESTO / COORDINACIÓN</td><td style='background:#2672EC;'></td></tr></thead>";
                var ideinv=array[i].IDEINV;
                out+="<tr><td>"+
                array[i].NOMEMP+" "+
                array[i].APPEMP+" "+
                array[i].APMEMP+"</td><td>"+
                array[i].NOMPUE+" / "+array[i].NOMCOO+"</td><td align='center'><a href='../gestion/query/baja_inv.php?IDERIE="+y+"&IDEREP="+rep+"&IDEINV="+ideinv+"'><IMG height='25px' title='Eliminar' SRC='../imagenes/eliminar.png'></td></tr>";
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
                array[i].NOMPUE+" / "+array[i].NOMCOO+"</td><td align='center'><a href='../gestion/query/baja_res.php?IDERIE="+rie+"&IDEREP="+rep+"&IDEINV="+ideres+"'><IMG height='25px' title='Eliminar' SRC='../imagenes/eliminar.png'></td></tr>";
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
                out+="<tr><td><b>Peligro genérico:<br> </b>"+
                array[i].GENPEL+"</td><td><b>Componente especifico:<br> </b>"+
                array[i].CESPRIE+"</td><td><b>Consecuencia:<br> </b>"+
                array[i].CONRIE+"</td><td><b>Periodo de tolerancia:<br> </b>"+
                array[i].PROBRIE+""+array[i].GRARIE+"</td></tr>";
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
  col_6: 'select',
  col_7: 'select',
  col_9: 'none',
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
  col_widths: [
    '100px', '30px', '100px',
    '70px', '200px', '70px',
    '70px', '60px', '60px',
    '60px','60px'
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
  col_types: [
        'string', 'number', 'date',
        'string', 'string', 'string', 'string'
    ],

  col_0: 'select',
  col_3: 'select',
  col_4: 'select',
  col_5: 'select',
  col_6: 'select',
  col_10: 'none',
  watermark: ['', 'No.', 'Fecha', '', '' ,'','','Fecha','Nombre','Peligro'],
  extensions: [{
    name: 'sort',
    images_path: '../TableFilter-master/dist/tablefilter/style/themes/'
  }]
};

var tf = new TableFilter('tabla_ges', filtersConfig,2);
tf.init();
}