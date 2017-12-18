<?php
    include '../../Modelo/Datos_Pesonales.php';
    include '../../Modelo/Usuario.php';
    $datos = json_decode(file_get_contents("php://input"),TRUE);
    $DatosP = new Datos_Personales();
    $usuario = new Usuario();
    $res1 = $DatosP->Insertar($datos["id"], $datos["nombre"],$datos["apellido"], $datos["fechanacimiento"],$datos["correo"], $datos["telefono"],$datos["genero"]);
    $res2 = $usuario->Insertar($datos["id"], $datos["pass"]);
    echo $res1.' '.$res2;
?>