<?php
    require '../../Modelo/Usuario.php';
    $usuario = new Usuario();
    $res1 = $usuario->ListaUsuario();
    echo json_encode(array('resultado' => $res1));
?>