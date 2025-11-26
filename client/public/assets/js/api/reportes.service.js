var ReportesService = {
  listar: function () {
    return $.ajax({
      url: ApiConfig.baseUrl + "/reportes",
      method: "GET",
      headers: ApiConfig.getHeaders(),
    });
  },

  crear: function (datosReporte) {
    return $.ajax({
      url: ApiConfig.baseUrl + "/reportes",
      method: "POST",
      headers: ApiConfig.getHeaders(),
      data: JSON.stringify(datosReporte),
      dataType: "json",
    });
  },

  // MÉTODOS PARA LLENAR LOS SELECTORES
  obtenerAreas: function () {
    return $.ajax({
      url: ApiConfig.baseUrl + "/reportes/catalogos/areas",
      method: "GET",
      headers: ApiConfig.getHeaders(),
    });
  },

  obtenerLugares: function () {
    return $.ajax({
      url: ApiConfig.baseUrl + "/reportes/catalogos/lugares",
      method: "GET",
      headers: ApiConfig.getHeaders(),
    });
  },

  obtenerEmpleados: function () {
    return $.ajax({
      url: ApiConfig.baseUrl + "/reportes/catalogos/empleados",
      method: "GET",
      headers: ApiConfig.getHeaders(),
    });
  },

  // 1. Obtener un reporte específico (trae sus evidencias anidadas)
  obtenerPorId: function (id) {
    return $.ajax({
      url: ApiConfig.baseUrl + "/reportes/" + id,
      method: "GET",
      headers: ApiConfig.getHeaders(),
    });
  },

  // 2. Subir evidencia (Maneja FormData para archivos)
  subirEvidencia: function (idReporte, formData) {
    return $.ajax({
      url: ApiConfig.baseUrl + "/reportes/" + idReporte + "/evidencias",
      method: "POST",
      // headers: ApiConfig.getHeaders(), // OJO: Si usas JWT, descomenta esto
      data: formData,
      processData: false, // Importante para enviar archivos
      contentType: false, // Importante para enviar archivos
    });
  },
};
