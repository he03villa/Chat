<?php
    require '../../Modelo/Amigos.php';
    
    try {
        $user = $_GET['user'];
        $amigo = new Amigos();
        $res = $amigo->Lista("Amigos_".$user);
        echo json_encode($res);
    } catch (Exception $ex) {
        echo json_encode(array('resultado' => 'Ocurrio un error intentelo mas tarde'));
    }
?>