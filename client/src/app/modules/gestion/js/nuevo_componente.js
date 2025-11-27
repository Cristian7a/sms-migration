$(document).ready(function () {
  // Obtener ID del reporte al abrir
  var idReporte = getParameterByName("IDEREP");
  $("#IDEREP_RIESGO").val(idReporte);

  $("#form_nuevo_riesgo").validate({
    rules: {
      com: { required: true },
      des: { required: true },
      cons: { required: true },
      pro: { required: true },
      gra: { required: true },
    },
    messages: {
      com: "Ingrese el componente",
      des: "Ingrese la descripción",
      cons: "Ingrese la consecuencia",
      pro: "Seleccione probabilidad",
      gra: "Seleccione gravedad",
    },
    submitHandler: function (form) {
      // Evitar doble envío
      $("#enviar_compo").attr("disabled", true).val("Guardando...");

      var datos = {
        reporte_id: parseInt($("#IDEREP_RIESGO").val()),
        componente: $("#com").val(),
        descripcion: $("#des").val(),
        consecuencia: $("#cons").val(),
        probabilidad: parseInt($("#pro").val()),
        gravedad: $("#gra").val(),
      };

      GestionService.crearRiesgo(datos)
        .done(function (res) {
          alert("Riesgo creado exitosamente");
          location.reload();
        })
        .fail(function (xhr) {
          var error = xhr.responseJSON
            ? xhr.responseJSON.error
            : "Error desconocido";
          alert("Error: " + error);
          $("#enviar_compo").attr("disabled", false).val("Guardar");
        });
    },
  });
});
