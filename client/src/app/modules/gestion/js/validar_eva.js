$(function(){
	

	$("#form_rev_eva").validate({
		
			rules: {
                    "pro_rev": {
                        "required": true,
                    },
                    "gra_rev": {
                        "required": true,
                    },

			
		},
				messages: { 
                    "pro_rev":  "Selecciona una probabilidad",
                    "gra_rev":  "Selecciona una gravedad",
                },
		
	
		submitHandler: function(form)
		{
			
       

       $(form).find("#enviar_rev_eva").attr("disabled", "disabled").attr("value","Enviando...");

            var dataString = 'pro_rev='+$('#pro_rev').val()+'&gra_rev='+$('#gra_rev').val()+'&IDRIEEVA='+$('#IDRIEEVA').val();

            $.ajax({
                type: "POST",
                url:"query/eva.php",
                data: dataString,
                success: function(data){
                  location.reload();
                   
                   
                }
            });

        }
	});

});
