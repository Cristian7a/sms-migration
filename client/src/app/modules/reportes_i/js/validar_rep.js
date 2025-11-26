$(function(){
	

	$("#form_rep").validate({
		
			rules: {
                    "area": {
                        "required": true
                    },
                    "emp": {
                        "required": true,
                    },
                    "fecsus": {
                        "required": true,
                    },
                    "fecrep": {
                        "required": true,
                    },
                    "lugsus": {
                        "required": true,           
                    },
                    "obs": {
						 "maxlength": "300",		
                    },
			
		},
				messages: { 
					"area": " Elija un areá",
                    "emp":  "Elija un nombre",
                    "fecsus":  "Elija una fecha de suceso",
                    "fecrep":  "Elija una fecha de reporte",
                    "lugsus":  "Elija un lugar del suceso",
					"obs": {
						 "maxlength": " Maximo 100 caracteres",
					},
					
					
					
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'area='+$('#area').val()+'&emp='+$('#emp').val()+'&con='+$('#con').val()+'&fecsus='+$('#fecsus').val()+'&fecrep='+$('#fecrep').val()+'&lugsus='+$('#lugsus').val()+'&obs='+$('#obs').val()+'&freeve='+$('#freeve').val();
            $.ajax({
                type: "POST",
                url:"query/alta_rep.php",
                data: dataString,
                success: function(data){

                    location.reload();
                   
                }
            });
        }
	});

});
