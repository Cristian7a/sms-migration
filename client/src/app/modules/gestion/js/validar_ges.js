$(function(){
	

	$("#form_ges").validate({
		
			rules: {
                    "con": {
                        "required": true,
                        "maxlength": 100,
                    },
                    "obj": {
                        "required": true,
                        "maxlength": 100,
                    },
                    "act": {
                        "required": true,
                        "maxlength": 100,
                    },
                    "cat": {
                        "required": true,
                    },
                    "met_ide": {
                        "required": true,           
                    },
                    "rie_ope": {
                        "required": true,
                    },
                    "ide_gen": {
                        "required": true,				
                    },
			
		},
				messages: { 
					"con": {
                         "required": "Introduzca una condición",
                         "maxlength": " Maximo 40 caracteres",
                    },
                    "obj": {
                         "required": "Introduzca un objeto",
                         "maxlength": " Maximo 20 caracteres",
                    },
                    "act": {
                         "required": "Introduzca una actividad",
                         "maxlength": " Maximo 40 caracteres",
                    },
                    "cat":  "Elija una categoria",
                    "met_ide":  "Elija un metodo de identificación",
                    "rie_ope":  "Elija si es un riesgo operacional o no ",
                    "ide_gen":  "Introduzca la identificación del peligro genérico",
	
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_ges").attr("disabled", "disabled").attr("value","Guardando...");
            var dataString = 'con='+$('#con').val()+'&obj='+$('#obj').val()+'&act='+$('#act').val()+'&cat='+$('#cat').val()+'&met_ide='+$('#met_ide').val()+'&rie_ope='+$('#rie_ope').val()+'&ide_gen='+$('#ide_gen').val()+'&IDEREP1='+$('#IDEREP1').val();
            $.ajax({
                type: "POST",
                url:"query/alta_ges.php",
                data: dataString,
                success: function(data){
                    location.reload();
                   
                }
            });
        }
	});

});
