var AuthService = {
  // Login Híbrido: Obtiene Token JWT (Flask) y crea Sesión (PHP)
  login: function (email, password) {
    return $.ajax({
      url: ApiConfig.baseUrl + "/auth/login",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        email: email,
        password: password,
      }),
    }).then(function (responseFlask) {
      // Si Flask responde OK, tenemos un usuario válido y un token
      if (responseFlask.token) {
        localStorage.setItem("sms_token", responseFlask.token);

        var usuarioInfo = {
          id: responseFlask.id,
          nombre: responseFlask.nombre_completo,
          rol: responseFlask.rol_sistema,
          cargo: responseFlask.cargo,
        };
        localStorage.setItem("sms_user", JSON.stringify(usuarioInfo));

        return $.ajax({
          url: "app/config/puente_autenticacion.php",
          method: "POST",
          contentType: "application/json",
          data: JSON.stringify({ email: email }),
        }).then(function (responsePHP) {
          console.log("Sesión Híbrida Sincronizada Correctamente");
          return responseFlask;
        });
      }
    });
  },

  logout: function () {
    // Borrar Token
    localStorage.removeItem("sms_token");
    localStorage.removeItem("sms_user");

    // Borrar Sesión PHP
    $.get("app/config/logout.php");

    // Redirección
    window.location.href = "index.php";
  },

  // Verificar si hay sesión activa
  estaLogueado: function () {
    var token = localStorage.getItem("sms_token");
    return token !== null && token !== "";
  },

  getToken: function () {
    return localStorage.getItem("sms_token");
  },

  getUsuario: function () {
    var user = localStorage.getItem("sms_user");
    return user ? JSON.parse(user) : null;
  },
};
