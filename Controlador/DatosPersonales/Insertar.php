<?php
    include '../../Modelo/Datos_Pesonales.php';
    $datos = json_decode(file_get_contents("php://input"),TRUE);
    $DatosP = new Datos_Personales();
    $res1 = $DatosP->Insertar($datos["id"], $datos["nombre"],$datos["apellido"], $datos["fechanacimiento"],$datos["correo"], $datos["telefono"],$datos["genero"]);
    $res2 = $DatosP->InsertarUsu($datos["id"], $datos["pass"]);
    echo $res1.' '.$res2;
?>