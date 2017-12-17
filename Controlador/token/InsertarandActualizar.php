<?php
    include '../../Modelo/Token.php';
    $datos = json_decode(file_get_contents("php://input"),TRUE);
    $token = new Token();
    $res = $token->Insertar($datos["id"], $datos["token"]);
    if($res == "error") {
        echo json_encode(array('resultado' => $token->Actualizar ($datos["id"], $datos["token"])));
    }
    else echo json_encode(array('resultado' => $res));
?>