$(function(){
	

	$("#formregistro_taxonomia").validate({
		
			rules: {
                    "ejemplo_taxonomia": {
                        "required": true,
                    },
                    
			
		},
				messages: { 
                    "ejemplo_taxonomia":  "Introduzca un peligro genérico",
                    
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_taxonomia").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'ejemplo_taxonomia='+$('#ejemplo_taxonomia').val()+'&IDETAC_NUEVO='+$('#IDETAC_NUEVO').val();
            $.ajax({
                type: "POST",
                url:"query/alta_ejemplo_taxonomia.php",
                data: dataString,
                success: function(data){
                    cerrarventana('.ventana_19');
                    $(form).find("#enviar_taxonomia").removeAttr("disabled").attr("value","Guardar");
                  $(form).find("#ide_gen").reload();
                }
            });
        }
	});

});
