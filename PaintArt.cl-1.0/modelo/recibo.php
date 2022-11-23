<?php 

    class recibo{
        private $numeBoleta;
        private $fechaEmision;
        private $detalles;
        private $total ;
        private $correoUsuario;
        private $idCompra;


        public function __construct()
        {
            
        }


        public function getNumBoleta(){
            return $this->numeBoleta;
        }
        public function setNumBoleta($numeBoleta){
            $this->numeBoleta=$numeBoleta;
            return $this;
        }


        public function getFechaEmision(){
            return $this->fechaEmision;
        }
        public function setFechaEmision($fechaEmision){
            $this->fechaEmision= $fechaEmision;
            return $this;
        }


        public function getDetalles(){
            return $this->detalles;
        }
        public function setDetalles($detalles ){
            $this->detalles= $detalles;
            return $this;
        }


        public function getTotal(){
            return $this->total;
        }
        public function setTotal($total){
            $this->total=$total;
            return $this;
        }


        public function getCorreoUsuario(){
            return $this->correoUsuario;
        }
        public function setCorreoUsuario($correoUsuario){
            $this->correoUsuario=$correoUsuario;
            return $this;
        }

        public function getCompra(){
            return $this->idCompra;
        }
        public function setCompra($idCompra){
            $this->idCompra=$idCompra;
            return $this;
        }


    }


?>