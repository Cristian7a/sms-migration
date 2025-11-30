$(document).ready(function () {
  function cargarEmpleados(areaId) {
    $("#emp_res").html('<option value="">Cargando...</option>');

    ReportesService.obtenerEmpleados(areaId)
      .done(function (res) {
        var options = '<option value="">--ELEGIR EMPLEADO--</option>';
        if (res.data && res.data.length > 0) {
          res.data.forEach(function (emp) {
            options += `<option value="${emp.id}">${emp.nombre_completo}</option>`;
          });
        } else {
          options = '<option value="">No hay empleados en esta área</option>';
        }
        $("#emp_res").html(options);
      })
      .fail(function (err) {
        console.error("Error API empleados:", err);
      });
  }

  ReportesService.obtenerAreas().done(function (res) {
    var options = '<option value="">--ELEGIR ÁREA--</option>';
    if (res.data) {
      res.data.forEach(function (area) {
        options += `<option value="${area.id}">${area.nombre}</option>`;
      });
    }
    $("#area_res").html(options);
  });

  $("#area_res")
    .off("change")
    .on("change", function () {
      cargarEmpleados($(this).val());
    });

  $("#form_res").validate({
    rules: {
      area_res: { required: true },
      emp_res: { required: true },
      feclim_res: { required: true },
    },
    messages: {
      area_res: "Seleccione un área",
      emp_res: "Seleccione un empleado",
      feclim_res: "Ingrese fecha límite",
    },
    submitHandler: function (form) {
      var btn = $("#enviar_res");
      btn.attr("disabled", true).val("Guardando...");

      var idPropuesta = $("#IDEPRO_RES").val();

      if (!idPropuesta || idPropuesta == "0" || idPropuesta == "") {
        alert("Error: No se identificó la propuesta. (ID=" + idPropuesta + ")");
        btn.attr("disabled", false).val("Guardar");
        return;
      }

      var datos = {
        propuesta_id: parseInt(idPropuesta),
        empleado_id: parseInt($("#emp_res").val()),
        fecha_limite: $("#feclim_res").val(),
      };

      GestionService.asignarEjecutor(datos)
        .done(function (res) {
          alert("Ejecutor asignado correctamente");
          location.reload();
        })
        .fail(function (xhr) {
          var errorMsg = xhr.responseJSON
            ? xhr.responseJSON.error
            : "Error desconocido";
          alert("Error: " + errorMsg);
          btn.attr("disabled", false).val("Guardar");
        });
    },
  });
});
