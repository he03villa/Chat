<?php
    class Conexion{
        private $conexion;
        private $usuario='id3366196_he03villa';
        private $clave='ivored';
        private $server='localhost';
        private $db='id3366196_dbchat';
        
        public function conectar(){
            $this->conexion = new mysqli($this->server,$this->usuario,$this->clave,$this->db);
            if($this->conexion->connect_errno) echo'Falla al conectar con MySQL: '.$this->conexion->connect_error;
        }
        
        public function query($consulta){
            return $this->conexion->query($consulta);
        }
        
        public function verificarRegistros($consulta){
            return $verificarRegistros = mysqli_num_rows($this->conexion->query($consulta));
        }
        
        public function consultarArreglo($consulta){
            return mysqli_fetch_array($this->conexion->query($consulta));
        }
        
        public function consultaTodo($consulta){
            $this->conexion->set_charset("utf8");
            return mysqli_fetch_all($this->conexion->query($consulta),MYSQLI_ASSOC);
        }


        public function cerrar(){
            $this->conexion->close();
        }
        
        public function salvar($des){
            $string = $this->conexion->real_escape_string($des);
            return $string;
        }
        
        public function filtra($string){
            $res = $this->salvar($string);
            $buscar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');
            $reemplazar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');
            $res = str_replace($buscar,$reemplazar,$string);
            $res = strtolower($res);
            $res = trim($res);
            return $res;
        }
        
        public function recartar($string){
            $buscar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');
            $reemplazar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');
            $res = str_replace($buscar,$reemplazar,$string);
            return $res;
        }
    }
?>