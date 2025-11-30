<?php

session_start();

require_once("conex.php"); 
mysqli_select_db($conex, $database_conex);

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['email'])) {
    $email = $input['email']; 

    $query = "SELECT IDEPER, NOMEMP, APPEMP, APMEMP, PRISES, FOTEMP, NOMCAR, ORGCAR 
              FROM EMP, PER, CAR, SES 
              WHERE IDEPER=IDESES AND EMPPER=IDEEMP AND EMAEMP='$email' AND CARPER=IDECAR";
    
    $log = mysqli_query($conex, $query) or die(mysqli_error($conex));
    $row = mysqli_fetch_assoc($log);

    if (mysqli_num_rows($log) > 0) {
        $_SESSION["user"] = $row['IDEPER'];
        $_SESSION["nivel"] = $row['PRISES'];
        $_SESSION["cargo"] = $row['NOMCAR'];
        $_SESSION["org"] = $row['ORGCAR'];
        $_SESSION["nombre"] = $row['NOMEMP'].' '.$row['APPEMP'].' '.$row['APMEMP'];
        $_SESSION["foto"] = $row['FOTEMP'];

        $user_id = $_SESSION["user"];
        $log2 = mysqli_query($conex, "SELECT tip_asp, img_asp FROM asp WHERE ide_usu=$user_id");
        if (mysqli_num_rows($log2) > 0) {
            $row2 = mysqli_fetch_array($log2);
            $_SESSION["theme"] = $row2['tip_asp'];
            $_SESSION["fondo"] = $row2['img_asp'];
        } else {
            $_SESSION["theme"] = 1;
            $_SESSION["fondo"] = "img/fondo.jpg";
        }

        
        echo json_encode(["status" => "success", "message" => "Sesión PHP creada"]);
    } else {
        http_response_code(401);
        echo json_encode(["status" => "error", "message" => "Usuario no encontrado en Legacy BD"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
}
?>