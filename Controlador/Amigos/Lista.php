<?php
    require '../../Modelo/Amigos.php';
    $amigo = new Amigos();
    $res = $amigo->Lista();
    echo json_encode(array('resultado' => $res));
?>