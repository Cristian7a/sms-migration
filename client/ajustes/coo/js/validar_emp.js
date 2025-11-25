$(function(){
	

	$("#form_emp").validate({
		
			rules: {
                    "area": {
                        "required": true,
                    },
                    "pue_emp": {
                        "required": true,
                    },
                    "app_emp": {
                        "required": true,
                    },
                    "apm_emp": {
                        "required": true,
                    },
                    "nom_emp": {
                        "required": true,           
                    },
                    "cel_emp": {
                        "required": true,               
                    },
                    "tel_emp": {
                        "required": true,               
                    },

		},
				messages: { 
					"area": "Elija un área",
                    "pue_emp":  "Elija un puesto",
                    "app_emp":  "Proporcione un apellido paterno",
                    "apm_emp":  "Proporcione un apellido materno",
                    "nom_emp":  "Proporcione un nombre",
                    "cel_emp":  "Proporcione un teléfono celular",
                    "tel_emp":  "Proporcione un teléfono",
	
                },
		
	
		submitHandler: function(form)
		{
			

			$(form).find("#enviar_emp").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'area='+$('#area').val()+'&pue_emp='+$('#pue_emp').val()+'&app_emp='+$('#app_emp').val()+'&apm_emp='+$('#apm_emp').val()+'&nom_emp='+$('#nom_emp').val()+'&ema_emp='+$('#ema_emp').val()+'&cel_emp='+$('#cel_emp').val()+'&cel2_emp='+$('#cel2_emp').val()+'&tel_emp='+$('#tel_emp').val()+'&tel2_emp='+$('#tel2_emp').val()+'&ext_emp='+$('#ext_emp').val();
            $.ajax({
                type: "POST",
                url:"query/alta_emp.php",
                data: dataString,
                success: function(data){

                    location.reload();
                   
                }
            });
        }
	});
    });

