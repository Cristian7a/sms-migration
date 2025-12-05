$(function () {
  $("#form_ges").validate({
    rules: {
      con: { required: true, maxlength: 100 },
      obj: { required: true, maxlength: 100 },
      act: { required: true, maxlength: 100 },
      cat: { required: true },
      met_ide: { required: true },
      rie_ope: { required: true },
      ide_gen: { required: true },
    },
    messages: {
      con: {
        required: "Introduzca una condición",
        maxlength: "Máximo 100 caracteres",
      },
      obj: {
        required: "Introduzca un objeto",
        maxlength: "Máximo 100 caracteres",
      },
      act: {
        required: "Introduzca una actividad",
        maxlength: "Máximo 100 caracteres",
      },
      cat: "Elija una categoría",
      met_ide: "Elija un método de identificación",
      rie_ope: "Elija si es un riesgo operacional",
      ide_gen: "Introduzca la identificación del peligro genérico",
    },

    submitHandler: function (form) {
      $(form)
        .find("#enviar_ges")
        .attr("disabled", "disabled")
        .val("Guardando...");

      // Construir el DTO
      var datos = {
        reporte_id: parseInt($("#IDEREP1").val()),
        condicion: $("#con").val(),
        objeto: $("#obj").val(),
        actividad: $("#act").val(),
        categoria: $("#cat").val(),
        metodo: $("#met_ide").val(),
        riesgo_operacional: $("#rie_ope").val(),
        generador: $("#ide_gen").val(),
      };

      console.log("Enviando a Python:", datos);

      // Llamar al servicio
      GestionService.guardarPeligro(datos)
        .done(function (response) {
          alert("Gestión guardada exitosamente.");
          location.reload();
        })
        .fail(function (xhr) {
          console.error("Error:", xhr);
          var errorMsg = xhr.responseJSON
            ? xhr.responseJSON.error
            : "Error desconocido";

          if (Array.isArray(xhr.responseJSON)) {
            errorMsg = "Error en datos: " + xhr.responseJSON[0].msg;
          }

          alert("Error al guardar: " + errorMsg);
          $(form).find("#enviar_ges").removeAttr("disabled").val("Guardar");
        });
    },
  });
});
