<?php 
include_once dirname(__FILE__)."/../Conexion/conexion.php";
class imagen 
{
    private $idImagen;
    private $urlImagen;


    public function __construct($urlImagen)
    {
        $this->urlImagen= $urlImagen;
    }


    public function getIdImagen(){
        return $this->idImagen;
    }
    public function setIdImagen($idImagen){
        $this->idImagen= $idImagen;
        return $this;
    }

    public function getUrlImagen(){
        return $this->urlImagen;
    }
    public function setUrlImagen($urlImagen){
        $this->urlImagen= $urlImagen;
        return $this;
    }


    public function __toString()
    {
        return 'Id Imagen: '.$this->idImagen.' url de la imagen: '.$this->urlImagen;
    }

    public function subirImagen($imagen){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("INSERT INTO `imagen` ( `urlImagen`) VALUES  ( ?)"); //prepared Statement
            $res->execute([$imagen->getUrlImagen()]);
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

    public function buscarImagen( imagen $imagen)
    {
        $img = FALSE;
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM imagen WHERE UrlImagen=?");
            $resul->execute([$imagen->getUrlImagen()]);
            while($fila = $resul->fetch())
            {
                $img = new imagen($fila["UrlImagen"]);
                $img->setIdImagen($fila["idImagen"]);
                
                
            }    
            return $img;
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
    public function buscarImagenID($imagen)
    {
        $img = FALSE;
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM imagen WHERE idImagen=?");
            $resul->execute([$imagen]);
            while($fila = $resul->fetch())
            {
                $img = new imagen($fila["UrlImagen"]);
                $img->setIdImagen($fila["idImagen"]);
                
                
            }    
            return $img;
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
    public function eliminarImagen($id){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("DELETE FROM imagen WHERE `imagen`.`idImagen` = ?");
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

     public function ulltimaIdImagen()
    {
        $img = FALSE;
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare("SELECT MAX(`idImagen`) AS id FROM imagen");
            $resul->execute([]);
            while($fila = $resul->fetch())
            {
                $img = new imagen("a");
                $img->setIdImagen($fila["id"]);
                
                
            }    
            return $img;
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

    public function cambiarUrl(imagen $imagen){
        
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE imagen SET UrlImagen=? WHERE idImagen=?");
                $res->execute([$imagen->getUrlImagen(),$imagen->getIdImagen()]);
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