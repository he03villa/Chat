<?php
    require 'conexion.php';
    
    class Datos_Personales extends Conexion{
        
        public function Insertar($id,$nombre,$apellido,$fecha_nacimiento,$correo,$telefono,$genero) {
            parent::conectar();
            $usuario = parent::filtra($id);
            $name = parent::filtra($nombre);
            $last = parent::filtra($apellido);
            $date = parent::filtra($fecha_nacimiento);
            $email = parent::filtra($correo);
            $phone = parent::filtra($telefono);
            $gender = parent::filtra($genero);
            $consulta1 = 'SELECT id,nombre FROM datospersonales WHERE id = "'.$usuario.'"';
            $consulta2 = 'INSERT INTO datospersonales(id,nombre,apellido,fecha_nacimiento,correo,telefono,genero) VALUES("'.$usuario.'","'.$name.'","'.$last.'","'.$date.'","'.$email.'","'.$phone.'","'.$gender.'")';
            $verificar = parent::verificarRegistros($consulta1);
            if($verificar > 0){
                parent::cerrar();
                //return $consulta1;
                return 'error';
            } else {
                parent::query($consulta2);
                parent::cerrar();
                //return $consulta2;
                return 'Se guardaron los datos';
            }
        }
        
        public function Actualizar($id,$nombre,$apellido,$fecha_nacimiento,$correo,$telefono,$genero) {
            parent::conectar();
            $usuario = parent::filtra($id);
            $name = parent::filtra($nombre);
            $last = parent::filtra($apellido);
            $date = parent::filtra($fecha_nacimiento);
            $email = parent::filtra($correo);
            $phone = parent::filtra($telefono);
            $gender = parent::filtra($genero);
            $consulta1 = 'SELECT id,nombre FROM datospersonales WHERE id = "'.$usuario.'"';
            $consulta2 = 'UPDATE datospersonales SET nombre="'.$name.'",apellido="'.$last.'",fecha_nacimiento="'.$date.'",correo="'.$email.'",telefono="'.$phone.'",genero="'.$gender.'" WHERE id="'.$usuario.'"';
            $verificar = parent::verificarRegistros($consulta1);
            if($verificar>0){
                parent::query($consulta2);
                parent::cerrar();
                return 'Se actualizaron los datos';   
            } else {
                parent::cerrar();
                return 'error';   
            }
        }
    }
?>