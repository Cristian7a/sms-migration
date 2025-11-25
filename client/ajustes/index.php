<?php 
session_start();
if (isset($_SESSION["nivel"])){ 
	$user=$_SESSION['user'];
    $theme=$_SESSION['theme'];
    if ($_SESSION["nivel"]==1){ if($theme==1){ include("theme.html"); }else{include("theme_2.html");}}
	if ($_SESSION["nivel"]==2){ if($theme==1){ include("theme_sms.html"); }else{include("theme_sms_2.html");}}
    if ($_SESSION["nivel"]==3){ if($theme==1){ include("theme_menu_dif.html"); }else{include("theme_2_menu_dif.html");} }
 	if ($_SESSION["nivel"]==4){ if($theme==1){ include("theme_menu_com.html"); }else{include("theme_2_menu_com.html");}} 

 }else{
 	session_destroy();
 	header("Location:../" );
 }


 ?>
 <head>
     <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ajustes</title>
        <link rel="shortcut icon" href="../imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    





