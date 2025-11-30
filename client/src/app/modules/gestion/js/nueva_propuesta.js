$(document).ready(function () {
  $("#form_nueva_propuesta").validate({
    rules: {
      desc: { required: true },
    },
    messages: {
      desc: "Es necesario introducir una propuesta",
    },
    submitHandler: function (form) {
      var btn = $("#enviar_pro");
      btn.attr("disabled", true).val("Guardando...");

      var idRiesgo = $("#IDERIE_PRO").val();

      if (!idRiesgo || idRiesgo == "0") {
        alert("Error: No se detectó el ID del Riesgo. Recarga la página.");
        btn.attr("disabled", false).val("Guardar");
        return;
      }

      var datos = {
        riesgo_id: parseInt(idRiesgo),
        descripcion: $("#desc").val(),
      };

      GestionService.crearPropuesta(datos)
        .done(function (res) {
          alert("Propuesta agregada exitosamente");
          location.reload();
        })
        .fail(function (xhr) {
          var errorMsg = xhr.responseJSON
            ? xhr.responseJSON.error
            : "Error desconocido";
          if (Array.isArray(xhr.responseJSON))
            errorMsg = xhr.responseJSON[0].msg;

          alert("Error al guardar: " + errorMsg);
          btn.attr("disabled", false).val("Guardar");
        });
    },
  });
});
