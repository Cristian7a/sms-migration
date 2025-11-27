<?php
# ...
$hostname_conex = "localhost";
$database_conex = "sms";
$username_conex = "sms";
$password_conex = "smseio2018";
// **CORRECCIÓN: Usar solo mysqli_connect y eliminar la llamada a mysql_error()**
$conex = mysqli_connect($hostname_conex, $username_conex, $password_conex) 
    or die("Error de conexión a MySQL: " . mysqli_connect_error());

setlocale(LC_TIME, 'es_ES.UTF-8');
// ...
?>