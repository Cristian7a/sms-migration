<?php 
session_start();
if (isset($_SESSION["user"])){
    $user=$_SESSION['user'];
    $theme=$_SESSION['theme']; 

	if ($_SESSION["nivel"]<=2){ if($theme==1){ include("theme.php"); }else{include("theme_2.php");}}
    if ($_SESSION["nivel"]==3){ if($theme==1){ include("theme_menu_dif.php"); }else{include("theme_2_menu_dif.php");} }
 	if ($_SESSION["nivel"]==4){ if($theme==1){ include("theme_menu_com.php"); }else{include("theme_2_menu_com.php");} } 
 
}else{
    header("Location: ../" );
	//include("index.html");
    

  } ?>

   <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>S.M.S.</title>
        <link rel="shortcut icon" href="imagenes/icon.ico" /> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">