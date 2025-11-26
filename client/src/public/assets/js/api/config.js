// Patrón: Contract Centralization
var ApiConfig = {
  baseUrl: "http://localhost:5000/api/v1",

  // Función helper para obtener headers con el token (JWT)
  getHeaders: function () {
    var token = localStorage.getItem("sms_token");
    return {
      "Content-Type": "application/json",
      Authorization: token ? "Bearer " + token : "",
    };
  },
};
