<?php
unlink('../../../theme_2/img/slider.jpg');
$ruta="../".$_POST['url'];
$destino="../../../theme_2/img/slider.jpg";
copy($ruta,$destino);
header("Location: ../" );
?>