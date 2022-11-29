<?php
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";

class critica {

    var $idCritica;
    var $valoracion;
    var $critica;
    var $idobra;
    var $idUsuarioRegistrado;

    public function __construct($idCritica, $valoracion, $critica, $idobra, $idUsuarioRegistrado)
    {
        $this->idCritica= $idCritica;
        $this->valoracion= $valoracion;
        $this->critica= $critica;
        $this->idobra= $idobra;
        $this->idUsuarioRegistrado= $idUsuarioRegistrado;
    }


    public function getIdCritica(){
        return $this->idCritica;       
    }
    public function setIdCritica($idCritica)
    {
        $this->idCritica= $idCritica;
        return $this;
    }

    public function getValoracion(){
        return $this->valoracion;
    }
    public function setValoracion($valoracion){
        $this->valoracion=$valoracion;
        return $this;
    }

    public function getCritica(){
        return $this->critica;
    }
    public function setCritica($critica){
        $this->critica=$critica;
        return $this;
    }

    public function getIdObra(){
        return $this->idobra;
    }
    public function setIdObra($idobra){
        $this->idobra= $idobra;
        return $this;

    }

    public function getIdUsuarioRegistrado(){
        return $this->idUsuarioRegistrado;
    }
    public function setIdUsuarioRegistrado($idUsuarioRegistrado){
        $this->idUsuarioRegistrado=$idUsuarioRegistrado;
        return $this;
    }
    public function __toString()
    {
        return 'idCritica'. $this->idCritica.' Valioracion '. $this->valoracion. ' critica '. $this->critica. ' idObra'. $this->idobra.' IdUsuarioRegistradp '. $this->idUsuarioRegistrado;
    }

    public function listarCritica($idObra){
        $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `critica` where `Obra_idObra`=?  ORDER BY `critica`.`idCrititica` DESC");
                $resul->execute([$idObra]);
                while($fila = $resul->fetch())
                {
                    $c = new critica($fila["idCrititica"],$fila["valoracion"],$fila["critica"], $fila["Obra_idObra"],$fila["Usuario_Registrado_idUsuario_Registrado"]);
                  
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

    public function insertarCritica(critica $crit){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("INSERT INTO `critica` (`idCrititica`, `valoracion`, `critica`, `Obra_idObra`, `Usuario_Registrado_idUsuario_Registrado`) VALUES  ( null,?,?,?,?)"); //prepared Statement
            $res->execute([$crit->getValoracion(),$crit->getCritica(),$crit->getIdObra(),$crit->getIdUsuarioRegistrado()]);
            return true;
             
        }
        catch(PDOException $e)
        {
             return error_log($e->getMessage());
            //return false;
        }
        finally{
            $this->pdo->closeConnection();
        }


    }

    public function buscarCritica($idCriti){
        $crit = FALSE;
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM critica WHERE idCrititica=?");
            $resul->execute([$idCriti]);
            while($fila = $resul->fetch())
            {
                $crit = new critica($fila["idCrititica"],$fila["valoracion"] , $fila["critica"], $fila["Obra_idObra"],$fila["Usuario_Registrado_idUsuario_Registrado"]);
              
                
                
            }    
            return $crit;
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

    public function bajarCritica($idCritica){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("DELETE FROM critica WHERE idCrititica=?");
            $resul= $res->execute([$idCritica]);
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
    public function bajarCriticaIDObra($idobra){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("DELETE FROM critica WHERE Obra_idObra=?");
            $resul= $res->execute([$idobra]);
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


    public function listarCriticaSegunObra($idobra){
        $lista = new ArrayList();
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `critica` where `Obra_idObra`=?");
            $resul->execute([$idobra]);
            while($fila = $resul->fetch())
            {
                $c = new critica($fila["idCrititica"],$fila["valoracion"],$fila["critica"],$fila["Obra_idObra"],$fila["Usuario_Registrado_idUsuario_Registrado"]);
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


    public function buscarElMasComentado($idAr){
        $crit = FALSE;
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare(
            "SELECT count(critica.idCrititica) as 'Cantidad',
            obra.idObra 
            from
                critica,
                obra,
                artista
            WHERE 
                critica.Obra_idObra =obra.idObra and 
                obra.Artista_idArtista= artista.idArtista AND 
                artista.idArtista= ?
            group BY 
                obra.idObra 
            ORDER BY 
                `Cantidad` DESC
            LIMIT 
                1");
            $resul->execute([$idAr]);
            while($fila = $resul->fetch())
            {
                $crit = new critica(NULL,NULL, NULL, $fila["idObra"],NULL);
              
                
                
            }    
            return $crit;
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