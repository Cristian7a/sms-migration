$(function () {
  $("#form_pro").validate({
    rules: {
      desc: {
        required: true,
      },
    },
    messages: {
      desc: "Es necesario introducir una propuesta",
    },

    submitHandler: function (form) {
      $(form)
        .find("#enviar_pro")
        .attr("disabled", "disabled")
        .attr("value", "Enviando...");

      var datos = {
        reporte_id: parseInt($("#IDEREP_PRO").val()), // Asegúrate de tener el ID del reporte
        descripcion: $("#desc").val(),
        // La API nueva no requiere IDERIE_PRO forzosamente si es creación automática,
        // pero si tu lógica de negocio requiere ligarlo a un riesgo específico,
        // el backend debe soportarlo.
        // Por ahora el backend crea riesgo general si no existe.
      };

      GestionService.crearPropuesta(datos)
        .done(function (data) {
          cerrarventana(".ventana_15");
          // cargar_propuestas_iniciales($('#IDERIE_PRO').val()); // Esta función legacy tal vez necesite ajuste
          location.reload();
        })
        .fail(function (xhr) {
          alert("Error al crear propuesta");
          $(form)
            .find("#enviar_pro")
            .removeAttr("disabled")
            .attr("value", "Guardar");
        });
    },
  });
});
