$(function(){
	

	$("#form_lug").validate({
		
			rules: {
                    "nom": {
                        "required": true,
                        "maxlength": "100",
                    },
			
		},
				messages: { 
					"nom": {
                         "required": "Es necesario introducir el nombre de un lugar",
						 "maxlength": " Maximo 100 caracteres",
					},
					
					
					
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_lug").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'nom='+$('#nom').val();
            $.ajax({
                type: "POST",
                url:"query/alta_lug.php",
                data: dataString,
                success: function(data){
                    
                    cerrarventana('.ventana_3');
                    location.reload();
                   
                }
            });
        }
	});

});
