<?php
    require 'conexion.php';
    
    class Amigos extends Conexion{
        public function Lista($nameTable){
            parent::conectar();
            $consulta = 'SELECT '.$nameTable.'.id,'.$nameTable.'.estado,'.$nameTable.'.fecha_amigos,datospersonales.nombre,datospersonales.apellido FROM '.$nameTable.',datospersonales WHERE '.$nameTable.'.id=datospersonales.id';
            $lista = parent::consultaTodo($consulta);
            parent::cerrar();
            return $lista;
        }
    }
?>