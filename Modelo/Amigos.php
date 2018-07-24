<?php
    require 'conexion.php';
    
    class Amigos extends Conexion{
        public function Lista($nameTable){
            parent::conectar();
            $consulta = 'SELECT id,estado,fecha_amogos FROM '.$nameTable;
            $lista = parent::consultaTodo($consulta);
            parent::cerrar();
            return $lista;
        }
    }
?>