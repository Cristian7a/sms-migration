$(function(){
	

	$("#form_comen").validate({
		
			rules: {
                    "comentario": {
                        "required": true,
                    },
			
		},
				messages: { 
					"comentario":  "Es necesario introducir un comentario",
	
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_comen").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'comentario='+$('#comentario').val()+'&IDERIE3='+$('#IDERIE3').val()+'&IDEREP3='+$('#IDEREP3').val();
            $.ajax({
                type: "POST",
                url:"query/alta_com.php",
                data: dataString,
                success: function(data){
                    location.reload();
                   
                }
            });
        }
	});

});
