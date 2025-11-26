<?php

$mail = "BUEN DIA SE LE NOTIFICA QUE HA RECIBIDO UN NUEVO REPORTE, VERIFICARLO EN LA PAGINA DE SMS: smspuebla.ddns.net";
$mail=utf8_decode($mail);
$email ="h.teo@hotmail.com,hilda_moran@yahoo.com.mx";
//Titulo
$titulo = "NOTIFICACION DE NUEVO REPORTE";
//cabecera
$headers = "smssistema@gmail.com";
//Enviamos el mensaje a tu_dirección_email 
$bool = mail($email,$titulo,$mail,"From: $headers");


?>
