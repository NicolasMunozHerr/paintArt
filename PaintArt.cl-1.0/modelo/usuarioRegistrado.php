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
        private $permiso;
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

        public function getNombreYApellido(){
            return $this->nombre.' '.$this->apellido;
        }

        public function __toString()
        {
            return 'Id user:'.$this->idUsuarioRegistrado." nombre: ".$this->nombre.' apellido: '.$this->apellido.' correo: '.$this->correo.
            ' numero telefonico:'. $this->numeroTel.' contraseña '. $this->contraseña . ' fecha nac: '.$this->fechaNac. ' permisos: '.
            ' rut: '.$this->rut.' id imagen: '.$this->idImagen;
        }

        public function crearUser(usuarioRegistrado $user){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("INSERT INTO `usuario_registrado` (  `nombre`, `apellido`, `correo`, `numeroTel`, `contraseña`, `fechaNac`, `permisos`,`rut`,`Imagen_idImagen`) VALUES  (  ?, ?, ?, ?, ?,?,?,?,?)"); //prepared Statement
                $res->execute([$user->getNombre(),$user->getApellido(),$user->getCorreo(),$user->getNumeroTel(), $user->getContraseña(), $user->getFechaNac(), 1, $user->getRut(), $user->getIdImagen()]);
                return true;
                 
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                return false;
            }
            finally{
                $this->pdo->closeConnection();
            }
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
                    $idUs->setPermisos($fila["permisos"]);
                    $idUs->setIdImagen($fila["Imagen_idImagen"]);
                    
                }    
                return $idUs;
            }
            catch(PDOException $e)
            {
                
               // return error_log($e->getMessage());
               return false;
            }
            finally{
                $this->pdo->closeConnection();
            }
        }

        public function cambiarPermiso($permiso, $id){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE usuario_registrado SET permisos=? WHERE idUsuario_Registrado=?");
                $res->execute([$permiso,$id]);
                return TRUE;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                return FALSE;
            }
            finally{
                $this->pdo->closeConnection();
            }
        
        }

        PUBLIC function iniciarSesion(usuarioRegistrado $user){
            $idUs = FALSE;
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM usuario_registrado WHERE correo=? and contraseña=?" );
                $resul->execute([$user->getCorreo(),$user->getContraseña()]);
                while($fila = $resul->fetch())
                {
                    $idUs = new usuarioRegistrado();
                    $idUs->setId($fila["idUsuario_Registrado"]);
                    $idUs->setNombre($fila["nombre"]);
                    $idUs->setApellido($fila["apellido"]);
                    $idUs->setPermisos($fila["permisos"]);
                    
                    
                }    
                return $idUs;
            }
            catch(PDOException $e)
            {
                
               // return error_log($e->getMessage());
               return false;
            }
            finally{
                $this->pdo->closeConnection();
            }
        }

        public function listarUsuarioRegistrado(){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `usuario_registrado` WHERE permisos=1 LIMIT 5;");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $c = new usuarioRegistrado();
                    $c->setId($fila["idUsuario_Registrado"]);
                    $c->setNombre($fila["nombre"]);
                    $c->setApellido($fila["apellido"]);
                    $c->setPermisos($fila["permisos"]);
                    
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                return FALSE;
               // return error_log($e->getMessage());
              

            }
            finally{
                $this->pdo->closeConnection();
            }
        }

        public function listarModeradores(){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `usuario_registrado` WHERE permisos=4 LIMIT 5;");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $c = new usuarioRegistrado();
                    $c->setId($fila["idUsuario_Registrado"]);
                    $c->setNombre($fila["nombre"]);
                    $c->setApellido($fila["apellido"]);
                    $c->setPermisos($fila["permisos"]);
                    
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                return FALSE;
               // return error_log($e->getMessage());
              

            }
            finally{
                $this->pdo->closeConnection();
            }
        }


        public function buscarArtistas($nombre){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM usuario_registrado WHERE  nombre like '%".$nombre."%' or apellido like '%".$nombre."%' && permisos=2 ");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $c = new usuarioRegistrado();
                   
                        
                        $c->setId($fila["idUsuario_Registrado"]);
                        $c->setNombre($fila["nombre"]);
                        $c->setApellido($fila["apellido"]);
                        $c->setPermisos($fila["permisos"]);
                        $c->setIdImagen($fila["Imagen_idImagen"]);
                  
                   
                    
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                return FALSE;
               // return error_log($e->getMessage());
              

            }
            finally{
                $this->pdo->closeConnection();
            }
        }


        public function buscarUsuarioNombres($nombre){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM usuario_registrado WHERE  nombre like '%".$nombre."%' or apellido like '%".$nombre."%' ");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $c = new usuarioRegistrado();
                   
                        
                        $c->setId($fila["idUsuario_Registrado"]);
                        $c->setNombre($fila["nombre"]);
                        $c->setApellido($fila["apellido"]);
                        $c->setPermisos($fila["permisos"]);
                  
                   
                    
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                return FALSE;
               // return error_log($e->getMessage());
              

            }
            finally{
                $this->pdo->closeConnection();
            }

        }



    }


?>