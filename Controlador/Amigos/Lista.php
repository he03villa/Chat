<?php
    require '../../Modelo/Amigos.php';
    $amigo = new Amigos();
    $res1 = $amigo->Lista();
    $res2 = $amigo->ListaToken();
    echo json_encode(array('resultado' => $res1, 'token' => $res2));
?>