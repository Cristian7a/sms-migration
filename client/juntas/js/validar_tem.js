$(function(){
	

	$("#form_tem").validate({
		
			rules: {
                    "tem": {
                        "required": true,
                    },
			
		},
				messages: { 
					"tem":  "Introduzca un tema",
	
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_tem").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'tem='+$('#tem').val()+'&IDEJUN='+$('#IDEJUN').val();
            $.ajax({
                type: "POST",
                url:"query/alta_tem.php",
                data: dataString,
                success: function(data){
                    location.reload();
                   
                }
            });
        }
	});

});
