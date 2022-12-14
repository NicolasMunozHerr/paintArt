<?php 
 include_once dirname(__FILE__)."/../Conexion/conexion.php";
 include_once dirname(__FILE__)."/../modelo/arraylist.php";
    class obra{
        private $idObra;
        private $categoria;
        private $detalles;
        private $dimensiones;
        private $fechaPublicacion;
        private $precio;
        private $reacciones;
        private $sobreObra;
        private $tecnica;
        private $titulo;
        private $stock;
        private $idArtista;
        private $idImagen;

        public function __construct($idObra, $categoria, $detalles, $dimensiones, $precio,$sobreObra,$tecnica,$titulo,$idImagen)
        {
            $this->idObra=$idObra;
            $this->categoria=$categoria;
            $this->detalles=$detalles;
            $this->dimensiones=$dimensiones;
            $this->precio=$precio;
            $this->reacciones=0;
            $this->sobreObra=$sobreObra;
            $this->tecnica=$tecnica;
            $this->titulo=$titulo;
            $this->stock=0;
            $this->idArtista=1;
            $this->idImagen=$idImagen ;
            $this->fechaPublicacion=null;
        }

        public function getIdObra(){
            return $this->idObra;
        }
        public function setIdObra($idObra){
            $this->idObra=$idObra;
            return $this;
        }

        public function getCategoria(){
            return $this->categoria;
        }
        public function setCategoria($categoria){
            $this->categoria= $categoria;
            return $this;
        }


        public function getDetalles(){
            return $this->detalles;
        }
        public function setDetalles($detalles){
            $this->detalles= $detalles;
            return $this;
        }

        
        public function getDimensiones(){
            return $this->dimensiones;
        }
        public function setDimensiones($dimensiones){
            $this->dimensiones= $dimensiones;
            return $this;
        }


        public function getFechaPublicacion(){
            return $this->fechaPublicacion;
        }
        public function setFechaPublicacion($fechaPublicacion){
            $this->fechaPublicacion= $fechaPublicacion;
            return $this;
        }


        public function getPrecio(){
            return $this->precio;
        }
        public function setPrecio($precio)
        {
            $this->precio= $precio;
            return $this;
        }


        public function getReacciones(){
            return $this->reacciones;
        }
        public function setReacciones($reacciones){
            $this->reacciones=$reacciones;
            return $this;
        }

        public function getSobreObra(){
            return $this->sobreObra;
        }
        public function setSobreObra($sobreObra){
            $this->sobreObra= $sobreObra;
            return $this;
        }


        public function getTecnica(){
            return $this->tecnica;
        }
        public function setTecnica($tecnica)
        {
            $this->tecnica=$tecnica;
            return $this;
        }


        public function getTitulo(){
            return $this->titulo;
        }
        public function setTitulo($titulo){
            $this->titulo=$titulo;
            return $this;
        }


        public function getStock(){
            return $this->stock;
        }
        public function setStock($stock){
            $this->stock=$stock;
            return $this;
        }

        public function getIdArtista(){
            return $this->idArtista;
        }
        public function setIdArtista($idArtista){
            $this->idArtista= $idArtista;
            return $this;
        }


        public function getIdImagen(){
            return $this->idImagen;
        }
        public function setIdImagen($idImagen){
            $this->idImagen=$idImagen;
            return $this;
        }

        public function __toString()
        {
            return $this->idObra.' '.$this->categoria.' '.$this->detalles.' '.$this->dimensiones.' '.$this->fechaPublicacion.' '.$this->precio.' '.$this->reacciones.
            ' '.$this->sobreObra.' '.$this->tecnica.' '.$this->titulo.' '.$this->stock.' '.$this->idArtista.' '.$this->idImagen;
        }
        
        public function subirObra(obra $obra){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("INSERT INTO `obra` ( `categoria`, `detalles`, `dimensiones`, `fechaPublicacion`, `precio`, `Reacciones`, `SobreObra`, `tecnica`, `Titulo`,`stock`, `Artista_idArtista`,`Imagen_idImagen`) VALUES  ( ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?)"); //prepared Statement
                $res->execute([$obra->getCategoria(),$obra->getDetalles(),$obra->getDimensiones(),$obra->getFechaPublicacion(),$obra->getPrecio(),$obra->getReacciones(),$obra->getSobreObra(),$obra->getTecnica(),$obra->getTitulo(),$obra->getStock(),$obra->getIdArtista(),$obra->getIdImagen()]);
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

        public function listarObras($reacciones){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM obra where `Reacciones`=? ORDER BY `obra`.`idObra` DESC");
                $resul->execute([$reacciones]);
                while($fila = $resul->fetch())
                {
                    $c = new obra($fila["idObra"],$fila["categoria"],$fila["detalles"],$fila["dimensiones"],$fila["precio"],$fila["SobreObra"],$fila["tecnica"],$fila["Titulo"],$fila["Imagen_idImagen"]);
                    $c->setReacciones($fila["Reacciones"]);
                    $c->setIdArtista($fila["Artista_idArtista"]);
                    
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

        public function listarObrasCat($reacciones,$categoria){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("
                select * 
                from 
                    `obra`
                where
                    Reacciones=? AND
                    categoria= ?
                ORDER by 
                    idObra DESC 
                    ");
                $resul->execute([ $reacciones,$categoria]);
                $contador= 0;
                while($fila = $resul->fetch())
                {
                   
                        $c = new obra($fila["idObra"],$fila["categoria"],$fila["detalles"],$fila["dimensiones"],$fila["precio"],$fila["SobreObra"],$fila["tecnica"],$fila["Titulo"],$fila["Imagen_idImagen"]);
                        $c->setReacciones($fila["Reacciones"]);
                        $c->setIdArtista($fila["Artista_idArtista"]);
                        
                        $lista->add($c);
                   
                    
                    $contador++;
                }
                return $lista;
            }
            catch(PDOException $e)
            {
                error_log($e->getMessage());
                //return FALSE;
                return $e->getMessage();

            }
            finally{
                $this->pdo->closeConnection();
            }
        }

        public function listarObrasArtistas($idArtista){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM obra WHERE `Artista_idArtista`=? and `Reacciones`=0 ORDER BY `obra`.`idObra` DESC");
                $resul->execute([$idArtista]);
                while($fila = $resul->fetch())
                {
                    $c = new obra($fila["idObra"],$fila["categoria"],$fila["detalles"],$fila["dimensiones"],$fila["precio"],$fila["SobreObra"],$fila["tecnica"],$fila["Titulo"],$fila["Imagen_idImagen"]);
                    $c->setReacciones($fila["Reacciones"]);
                    $c->setStock($fila["stock"]);
                    $c->setIdArtista($fila["Artista_idArtista"]);
                    
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

        public function listarObrasArtistaArchivadas($idArtista){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM obra WHERE `Artista_idArtista`=? and `Reacciones`=1 ORDER BY `obra`.`idObra` DESC");
                $resul->execute([$idArtista]);
                while($fila = $resul->fetch())
                {
                    $c = new obra($fila["idObra"],$fila["categoria"],$fila["detalles"],$fila["dimensiones"],$fila["precio"],$fila["SobreObra"],$fila["tecnica"],$fila["Titulo"],$fila["Imagen_idImagen"]);
                    $c->setReacciones($fila["Reacciones"]);
                    $c->setStock($fila["stock"]);
                    $c->setIdArtista($fila["Artista_idArtista"]);
                    
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


        PUBLIC function buscarObraId($id){
            $idUs = FALSE;
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM obra WHERE idObra=?");
                $resul->execute([$id]);
                while($fila = $resul->fetch())
                {
                    $idUs = new obra(null,null,null,null,null,null,null,null.null,null);
                    $idUs->setIdObra($fila["idObra"]);
                    $idUs->setCategoria($fila["categoria"]);
                    $idUs->setDetalles($fila["detalles"]);
                    $idUs->setDimensiones($fila["dimensiones"]);
                    $idUs->setFechaPublicacion($fila["fechaPublicacion"]);
                    $idUs->setPrecio($fila["precio"]);
                    $idUs->setReacciones($fila["Reacciones"]);
                    $idUs->setSobreObra($fila["SobreObra"]);
                    $idUs->setTecnica($fila["tecnica"]);
                    $idUs->setTitulo($fila["Titulo"]);
                    $idUs->setStock($fila["stock"]);
                    $idUs->setIdArtista($fila["Artista_idArtista"]);
                    $idUs->setIdImagen($fila["Imagen_idImagen"]);
                    
                    
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
        public function eliminarObra($id){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("DELETE FROM obra WHERE IdObra=?");
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
        public function buscarObraTitulo($nombre){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM obra WHERE  Titulo like '%".$nombre."%'  ");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $idUs = new obra(null,null,null,null,null,null,null,null.null,null);
                    $idUs->setIdObra($fila["idObra"]);
                    $idUs->setCategoria($fila["categoria"]);
                    $idUs->setDetalles($fila["detalles"]);
                    $idUs->setDimensiones($fila["dimensiones"]);
                    $idUs->setFechaPublicacion($fila["fechaPublicacion"]);
                    $idUs->setPrecio($fila["precio"]);
                    $idUs->setReacciones($fila["Reacciones"]);
                    $idUs->setSobreObra($fila["SobreObra"]);
                    $idUs->setTecnica($fila["tecnica"]);
                    $idUs->setTitulo($fila["Titulo"]);
                    $idUs->setStock($fila["stock"]);
                    $idUs->setIdArtista($fila["Artista_idArtista"]);
                    $idUs->setIdImagen($fila["Imagen_idImagen"]);
                    
                  
                   
                    
                    $lista->add($idUs);
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
        public function shadowBan($idObra){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE obra SET Reacciones=1 WHERE idObra=?");
                $res->execute([$idObra]);
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
        public function quitarShadowBan($idObra){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE obra SET Reacciones=0 WHERE idObra=?");
                $res->execute([$idObra]);
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

        public function descontarStock($stock, $idObra){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE obra SET stock=? WHERE idObra=?");
                $res->execute([$stock,$idObra]);
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

        public function masContado(){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT tp.Obra_idObra, COUNT(0) AS total FROM compra tp GROUP BY tp.Obra_idObra HAVING COUNT(0) > 0 ORDER by total DESC;");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $c = new obra($fila["Obra_idObra"],null, null, null, null, null, null,null, null);
                    
                    $c->setStock($fila["total"]);
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


        public function buscarUltimaObra(){
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM obra ORDER by idObra desc LIMIT 1;                ");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $idUs = new obra(null,null,null,null,null,null,null,null.null,null);
                    $idUs->setIdObra($fila["idObra"]);
                    $idUs->setCategoria($fila["categoria"]);
                    $idUs->setDetalles($fila["detalles"]);
                    $idUs->setDimensiones($fila["dimensiones"]);
                    $idUs->setFechaPublicacion($fila["fechaPublicacion"]);
                    $idUs->setPrecio($fila["precio"]);
                    $idUs->setReacciones($fila["Reacciones"]);
                    $idUs->setSobreObra($fila["SobreObra"]);
                    $idUs->setTecnica($fila["tecnica"]);
                    $idUs->setTitulo($fila["Titulo"]);
                    $idUs->setStock($fila["stock"]);
                    $idUs->setIdArtista($fila["Artista_idArtista"]);
                    $idUs->setIdImagen($fila["Imagen_idImagen"]);
                    
                    
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

        public function listarSubasta(){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM obra where `Reacciones`=2 ORDER BY `obra`.`idObra`` DESC");
                $resul->execute([]);
                while($fila = $resul->fetch())
                {
                    $c = new obra($fila["idObra"],$fila["categoria"],$fila["detalles"],$fila["dimensiones"],$fila["precio"],$fila["SobreObra"],$fila["tecnica"],$fila["Titulo"],$fila["Imagen_idImagen"]);
                    $c->setReacciones($fila["Reacciones"]);
                    $c->setIdArtista($fila["Artista_idArtista"]);
                    
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
        public function listarSubastaIdArtista($idArtista){
            $lista = new ArrayList();
            try
            {
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $resul = $this->pdo->useConnection()->prepare("SELECT * FROM obra where `Reacciones`=2 and `Artista_idArtista`=? ORDER BY `obra`.`idObra` DESC");
                $resul->execute([$idArtista]);
                while($fila = $resul->fetch())
                {
                    $c = new obra($fila["idObra"],$fila["categoria"],$fila["detalles"],$fila["dimensiones"],$fila["precio"],$fila["SobreObra"],$fila["tecnica"],$fila["Titulo"],$fila["Imagen_idImagen"]);
                    $c->setReacciones($fila["Reacciones"]);
                    $c->setIdArtista($fila["Artista_idArtista"]);
                    
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

        public function modficarObra(obra $obra){
            try{
                $this->pdo = Conexion::getInstance();
                $this->pdo->openConnection();
                $res = $this->pdo->useConnection()->prepare("UPDATE obra SET categoria=?, detalles=?, dimensiones=?,fechaPublicacion=?, precio=?, Reacciones=?, SobreObra=?,tecnica=?, Titulo=?,stock=? WHERE idObra =?");
                $res->execute([$obra->getCategoria(),$obra->getDetalles(), $obra->getDimensiones(), $obra->getFechaPublicacion(),$obra->getPrecio(), $obra->getReacciones(), $obra->getSobreObra(), $obra->getTecnica(), $obra->getTitulo(), $obra->getStock(), $obra->getIdObra()]);
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