<?php
    include '../Modelo/Solicitudes.php';
    
    setlocale(LC_TIME, 'es_CO.UTF-8');
    date_default_timezone_set('America/Bogota');
    
    $datos = json_decode(file_get_contents("php://input"),TRUE);
    
    $emisor = $datos['emisor'];//Quien envia la solicitud es el numero 2
    $receptor = $datos['receptor'];//Quien envia la solicitud es el numero 3

    $NameTableEmisor = "Amigos_".$emisor;
    $NameTableReceptor = "Amigos_".$receptor;
    
    $hora_de_acetar_amistad = strftime("%H:%M ,%A, %d de %B de %Y ");
    
    $existeTablaEmisor = true;
    $existeTablaReceptor = true;
    
    $solicitudes = new Solicitudes();
    
    $resSolicitudEmisor = $solicitudes->Actualizar($NameTableEmisor, $receptor, 4, $hora_de_acetar_amistad,3);//insertar una solicitud en la tabla del emisor
    $resSolicitudReceptor = $solicitudes->Actualizar($NameTableReceptor, $emisor, 4, $hora_de_acetar_amistad,2);//insertar una solicitud en la tabla del receptor
    
    if($resSolicitudEmisor){
        echo json_encode(array('respuesta' => 'Error de la solicitud'));
    }
    if($resSolicitudReceptor){
        echo json_encode(array('respuesta' => 'Error de la solicitud'));
    }
?>