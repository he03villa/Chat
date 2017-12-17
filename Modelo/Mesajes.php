<?php
    require 'conexion.php';
    
    class Mensaje extends Conexion{
        public function CreateTable($NameTable) {
            parent::conectar();
            $consulta = 'CREATE TABLE '.$NameTable.'('
                        . 'id VARCHAR(50) PRIMARY KEY, '
                        . 'mensaje VARCHAR(500) NOT NULL,'
                        . 'tipo_mensaje VARCHAR(10) NOT NULL,'
                        . 'hora_del_mensage VARCHAR(50) NOT NULL)';
            return parent::query($consulta);
        }
        
        public function getMensaje($id) {
            parent::conectar();
            $user1 = parent::filtra($id);
            $consulta = 'SELECT id,tokens FROM token WHERE id="'.$user1.'"';
            $user = parent::consultarArreglo($consulta);
            $lista = array();
            $lista['id']=$user['id'];
            $lista['tokens']=$user['tokens'];
            return $lista;
        }
        
        public function EnviarMensage($NameTable,$id,$mensaje,$tipo_mensaje,$hora_del_mensaje) {
            parent::conectar();
            $consultar = 'INSERT INTO '.$NameTable.'(id,mensaje,tipo_mensaje,hora_del_mensage) VALUES("'.$id.'","'.$mensaje.'","'.$tipo_mensaje.'","'.$hora_del_mensaje.'")';
            return parent::query($consultar);
        }
        
        public function EnviarNotificacion($mensaje,$hora,$token,$emisor_mensaje) {
            ignore_user_abort();
            ob_start();

            $url = 'https://fcm.googleapis.com/fcm/send';

            $fields = array('to' => $token ,
                      'data' => array('mensaje' => $mensaje,'hora' => $hora,'cabezera' => $emisor_mensaje.' te envio un nuevo mensaje','cuerpo' => $mensaje));

            define('GOOGLE_API_KEY', 'AIzaSyAy5a-RyooO1LIx8TTyPpMGb9yqdCI8tvg');

            $headers = array(
                       'Authorization:key='.GOOGLE_API_KEY,
                       'Content-Type: application/json'
            );      

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            $result = curl_exec($ch);
            if($result === false)
                die('Curl failed ' . curl_error());
            curl_close($ch);
            return $result;
        }
    }
?>