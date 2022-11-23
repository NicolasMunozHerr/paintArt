<?php 
    class reportes{

        private $idReportes;
        private $explicacion;
        private $razon;
        private $idUsuarioRegistrado;
        private $idObra;

        public function __construct()
        {
            
        }

        public function getIdReporte(){
            return $this->idReportes;
        }
        public function setIdReporte($idReportes){
            $this->idReportes= $idReportes;
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

        public function getIdUsuarioRegistrado(){
            return $this->idUsuarioRegistrado;
        }
        public function setIdUsuarioRegistrado($idUsuarioRegistrado){
            $this->idUsuarioRegistrado= $idUsuarioRegistrado;
            return $this;
        }

        public function getidObra(){
            return $this->idObra;
        }
        public function setIdObra($idObra){
            $this->idObra= $idObra;
            return $this;
        }

        public function __toString()
        {
            return "id reporte: "+$this->idReportes+" Explicacion: "+$this->explicacion+" razon: "+$this->razon+" id usuario registrado: "+$this->idUsuarioRegistrado+" idObra: "+$this->idObra;;;;;
        }


    }


?>