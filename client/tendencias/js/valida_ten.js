
    $(function(){
    

    $("#form_ten").validate({
        
            rules: {
                    "nombre": {
                        "required": true,
                        "maxlength": "100",
                    },
                    "y": {
                        "required": true,
                        "maxlength": "3",
                    },
            
        },
                messages: { 
                    "nombre": {
                         "required": "Es necesario introducir el nombre de un lugar",
                         "maxlength": " Maximo 100 caracteres",
                    },
                    "y": {
                         "required": "Proporcione un numero de incidencias",
                         "maxlength": " No puede poner un numero de ms de 5 digitos",
                    },
                    
                    
                    
                },
        
    
        submitHandler: function(form)
        {
            

            $(form).find("#enviar_ten").attr("disabled", "disabled").attr("value","Enviando...");
            var dataString = 'nombre='+$('#nombre').val()+'&y='+$('#y').val();
            $.ajax({
                type: "POST",
                url:"query/alta_ten.php",
                data: dataString,
                success: function(data){
                    location.reload();
                   
                }
            });
        }
    });

});


