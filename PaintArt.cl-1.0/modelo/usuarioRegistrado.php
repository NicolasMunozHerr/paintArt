<?php
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";
    class usuarioRegistrado 
    {
        private $idUsuarioRegistrado;
        private $nombre;
        private $apellido;
        private $correo;
        private $numeroTel;
        private $contraseña;
        private $fechaNac;
        private $permisos;
        private $rut;
        private $idImagen;


        public function __construct()
        {
            
        }

        public function getId()
        {
            return $this->idUsuarioRegistrado;
        }
        public function setId($idUser){
            
            $this->idUsuarioRegistrado= $idUser;
            return $this;
        }


        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre= $nombre;
            return $this;
        }
        

        public function getApellido(){
            return $this->apellido;
        }
        public function setApellido($apellido){
            $this->apellido= $apellido;
            return $this;
        }

        public function getCorreo()
        {
            return $this->correo;
        }
        public function setCorreo($correo){
            $this->correo = $correo;
            return $this;
        }

        public function getNumeroTel(){
            return $this->numeroTel;
        }
        public function setNumeroTel($numeroTel){
            $this->numeroTel= $numeroTel;
            return $this;
        }

        public function getContraseña(){
            return $this->contraseña;
        }
        public function setContraseña($contraseña){
            $this->contraseña = $contraseña;
            return $this;
        }

        public function getFechaNac(){
            return $this->fechaNac;
        }
        public function setFechaNac($fechaNac){
            $this->fechaNac= $fechaNac;
            return $this;
        }

        public function getPermisos(){
            return $this->permiso;
        }
        public function setPermisos($permiso){
            $this->permiso= $permiso;
            return $this;
        }

        public function getRut(){
            return $this->rut;
        }
        public function setRut($rut){
            $this->rut= $rut;
            return $this;
        }

        public function getIdImagen(){
            return $this->idImagen;
        }
        public function setIdImagen($idImagen){
            $this->idImagen= $idImagen;
            return $this;
        }

        public function __toString()
        {
            return 'Id user:'.$this->idUsuarioRegistrado." nombre: ".$this->nombre.' apellido: '.$this->apellido.' correo: '.$this->correo.
            ' numero telefonico:'. $this->numeroTel.' contraseña '. $this->contraseña . ' fecha nac: '.$this->fechaNac. ' permisos: '.
            ' rut: '.$this->rut.' id imagen: '.$this->idImagen;
        }

        PUBLIC function buscarUusuarioId($id){
            $idUs = FALSE;
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM usuario_registrado WHERE idUsuario_Registrado=?");
                $resul->execute([$id]);
                while($fila = $resul->fetch())
                {
                    $idUs = new usuarioRegistrado();
                    $idUs->setId($fila["idUsuario_Registrado"]);
                    $idUs->setNombre($fila["nombre"]);
                    $idUs->setApellido($fila["apellido"]);
                    
                    
                }    
                return $idUs;
            }
            catch(PDOException $e)
            {
                
                return error_log($e->getMessage());
            }
            finally{
                $this->pdo->closeConnection();
            }
        }


    }


?>