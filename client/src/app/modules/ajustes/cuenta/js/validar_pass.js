$(function(){
	

	$("#form_pass").validate({
		
			rules: {
                    "pass": {
                        "required": true,
                        "minlength": 8,
                        "maxlength": 15
                    },
                    "pass2": {
                        "required": true,
                        "equalTo":"#pass"
                    },
			
		},
				messages: { 
					"pass": {
                         "required": " Escriba su contraseña",
                         "minlength": " Minimo 8 caracteres",
                         "maxlength": " Maximo 15 caracteres",
                    },
                   "pass2": {
						 "required": " Repita su contraseña",
                         "equalTo": "Las contraseñas no coinciden"
					},
					
					
					
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'pass='+$('#pass').val()+'&pass2='+$('#pass2').val();
            $.ajax({
                type: "POST",
                url:"query/mod_pass.php",
                data: dataString,
                success: function(data){

                    location.reload();
                   
                }
            });
        }
	});

});
