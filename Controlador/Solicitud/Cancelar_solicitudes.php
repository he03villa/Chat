<?php
    include '../../Modelo/Solicitudes.php';
    
    setlocale(LC_TIME, 'es_CO.UTF-8');
    date_default_timezone_set('America/Bogota');
    
    $datos = json_decode(file_get_contents("php://input"),TRUE);
    
    $emisor = $datos['emisor'];//Quien envia la solicitud es el numero 2
    $receptor = $datos['receptor'];//Quien envia la solicitud es el numero 3

    $NameTableEmisor = "Amigos_".$emisor;
    $NameTableReceptor = "Amigos_".$receptor;
    
    $existeTablaEmisor = true;
    $existeTablaReceptor = true;
    
    $solicitudes = new Solicitudes();
    
    $resSolicitudEmisor = $solicitudes->Eliminar($NameTableEmisor, $receptor);//insertar una solicitud en la tabla del emisor
    $resSolicitudReceptor = $solicitudes->Eliminar($NameTableReceptor, $emisor);//insertar una solicitud en la tabla del receptor
    
    if(!$resSolicitudEmisor){//si nuestra tabla del emisor no existe
       echo json_encode(array('respuesta' => 'Error de la solicitud'));
    }
    if(!$resSolicitudReceptor){//si nuestra tabla del receptor no existe
        echo json_encode(array('respuesta' => 'Error de la solicitud'));
    }
    if($resSolicitudEmisor && $resSolicitudReceptor) echo json_encode(array('respuesta' => 'Se cancelo la solicitud correctamente'));
?>