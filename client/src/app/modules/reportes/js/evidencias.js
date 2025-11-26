$(function () {
  // Obtenemos el ID del reporte del input oculto en PHP
  const reporteId = $("#IDEREP_GLOBAL").val();

  // --- CARGAR EVIDENCIAS USANDO EL SERVICIO ---
  cargarEvidencias();

  function cargarEvidencias() {
    // Usamos el servicio en lugar de $.ajax directo
    ReportesService.obtenerPorId(reporteId)
      .done(function (reporte) {
        // Limpiar contenedores
        $("#lista-reporte-fisico").empty();
        $("#lista-adicionales").empty();
        $("#mensaje-sin-scan").show();

        if (reporte.evidencias && reporte.evidencias.length > 0) {
          reporte.evidencias.forEach((evi) => {
            const html = generarHtmlEvidencia(evi);

            // Filtramos por el nombre/descripción (REPORTE vs ADICIONAL)
            if (
              evi.descripcion === "REPORTE" ||
              (evi.tipo === "FISICA" && evi.nombre_archivo.includes("REPORTE"))
            ) {
              $("#lista-reporte-fisico").append(html);
              $("#mensaje-sin-scan").hide();
            } else {
              $("#lista-adicionales").append(html);
            }
          });
        }
      })
      .fail(function (xhr) {
        console.error("Error cargando reporte:", xhr);
        alert("Error al cargar las evidencias.");
      });
  }

  function generarHtmlEvidencia(evi) {
    // 1. Obtenemos la raíz del backend dinámicamente
    const rootUrl = ApiConfig.baseUrl.replace("/api/v1", "");

    // 2. Concatenamos. evi.url_acceso
    const urlCompleta = rootUrl + evi.url_acceso;

    // Lógica para icono PDF vs Imagen
    const esPdf = evi.nombre_archivo.toLowerCase().endsWith(".pdf");
    // ruta al icono_pdf
    const imgUrl = esPdf ? "../imagenes/icono_pdf.png" : urlCompleta;

    return `
        <div class="image_wrapper" id="evi-${evi.id}">
            <a href="${urlCompleta}" target="_blank">
                <img title="${evi.tipo}" class="image" height="100px" src="${imgUrl}" style="max-width:100px; object-fit: cover;">
            </a>
            <a href="javascript:void(0);" onclick="eliminarEvidencia(${evi.id})">
                <img src="../../../../public/assets/images/eliminar_cuadro.jpg" class="remove" title="Eliminar">
            </a>
        </div>
    `;
  }

  // --- 2. SUBIR EVIDENCIAS USANDO EL SERVICIO ---
  $(".form-upload").on("submit", function (e) {
    e.preventDefault();

    var $form = $(this);
    var fileInput = $form.find('input[type="file"]')[0];

    if (fileInput.files.length === 0) {
      alert("Selecciona un archivo");
      return;
    }

    // Crear FormData
    var formData = new FormData($form[0]); // Toma automáticamente 'nom' y 'tip' del form HTML
    // Aseguramos que el archivo vaya con la clave correcta 'archivo'
    if (!formData.has("archivo")) {
      formData.append("archivo", fileInput.files[0]);
    }

    var $btn = $form.find('input[type="submit"]');
    var txtOriginal = $btn.val();
    $btn.val("Subiendo...").prop("disabled", true);

    // Llamada al servicio
    ReportesService.subirEvidencia(reporteId, formData)
      .done(function (res) {
        alert("¡Evidencia subida correctamente!");
        cargarEvidencias(); // Refrescar la vista
        $form[0].reset(); // Limpiar formulario
      })
      .fail(function (xhr) {
        var msg = xhr.responseJSON
          ? xhr.responseJSON.error || xhr.responseJSON.message
          : "Error desconocido";
        alert("Error al subir: " + msg);
      })
      .always(function () {
        $btn.val(txtOriginal).prop("disabled", false);
      });
  });

  window.eliminarEvidencia = function (id) {
    if (confirm("¿Borrar esta evidencia?")) {
      // ReportesService.eliminarEvidencia(id)... fala hacerlo en backend
    }
  };
});
