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
        private $idCompra;


        public function __construct($idDireccion, $region, $ciudad, $comuna, $calle, $tipoHogar, $numeracion, $idCompra)
        {
            $this->idDireccion= $idDireccion;
            $this->region= $region;
            $this->ciudad= $ciudad;
            $this->comuna= $comuna;
            $this->calle= $calle;
            $this->tipoHogar= $tipoHogar;
            $this->numeracion= $numeracion;
            $this->idCompra= $idCompra;
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


        public function getIdCompra(){
            return $this->idCompra;
        }
        public function setIdCompra($idCompra){
            $this->idCompra= $idCompra;
            return $this;
        }

        public function crearDireccion(direccion $direccion){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("INSERT INTO `direccion` ( `region`, `ciudad`, `comuna`, `calle`, `tipoHogar`,`numeracion`,`Compra_idCompra`) VALUES  ( ?,?,?,?,?,?,?)"); //prepared Statement
                $res->execute([$direccion->getRegion(),$direccion->getCiudad(),$direccion->getComuna(),$direccion->getCalle(),$direccion->getTipoHogar(), $direccion->getNumeracion(),$direccion->getIdCompra()]);
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
