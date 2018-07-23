<?php
    require 'conexion.php';
    
    class Amigos extends Conexiono{
        public function Lista($nameTable){
            parent::conectar();
            $consulta = 'SELECT usuario,password FROM '.$nameTable;
            $lista = parent::consultaTodo($consulta);
            parent::cerrar();
            return $lista;
        }
    }
?>