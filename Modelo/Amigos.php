<?php
    require 'conexion.php';
    
    class Amigos extends Conexion{
        public function Lista() {
            parent::conectar();
            $consulta = 'SELECT id,nombre FROM datospersonales';
            $lista = parent::consultaTodo($consulta);
            parent::cerrar();
            return $lista;
        }
        
        public function ListaToken(){
            parent::conectar();
            $consulta = 'SELECT id FROM token';
            $lista = parent::consultaTodo($consulta);
            parent::cerrar();
            return $lista;
        }
    }
?>