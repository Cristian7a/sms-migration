<?php
$mail = "";
$mail=utf8_decode($mail);
//Titulo
$from = '';
$to = "";
$titulo = "PAGINA DE CONFIGURACION SSMTP";

//Enviamos el mensaje a tu_dirección_email 
$bool = mail($to,$titulo,$mail,'From: $from');
if($bool){
    echo "Mensaje enviado";
}else{
    echo "Mensaje no enviado";
}
?>
