$(function(){
	

	$("#form_exa").validate({
		
			rules: {
                    "per": {
                        "required": true
                    },
                    "tip": {
                        "required": true,
                    },
                    "eva": {
                        "required": true,
                    },
		},
				messages: { 
					"per": " Elija una opción",
                    "eva":  "Elija una opción",
                    "tip":  "Elija una opción",
                   
					
					
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'per='+$('#per').val()+'&tip='+$('#tip').val()+'&eva='+$('#eva').val();
            $.ajax({
                type: "POST",
                url:"query/alta_exa.php",
                data: dataString,
                success: function(data){

                    location.reload();
                   
                }
            });
        }
	});

});
