$(function(){
	

	$("#form_par").validate({
		
			rules: {
                    "emp": {
                        "required": true,
                    },
			
		},
				messages: { 
					"emp":  "Es necesario seleccionar a alguien",
	
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'emp='+$('#emp').val()+'&ide='+$('#ide').val();
            $.ajax({
                type: "POST",
                url:"query/alta_par.php",
                data: dataString,
                success: function(data){
                    location.reload();
                   
                }
            });
        }
	});

});
