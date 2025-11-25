$(function(){
	

	$("#form_rea").validate({
		
			rules: {
                    "des_rea": {
                        "required": true
                    },
                    
			
		},
				messages: { 
					"des_rea": " Escriba un reactivo",	
					
					
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_rea").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'des_rea='+$('#des_rea').val()+'&IDEPRE='+$('#IDEPRE').val();
            $.ajax({
                type: "POST",
                url:"query/alta_rea.php",
                data: dataString,
                success: function(data){
                 location.reload();
                    
                   
                }
            });
        }
	});

});
