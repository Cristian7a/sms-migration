var GestionService = {
  // Reemplaza a: alta_ges.php
  guardarPeligro: function (datosPeligro) {
    return $.ajax({
      url: ApiConfig.baseUrl + "/gestion/peligros",
      method: "PUT",
      headers: ApiConfig.getHeaders(),
      data: JSON.stringify(datosPeligro),
      contentType: "application/json",
      dataType: "json",
    });
  },

  // Reemplaza a: alta_pro.php
  crearPropuesta: function (datosPropuesta) {
    return $.ajax({
      url: ApiConfig.baseUrl + "/gestion/propuestas",
      method: "POST",
      headers: ApiConfig.getHeaders(),
      data: JSON.stringify(datosPropuesta),
      contentType: "application/json",
      dataType: "json",
    });
  },

  obtenerPeligro: function (idReporte) {
    return $.ajax({
      url: ApiConfig.baseUrl + "/gestion/peligros/" + idReporte,
      method: "GET",
      headers: ApiConfig.getHeaders(),
    });
  },

  crearRiesgo: function (datosRiesgo) {
    return $.ajax({
      url: ApiConfig.baseUrl + "/gestion/riesgos",
      method: "POST",
      headers: ApiConfig.getHeaders(),
      data: JSON.stringify(datosRiesgo),
      contentType: "application/json",
      dataType: "json",
    });
  },
};
