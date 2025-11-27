$(function () {
  $("#form_ges").validate({
    rules: {
      con: {
        required: true,
        maxlength: 100,
      },
      obj: {
        required: true,
        maxlength: 100,
      },
      act: {
        required: true,
        maxlength: 100,
      },
      cat: {
        required: true,
      },
      met_ide: {
        required: true,
      },
      rie_ope: {
        required: true,
      },
      ide_gen: {
        required: true,
      },
    },
    messages: {
      con: {
        required: "Introduzca una condición",
        maxlength: " Maximo 40 caracteres",
      },
      obj: {
        required: "Introduzca un objeto",
        maxlength: " Maximo 20 caracteres",
      },
      act: {
        required: "Introduzca una actividad",
        maxlength: " Maximo 40 caracteres",
      },
      cat: "Elija una categoria",
      met_ide: "Elija un metodo de identificación",
      rie_ope: "Elija si es un riesgo operacional o no ",
      ide_gen: "Introduzca la identificación del peligro genérico",
    },

    submitHandler: function (form) {
      $(form)
        .find("#enviar_ges")
        .attr("disabled", "disabled")
        .attr("value", "Guardando...");

      // Construir el objeto JSON para el DTO de Python
      var datos = {
        reporte_id: parseInt($("#IDEREP1").val()),
        condicion: $("#con").val(),
        objeto: $("#obj").val(),
        actividad: $("#act").val(),
        categoria: $("#cat").val(),
        metodo: $("#met_ide").val(),
        riesgo_operacional: $("#rie_ope").val(),
        generador: $("#ide_gen").val(), // Asegúrate que esto mande el texto correcto
      };

      GestionService.guardarPeligro(datos)
        .done(function (response) {
          alert("Gestión guardada exitosamente");
          location.reload();
        })
        .fail(function (xhr) {
          var errorMsg = xhr.responseJSON
            ? xhr.responseJSON.error
            : "Error desconocido";
          alert("Error: " + errorMsg);
          $(form)
            .find("#enviar_ges")
            .removeAttr("disabled")
            .attr("value", "Guardar");
        });
    },
  });
});
