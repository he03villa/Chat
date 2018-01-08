<?php
    require 'conexion.php';
    
    class Solicitudes extends Conexion{
        public function CreateTable($NameTable) {
            parent::conectar();
            $consulta = 'CREATE TABLE '.$NameTable.'('
                        . 'id VARCHAR(50) PRIMARY KEY, '
                        . 'estado VARCHAR(10) NOT NULL,'
                        . 'fecha_amigos VARCHAR(50) NOT NULL)';
            return parent::query($consulta);
        } 
        
        public function EnviarSolicitud($NameTable,$id,$estado,$fecha_amigos) {
            parent::conectar();
            $consultar = 'INSERT INTO '.$NameTable.'(id,estado,fecha_amigos) VALUES("'.$id.'","'.$estado.'","'.$fecha_amigos.'")';
            return parent::query($consultar);
        }
        
        public function Actualizar($NameTable,$id,$estado,$fecha_amigos,$estado_var) {
            parent::conectar();
            $consulta1 = 'SELECT id,estado,fecha_amigos FROM '.$NameTable.' WHERE id = "'.$id.'"';
            $consulta2 = 'UPDATE '.$NameTable.' SET estado="'.$estado.'", fecha_amigos="'.$fecha_amigos.'" WHERE id="'.$id.'" AND estado="'.$estado_var.'"';
            $verificar = parent::verificarRegistros($consulta1);
            if($verificar>0){
                parent::query($consulta2);
                parent::cerrar();
                return 'Se actualizo la contraseña';   
            } else {
                parent::cerrar();
                return 'error';   
            }
        }
        
        public function Eliminar($NameTable,$id) {
            parent::conectar();
            $consultar1 = 'DELETE FROM '.$NameTable.' WHERE id="'.$id.'"';
            return parent::query($consultar1);
        }
        
        public function getToken($id) {
            parent::conectar();
            $user1 = parent::filtra($id);
            $consulta = 'SELECT id,tokens FROM token WHERE id="'.$user1.'"';
            $user = parent::consultarArreglo($consulta);
            $lista = array();
            $lista['id']=$user['id'];
            $lista['tokens']=$user['tokens'];
            return $lista;
        }
        
        public function EnviarNotificacion($token,$usuario_envio,$cuerpo) {
            ignore_user_abort();
            ob_start();

            $url = 'https://fcm.googleapis.com/fcm/send';

            $fields = array('to' => $token ,
                      'data' => array('type'=>'solicitud','user_envio' => $usuario_envio,'cabezera' => 'Solicitud de amistad','cuerpo' => $cuerpo));

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