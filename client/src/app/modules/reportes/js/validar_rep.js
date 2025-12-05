$(function () {
  $("#area").off("change");
  $("#emp").off("change");
  $("#lugsus").off("change");

  function llenarSelect(idSelector, promesa, keyId, keyTexto) {
    var $sel = $(idSelector);
    if ($sel.children("option").length <= 1) {
      $sel.html('<option value="">Cargando...</option>');
    }

    promesa
      .done(function (res) {
        var lista = res.data || res;

        $sel.empty().append('<option value="">-- SELECCIONE --</option>');

        if (lista && lista.length > 0) {
          $.each(lista, function (i, item) {
            var texto = item[keyTexto] || "Sin Nombre";
            var id = item[keyId];

            $sel.append('<option value="' + id + '">' + texto + "</option>");
          });
        } else {
          $sel.append('<option value="">No hay datos</option>');
        }

        $sel.prop("disabled", false);
      })
      .fail(function (xhr) {
        console.error("Error en " + idSelector, xhr);
        $sel.html('<option value="">Error de carga</option>');
      });
  }

  // Cargar Áreas
  llenarSelect("#area", ReportesService.obtenerAreas(), "id", "nombre");

  // Cargar Lugares
  llenarSelect("#lugsus", ReportesService.obtenerLugares(), "id", "nombre");

  // Cargar Empleados
  llenarSelect(
    "#emp",
    ReportesService.obtenerEmpleados(),
    "id",
    "nombre_completo"
  );

  if ($("#form_rep").data("validator")) {
    $("#form_rep").data("validator").destroy();
  }

  $("#form_rep").validate({
    rules: {
      area: { required: true },
      emp: { required: true },
      fecsus: { required: true },
      fecrep: { required: true },
      lugsus: { required: true },
      obs: { maxlength: 300 },
    },
    messages: {
      area: "Seleccione un área",
      emp: "Seleccione un empleado",
      fecsus: "Indique la fecha",
      fecrep: "Indique la fecha",
      lugsus: "Indique el lugar",
      obs: { maxlength: "Máximo 300 caracteres" },
    },
    submitHandler: function (form) {
      var $btn = $(form).find("#enviar");
      $btn.attr("disabled", true).val("Guardando...");

      var datosDTO = {
        descripcion: $("#obs").val() || "",
        fecha_evento: $("#fecsus").val(),
        fecha_reporte: $("#fecrep").val(),
        autor_id: parseInt($("#emp").val()) || null,
        confidencial: parseInt($("#con").val()) || 0,
        lugar_id: parseInt($("#lugsus").val()) || null,
        frecuencia: $("#freeve").val() || "NINGUNA",
      };

      ReportesService.crear(datosDTO)
        .done(function () {
          alert("¡Guardado correctamente!");
          window.location.reload();
        })
        .fail(function (xhr) {
          var msg = xhr.responseJSON
            ? xhr.responseJSON.message || xhr.responseJSON.error
            : "Error desconocido";
          alert("Error: " + msg);
          $btn.attr("disabled", false).val("Guardar");
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
