<?php
    require 'conexion.php';
    
    class Usuario extends Conexion{
        public function Lista(){
            parent::conectar();
            $consulta = 'SELECT usuario,password FROM login';
            $lista = parent::consultaTodo($consulta);
            parent::cerrar();
            return $lista;
        }
        
        public function Login($user){
            parent::conectar();
            $user1 = parent::filtra($user);
            $consulta = 'SELECT usuario,password FROM login WHERE usuario="'.$user1.'"';
            $user = parent::consultarArreglo($consulta);
            $lista = array();
            $lista['usuario']=$user['usuario'];
            $lista['password']=$user['password'];
            return $lista;
        }
        
        public function Insertar($usua,$pass) {
            parent::conectar();
            $usuario = parent::filtra($usua);
            $password = parent::filtra($pass);
            $consulta1 = 'SELECT usuario,password FROM login WHERE usuario = "'.$usuario.'"';
            $consulta2 = 'INSERT INTO login(usuario,password) VALUES("'.$usuario.'","'.$password.'")';
            $verificar = parent::verificarRegistros($consulta1);
            if($verificar > 0){
                parent::cerrar();
                return 'error';
            } else {
                parent::query($consulta2);
                parent::cerrar();
                return 'Se guardo el usuario';
            }
        }
        
        public function Actualizar($usua,$pass) {
            parent::conectar();
            $usuario = parent::filtra($usua);
            $password = parent::filtra($pass);
            $consulta1 = 'SELECT usuario,password FROM login WHERE usuario = "'.$usuario.'"';
            $consulta2 = 'UPDATE login SET password="'.$password.'" WHERE usuario="'.$usuario.'"';
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
    }
?>