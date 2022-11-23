<?php
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";
    class notaInformativa{
        private $idNotaInformativa;
        private $titular;
        private $cuerpo;
        private $epigrafe;
        private $idUsuarioRegistrado;
        private $idImagen;


        public function __construct($idNotaInformativa, $titular, $cuerpo, $epigrafe, $idUsuarioRegistrado,$idImagen)
        {
            $this->idNotaInformativa= $idNotaInformativa;
            $this->titular= $titular;
            $this->cuerpo= $cuerpo;
            $this->epigrafe= $epigrafe;
            $this->$idUsuarioRegistrado= $idUsuarioRegistrado; 
            $this->idImagen= $idImagen;
        }

        public function getIdNotainformativa()
        {
            return $this->idNotaInformativa;
        }
        public function setIdNotaInformativa($idNotaInformativa){
            $this->idNotaInformativa= $idNotaInformativa;
            return $this;
        }

        public function getTitular(){
            return $this->titular;
        }
        public function setTitular($titular){
            $this->titular=$titular;
            return $this;
        }

        public function getCuerpo(){
            return $this->cuerpo;
        }
        public function setCuerpo($cuerpo)
        {
            $this->cuerpo= $cuerpo;
            return $this;
        }

        public function getEpigrafe(){
            return $this->epigrafe;
        }
        public function setEpigrafe($epigrafe){
            $this->epigrafe= $epigrafe;
            return $this;
        }

        public function getIdUsuarioRegistrado(){
            return $this->idUsuarioRegistrado;
        }
        public function setIdUsuarioRegistrado($idUsuarioRegistrado){
            $this->idUsuarioRegistrado= $idUsuarioRegistrado;
            return $this;
        }

        public function getIdMagen(){
            return $this->idImagen;
        }
        public function setIdImagen($idImagen){
            $this->idImagen= $idImagen;
            return $this;
        }

        public function __toString()
        {
            return " id Nota informativa: ".$this->idNotaInformativa." titular: ".$this->titular." cuerpo: ".$this->cuerpo.
            " epigrafe : ".$this->epigrafe." IdUsuarioRegistrado:".$this->idUsuarioRegistrado. " id imagen: ".$this->idImagen;
        }


        public function crearNota(notaInformativa $nota){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("INSERT INTO `notainformativa` ( `idnotaInformativa`, `titular`, `cuerpo`, `epigrafe`, `Usuario_Registrado_idUsuario_Registrado`, `Imagen_idImagen`) VALUES  ( ?, ?, ?, ?, ?, ?)"); //prepared Statement
                $res->execute([null,$nota->getTitular(),$nota->getCuerpo(),$nota->getEpigrafe(),$nota->getIdUsuarioRegistrado(),$nota->getIdMagen()]);
                return true;
                 
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                return $e->getMessage();
            }
            finally{
                $this->pdo->closeConnection();
            }
        }

        public function listarNotas(){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `notainformativa` ORDER by idnotaInformativa DESC");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $c = new notaInformativa($fila["idnotaInformativa"],$fila["titular"], $fila["cuerpo"], $fila["epigrafe"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Imagen_idImagen"]);
                   
                    
                    $lista->add($c);
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                return FALSE;
                //return error_log($e->getMessage());

            }
            finally{
                $this->pdo->closeConnection();
            }
        }
        public function eliminarNota($idNotaInformativa){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("DELETE FROM notainformativa WHERE idnotaInformativa=?");
                $resul= $res->execute([$idNotaInformativa]);
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

        public function buscarNota($idNotaInformativa){
            $nota = FALSE;
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM notainformativa WHERE idnotaInformativa=?");
                $resul->execute([$idNotaInformativa]);
                while($fila = $resul->fetch())
                {
                    $nota = new notaInformativa($fila["idnotaInformativa"],$fila["titular"], $fila["cuerpo"], $fila["epigrafe"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Imagen_idImagen"]);
                    
                }    
                return $nota;
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
