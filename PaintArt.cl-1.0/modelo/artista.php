<?php 
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";
    class artista 
    {
        private $idArtista;
        private $biografia;
        private $idUsuarioRegistrado;

        public function __construct()
        {
            
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

        public function __toString()
        {
            return "id artista: ".$this->idArtista." biografia: ".$this->biografia." id usuario registrado: ".$this->idUsuarioRegistrado;
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
                    $idAr = new artista();
                    $idAr->setIdArtista($fila["idArtista"]);
                    $idAr->setIdUsuarioRegistrado($fila["Usuario_Registrado_idUsuario_Registrado"]);
                    $idAr->setBiografia($fila["biografia"]);
                    
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