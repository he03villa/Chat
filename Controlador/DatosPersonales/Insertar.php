<?php
    include '../../Modelo/Datos_Pesonales.php';
    $datos = json_decode(file_get_contents("php://input"),TRUE);
    $DatosP = new Datos_Personales();
    $res = $DatosP->Insertar($datos["id"], $datos["nombre"],$datos["apellido"], $datos["fechanacimiento"],$datos["correo"], $datos["telefono"],$datos["genero"]);
    echo $res;
?>