<?php 
include_once '../modelo/obra.php';
include_once '../modelo/imagen.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/imagen.php';
include_once '../modelo/artista.php';
include_once '../modelo/usuarioRegistrado.php';
$ob =new obra(null,null,null, null, null, null ,null,null,null);

class mostrarObra{
    public function mostraObra($id){
        $ob =new obra(null,null,null, null, null, null ,null,null,null);
       $titulo= $ob->buscarObraId($id);    
      
       return $titulo;
        

    }

    public function mostrarImagen($id){

        $ob =new obra(null,null,null, null, null, null ,null,null,null);
       $titulo= $ob->buscarObraId($id);
        $im= new imagen(null,null);
        $url=$im->buscarImagenID($titulo->getIdImagen());
        
       return $url->getUrlImagen();
    }



}
















?>