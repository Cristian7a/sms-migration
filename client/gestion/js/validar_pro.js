$(function(){
	

	$("#form_pro").validate({
		
			rules: {
                    "desc": {
                        "required": true,
                    },
			
		},
				messages: { 
					"desc":  "Es necesario introducir una propuesta",
	
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_pro").attr("disabled", "disabled").attr("value","Enviando...");
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
	});

});


