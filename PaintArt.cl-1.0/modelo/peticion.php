<?php
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";
use JetBrains\PhpStorm\Internal\ReturnTypeContract;

    class peticion{
        private $idPeticion;
        private $asunto;
        private $descripcion;
        private $estado;
        private $fecha;
        private $precio;
        private $idUsuarioRegistrado;
        private $idArtista;
        private $idDireccion;

        public function __construct($idPeticion, $asunto, $descripcion, $estado, $fecha, $precio, $idUsuarioRegistrado, $idArtista, $idDireccion)
        {
            $this->idPeticion= $idPeticion;
            $this->asunto= $asunto;
            $this->descripcion= $descripcion;
            $this->estado= $estado;
            $this->fecha= $fecha;
            $this->precio= $precio;
            $this->idUsuarioRegistrado=$idUsuarioRegistrado;
            $this->idArtista= $idArtista;
            $this->idDireccion= $idDireccion;
        }

        public function getIdPeticion()
        {
            return $this->idPeticion;
        }
        public function setIdPeticion($idPeticion){
            $this->idPeticion= $idPeticion;
            return $this;
        }

        public function getAsunto(){
            return $this->asunto;
        }
        public function setAsunto($asunto){
            $this->asunto= $asunto;
            return $this;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }
        public function setDescripcion($descripcion){
            $this->descripcion= $descripcion;
            return $this;
        }

        public function getEstado(){
            return $this->estado;
        }
        public function setEstado($estado)
        {
            $this->estado= $estado;
            return $this;
        }

        public function getFecha(){
            return $this->fecha;
        }
        public function setFecha($fecha){
            $this->fecha = $fecha;
            return $this;
        }


        public function getPrecio(){
            return $this->precio;
        }
        public function setPrecio ($precio){
            $this->precio= $precio;
            return $this;
        }

        public function getIdUsuarioRegistrado(){
            return $this->idUsuarioRegistrado;
        }
        public function setIdUsuarioRegistrado($idUsuarioRegistrado){
            $this->idUsuarioRegistrado= $idUsuarioRegistrado;
            return $this;
        }


        public function getIdArtista(){
            return $this->idArtista;
        }
        public function setIdArtista($idArtista)
        {
            $this->idArtista= $idArtista;
            return $this;
        }


        public function getIdDireccion(){
            return $this->idDireccion;
        }
        public function setIdDireccion($idDireccion){
            $this->idDireccion=$idDireccion;
            return $this;
        }


        public function __toString()
        {
            return ' id peticion: '.$this->idPeticion. ' asunto: '.$this->asunto.' descripcion: '.$this->descripcion.
            ' estado: '.$this->estado.' fecha: '.$this->fecha.' precio: '.$this->precio.' id usuario registrado:'.$this->idUsuarioRegistrado.
            ' id artista: '.$this->idArtista.' id direccion:'. $this->idDireccion;
        }

        public function subirPeticion(peticion $pet){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("INSERT INTO `peticion` (`idpeticion`, `asunto`, `descripcion`, `estado`, `fecha`, `precio`, `Usuario_Registrado_idUsuario_Registrado`, `Artista_idArtista`, `Direccion_IdDireccion`) VALUES (?, ?,?,?,?, ?,?,?, ?);"); //prepared Statement
                $res->execute([NULL, $pet->getAsunto(), $pet->getDescripcion(), $pet->getEstado(), $pet->getFecha(), $pet->getPrecio(), $pet->getIdUsuarioRegistrado(), $pet->getIdArtista(), $pet->getIdDireccion()]);
                return true;
                 
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                return error_log($e->getMessage());
            }
            finally{
                $this->pdo->closeConnection();
            }
            
        }


        public function listarPeticionAprobacion($idArtista){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `peticion` where `estado`=0 AND `Artista_idArtista`=?  ");
                $resul->execute([$idArtista]);
                while($fila = $resul->fetch())
                {
                    $c = new peticion($fila["idpeticion"],$fila["asunto"],$fila["descripcion"],$fila["estado"],$fila["fecha"],$fila["precio"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Artista_idArtista"],$fila["Direccion_IdDireccion"]);  
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                //return FALSE;
               // return error_log($e->getMessage());
               return false;

            }
            finally{
                $this->pdo->closeConnection();
            }
        }

        public function listarPeticionUser($idUsuario){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `peticion` where `Usuario_Registrado_idUsuario_Registrado`=? ORDER BY `idpeticion` DESC");
                $resul->execute([$idUsuario   ]);
                while($fila = $resul->fetch())
                {
                    $c = new peticion($fila["idpeticion"],$fila["asunto"],$fila["descripcion"],$fila["estado"],$fila["fecha"],$fila["precio"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Artista_idArtista"],$fila["Direccion_IdDireccion"]);  
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                //return FALSE;
               // return error_log($e->getMessage());
               return false;

            }
            finally{
                $this->pdo->closeConnection();
            }
        }
        public function listaPeticionTrabajadas($idArtista){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `peticion` where `estado`!=0 and `estado`!=4 and `Artista_idArtista`=? ORDER BY `idpeticion` DESC ");
                $resul->execute([$idArtista]);
                while($fila = $resul->fetch())
                {
                    $c = new peticion($fila["idpeticion"],$fila["asunto"],$fila["descripcion"],$fila["estado"],$fila["fecha"],$fila["precio"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Artista_idArtista"],$fila["Direccion_IdDireccion"]);  
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                //return FALSE;
               // return error_log($e->getMessage());
               return false;

            }
            finally{
                $this->pdo->closeConnection();
            }
        }


        public function rechazaPeticion($desc, $idpet ){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE  peticion SET estado=4 , descripcion=? WHERE idpeticion=?");
                $resul= $res->execute([$desc, $idpet]);
                return true;
                
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

        public function apruebaPeticion($id)
         {
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE peticion SET estado=1 WHERE idpeticion=?");
                $res->execute([$id]);
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
        public function terminandoPeticion($id)
         {
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE peticion SET estado=2 WHERE idpeticion=?");
                $res->execute([$id]);
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
        public function enviadoPeticion($id)
         {
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE peticion SET estado=3 WHERE idpeticion=?");
                $res->execute([$id]);
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

        public function listarPeticionesEnviadas($idArtista){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `peticion` where `estado`=3 and EXTRACT(MONTH FROM fecha)= MONTH(CURRENT_DATE()) and `Artista_idArtista`=?  ");
                $resul->execute([$idArtista]);
                while($fila = $resul->fetch())
                {
                    $c = new peticion($fila["idpeticion"],$fila["asunto"],$fila["descripcion"],$fila["estado"],$fila["fecha"],$fila["precio"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Artista_idArtista"],$fila["Direccion_IdDireccion"]);  
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                //return FALSE;
               // return error_log($e->getMessage());
               return false;

            }
            finally{
                $this->pdo->closeConnection();
            }
        }

        public function eliminarPeticion($idPeticion){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("DELETE FROM peticion WHERE `peticion`.`idpeticion` = ?");
                $resul= $res->execute([$idPeticion]);
                return true;
                
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


        public function peticionesEnviadaUltimosSeisMeses($idArtista){
         
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare(
                    "SELECT SUM(peticion.precio) as 'cantidad'
                    from 
                        peticion, 
                        artista 
                    WHERE 
                        peticion.Artista_idArtista= artista.idArtista AND 
                        artista.idArtista= ? and 
                        peticion.fecha>= CURRENT_DATE - INTERVAL 6 MONTH and
                         peticion.fecha<= CURRENT_DATE;
                ");
                $resul->execute([$idArtista]);
                while($fila = $resul->fetch())
                {
                    $c = $fila['cantidad'];  
                   
                }
                return $c;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                //return FALSE;
               // return error_log($e->getMessage());
               return false;

            }
            finally{
                $this->pdo->closeConnection();
            }
        }
        public function detallepeticionesEnviadaUltimosSeisMeses($idArtista){
            $lista = new ArrayList();

            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare(
                "SELECT SUM(peticion.precio) as 'cantidad', 
                    date_format(peticion.fecha, '%m-%y') as 'mes'
                from 
                    peticion, 
                    artista 
                WHERE 
                    peticion.Artista_idArtista= artista.idArtista AND 
                    artista.idArtista= ? and 
                    peticion.fecha>= CURRENT_DATE - INTERVAL 6 MONTH and 
                    peticion.fecha<= CURRENT_DATE GROUP BY `mes`;
                ");
                $resul->execute([$idArtista]);
                while($fila = $resul->fetch())
                {
                    $c = new peticion(null, null, null,null,$fila['mes'], $fila['cantidad'], null, null,null);
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                //return FALSE;
               // return error_log($e->getMessage());
               return false;

            }
            finally{
                $this->pdo->closeConnection();
            }
        }






    }
?>