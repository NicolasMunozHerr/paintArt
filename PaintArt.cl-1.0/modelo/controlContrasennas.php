<?php 
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";


 class contraseñas{
    private $idContraseña;
    private $email;
    private $token;
    private $fecha;
    private $codigo;
    private $usuarioRegistrado;


    public function __construct($idContraseña, $email, $token, $fecha, $codigo, $usuarioRegistrado)
    {
        $this->idContraseña= $idContraseña;
        $this->email= $email;
        $this->token= $token;
        $this->fecha= $fecha;
        $this->codigo = $codigo;
        $this->usuarioRegistrado= $usuarioRegistrado;
    }

    public function __getIdContraseña(){
        return $this->idContraseña;
    }
    public function __setIdContraseña($idContraseña){
        $this->idContraseña= $idContraseña;
        return $this;
    }

    public function __getEmail(){
        return $this->email;
    }
    public function __setEmail($email){
        $this->email= $email;
        return $this;
    }

    public function __getToken(){
        return $this->token;
    }
    public function __setToken($token){
        $this->token= $token;
        return $this;
    }

    public function __getFecha(){
        return $this->fecha;
    }
    public function __setFecha($fecha){
        $this->fecha= $fecha;
        return;
    }

    public function __getCodigo(){
        return $this->codigo;
    }
    public function __setCodigo($codigo){
        $this->codigo= $codigo;
        return;
    }

    public function __getIdUserRegistrado(){
        return $this->usuarioRegistrado;
    }
    public function __setIdUserRegistrado($usuarioRegistrado){
        $this->usuarioRegistrado= $usuarioRegistrado;
        return;
    }

    public function __toString()
    {
        return 'IdContraseña: '. $this->idContraseña. ' email: '.$this->email. ' token: '.$this->token. ' fecha: '. $this->fecha.' codigo: '.$this->codigo. ' usuario registrado: '. $this->usuarioRegistrado;
    }


    public function crearContraseña(contraseñas $con){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("INSERT INTO `contraseña` ( `idcontraseña`,  `email`, `token`, `fecha`, `codigo`, `Usuario_Registrado_idUsuario_Registrado`) VALUES  (  null, ?, ?,?,?,?)"); //prepared Statement
            $res->execute([$con->__getEmail(), $con->__getToken(), $con->__getFecha(),$con->__getCodigo(), $con->__getIdUserRegistrado()]);
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

    PUBLIC function buscarConstraseña($email, $token){
        $idUs = FALSE;
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM contraseña WHERE email=? and token= ?");
            $resul->execute([$email, $token]);
            while($fila = $resul->fetch())
            {
                $idUs = new contraseñas($fila['idcontraseña'], $fila['email'], $fila['token'], $fila['fecha'], $fila['codigo'], $fila['Usuario_Registrado_idUsuario_Registrado']);
                
                
            }    
            return $idUs;
        }
        catch(PDOException $e)
        {
            
           // return error_log($e->getMessage());
           return false;
        }
        finally{
            $this->pdo->closeConnection();
        }
    }


    public function eliminarSolicitud($correo){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("DELETE FROM contraseña WHERE email=?");
            $resul= $res->execute([$correo]);
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



 }


?>