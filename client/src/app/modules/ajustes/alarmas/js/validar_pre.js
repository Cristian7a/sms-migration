$(function(){
	

	$("#form_pre").validate({
		
			rules: {
                    "des_pre": {
                        "required": true
                    },
                    
		},
				messages: { 
					"des_pre": " Introduzca una descripción",
								
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_pre").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'des_pre='+$('#des_pre').val()+'&IDEEXA_NPRE='+$('#IDEEXA_NPRE').val();
            $.ajax({
                type: "POST",
                url:"query/alta_pre.php",
                data: dataString,
                success: function(data){

                    location.reload();
                   
                }
            });
        }
	});

});
