<?php
    include '../Modelo/Solicitudes.php';
    
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
    
    $resSolicitudEmisor = $solicitudes->EnviarSolicitud($NameTableEmisor, $receptor, 2, "por definir");//insertar una solicitud en la tabla del emisor
    $resSolicitudReceptor = $solicitudes->EnviarSolicitud($NameTableReceptor, $emisor, 3, "por definir");//insertar una solicitud en la tabla del receptor
    
    if(!$resSolicitudEmisor){//si nuestra tabla del emisor no existe
       $solicitudes->CreateTable($NameTableEmisor);
       $solicitudes->EnviarSolicitud($NameTableEmisor, $receptor, 2, "por definir");//insertar una solicitud en la tabla del emisor
    }
    if(!$resSolicitudReceptor){//si nuestra tabla del receptor no existe
        $solicitudes->CreateTable($NameTableReceptor);
        $solicitudes->EnviarSolicitud($NameTableReceptor, $emisor, 3, "por definir");//insertar una solicitud en la tabla del receptor
    }
?>