<?php
    require '../../Modelo/Usuario.php';
    $user = $_GET['user'];
    $usuario = new Usuario();
    $res = $usuario->Login($user);
    $contenedor = array();
    if($res){
        $contenedor['resultado']="CC";
        $contenedor['datos']=$res;
        echo json_encode($contenedor);
    }
    else echo json_encode(array('resultado'=>'El usuario no existe'));
?>