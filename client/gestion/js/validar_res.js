$(function(){
	

	$("#form_res").validate({
		
			rules: {
                    "area_res": {
                        "required": true,
                    },
                    "emp_res": {
                        "required": true,
                    },
                    "feclim_res": {
                        "required": true,
                    },
			
		},
				messages: { 
                    "area_res":  "Seleccione un area",
                    "emp_res":  "Seleccione un involucrado",
                    "feclim_res":  "Inserte fecha limite de entrega de la acción o documento",
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_res").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'area_res='+$('#area_res').val()+'&emp_res='+$('#emp_res').val()+'&IDEREP_RES='+$('#IDEREP_RES').val()+'&IDERIE_RES='+$('#IDERIE_RES').val()+'&IDEPRO_RES='+$('#IDEPRO_RES').val()+'&feclim_res='+$('#feclim_res').val();
            $.ajax({
                type: "POST",
                url:"query/alta_res.php",
                data: dataString,
                success: function(data){
                   location.reload();
                   /*
                   cerrarventana('.ventana_17');
                  cargar_responsable_ejecutar($('#IDEPRO_RES').val());
                  $(form).find("#enviar_res").removeAttr("disabled").attr("value","Agregar"); */

                }
            });
        }
	});

});
