$(function(){
	

	$("#form_compo").validate({
		
			rules: {
                    "com": {
                        "required": true,
                    },
                    "des": {
                        "required": true,
                    },
                    "cons": {
                        "required": true,
                    },
                    "gra": {
                        "required": true,
                    },
                    "pro": {
                        "required": true,           
                    },
			
		},
				messages: { 
                    "com":  "Introduzca un componente",
                    "des":  "Introduzca una descripción",
                    "cons":  "Introduzca una consecuencia",
                    "gra":  "Elija una gravedad",
                    "pro":  "Elija una probablilidad",
	
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_compo").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'com='+$('#com').val()+'&des='+$('#des').val()+'&cons='+$('#cons').val()+'&gra='+$('#gra').val()+'&pro='+$('#pro').val()+'&IDEREP2='+$('#IDEREP2').val();
            $.ajax({
                type: "POST",
                url:"query/alta_rie.php",
                data: dataString,
                success: function(data){
                    location.reload(); 
                }
            });
        }
	});

});
