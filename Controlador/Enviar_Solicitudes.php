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
    
    /*if($token_tabla){
        
        $token = $token_tabla['tokens'];
        
        if($token){
            $resEmisor=$mensaje->CreateTable($NameTableEmisor);
            $resReceptor=$mensaje->CreateTable($NameTableReceptor);
    
            $fechaActual = getdate();
            $hora = $fechaActual['hours'];
            $minuto = $fechaActual['minutes'];
            $segundo = $fechaActual['seconds'];
            $dia = $fechaActual['mday'];
            $mes = $fechaActual['mon'];
            $year = $fechaActual['year'];
        
            $miliseconds = DateTime::createFromFormat('U.u', microtime(true));
    
            $id_user_emisor = $emisor.'_'. $hora.'_'.$minuto.'_'.$segundo.'_'.$miliseconds->format("u");
            $id_user_receptor = $receptor.'_'. $hora.'_'.$minuto.'_'.$segundo.'_'.$miliseconds->format("u");
    
            $hora_del_mensaje = strftime("%H:%M ,%A, %d de %B de %Y ");
    
            $MEE = false;
            $MER = false;
    
            $resMensajeEmisor = $mensaje->EnviarMensage($NameTableEmisor, $id_user_emisor, $mensaje1, 1, $hora_del_mensaje);
            if($resMensajeEmisor) $MEE = true;
            else echo 'No se puede enviar el mensaje';
    
            $resMensajeReceptor = $mensaje->EnviarMensage($NameTableReceptor, $id_user_receptor.'1', $mensaje1, 2, $hora_del_mensaje);
            if($resMensajeReceptor)$MER = true;
            else echo 'No se puede enviar el mensaje';
    
            if($MEE && $MER){
                echo json_encode(array('resultado'=>'El mensaje fue enviado existosamente'));
                $mensaje->EnviarNotificacion($mensaje1, $hora_del_mensaje, $token,$emisor,$receptor);
            }
        }else echo json_encode(array('resultado'=>'El usuario receptor no existe'));
    }else echo json_encode(array('resultado'=>'El usuario receptor no existe'));*/
    
?>