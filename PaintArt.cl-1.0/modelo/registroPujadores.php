<?php 
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";
class registroPujadores{
    private $idregistroPujadores;
    private $valor;
    private $Direccion_IdDireccion;
    private $Usuario_Registrado_idUsuario_Registrado;
    private $Subasta_idSubasta;
    
    public function __construct()
    {
        
    }


    public function __getIdPujadores()
    {
        return $this->idregistroPujadores;
    }
    public function __setIdPujadores($idregistroPujadores)
    {
        $this->idregistroPujadores= $idregistroPujadores;
        return $this;
    }

    
    public function __getValor(){
        return $this->valor;
    }
    public function __setValor($valor){
        $this->valor= $valor;
        return $this;
    }

    public function __getDireccion_IdDireccion(){
        return $this->Direccion_IdDireccion;
    }

    public function __setDireccion_IdDireccion($Direccion_IdDireccion){
        $this->Direccion_IdDireccion= $Direccion_IdDireccion;
        return $this;
    }

    public function __getIdUser(){
        return $this->Usuario_Registrado_idUsuario_Registrado;
    }

    public function __setIdUser($Usuario_Registrado_idUsuario_Registrado){
        $this->Usuario_Registrado_idUsuario_Registrado= $Usuario_Registrado_idUsuario_Registrado;
        return $this;
    }

    public function __getSubasta_idSubasta(){
        return $this->Subasta_idSubasta;
        
    }
    public function __setSubasta($Subasta_idSubasta){
        $this->Subasta_idSubasta= $Subasta_idSubasta;
        return $this;
    }

    

    public function mostrarRegistro(){
        return "idR: ".$this->idregistroPujadores." valor:".$this->valor." direccion: ".$this->Direccion_IdDireccion." idUser: ".$this->Usuario_Registrado_idUsuario_Registrado." Subasta: ".$this->Subasta_idSubasta; 
    }

    public function agregarRegistro( $registro){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("INSERT INTO `registropujadores` (  `idregistroPujadores`, `valor`, `Direccion_IdDireccion`, `Usuario_Registrado_idUsuario_Registrado`,`Subasta_idSubasta`) VALUES  (  ?, ?,? ,? ,?)"); //prepared Statement
            $res->execute([NULL , $registro->__getValor(), $registro->__getDireccion_IdDireccion(), $registro->__getIdUser(),$registro->__getSubasta_idSubasta()]);
            return true;
             
        }
        catch(PDOException $e)
        {
            return  error_log($e->getMessage());
           return  false;
        }
        finally{
            $this->pdo->closeConnection();
        }


    }

    public function listarRegistro()
    {
        $idAr = FALSE;
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("select * from registropujadores order by idregistroPujadores desc;");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $idAr = new registroPujadores();
                    //$idAr->__setFechaLimite($fila["fechaTermino"]);
                    
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

    public function listarRegistroIdSubUser($idUsuario,$idSubasta){
        $idAr = FALSE;
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("select * from registropujadores where Usuario_Registrado_idUsuario_Registrado=? and  Subasta_idSubasta=?");
                $resul->execute([$idUsuario, $idSubasta]);
                while($fila = $resul->fetch())
                {
                    $idAr = new registroPujadores();
                    $idAr->__setIdPujadores($fila["idregistroPujadores"]);
                    $idAr->__setValor($fila["valor"]);
                    $idAr->__setIdUser($fila["Usuario_Registrado_idUsuario_Registrado"]);
                    $idAr->__setSubasta($fila["Subasta_idSubasta"]);
                    
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
    public function listarRegistroIdUser($idUsuario){
        $lista = new ArrayList();
                try
                {
                    $this->pdo = Conexion::getInstance();
                    $this->pdo->openConnection();
                    $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `registropujadores` where `Usuario_Registrado_idUsuario_Registrado`=? ORDER by idregistroPujadores DESC ");
                    $resul->execute([$idUsuario]);
                    while($fila = $resul->fetch())
                    {
                        $c = new registroPujadores();
                        $c->__setIdPujadores($fila["idregistroPujadores"]);
                        $c->__setValor($fila["valor"]);
                        $c->__setIdUser($fila["Usuario_Registrado_idUsuario_Registrado"]);
                        $c->__setSubasta($fila["Subasta_idSubasta"]);
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
    
    public function eliminarRegistroIdSubasta($idSubasta){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("DELETE FROM `registropujadores` WHERE `Subasta_idSubasta`=?");
            $resul= $res->execute([$idSubasta]);
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

    public function modificarPuja($valor, $idUsuario, $idSubasta){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("UPDATE registropujadores SET valor=? WHERE Usuario_Registrado_idUsuario_Registrado=? and  Subasta_idSubasta=?");
            $res->execute([$valor,$idUsuario, $idSubasta]);
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

    public function maximoPujador($idSubasta){

        $c="";
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `registropujadores` where Subasta_idSubasta= ? ORDER BY cast(`registropujadores`.`valor` as int ) DESC limit 1");
            $resul->execute([$idSubasta]);
            while($fila = $resul->fetch())
            {
                $c = new registroPujadores();
                $c->__setIdPujadores($fila["idregistroPujadores"]);
                $c->__setValor($fila["valor"]);
                $c->__setIdUser($fila["Usuario_Registrado_idUsuario_Registrado"]);
                $c->__setSubasta($fila["Subasta_idSubasta"]);
            }    
            return $c;
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