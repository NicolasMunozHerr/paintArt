<?php  
include_once dirname(__FILE__)."/../Conexion/conexion.php"; 
include_once dirname(__FILE__)."/../modelo/arraylist.php"; 
class click{ 
    private $idclicks; 
    private $fecha; 

    public function __construct() 
    { 

    } 

  

    public function __getIdClick() 

    {    
        return $this->idclicks; 

    } 

    public function __setIdClick($idclicks){ 
        $this->idclicks=$idclicks; 
        return $this; 
    } 

  

    public function __getFecha(){ 
        return $this->fecha; 
    } 

  

  

    public function __setFecha($fecha){ 
        $this->fecha=$fecha; 
        return $this; 
    } 

  

  

    public function __toString() 

    { 

        return "id: ".$this->idclicks." fecha: ".$this->fecha; 

    } 

  

  

  

    public function agregarClick($fecha){ 

        try{ 

            $this->pdo = Conexion::getInstance(); 

            $this->pdo->openConnection(); 

            $res = $this->pdo->useConnection()->prepare("INSERT INTO clicks ( `fechaClick`) VALUES  ( ?);"); //prepared Statement 

            $res->execute([$fecha]); 

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

    public function agregarClickObraHasClick($IdObra, $idClick){ 

        try{ 

            $this->pdo = Conexion::getInstance(); 

            $this->pdo->openConnection(); 

            $res = $this->pdo->useConnection()->prepare("INSERT INTO obra_has_clicks ( `Obra_idObra`,`clicks_idclicks`) VALUES  ( ?,?);"); //prepared Statement 

            $res->execute([$IdObra, $idClick]); 

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

    public function agregarClickArtistaHasClick($idArtista, $idClick){ 

        try{ 

            $this->pdo = Conexion::getInstance(); 

            $this->pdo->openConnection(); 

            $res = $this->pdo->useConnection()->prepare("INSERT INTO artista_has_clicks ( `Artista_idArtista`,`clicks_idclicks`) VALUES  ( ?,?);"); //prepared Statement 

            $res->execute([$idArtista, $idClick]); 

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

    public function listarUltimoClick(){ 

        $c = FALSE; 

        try 

        { 

            $this->pdo = Conexion::getInstance(); 

            $this->pdo->openConnection(); 

            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM clicks ORDER by idclicks desc LIMIT 1;" ); 

            $resul->execute([]); 

            while($fila = $resul->fetch()) 

            { 

                $c = new click(); 

                $c->__setIdClick($fila["idclicks"]); 

                

            }     

            return $c; 

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

  

    public function cantidadClickArtista($idArtista){ 

        $c = FALSE; 

        try 

        { 

            $this->pdo = Conexion::getInstance(); 

            $this->pdo->openConnection(); 

            $resul = $this->pdo->useConnection()->prepare(" 

            select count( artista_has_clicks.Artista_idArtista) as 'cantidad' 

	 

            from  

                artista_has_clicks,  

                clicks  

            where 

                clicks.idclicks= artista_has_clicks.clicks_idclicks and  

                MONTH(clicks.fechaClick)= MONTH (NOW()) and 

                artista_has_clicks.Artista_idArtista=?;" ); 

            $resul->execute([$idArtista]); 

            while($fila = $resul->fetch()) 

            { 

                

                $c=$fila["cantidad"]; 

                

            }     

            return $c; 

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

    public function cantidadClickUltimosMesesArtista($idArtista){ 

        $lista = new ArrayList(); 

            try 

            { 

                $this->pdo = Conexion::getInstance(); 

                $this->pdo->openConnection(); 

                $resul = $this->pdo->useConnection()->prepare(" 

                select  

                    count(artista_has_clicks.Artista_idArtista) as 'cantidad', 

                    date_format(clicks.fechaClick, '%m-%y') as 'fecha'  

                from  

                    artista_has_clicks,  

                    clicks 

                where  

                    clicks.idclicks= artista_has_clicks.clicks_idclicks and  

                    artista_has_clicks.Artista_idArtista=? and  

                    clicks.fechaClick>= CURRENT_DATE - INTERVAL 6 MONTH and  

                    clicks.fechaClick<= CURRENT_DATE  

                group BY Month(clicks.fechaClick);"); 

                $resul->execute([$idArtista]); 

                while($fila = $resul->fetch()) 

                { 

                    $c = new click(); 

                    $c = $c->__setIdClick($fila['cantidad']); 

                    $c= $c->__setFecha($fila['fecha']); 

                    $lista->add($c); 

                } 

                return $lista; 

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

    public function cantidadClickObra($idArtista){ 

        $c = FALSE; 

        try 

        { 

            $this->pdo = Conexion::getInstance(); 

            $this->pdo->openConnection(); 

            $resul = $this->pdo->useConnection()->prepare(" 

            select  

            count(obra_has_clicks.Obra_idObra) as 'cantidad' , 

            artista.idArtista 

            from 

                obra_has_clicks, 

                clicks,  

                artista, 

                obra 

            where 

                clicks.idclicks= obra_has_clicks.clicks_idclicks and 

                obra_has_clicks.Obra_idObra= obra.idObra AND 

                obra.Artista_idArtista= artista.idArtista AND 

                MONTH(clicks.fechaClick)= MONTH (NOW()) and  

                artista.idArtista=?"); 

            $resul->execute([$idArtista]); 

            while($fila = $resul->fetch()) 

            { 

                

                $c=$fila["cantidad"]; 

                

            }     

            return $c; 

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

    public function cantidadClickUltimosMesesObra($idArtista){ 

        $lista = new ArrayList(); 

            try 

            { 

                $this->pdo = Conexion::getInstance(); 

                $this->pdo->openConnection(); 

                $resul = $this->pdo->useConnection()->prepare(" 

                select  

                count(obra_has_clicks.Obra_idObra) as 'cantidad', 

                date_format(clicks.fechaClick, '%m-%y') as 'fecha'  

                from  

                    obra_has_clicks,  

                    obra, 

                    clicks 

                where  

                    clicks.idclicks= obra_has_clicks.clicks_idclicks and  

                    obra.idObra = obra_has_clicks.Obra_idObra and 

                    obra.Artista_idArtista=? and  

                    clicks.fechaClick>= CURRENT_DATE - INTERVAL 6 MONTH and  

                    clicks.fechaClick<= CURRENT_DATE  

                group BY Month(clicks.fechaClick);"); 

                $resul->execute([$idArtista]); 

                while($fila = $resul->fetch()) 

                { 

                    $c = new click(); 

                    $c = $c->__setIdClick($fila['cantidad']); 

                    $c= $c->__setFecha($fila['fecha']); 

                    $lista->add($c); 

                } 

                return $lista; 

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

  

    public function obraMasVisitada($idArtista){ 

        $c = FALSE; 

        try 

        { 

            $this->pdo = Conexion::getInstance(); 

            $this->pdo->openConnection(); 

            $resul = $this->pdo->useConnection()->prepare(" 

            SELECT obra_has_clicks.Obra_idObra, COUNT(obra_has_clicks.Obra_idObra) 

            FROM  

                obra_has_clicks,  

	            clicks,  

	            artista, 

                obra 

            where 

                clicks.idclicks= obra_has_clicks.clicks_idclicks and 

                obra_has_clicks.Obra_idObra= obra.idObra AND 

                obra.Artista_idArtista= artista.idArtista AND 

                MONTH(clicks.fechaClick)= MONTH (NOW()) and  

                artista.idArtista=? 

            GROUP BY  

                obra_has_clicks.Obra_idObra  

            ORDER BY  

                `COUNT(obra_has_clicks.Obra_idObra)`  

            DESC LIMIT 1"); 

            $resul->execute([$idArtista]); 

            while($fila = $resul->fetch()) 

            { 

                

                $c=$fila["Obra_idObra"]; 

                

            }     

            return $c; 

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

  

    public function buscarClickObras($idObra){ 

        $lista = NEW ArrayList(); 

        try 

        { 

            $this->pdo = Conexion::getInstance(); 

            $this->pdo->openConnection(); 

            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM obra_has_clicks WHERE Obra_idObra=? "); 

            $resul->execute([$idObra]); 

            while($fila = $resul->fetch()) 

            { 

                $c = NEW click() ; 

                $c= $c->__setIdClick($fila['clicks_idclicks']); 

                 

                $lista->add($c); 

            } 

            return $lista; 

        } 

        catch(PDOException $e) 

        { 

            error_log($e->getMessage()); 

            //return FALSE; 

           // return error_log($e->getMessage()); 

           return 'hola'; 

  

        } 

        finally{ 

            $this->pdo->closeConnection(); 

        } 

    } 

  

    PUBLIC function buscarClick($id){ 

        $repor = FALSE; 

        try 

        { 

            $this->pdo = Conexion::getInstance(); 

            $this->pdo->openConnection(); 

            $resul = $this->pdo->useConnection()->prepare("SELECT * FROM clicks WHERE idclicks=?"); 

            $resul->execute([$id]); 

            while($fila = $resul->fetch()) 

            { 

                $click= new click(); 

                $click->__setIdClick($fila['idclicks']); 

                

                 

                 

            }     

            return $repor; 

        } 

        catch(PDOException $e) 

        { 

             

            //return error_log($e->getMessage()); 

            return false; 

        } 

        finally{ 

            $this->pdo->closeConnection(); 

        } 

    } 

    public function eliminarClickObra($idObras){ 

        try{ 

            $this->pdo = Conexion::getInstance(); 

            $this->pdo->openConnection(); 

            $res = $this->pdo->useConnection()->prepare("DELETE FROM obra_has_clicks WHERE `Obra_idObra`=?"); 

            $resul= $res->execute([$idObras]); 

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

  

    public function eliminarClic($idClick){ 

        try{ 

            $this->pdo = Conexion::getInstance(); 

            $this->pdo->openConnection(); 

            $res = $this->pdo->useConnection()->prepare("DELETE FROM obra_has_clicks WHERE `idclicks`=?"); 

            $resul= $res->execute([$idClick]); 

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

  
} 

?> 

  

