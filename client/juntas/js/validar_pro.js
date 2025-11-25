$(function(){
	

	$("#form_pro").validate({
		
			rules: {
                    "des": {
                        "required": true,
                    },
                     "tie": {
                        "required": true,
                    },
                     "emp": {
                        "required": true,
                    },	
		},
				messages: { 
					"des":  "Introduzca una propuesta",
					"tie":  "Introduzca una cantidad",
                    "emp":  "Seleccione un responsable",
	
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_pro").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString ='tie='+$('#tie').val()+'&IDETEM2='+$('#IDETEM2').val()+'&des='+$('#des').val()+'&emp='+$('#emp').val();
            $.ajax({
                type: "POST",
                url:"query/alta_pro.php",
                data: dataString,
                success: function(data){
                    location.reload();
                   
                }
            });
        }
	});

});
