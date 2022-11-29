<?php 
include_once '../modelo/obra.php';
include_once '../modelo/imagen.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/imagen.php';
include_once '../modelo/artista.php';
include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/subastas.php';
include_once '../modelo/click.php';
$ob =new obra(null,null,null, null, null, null ,null,null,null);

class mostrarObra{
    public function __construct($idObra)
    {
        
        date_default_timezone_set('America/Santiago');
        $fecha= date('Y-m-d');
        $click = new click;
        $resp= $click->agregarClick($fecha);
        if ($resp== false) {
          //  echo 'ta mal';
        }else{
            $idClick= $click->listarUltimoClick();
            $resp = $click->agregarClickObraHasClick($idObra, $idClick->__getIdClick());
            if ($resp==false) {
            //    echo 'Error al tomar la cuenta de visita';
            }
        }
    }


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

    public function mostraNonmbre($id){
        $ob = new obra(null, null, null, null, null, null, null, null, null);
        $infObra= $ob->buscarObraId($id);
        if($infObra==false){
                return 'ups, no encontramos nada';
        }else{
            $idArtista= $infObra->getIdArtista();
            $artista= new artista(null, null, null,null);
            $resp= $artista->buscarIdArtista($idArtista);
            if($resp==false){
                return 'No se encontro al artista asociado';
            }else{
                $usuario= new usuarioRegistrado();
                $resp= $usuario->buscarUusuarioId($resp->getIdUsuarioRegistrado());
                if($resp==false){
                    return 'No se econtro al usuario asociado al artista';
                }else{
                    return $resp->getNombreYApellido();
                }
            }
        }
    }

    public function validarSubasta($id){
        $subasta= new subasta();
        $resp= $subasta->validaAsociacionObra($id);
        if($resp==false){
            return $resp;
        }else{
            return $resp;
        }

    }
    
  
}
















?>