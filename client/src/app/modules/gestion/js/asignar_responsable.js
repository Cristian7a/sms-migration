$(document).ready(function () {
  function cargarEmpleados(areaId) {
    $("#emp_res_asignar").html('<option value="">Cargando...</option>');

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
        $("#emp_res_asignar").html(options);
      })
      .fail(function () {
        $("#emp_res_asignar").html('<option value="">Error al cargar</option>');
      });
  }

  ReportesService.obtenerAreas().done(function (res) {
    var options = '<option value="">--ELEGIR ÁREA--</option>';
    if (res.data) {
      res.data.forEach(function (area) {
        options += `<option value="${area.id}">${area.nombre}</option>`;
      });
    }
    $("#area_res_asignar").html(options);
  });

  $("#area_res_asignar")
    .off("change")
    .on("change", function () {
      var areaSeleccionada = $(this).val();
      cargarEmpleados(areaSeleccionada);
    });

  cargarEmpleados(null);

  $("#form_res_asignar").validate({
    rules: {
      area_res_asignar: { required: true },
      emp_res_asignar: { required: true },
    },
    messages: {
      area_res_asignar: "Seleccione un área",
      emp_res_asignar: "Seleccione un empleado",
    },
    submitHandler: function (form) {
      var btn = $("#enviar_res2");
      btn.attr("disabled", true).val("Guardando...");

      var idPropuesta = $("#IDEPRO_RES2").val();
      var idEmpleado = $("#emp_res_asignar").val();

      if (!idPropuesta || idPropuesta == "0") {
        alert("Error: No se identificó la propuesta.");
        btn.attr("disabled", false).val("Guardar");
        return;
      }

      var datos = {
        propuesta_id: parseInt(idPropuesta),
        responsable_id: parseInt(idEmpleado),
      };

      GestionService.asignarResponsable(datos)
        .done(function (res) {
          alert("Responsable asignado correctamente");
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
