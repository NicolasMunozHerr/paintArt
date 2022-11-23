<?php

    class notaInformativa{
        private $idNotaInformativa;
        private $titular;
        private $cuerpo;
        private $epigrafe;
        private $idUsuarioRegistrado;
        private $idImagen;


        public function __construct()
        {
            
        }

        public function getIdNotainformativa()
        {
            return $this->idNotaInformativa;
        }
        public function setIdNotaInformativa($idNotaInformativa){
            $this->idNotaInformativa= $idNotaInformativa;
            return $this;
        }

        public function getTitular(){
            return $this->titular;
        }
        public function setTitular($titular){
            $this->titular=$titular;
            return $this;
        }

        public function getCuerpo(){
            return $this->cuerpo;
        }
        public function setCuerpo($cuerpo)
        {
            $this->cuerpo= $cuerpo;
            return $this;
        }

        public function getEpigrafe(){
            return $this->epigrafe;
        }
        public function setEpigrafe($epigrafe){
            $this->epigrafe= $epigrafe;
            return $this;
        }

        public function getIdUsuarioRegistrado(){
            return $this->idUsuarioRegistrado;
        }
        public function setIdUsuarioRegistrado($idUsuarioRegistrado){
            $this->idUsuarioRegistrado= $idUsuarioRegistrado;
            return $this;
        }

        public function getIdMagen(){
            return $this->idImagen;
        }
        public function setIdImagen($idImagen){
            $this->idImagen= $idImagen;
            return $this;
        }

        public function __toString()
        {
            return " id Nota informativa: "+$this->idNotaInformativa+" titular: "+$this->titular+" cuerpo: "+$this->cuerpo+
            " epigrafe : "+$this->epigrafe+ " id imagen: "+$this->idImagen;
        }
    }


?>
