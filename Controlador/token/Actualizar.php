<?php
    include '../../Modelo/Token.php';
    $datos = json_decode(file_get_contents("php://input"),TRUE);
    $token = new Token();
    $res = $token->Actualizar($datos["id"], $datos["token"]);
    echo $res;
?>