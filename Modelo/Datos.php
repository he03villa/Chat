<?php
    require 'conexion.php';
    
    class Datos extends Conexion{
        public function Lista($id){
            $tableAmigos = "Amigos_".$id;
            $tableMensaje = "Mensahe_".$id;
            parent::conectar();
            $consulta = 'SELECT d.id, d.nombre, d.apellido, h.estado, h.fecha_amigos, MAX(m.mensaje), MAX(m.hora_del_mensage)
            FROM datospersonales d
            LEFT JOIN $tableAmigos h ON h.id =d.id
            LEFT JOIN Mensahe_he03villa m ON m.user = d.id
            GROUP BY d.id, d.nombre, d.apellido, h.estado, h.fecha_amigos';
            $lista = parent::consultaTodo($consulta);
            parent::cerrar();
            return $lista;
        }
    }
?>