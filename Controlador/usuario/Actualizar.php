<?php
    include '../../Modelo/Usuario.php';
    $datos = json_decode(file_get_contents("php://input"),TRUE);
    $usuario = new Usuario();
    $res = $usuario->Actualizar($datos["user"], $datos["pass"]);
    echo $res;
?>