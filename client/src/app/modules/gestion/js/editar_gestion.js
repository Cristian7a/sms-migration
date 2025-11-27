$(document).ready(function () {
  // Función auxiliar para obtener parámetros de la URL
  function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
    return results === null
      ? ""
      : decodeURIComponent(results[1].replace(/\+/g, " "));
  }

  /**
   * Intenta obtener el ID del reporte de dos fuentes:
   * 1. Del input oculto #IDREP (inyectado por el sistema viejo al abrir el modal)
   * 2. De la URL (parámetro IDEREP)
   */
  function obtenerIdReporte() {
    // Intentar leer del input oculto
    var valInput = $("#IDREP").val();
    console.log("Valor en input #IDREP:", valInput); // Debug

    if (
      valInput &&
      valInput !== "" &&
      valInput !== "0" &&
      valInput !== "undefined"
    ) {
      return parseInt(valInput);
    }

    // Si falla, intentar leer de la URL
    var valUrl = getParameterByName("IDEREP");
    console.log("Valor en URL IDEREP:", valUrl); // Debug

    if (valUrl) {
      return parseInt(valUrl);
    }
    return null;
  }

  // --- Lógica de Carga Inicial ---
  // Solo intentamos cargar datos si hay un ID disponible al inicio (ej: ver_gestion.php)
  // Si estamos en index.php, el ID se inyecta dinámicamente al abrir el modal,
  // por lo que esta carga inicial podría fallar (es normal en el index).
  var idInicial = obtenerIdReporte();
  if (idInicial) {
    cargarDatos(idInicial);
  }

  function cargarDatos(id) {
    console.log("Cargando datos para ID:", id);
    GestionService.obtenerPeligro(id)
      .done(function (data) {
        $("#con_e").val(data.condicion);
        $("#obj_e").val(data.objeto);
        $("#act_e").val(data.actividad);
        $("#cat_e").val(data.categoria);
        $("#met_ide_e").val(data.metodo);
        $("#rie_ope_e").val(data.riesgo_operacional);
        $("#ide_gen_e").val(data.generador);
      })
      .fail(function () {
        console.log("No se encontraron datos previos o es un registro nuevo.");
      });
  }

  // --- Lógica de Guardado ---
  $("#form_editar_gestion")
    .off("submit")
    .on("submit", function (e) {
      e.preventDefault();

      // IMPORTANTE: Volvemos a buscar el ID justo ahora, porque
      // en index.php el ID cambia dinámicamente al abrir diferentes modales.
      var idFinal = obtenerIdReporte();

      if (!idFinal) {
        alert("Error crítico: No se encuentra el ID del reporte (IDREP).");
        return;
      }

      var btn = $("#btn_guardar_edicion");
      btn.prop("disabled", true).text("Guardando...");

      var datos = {
        reporte_id: idFinal,
        condicion: $("#con_e").val(),
        objeto: $("#obj_e").val(),
        actividad: $("#act_e").val(),
        categoria: $("#cat_e").val(),
        metodo: $("#met_ide_e").val(),
        riesgo_operacional: $("#rie_ope_e").val(),
        generador: $("#ide_gen_e").val(),
      };

      console.log("Enviando datos a la API:", datos); // Debug

      GestionService.guardarPeligro(datos)
        .done(function (res) {
          alert("¡Actualización exitosa!");
          location.reload();
        })
        .fail(function (xhr) {
          console.error("Error API:", xhr);
          var errorMsg = "Error desconocido";

          if (xhr.responseJSON) {
            if (xhr.responseJSON.error) {
              errorMsg = xhr.responseJSON.error;
            } else if (Array.isArray(xhr.responseJSON)) {
              // Errores de validación de Pydantic
              errorMsg = "Datos inválidos: " + xhr.responseJSON[0].msg;
            }
          }

          alert("Error al actualizar: " + errorMsg);
          btn.prop("disabled", false).text("Actualizar");
        });
    });
});
