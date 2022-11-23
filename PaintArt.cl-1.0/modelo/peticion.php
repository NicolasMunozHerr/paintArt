<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

    class peticion{
        private $idPeticion;
        private $asunto;
        private $descripcion;
        private $estado;
        private $fecha;
        private $precio;
        private $idUsuarioRegistrado;
        private $idArtista;
        private $idDireccion;

        public function __construct()
        {
            
        }

        public function getIdPeticion()
        {
            return $this->idPeticion;
        }
        public function setIdPeticion($idPeticion){
            $this->idPeticion= $idPeticion;
            return $this;
        }

        public function getAsunto(){
            return $this->asunto;
        }
        public function setAsunto($asunto){
            $this->asunto= $asunto;
            return $this;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }
        public function setDescripcion($descripcion){
            $this->descripcion= $descripcion;
            return $this;
        }

        public function getEstado(){
            return $this->estado;
        }
        public function setEstado($estado)
        {
            $this->estado= $estado;
            return $this;
        }

        public function getFecha(){
            return $this->fecha;
        }
        public function setFecha($fecha){
            $this->fecha = $fecha;
            return $this;
        }


        public function getPrecio(){
            return $this->precio;
        }
        public function setPrecio ($precio){
            $this->precio= $precio;
            return $this;
        }

        public function getIdUsuarioRegistrado(){
            return $this->idUsuarioRegistrado;
        }
        public function setIdUsuarioRegistrado($idUsuarioRegistrado){
            $this->idUsuarioRegistrado= $idUsuarioRegistrado;
            return $this;
        }


        public function getIdArtista(){
            return $this->idArtista;
        }
        public function setIdArtista($idArtista)
        {
            $this->idArtista= $idArtista;
            return $this;
        }


        public function getIdDireccion(){
            return $this->idDireccion;
        }
        public function setIdDireccion($idDireccion){
            $this->idDireccion=$idDireccion;
            return $this;
        }


        public function __toString()
        {
            return ' id peticion: '+$this->idPeticion+ ' asunto: '+$this->asunto+' descripcion: '+$this->descripcion+
            ' estado: '+$this->estado+' fecha: '+$this->fecha+' precio: '+$this->precio+' id usuario registrado:'+$this->idUsuarioRegistrado+
            ' id artista: '+$this->idArtista+' id direccion:'+ $this->idDireccion;
        }


    }
?>