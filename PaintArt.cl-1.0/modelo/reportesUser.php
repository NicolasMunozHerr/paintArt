<?php 
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";


 class reporteUser{
    var $idReporteUser;
    var $explicacion;
    var $razon;
    var $idUsuarioRegistrado;
    var $idCritica;

    public function __construct($idReporteUser, $explicacion, $razon, $idUsuarioRegistrado, $idCritica)
    {
        $this->idReporteUser= $idReporteUser;
        $this->explicacion = $explicacion;
        $this->razon= $razon ;
        $this->idUsuarioRegistrado= $idUsuarioRegistrado;
        $this->idCritica= $idCritica;
        
    }

    public function getIdReporteUser(){
        return $this->idReporteUser;
    }
    public function setIdReporteUser($idReporteUser)
    {
        $this->idReporteUser= $idReporteUser;
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

    public function getIdUsuarioRegistrado()
    {
        return $this->idUsuarioRegistrado;
    }
    public function setIdUsuarioRegistrado($idUsuarioRegistrado){
        $this->idUsuarioRegistrado= $idUsuarioRegistrado;
        return $this;
    }

    public function getIdCriticas(){
        return $this->idCritica;
    }
    public function setIdCritica($idCritica){
        $this->idCritica= $idCritica;
        return $this;
    }


    public function __toString()
    {
        return ' '. $this->idReporteUser.' '. $this->explicacion.' '. $this->razon.' '. $this->idUsuarioRegistrado.' '. $this->idCritica; ;
        
    }

    public function subirReporUser(reporteUser $repor){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("INSERT INTO `reportesuser` (  `explicacion`, `razon`, `Usuario_Registrado_idUsuario_Registrado`, `Crititica_idCrititica`) VALUES  (  ?, ?, ?, ?)"); //prepared Statement
            $res->execute([$repor->getExplicacion(),$repor->getRazon(),$repor->getIdUsuarioRegistrado(),$repor->getIdCriticas()]);
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
    public function buscarReporteUserId($id){
        $repor = FALSE;
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM reportesuser WHERE idReportesUser=?");
            $resul->execute([$id]);
            while($fila = $resul->fetch())
            {
                $repor = new reporteUser($fila["idReportesUser"],$fila["explicacion"],$fila["razon"] , $fila["Usuario_Registrado_idUsuario_Registrado"], $fila["Crititica_idCrititica"]);
              
                
                
            }    
            return $repor;
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

    public function bajarReporteUser($id){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("DELETE FROM reportesuser WHERE idReportesUser=?");
            $resul= $res->execute([$id]);
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

    public function bajarReporteCritia($id){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("DELETE FROM reportesuser WHERE Crititica_idCrititica=?");
            $resul= $res->execute([$id]);
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

    PUBLIC function listarReporteUser(){
        $lista = new ArrayList();
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `reportesuser`");
            $resul->execute([]);
            while($fila = $resul->fetch())
            {
                $c = new reporteUser($fila["idReportesUser"],$fila["explicacion"],$fila["razon"],$fila["Usuario_Registrado_idUsuario_Registrado"],$fila["Crititica_idCrititica"]);
               
                
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

 }

?>