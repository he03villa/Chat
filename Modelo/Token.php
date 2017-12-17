<?php
    require 'conexion.php';
    
    class Token extends Conexion{
        public function Lista(){
            parent::conectar();
            $consulta = 'SELECT id,tokens FROM token';
            $lista = parent::consultaTodo($consulta);
            parent::cerrar();
            return $lista;
        }
        
        public function getTokenId($id){
            parent::conectar();
            $user1 = parent::filtra($id);
            $consulta = 'SELECT id,tokens FROM token WHERE id="'.$user1.'"';
            $user = parent::consultarArreglo($consulta);
            $lista = array();
            $lista['id']=$user['id'];
            $lista['tokens']=$user['tokens'];
            return $lista;
        }
        
        public function Insertar($id,$tokens) {
            parent::conectar();
            $usuario = parent::filtra($id);
            $consulta1 = 'SELECT id,tokens FROM token WHERE id = "'.$usuario.'"';
            $consulta2 = 'INSERT INTO token(id,tokens) VALUES("'.$usuario.'","'.$tokens.'")';
            $verificar = parent::verificarRegistros($consulta1);
            if($verificar > 0){
                parent::cerrar();
                return 'error';
            } else {
                parent::query($consulta2);
                parent::cerrar();
                return 'Se guardo el token';
            }
        }
        
        public function Actualizar($id,$tokens) {
            parent::conectar();
            $usuario = parent::filtra($id);
            $consulta1 = 'SELECT id,tokens FROM token WHERE id = "'.$usuario.'"';
            $consulta2 = 'UPDATE token SET tokens="'.$tokens.'" WHERE id="'.$usuario.'"';
            $verificar = parent::verificarRegistros($consulta1);
            if($verificar>0){
                parent::query($consulta2);
                parent::cerrar();
                return 'Se actualizo el token';   
            } else {
                parent::cerrar();
                return 'error';   
            }
        }
    }
?>