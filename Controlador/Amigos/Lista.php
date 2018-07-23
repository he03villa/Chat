<?php
    require '../../Modelo/Amigos.php';
    $user = $_GET['user'];
    $amigo = new Amigos();
    $res = $amigo->Lista("Amigos_".$user);
    echo json_encode($res);
?>