<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

include_once dirname(__FILE__)."/../Conexion/conexion.php";
include_once dirname(__FILE__)."/../modelo/arraylist.php";

class tarjetaUser{
    private $idTarjetUser;
    private $numTarjeta;
    private $mesCaducidad;
    private $añoCaducidad;
    private $cvv;
    private $idUsuarioRegistrado;
    private $tipoTarjeta;


    public function __construct()
    {
        
    }


    public function __getIdtarjetaUser(){
        return $this->idTarjetUser;
    }
    public function __setIdTarjetaUser($idTarjetUser){
        $this->idTarjetUser= $idTarjetUser;
        return ;
    }

    public function __getNumTarjeta(){
        return $this->numTarjeta;
    }
    public function __setNumTarjeta($numTarjeta){
        $this->numTarjeta= $numTarjeta;
        return $this;
    }


    public function __getMesCaducidad(){
        return $this->mesCaducidad;
    }

    public function __setMesCaducidad($mesCaducidad){
        $this->mesCaducidad= $mesCaducidad;
        return $this;
    }

    public function __getAñoCaducidad(){
        return $this->añoCaducidad;
    }
    public function __setAñoCaducidad($añoCaducidad){
        $this->añoCaducidad= $añoCaducidad;
        return $this;
    }

    public function __getCvv(){
        return $this->cvv;
    }
    public function __setCvv($cvv){
        $this->cvv= $cvv;
        return $this;
    }

    public function __getIdUser(){
        return $this->idUsuarioRegistrado;
    }
    public function __setIdUser($idUsuarioRegistrado){
        $this->idUsuarioRegistrado= $idUsuarioRegistrado;
        return $this;
    }

    public function __getTipoTarjeta(){
        return $this->tipoTarjeta;
    }
    public function __setTipoTarjeta($tipoTarjeta){
        $this->tipoTarjeta =$tipoTarjeta;
        return $this;
    }

    public function mostrarTajerUser(){
        return "id: ".$this->idTarjetUser." Nume: ".$this->numTarjeta." mes: ". $this->mesCaducidad. " año: ". $this->añoCaducidad." cvv: ".$this->cvv." idUser: ".$this->idUsuarioRegistrado. "tipo Tarjeta: ".$this->tipoTarjeta;
    }

    public function agregarTarjeta($numTarjeta, $mesCaducidad, $añoCaducidad, $cvv, $idUsuarioRegistrado, $tipoTarjeta){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("INSERT INTO tarjetauser ( `idTarjetaUser`, `numTarjeta`, `mesCaducidad`, `AñoCaducidad`, `cvv`, `Usuario_Registrado_idUsuario_Registrado`,`tipoTarjeta`) VALUES ( null, ?,?, ?, ?, ?, ?);"); //prepared Statement
            $res->execute([$numTarjeta, $mesCaducidad, $añoCaducidad, $cvv, $idUsuarioRegistrado, $tipoTarjeta]);
            return true;
             
        }
        catch(PDOException $e)
        {
            
            return $e->getMessage();
            //return false;
        }
        finally{
            $this->pdo->closeConnection();
        }
    }

    PUBLIC function buscarTarjetaUserId($id){
        $idUs = FALSE;
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM tarjetauser WHERE Usuario_Registrado_idUsuario_Registrado=?");
            $resul->execute([$id]);
            while($fila = $resul->fetch())
            {
                $idUs = new tarjetaUser();
                $idUs->__setIdTarjetaUser($fila["idTarjetaUser"]);
                $idUs->__setNumTarjeta($fila["numTarjeta"]);
                $idUs->__setMesCaducidad($fila["mesCaducidad"]);
                $idUs->__setAñoCaducidad($fila["AñoCaducidad"]);
                $idUs->__setCvv($fila["cvv"]);
                $idUs->__setIdUser($fila["Usuario_Registrado_idUsuario_Registrado"]);
                $idUs->__setTipoTarjeta($fila["tipoTarjeta"]);
                
                
                
            }    
            return $idUs;
        }
        catch(PDOException $e)
        {
            
            return error_log($e->getMessage());
        }
        finally{
            $this->pdo->closeConnection();
        }
    }

    public function modificarTarjeta($numTarjeta, $mesCaducidad, $añoCaducidad, $cvv,  $tipoTarjeta ,$idUsuarioRegistrado){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("UPDATE tarjetauser SET `numTarjeta` = ?, `mesCaducidad` = ?, `AñoCaducidad` = ?, `cvv` = ?, `tipoTarjeta`=? WHERE `tarjetauser`.`Usuario_Registrado_idUsuario_Registrado` = ?;");
            $res->execute([$numTarjeta,$mesCaducidad, $añoCaducidad, $cvv, $tipoTarjeta, $idUsuarioRegistrado]);
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