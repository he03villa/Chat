<?php
    require '../../Modelo/Usuario.php';
    $usuario = new Usuario();
    $res = $usuario->Lista();
    echo json_encode($res);
?>