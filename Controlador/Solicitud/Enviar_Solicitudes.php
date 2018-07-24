<?php
    include '../../Modelo/Solicitudes.php';
    
    setlocale(LC_TIME, 'es_CO.UTF-8');
    date_default_timezone_set('America/Bogota');
    
    $datos = json_decode(file_get_contents("php://input"),TRUE);
    
    $emisor = $datos['emisor'];//Quien envia la solicitud es el numero 2
    $receptor = $datos['receptor'];//Quien envia la solicitud es el numero 3

    $NameTableEmisor = "Amigos_".$emisor;
    $NameTableReceptor = "Amigos_".$receptor;
    
    $solicitudes = new Solicitudes();
    
    $token_tabla = $solicitudes->getToken($receptor);
    
    if($token_tabla){
        
        $token = $token_tabla['tokens'];
        
        $hora_del_solicitud = strftime("%H:%M ,%A, %d de %B de %Y ");
        
        $resSolicitudEmisor = $solicitudes->EnviarSolicitud($NameTableEmisor, $receptor, 2, $hora_del_solicitud);//insertar una solicitud en la tabla del emisor
        $resSolicitudReceptor = $solicitudes->EnviarSolicitud($NameTableReceptor, $emisor, 3, $hora_del_solicitud);//insertar una solicitud en la tabla del receptor
    
        if(!$resSolicitudEmisor){//si nuestra tabla del emisor no existe
            $solicitudes->CreateTable($NameTableEmisor);
            $resSolicitudEmisor = $solicitudes->EnviarSolicitud($NameTableEmisor, $receptor, 2, $hora_del_solicitud);//insertar una solicitud en la tabla del emisor
        }
        if(!$resSolicitudReceptor){//si nuestra tabla del receptor no existe
            $solicitudes->CreateTable($NameTableReceptor);
            $resSolicitudReceptor = $solicitudes->EnviarSolicitud($NameTableReceptor, $emisor, 3, $hora_del_solicitud);//insertar una solicitud en la tabla del receptor
        }
        
        if($resSolicitudEmisor && $resSolicitudReceptor){
            $solicitudes->EnviarNotificacion($token, $emisor,$emisor.' te envio una solicitud de amistad');
        }
    }
    
?>