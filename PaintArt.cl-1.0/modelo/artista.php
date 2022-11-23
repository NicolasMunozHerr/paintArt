<?php 
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";
    class artista 
    {
        private $idArtista;
        private $biografia;
        private $idUsuarioRegistrado;
        private $contacFace;
        private $contacIg;
        private $contacTwit;
        private $contacTikTok;


        public function __construct($idArtista, $biografia, $idUsuarioRegistrado)
        {
            $this->idArtista= $idArtista;
            $this->biografia= $biografia;
            $this->idUsuarioRegistrado= $idUsuarioRegistrado;
        }


        public function getIdArtista()
        {
            return $this->idArtista;
        }
        public function setIdArtista($idArtista)
        {
            $this->idArtista= $idArtista;
            return $this;
        }

        public function getBiografia(){
            return $this->biografia;
        }
        public function setBiografia($biografia){
            $this->biografia= $biografia;
            return $this;
        }

        public function getIdUsuarioRegistrado(){
            return $this->idUsuarioRegistrado;
        }
        public function setIdUsuarioRegistrado($idUsuarioRegistrado){
            $this->idUsuarioRegistrado= $idUsuarioRegistrado;
            return $this;
        }

        public function getContacIg(){
            return $this->contacIg;
        }
        public function setContacIg($contacIg){
            $this->contacIg= $contacIg;
            return $this;
        }

        public function getContacTwit(){
            return $this->contacTwit;
        }
        public function setContacTwit($contacTwit){
            $this->contacTwit= $contacTwit;
            return $this;
        }

        public function setContacTikTok(){
            return $this->contacTikTok;
        }
        public function setContaTikTok($contacTikTok){
            $this->contacTikTok= $contacTikTok;
            return $this;
        }

        public function getContacFace(){
            return $this->contacFace;
        }
        public function setContaFace($contacFace){
            $this->contacFace= $contacFace;
            return $this;
        }


        public function __toString()
        {
            return "id artista: ".$this->idArtista." biografia: ".$this->biografia." id usuario registrado: ".$this->idUsuarioRegistrado;
        }
        public function crearArtista(artista $artista){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("INSERT INTO `artista` (  `idArtista`, `biografia`, `Usuario_Registrado_idUsuario_Registrado`) VALUES  (  ?, ?, ?)"); //prepared Statement
                $res->execute([NULL , $artista->getBiografia(), $artista->getIdUsuarioRegistrado()]);
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

        PUBLIC function buscarIdArtista($id){
            $idAr = FALSE;
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM artista WHERE idArtista=?");
                $resul->execute([$id]);
                while($fila = $resul->fetch())
                {
                    $idAr = new artista($fila["idArtista"],$fila["biografia"],$fila["Usuario_Registrado_idUsuario_Registrado"]);
                    
                    
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
        PUBLIC function buscarArtistaIdUser($id){
            $idAr = FALSE;
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM artista WHERE Usuario_Registrado_idUsuario_Registrado=?");
                $resul->execute([$id]);
                while($fila = $resul->fetch())
                {
                    $idAr = new artista($fila["idArtista"],$fila["biografia"],$fila["Usuario_Registrado_idUsuario_Registrado"]);
                    
                    
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

        public function listarArtista(){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `artista`");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $c = new artista($fila["idArtista"],$fila["biografia"],$fila["Usuario_Registrado_idUsuario_Registrado"]);
                  
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

        public function actualizarBiografiaArtista(artista $artista){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE artista SET biografia=? WHERE idArtista=?");
                $res->execute([$artista->getBiografia(), $artista->getIdArtista()]);
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



    }





?>