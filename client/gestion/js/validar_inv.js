$(function(){
	

	$("#form_inv").validate({
		
			rules: {
                    "area1": {
                        "required": true,
                    },
                    "emp1": {
                        "required": true,
                    },
			
		},
				messages: { 
                    "area1":  "Seleccione un area",
                    "emp1":  "Seleccione un involucrado",
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_inv").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'area1='+$('#area1').val()+'&emp1='+$('#emp1').val()+'&IDEREP='+$('#IDEREP').val()+'&IDEPRO_INV='+$('#IDEPRO_INV').val();
            $.ajax({
                type: "POST",
                url:"query/alta_inv.php",
                data: dataString,
                success: function(data){ 
                    //location.reload();
                  cerrarventana('.ventana_8');
                  cargar_inv($('#IDEPRO_INV').val());
                  $(form).find("#enviar_inv").removeAttr("disabled").attr("value","Guardar");
                   
                }
            });
        }
	});

});
