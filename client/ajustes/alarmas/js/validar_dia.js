$(function(){
	

	$("#form_dia").validate({
		
			rules: {
                    "per": {
                        "required": true
                    },
                    "fecini": {
                        "required": true,
                    },
                    "fecfin": {
                        "required": true,
                    },
                    "exa": {
                        "required": true,
                    },
		},
				messages: { 
					"per": " Elija una opción",
                    "fecini":  "Elija una opción",
                    "fecfin":  "Elija una opción",
                    "exa":  "Elija una opción",
                   
					
					
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_dia").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'per='+$('#per').val()+'&fecini='+$('#fecini').val()+'&fecfin='+$('#fecfin').val()+'&exa='+$('#exa').val();
            $.ajax({
                type: "POST",
                url:"query/alta_dia.php",
                data: dataString,
                success: function(data){

                    location.reload();
                   
                }
            });
        }
	});

});
