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
        private $precioCompra;
        private $estadoEnvio;

        public function __construct($idCompra, $fechaCompra, $metodoCompra, $idObra,$idUsuarioRegistrado,$idArtista,$IdDireccion, $precioCompra)
        {
            $this->idCompra= $idCompra;
            $this->fechaCompra= $fechaCompra;
            $this->metodoCompra= $metodoCompra;
            $this->idObra= $idObra;
            $this->idUsuarioRegistrado= $idUsuarioRegistrado;
            $this->idArtista=$idArtista;
            $this->IdDireccion=$IdDireccion;
            $this->precioCompra= $precioCompra;
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

        public function getPrecioCompra(){
            return $this->precioCompra;

        }

        public function setPrecioCompra($precioCompra){
            $this->precioCompra= $precioCompra;
            return $this;
        }
        public function getEstadoEnvio()
        {
            return $this->estadoEnvio;
        }
        public function setEstadoEnvio($estadoEnvio){
            $this->estadoEnvio= $estadoEnvio;
            return $this;
        }

        public function mostrarCompra(){
            return 'idCompra '.$this->idCompra.'fechaCompra '.$this->fechaCompra.'metodoCompra '.$this->metodoCompra.'IdObra '.$this->idObra.'idUserRegistrado '.$this->idUsuarioRegistrado.'IdArtista '.$this->idArtista.'idDireccion '.$this->IdDireccion.' precio compra: '.$this->precioCompra;


        }
        public function crearCompra(compra $compra){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("INSERT INTO `compra` ( `fechaCompra`, `metodoCompra`, `Obra_idObra`, `Usuario_Registrado_idUsuario_Registrado`, `Artista_idArtista`,Direccion_IdDireccion, precioCompra) VALUES  ( ?,?,?,?,?,?,?)"); //prepared Statement
                $res->execute([$compra->getFechaCompra(),$compra->getMetodoCompra(),$compra->getIdObra(),$compra->getIdUsuarioRegistrado(),$compra->getIdArtista(),$compra->getIdDireccion(),$compra->getPrecioCompra()]);
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
                    $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `compra` where `Obra_idObra`=? ORDER by idCompra DESC  ");
                    $resul->execute([$idObra]);
                    while($fila = $resul->fetch())
                    {
                        $c = new compra($fila["idCompra"],$fila["fechaCompra"],$fila["metodoCompra"], $fila["Obra_idObra"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Artista_idArtista"], $fila["Direccion_IdDireccion"], $fila["precioCompra"]);
                      
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
                    $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `compra` where `Usuario_Registrado_idUsuario_Registrado`=? ORDER by idCompra DESC ");
                    $resul->execute([$idUsuarioRegistrado]);
                    while($fila = $resul->fetch())
                    {
                        $c = new compra($fila["idCompra"],$fila["fechaCompra"],$fila["metodoCompra"], $fila["Obra_idObra"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Artista_idArtista"], $fila["Direccion_IdDireccion"],$fila["precioCompra"]);
                        $c->setEstadoEnvio($fila['estadoEnvio']);
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
        public function listarVentasIdArtista($idAr){
            $lista = new ArrayList();
                try
                {
                    $this->pdo = Conexion::getInstance();
                    $this->pdo->openConnection();
                    $resul = $this->pdo->useConnection()->prepare("SELECT * FROM compra WHERE `Artista_idArtista`=? and EXTRACT(MONTH FROM fechaCompra)= MONTH(CURRENT_DATE()) ORDER BY `compra`.`fechaCompra` DESC;");
                    $resul->execute([$idAr]);
                    while($fila = $resul->fetch())
                    {
                        $c = new compra($fila["idCompra"],$fila["fechaCompra"],$fila["metodoCompra"], $fila["Obra_idObra"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Artista_idArtista"], $fila["Direccion_IdDireccion"],$fila["precioCompra"]);
                        $c->setEstadoEnvio($fila['estadoEnvio']);
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

        public function montoVentasUltimosSeisMese($idAr){
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("
                SELECT  sum(compra.precioCompra) as 'precio'
                FROM 
                    compra, obra
                WHERE 
                    compra.Obra_idObra= obra.idObra and
                    compra.Artista_idArtista=? and
                    compra.fechaCompra>= CURRENT_DATE - INTERVAL 6 MONTH and 
                    compra.fechaCompra<= CURRENT_DATE
                
                
                ");
                $resul->execute([$idAr]);
                while($fila = $resul->fetch())
                {
                    $c = $fila["precio"];
                   
                }
                return $c;
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
        
        public function listarVentasObrasSeisMeses($idAr){
            $lista = new ArrayList();
                try
                {
                    $this->pdo = Conexion::getInstance();
                    $this->pdo->openConnection();
                    $resul = $this->pdo->useConnection()->prepare(
                    "SELECT sum(compra.precioCompra) as 'precio',date_format(compra.fechaCompra, '%m-%y') as 'fecha' 
                    FROM 
                        compra, 
                        obra 
                    WHERE 
                        compra.Obra_idObra= obra.idObra and 
                        compra.Artista_idArtista=? and 
                        compra.fechaCompra>= CURRENT_DATE - INTERVAL 6 MONTH and
                         compra.fechaCompra<= CURRENT_DATE 
                    GROUP BY compra.fechaCompra;");
                    $resul->execute([$idAr]);
                    while($fila = $resul->fetch())
                    {
                        $c = new compra( $fila['precio'],$fila['fecha'],null, null, null, null, null, null);
                        $c->setIdArtista($fila['precio']);
                        $c->setFechaCompra($fila["fecha"]);
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

        public function editarCompra($idCompra, $codigoEnvio){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE compra SET estadoEnvio=? WHERE idCompra=?");
                $res->execute([$codigoEnvio,$idCompra]);
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


        public function buscarCompraIdObra($id){
            $idAr = FALSE;
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM compra WHERE Obra_idObra=?");
                $resul->execute([$id]);
                while($fila = $resul->fetch())
                {
                    $idAr = new compra($fila["idCompra"], $fila['fechaCompra'], $fila['metodoCompra'], $fila['Obra_idObra'],$fila['Usuario_Registrado_idUsuario_Registrado'], $fila['Artista_idArtista'], $fila['Direccion_IdDireccion'], $fila['precioCompra']);
                    $idAr->setEstadoEnvio($fila['precioCompra']);
                    
                }    
                return $idAr;
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
        


    }


?>