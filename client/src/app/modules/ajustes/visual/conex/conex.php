<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conex = "localhost";
$database_conex = "config_sms";
$username_conex = "sms";
$password_conex = "smseio2018";
$conex = mysqli_connect($hostname_conex, $username_conex, $password_conex) or trigger_error(mysql_error(),E_USER_ERROR); 
setlocale(LC_TIME, 'es_ES.UTF-8');
#if (is_file("includes/funciones.php")){
#	include("includes/funciones.php");
#}
#else
#{
#	include("../includes/funciones.php");
#	}

?>




