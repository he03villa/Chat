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
    }
?>