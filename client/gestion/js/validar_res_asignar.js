$(function(){
	

	$("#form_res_asignar").validate({
		
			rules: {
                    "area_res_asignar": {
                        "required": true,
                    },
                    "emp_res_asignar": {
                        "required": true,
                    },
                   
		},
				messages: { 
                    "area_res_asignar":  "Seleccione un area",
                    "emp_res_asignar":  "Seleccione un involucrado",
                    
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_res2").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'area_res_asignar='+$('#area_res_asignar').val()+'&emp_res_asignar='+$('#emp_res_asignar').val()+'&IDEPRO_RES2='+$('#IDEPRO_RES2').val();
            $.ajax({
                type: "POST",
                url:"query/alta_res_asignar.php",
                data: dataString,
                success: function(data){
                    location.reload();
                    /*cerrarventana('.ventana_16');
                  cargar_responsable_asignar($('#IDEPRO_RES2').val());
                  $(form).find("#enviar_res2").removeAttr("disabled").attr("value","Guardar");*/

                }
            });
        }
	});

});
