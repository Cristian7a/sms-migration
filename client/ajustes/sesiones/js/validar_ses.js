$(function(){
	

	$("#form_ses").validate({
		
			rules: {
                    "area": {
                        "required": true
                    },
                    "emp": {
                        "required": true,
                    },
                    "pri": {
                        "required": true,
                    },
                    "pass": {
                        "required": true,
                    },
                    
			
		},
				messages: { 
					"area": " Elija un areá",
                    "emp":  "Elija un nombre",
                    "pri":  "Elija un privilegio",
                    "pass":  "Introduzca una contraseña",
                   
					
					
					
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'area='+$('#area').val()+'&emp='+$('#emp').val()+'&pri='+$('#pri').val()+'&pass='+$('#pass').val();
            $.ajax({
                type: "POST",
                url:"query/alta_ses.php",
                data: dataString,
                success: function(data){

                    location.reload();
                   
                }
            });
        }
	});

});
