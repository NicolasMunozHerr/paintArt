<?php
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";
    class direccion{
        private $idDireccion;
        private $region;
        private $ciudad;
        private $comuna;
        private $calle;
        private $tipoHogar;
        private $numeracion;


        public function __construct($idDireccion, $region, $ciudad, $comuna, $calle, $tipoHogar, $numeracion)
        {
            $this->idDireccion= $idDireccion;
            $this->region= $region;
            $this->ciudad= $ciudad;
            $this->comuna= $comuna;
            $this->calle= $calle;
            $this->tipoHogar= $tipoHogar;
            $this->numeracion= $numeracion;
          
        }

        public function getIdDireccion(){
            return $this->idDireccion;
        }
        public function setIdDireccion($idDireccion){
            $this->idDireccion= $idDireccion;
            return $this;
        }

        public function getRegion(){
            return $this->region;
        }
        public function setRegion($region){
            $this->region= $region;
            return $this;
        }

        public function getCiudad(){
            return $this->ciudad;
        }
        public function setCiudad($ciudad){
            $this->ciudad= $ciudad;
            return $this;
        }

        public function getComuna(){
            return $this->comuna;
        }
        public function setComuna($comuna){
            $this->comuna= $comuna;
            return $this;
        }

        public function getCalle(){
            return $this->calle;
        }
        public function setCalle($calle){
            $this->calle= $calle;
            return $this;
        }

        public function getTipoHogar(){
            return $this->tipoHogar;
        }
        public function setTipoHogar($tipoHogar){
            $this->tipoHogar= $tipoHogar;
            return $this;
        }


        public function getNumeracion(){
            return $this->numeracion;
        }
        public function setNumeracion($numeracion){
            $this->numeracion=$numeracion;
            return $this;
        }


        public function __toString()
        {
            $hogar="";
            if ($this->tipoHogar==1) {
                $hogar="casa";
            }else{
                $hogar="departamento";
            }
            return $this->calle." ".$this->numeracion." (".$hogar."), ".$this->comuna." ,".$this->ciudad." ,Region de ".$this->region;
        }

        public function crearDireccion(direccion $direccion){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("INSERT INTO `direccion` ( `region`, `ciudad`, `comuna`, `calle`, `tipoHogar`,`numeracion`) VALUES  ( ?,?,?,?,?,?)"); //prepared Statement
                $res->execute([$direccion->getRegion(),$direccion->getCiudad(),$direccion->getComuna(),$direccion->getCalle(),$direccion->getTipoHogar(), $direccion->getNumeracion()]);
                return true;
                 
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                return  "error";
;

            }
            finally{
                $this->pdo->closeConnection();
            }
        }
        public function ultimaDireccion(){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("SELECT * FROM `direccion` ORDER BY `IdDireccion` DESC LIMIT 1"); //prepared Statement
                $res->execute([]);
                while($fila = $res->fetch())
                {
                    $dire = new direccion($fila["IdDireccion"],$fila["region"],$fila["ciudad"],$fila["comuna"],$fila["calle"],$fila["tipoHogar"],$fila["numeracion"]);
                   
                    
                }    
               
                return $dire;
                 
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
        public function buscarDireccionID($ID){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("SELECT * FROM `direccion` where `IdDireccion`=?"); //prepared Statement
                $res->execute([$ID]);
                while($fila = $res->fetch())
                {
                    $dire = new direccion($fila["IdDireccion"],$fila["region"],$fila["ciudad"],$fila["comuna"],$fila["calle"],$fila["tipoHogar"],$fila["numeracion"]);
                   
                    
                }    
               
                return $dire;
                 
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
        public function eliminarDireccion($idDireccion){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("DELETE FROM crititica WHERE IdDireccion=?");
                $resul= $res->execute([$idDireccion]);
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
        

    }


?>
