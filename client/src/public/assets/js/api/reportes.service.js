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
};
