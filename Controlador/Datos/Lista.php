<?php
    require '../../Modelo/Datos.php';
    
    try {
        $user = $_GET['user'];
        $datos = new Datos();
        $res = $datos->Lista($user);
        echo json_encode(array('resultado' => $res));
    } catch (Exception $ex) {
        echo json_encode(array('resultado' => 'Ocurrio un error intentelo mas tarde'));
    }
?>