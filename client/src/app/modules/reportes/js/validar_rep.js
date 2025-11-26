$(function () {
  $("#form_rep").validate({
    rules: {
      titulo: { required: true, maxlength: 255 },
      des: { required: true },
      area: { required: true },
      emp: { required: true },
      fecsus: { required: true },
      fecrep: { required: true },
      lugsus: { required: true },
      obs: { maxlength: "300" },
    },
    messages: {
      titulo: "Ingrese un título para el reporte.",
      des: "Ingrese la descripción del reporte.",
      area: " Elija un área",
      emp: "Elija un nombre",
      fecsus: "Elija una fecha de suceso",
      fecrep: "Elija una fecha de reporte",
      lugsus: "Elija un lugar del suceso",
      obs: { maxlength: " Máximo 300 caracteres" },
    },
    submitHandler: function (form) {
      $(form)
        .find("#enviar")
        .attr("disabled", "disabled")
        .attr("value", "Enviando..."); // 1. CONSTRUCCIÓN del objeto JSON (Canonical Schema: ReporteCreateDTO) // SOLO SE ENVÍAN LOS 5 CAMPOS REQUERIDOS POR LA API DE PYTHON.

      var objetoReporte = {
        titulo: $("#titulo").val(), // Mapea a ReporteCreateDTO.titulo
        descripcion: $("#des").val(), // Mapea a ReporteCreateDTO.descripcion // CAMPOS EXISTENTES EN EL DTO

        fecha_evento: $("#fecsus").val(), // Mapea a ReporteCreateDTO.fecha_evento (Formato 'YYYY-MM-DD')
        lugar_id: parseInt($("#lugsus").val()), // Mapea a ReporteCreateDTO.lugar_id
        autor_id: parseInt($("#emp").val()), // Mapea a ReporteCreateDTO.autor_id
      }; // 2. ENVÍO a la nueva API de Python

      $.ajax({
        type: "POST",
        url: "http://localhost:5000/api/v1/reportes/", // URL correcta.
        data: JSON.stringify(objetoReporte),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
          alert("¡Reporte guardado con éxito! ID: " + data.id);
          console.log("Respuesta del Canonical Schema:", data);
          location.reload();
        },
        error: function (xhr, status, error) {
          console.error("Error de la API:", xhr.responseText);
          alert(
            "Error al conectar con la API o error de validación. Revisa la consola del navegador y la terminal de Python."
          );
          $(form)
            .find("#enviar")
            .removeAttr("disabled")
            .attr("value", "Enviar");
        },
      });
    },
  });
});
/*
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
*/
