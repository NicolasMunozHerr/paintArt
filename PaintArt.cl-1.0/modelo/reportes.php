<?php 
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";
    class reportes{

        private $idReportes;
        private $explicacion;
        private $razon;
        private $idUsuarioRegistrado;
        private $idObra;

        public function __construct($idReportes, $explicacion , $razon, $idUsuarioRegistrado, $idObra)
        {
            $this->idReportes= $idReportes;
            $this->explicacion =$explicacion;
            $this->razon= $razon;
            $this->idUsuarioRegistrado= $idUsuarioRegistrado;
            $this->idObra= $idObra;
        }

        public function getIdReporte(){
            return $this->idReportes;
        }
        public function setIdReporte($idReportes){
            $this->idReportes= $idReportes;
            return $this;
        }

        public function getExplicacion(){
            return $this->explicacion;
        }
        public function setExplicacion($explicacion){
            $this->explicacion= $explicacion;
            return $this;
        }

        public function getRazon(){
            return $this->razon;
        }
        public function setRazon($razon){
            $this->razon= $razon;
            return $this;
        }

        public function getIdUsuarioRegistrado(){
            return $this->idUsuarioRegistrado;
        }
        public function setIdUsuarioRegistrado($idUsuarioRegistrado){
            $this->idUsuarioRegistrado= $idUsuarioRegistrado;
            return $this;
        }

        public function getidObra(){
            return $this->idObra;
        }
        public function setIdObra($idObra){
            $this->idObra= $idObra;
            return $this;
        }

        public function __toString()
        {
            return "id reporte: ".$this->idReportes." Explicacion: ".$this->explicacion." razon: ".$this->razon." id usuario registrado: ".$this->idUsuarioRegistrado." idObra: ".$this->idObra;
        }
        public function subirRepor(reportes $repor){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("INSERT INTO `reportes` (  `explicacion`, `razon`, `Usuario_Registrado_idUsuario_Registrado`, `Obra_idObra`) VALUES  (  ?, ?, ?, ?)"); //prepared Statement
                $res->execute([$repor->getExplicacion(),$repor->getRazon(),$repor->getIdUsuarioRegistrado(),$repor->getidObra()]);
                return true;
                 
            }
            catch(PDOException $e)
            {
               //return error_log($e->getMessage());
                return false;
            }
            finally{
                $this->pdo->closeConnection();
            }
        }


        public function listarReporte(){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `reportes`");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $c = new reportes($fila["idreportes"],$fila["explicacion"],$fila["razon"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Obra_idObra"]);
                   
                    
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                //return FALSE;
               // return error_log($e->getMessage());
               return 'hola';

            }
            finally{
                $this->pdo->closeConnection();
            }
        }
        public function eliminarReporte($idRepor){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("DELETE FROM reportes WHERE idreportes=?");
                $resul= $res->execute([$idRepor]);
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
        public function eliminarReporteAdyacentes($idObras){
            //DELETE FROM `reportes` WHERE `reporetes`.`Obra_idObra`=24
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("DELETE FROM `reportes` WHERE `reportes`.`Obra_idObra`=?");
                $resul= $res->execute([$idObras]);
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

        PUBLIC function buscarReporteId($id){
            $repor = FALSE;
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM reportes WHERE idreportes=?");
                $resul->execute([$id]);
                while($fila = $resul->fetch())
                {
                    $repor = new reportes($fila["idreportes"], $fila["explicacion"],$fila["razon"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Obra_idObra"]);
                   
                    
                    
                }    
                return $repor;
            }
            catch(PDOException $e)
            {
                
                //return error_log($e->getMessage());
                return false;
            }
            finally{
                $this->pdo->closeConnection();
            }
        }

    }


?>