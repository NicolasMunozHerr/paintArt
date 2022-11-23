<?php 
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";
    class compra{
        private $idCompra;
        private $fechaCompra;
        private $metodoCompra;
        private $idObra;
        private $idUsuarioRegistrado;
        private $idArtista;
        private $IdDireccion;


        public function __construct($idCompra, $fechaCompra, $metodoCompra, $idObra,$idUsuarioRegistrado,$idArtista,$IdDireccion)
        {
            $this->idCompra= $idCompra;
            $this->fechaCompra= $fechaCompra;
            $this->metodoCompra= $metodoCompra;
            $this->idObra= $idObra;
            $this->idUsuarioRegistrado= $idUsuarioRegistrado;
            $this->idArtista=$idArtista;
            $this->IdDireccion=$IdDireccion;
        }

        public function getIdCompra(){
            return $this->idCompra;
        }
        public function setIdCompra($idCompra){
            $this->idCompra= $idCompra;
            return $this;
        }

        public function getFechaCompra(){
            return $this->fechaCompra;
        }
        public function setFechaCompra($fechaCompra){
            $this->fechaCompra= $fechaCompra;
            return $this;
        }

        public function getMetodoCompra(){
            return $this->metodoCompra;
        }
        public function setMetodoCompra($metodoCompra){
            $this->metodoCompra= $metodoCompra;
            return $this;
        }

        public function getIdObra(){
            return $this->idObra;
        }
        public function setIdObra($idObra){
            $this->idObra= $idObra;
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
        public function setIdArtista($idArtista){
            $this->idArtista= $idArtista;
            return $this;
        }
        public function getIdDireccion(){
            return $this->IdDireccion;
        }
        public function setIdDireccion($IdDireccion){
            $this->IdDireccion= $IdDireccion;
            return $this;
        }


        public function mostrarCompra(){
            return 'idCompra '.$this->idCompra.'fechaCompra '.$this->fechaCompra.'metodoCompra '.$this->metodoCompra.'IdObra '.$this->idObra.'idUserRegistrado '.$this->idUsuarioRegistrado.'IdArtista '.$this->idArtista.'idDireccion '.$this->IdDireccion;


        }
        public function crearCompra(compra $compra){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("INSERT INTO `compra` ( `fechaCompra`, `metodoCompra`, `Obra_idObra`, `Usuario_Registrado_idUsuario_Registrado`, `Artista_idArtista`,Direccion_IdDireccion) VALUES  ( ?,?,?,?,?,?)"); //prepared Statement
                $res->execute([$compra->getFechaCompra(),$compra->getMetodoCompra(),$compra->getIdObra(),$compra->getIdUsuarioRegistrado(),$compra->getIdArtista(),$compra->getIdDireccion()]);
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
       

        public function ultimaCompra(){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `compra`");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $c = $fila["idCompra"];
                   
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                //return FALSE;
                return error_log($e->getMessage());

            }
            finally{
                $this->pdo->closeConnection();
            }
        }

        public function eliminarCompra($idCompra){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("DELETE FROM compra WHERE idCompra=?");
                $resul= $res->execute([$idCompra]);
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
        public function eliminarCompraidObra($idobra){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("DELETE FROM compra WHERE Obra_idObra=?");
                $resul= $res->execute([$idobra]);
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

        public function listarCompraIdObra($idObra){
            $lista = new ArrayList();
                try
                {
                    $this->pdo = Conexion::getInstance();
                    $this->pdo->openConnection();
                    $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `compra` where `Obra_idObra`=? ");
                    $resul->execute([$idObra]);
                    while($fila = $resul->fetch())
                    {
                        $c = new compra($fila["idCompra"],$fila["fechaCompra"],$fila["metodoCompra"], $fila["Obra_idObra"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Artista_idArtista"], $fila["Direccion_IdDireccion"]);
                      
                        $lista->add($c);
                    }
                    return $lista;
                }
                catch(PDOException $e)
                {
                    error_log($e->getMessage());
                    //return FALSE;
                    return false;
    
                }
                finally{
                    $this->pdo->closeConnection();
                }
        }

        public function listarCompraIdUser($idUsuarioRegistrado){
            $lista = new ArrayList();
                try
                {
                    $this->pdo = Conexion::getInstance();
                    $this->pdo->openConnection();
                    $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `compra` where `Usuario_Registrado_idUsuario_Registrado`=? ");
                    $resul->execute([$idUsuarioRegistrado]);
                    while($fila = $resul->fetch())
                    {
                        $c = new compra($fila["idCompra"],$fila["fechaCompra"],$fila["metodoCompra"], $fila["Obra_idObra"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Artista_idArtista"], $fila["Direccion_IdDireccion"]);
                      
                        $lista->add($c);
                    }
                    return $lista;
                }
                catch(PDOException $e)
                {
                    error_log($e->getMessage());
                    //return FALSE;
                    return false;
    
                }
                finally{
                    $this->pdo->closeConnection();
                }
        }
    

    }


?>