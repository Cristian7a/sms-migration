$(function(){
	

	$("#form_rep").validate({
		
			rules: {
                    "email": {
                        "required": true
                    },
                    "fecsus": {
                        "required": true,
                    },
                    "lugsus": {
                        "required": true,           
                    },
                    
                    "obs": {
						 "maxlength": "300",		
                    },
			
		},
				messages: { 
					"email": " Escriba su correo",
                    "fecsus":  "Elija una fecha de suceso",
                    "lugsus":  "Elija un lugar del suceso",
                   
					"obs": {
						 "maxlength": " Maximo 100 caracteres",
					},
					
					
					
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'email='+$('#email').val()+'&con='+$('#con').val()+'&fecsus='+$('#fecsus').val()+'&lugsus='+$('#lugsus').val()+'&obs='+$('#obs').val()+'&freeve='+$('#freeve').val();
            $.ajax({
                type: "POST",
                url:"query/alta_rep2.php",
                data: dataString,
                success: function(data){
                 location.reload();
                    
                   
                }
            });
        }
	});

});
