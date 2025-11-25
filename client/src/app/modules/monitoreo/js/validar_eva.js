$(function(){
	

	$("#form_eva").validate({
		
			rules: {
                    "gra": {
                        "required": true,
                    },
                    "pro": {
                        "required": true,
                    },
			
		},
				messages: { 
					"gra": {
                         "required": "Selecciona una gravedad",
					},
					"pro": {
                         "required": "Selecciona una probabilidad",
					},
					
					
					
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_eva").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString ='gra='+$('#gra').val()+'&pro='+$('#pro').val()+'&IDEPRO='+$('#IDEPRO').val();
            $.ajax({
                type: "POST",
                url:"query/alta_eva.php",
                data: dataString,
                success: function(data){
                    location.reload();
                   
                }
            });
        }
	});

});
