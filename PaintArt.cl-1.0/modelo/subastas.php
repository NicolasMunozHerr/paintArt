<?php 
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";
class subasta{
    private $idSubasta;
    private $fechaLimite;
    private $precioPuja;
    private $idUsuarioRegistrado;
    private $precioMinimo;
    private $idArtista;
    private $idObra;
    public function __construct()
    {
        
    }


    public function __getidSubasta()
    {
        return $this->idSubasta;
    }
    public function __setidSubasta($idSubasta)
    {
        $this->idSubasta= $idSubasta;
        return $this;
    }

    
    public function __getFechaLimite(){
        return $this->fechaLimite;
    }
    public function __setFechaLimite($fechaLimite){
        $this->fechaLimite= $fechaLimite;
        return $this;
    }

    public function __getPrecioPuja(){
        return $this->precioPuja;
    }

    public function __setPrecioPuja($precioPuja){
        $this->precioPuja= $precioPuja;
        return $this;
    }

    public function __getIdArtista(){
        return $this->idArtista;
    }

    public function __setIdArtista($idArtista){
        $this->idArtista= $idArtista;
        return $this;
    }

    public function __getPrecioMinimo(){
        return $this->precioMinimo;
        
    }
    public function __setPrecioMinimo($precioMinimo){
        $this->precioMinimo= $precioMinimo;
        return $this;
    }

    public function __getIdObra()
    {
        return $this->idObra;
    }

    PUBLIC function __setIdObra($idObra){
        $this->idObra= $idObra;
        return $this;
    }

    public function mostrarSubasta(){
        return "idSubasta: ".$this->idSubasta." fechaLimiete:".$this->fechaLimite." precioPuja: ".$this->precioPuja." idArtista: ".$this->idArtista." idObra: ".$this->idObra." precioMinimo: ".$this->precioMinimo ; 
    }

    public function agregarSubasta( $subasta){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("INSERT INTO `subasta` (  `idSubasta`, `fechaTermino`, `precioPuja`, `Artista_idArtista`,`Obra_idObra`, `precioMinimo`) VALUES  (  ?, ?,? ,? ,?,?)"); //prepared Statement
            $res->execute([NULL , $subasta->__getFechaLimite(), $subasta->__getPrecioPuja(), $subasta->__getIdArtista(),$subasta->__getIdObra(), $subasta->__getPrecioMinimo()]);
            return true;
             
        }
        catch(PDOException $e)
        {
            return  error_log($e->getMessage());
           //return  false;
        }
        finally{
            $this->pdo->closeConnection();
        }


    }
    public function buscarSubasta($idSubasta){
        $idAr = FALSE;
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare("select * from subasta where idSubasta=?");
            $resul->execute([$idSubasta]);
            while($fila = $resul->fetch())
            {
                $idAr = new subasta();
                $idAr->__setidSubasta($fila["idSubasta"]);
                $idAr->__setFechaLimite($fila["fechaTermino"]);
                $idAr->__setIdObra($fila["Obra_idObra"]);
                $idAr->__setPrecioPuja($fila["precioPuja"]);
                $idAr->__setPrecioMinimo($fila["precioMinimo"]);
                $idAr->__setIdArtista($fila["Artista_idArtista"]);
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

    public function listarUltimaFecha()
    {
        $idAr = FALSE;
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("select * from subasta order by idSubasta desc limit 1;");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $idAr = new subasta();
                    $idAr->__setFechaLimite($fila["fechaTermino"]);
                    
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


    public function validaAsociacionObra($idObra){
        $idAr="";
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * from subasta where Obra_idObra=?");
                $resul->execute([$idObra]);
                while($fila = $resul->fetch())
                {
                    $idAr = new subasta();
                    $idAr->__setidSubasta($fila["idSubasta"]);
                    $idAr->__setFechaLimite($fila["fechaTermino"]);
                    $idAr->__setPrecioPuja($fila["precioPuja"]);
                    $idAr->__setPrecioMinimo($fila["precioMinimo"]);
                }    
                return $idAr;
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


    public function eliminarSubastaIdSubasta($idSubasta){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("DELETE FROM `subasta` WHERE `idSubasta`=?");
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


    public function aumentarPujaActual($valor,$idSub){
        try{
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $res = $this->pdo->useConnection()->prepare("UPDATE subasta SET precioPuja=? WHERE idSubasta=?");
            $res->execute([$valor,$idSub]);
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


    public function listarSubastaIdArtista($idAr){
        $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM `subasta` WHERE `Artista_idArtista`=? and EXTRACT(MONTH FROM `fechaTermino` )= MONTH(CURRENT_DATE());");
                $resul->execute([$idAr]);
                while($fila = $resul->fetch())
                {
                    
                    $c = new subasta();
                    $c->__setidSubasta($fila["idSubasta"]);
                    $c->__setFechaLimite($fila["fechaTermino"]);
                    $c->__setPrecioPuja($fila["precioPuja"]);
                    $c->__setPrecioMinimo($fila["precioMinimo"]);
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
    public function subastasUltimosSeisMeses($idAr){
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare(
                "SELECT SUM(subasta.precioPuja) as 'cantidad'
                FROM
                    obra,
                    subasta,
                    artista
                WHERE 
                    obra.idObra= subasta.Obra_idObra AND
                    obra.Artista_idArtista= artista.idArtista AND
                    artista.idArtista = ? AND
                    subasta.fechaTermino>= CURRENT_DATE - INTERVAL 6 MONTH and
                     subasta.fechaTermino<= CURRENT_DATE;");
                $resul->execute([$idAr]);
                while($fila = $resul->fetch())
                {
                    
                    $c = $fila['cantidad'];
                }
                return $c;
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
    public function detalleSubastasUltimosSeisMeses($idAr){
        $lista = new ArrayList();
        try
        {
            $this->pdo = Conexion::getInstance();
            $this->pdo->openConnection();
            $resul = $this->pdo->useConnection()->prepare(
            "SELECT SUM(subasta.precioPuja) as 'cantidad',
            date_format(subasta.fechaTermino, '%m-%y') as 'mes' 
            FROM obra, subasta, artista 
            WHERE obra.idObra= subasta.Obra_idObra AND 
                obra.Artista_idArtista= artista.idArtista AND 
                artista.idArtista = ? AND 
                subasta.fechaTermino>= CURRENT_DATE - INTERVAL 6 MONTH and 
                subasta.fechaTermino<= CURRENT_DATE
            GROUP by 
                `mes`
            ");
            $resul->execute([$idAr]);
            while($fila = $resul->fetch())
            {
                
                $c = new subasta();
                $c->__setFechaLimite($fila['mes']);
                $c->__setPrecioPuja($fila['cantidad']);
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

    

}
?>