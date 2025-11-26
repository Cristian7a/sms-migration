$(function () {
  // ---------------------------------------------------------
  // 1. FUNCIÓN HELPER PARA LLENAR SELECTS (Reutilizable)
  // ---------------------------------------------------------
  function llenarSelect(idSelector, promesa, keyId, keyTexto) {
    var $sel = $(idSelector);
    // Mensaje inicial mientras carga
    $sel.html('<option value="">Cargando datos...</option>');

    promesa
      .done(function (res) {
        $sel
          .empty()
          .append('<option value="">Seleccione una opción...</option>');

        // Verificamos si la respuesta viene en 'data' (estándar API) o directa
        var lista = res.data || res;

        if (lista && lista.length > 0) {
          $.each(lista, function (i, item) {
            $sel.append(
              '<option value="' +
                item[keyId] +
                '">' +
                item[keyTexto] +
                "</option>"
            );
          });
        } else {
          $sel.append('<option value="">No hay datos disponibles</option>');
        }
      })
      .fail(function () {
        $sel.empty().append('<option value="">Error al cargar lista</option>');
        console.error("Error cargando selector: " + idSelector);
      });
  }

  // ---------------------------------------------------------
  // 2. EJECUTAR LA CARGA DE DATOS AL INICIAR
  // ---------------------------------------------------------
  // Estos IDs (#area, #lugsus, #emp) deben coincidir con los IDs en n_rep.html

  // Cargar Áreas
  llenarSelect("#area", ReportesService.obtenerAreas(), "id", "nombre");

  // Cargar Lugares (lugsus = lugar del suceso)
  llenarSelect("#lugsus", ReportesService.obtenerLugares(), "id", "nombre");

  // Cargar Empleados
  llenarSelect(
    "#emp",
    ReportesService.obtenerEmpleados(),
    "id",
    "nombre_completo"
  );

  // ---------------------------------------------------------
  // 3. VALIDACIÓN Y ENVÍO DEL FORMULARIO
  // ---------------------------------------------------------
  $("#form_rep").validate({
    // Reglas de validación (HTML name o ID)
    rules: {
      area: { required: true },
      emp: { required: true },
      fecsus: { required: true },
      fecrep: { required: true },
      lugsus: { required: true },
      obs: { maxlength: 300 }, // Observaciones opcional, pero con límite
    },
    // Mensajes de error para el usuario
    messages: {
      area: "Por favor, elija un área.",
      emp: "Por favor, elija un empleado responsable.",
      fecsus: "Indique la fecha del suceso.",
      fecrep: "Indique la fecha del reporte.",
      lugsus: "Indique el lugar del suceso.",
      obs: {
        maxlength: "La observación no puede exceder los 300 caracteres.",
      },
    },

    // Qué hacer cuando el formulario es válido
    submitHandler: function (form) {
      // Referencia al botón de envío para bloquearlo
      var $btn = $(form).find("#enviar");
      var btnTextoOriginal = $btn.val();

      $btn.attr("disabled", true).val("Guardando en API...");

      // -------------------------------------------------------
      // PATRÓN: Entity Abstraction / Canonical Schema
      // Convertimos los inputs del HTML al JSON que espera Python
      // -------------------------------------------------------
      var datosDTO = {
        area_id: $("#area").val(),
        empleado_id: $("#emp").val(),
        lugar_id: $("#lugsus").val(),
        fecha_suceso: $("#fecsus").val(),
        fecha_reporte: $("#fecrep").val(),
        observacion: $("#obs").val(),

        // Campos adicionales (Asegúrate que existan en tu HTML)
        // Si 'con' es concepto y es texto o ID
        concepto_id: $("#con").val() || null,
        frecuencia: $("#freeve").val() || null,
      };

      console.log("Enviando datos a API:", datosDTO);

      // -------------------------------------------------------
      // PATRÓN: Service Encapsulation
      // Llamamos al servicio en lugar de $.ajax directo
      // -------------------------------------------------------
      ReportesService.crear(datosDTO)
        .done(function (res) {
          // Éxito (HTTP 200/201)
          alert("¡Reporte guardado exitosamente!");

          // Recargar la página para ver la tabla actualizada
          window.location.reload();
        })
        .fail(function (err) {
          // Error (HTTP 400/500)
          console.error("Error API:", err);

          // Intentamos obtener el mensaje de error del backend
          var mensajeError = "Ocurrió un error desconocido.";

          if (err.responseJSON && err.responseJSON.message) {
            mensajeError = err.responseJSON.message;
          } else if (err.responseText) {
            // A veces el error viene en texto plano si explota el servidor
            mensajeError = "Error del servidor (ver consola).";
          }

          alert("Error al guardar: " + mensajeError);

          // Rehabilitar el botón para que el usuario intente de nuevo
          $btn.attr("disabled", false).val(btnTextoOriginal);
        });
    },
  });
});
