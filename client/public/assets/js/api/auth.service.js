var AuthService = {
  // Pide el token al backend
  login: function (email, password) {
    return $.ajax({
      url: ApiConfig.baseUrl + "/auth/login",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        email: email,
        password: password,
      }),
    }).done(function (response) {
      if (response.token) {
        // AQUÍ ocurre la magia: guardamos el token en el navegador
        localStorage.setItem("sms_token", response.token);
      }
    });
  },

  // Borra el token (Cerrar sesión)
  logout: function () {
    localStorage.removeItem("sms_token");
  },

  // Verifica si ya tenemos un token guardado
  estaLogueado: function () {
    var token = localStorage.getItem("sms_token");
    // Podríamos agregar lógica para ver si expiró, pero por ahora basta con que exista
    return token !== null && token !== "";
  },

  getToken: function () {
    return localStorage.getItem("sms_token");
  },
};
