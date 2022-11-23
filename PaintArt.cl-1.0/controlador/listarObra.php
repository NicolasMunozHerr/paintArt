<?php 
 include_once '../modelo/obra.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/arraylist.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/artista.php';
 include_once '../modelo/usuarioRegistrado.php';
 class listObra{
    function listarObrasDefault(){
        $listaObras= new obra(null, null,null, null,null, null,null, null,null);
        $a=0;
        $ar= new artista();
        $us= new usuarioRegistrado();
        $lista= $listaObras->listarObras();
        $img=new imagen(null);
        for ($i=0; $i <$listaObras->listarObras()->size() ; $i++) { 
            $idImg=$lista->get($i)->getIdImagen();
            
           
            $artista= $ar->buscarIdArtista($lista->get($i)->getIdArtista());
           $usuario= $us->buscarUusuarioId($artista->getIdUsuarioRegistrado());
          
            $imagen=$img->buscarImagenID($idImg);
            $url=$imagen->getUrlImagen();
            echo '
            <div class="cajaArtista">
              <div style="text-align: center;" class="cuadro">
                <div class="fotoArtista"> <img src="'.$url.'" alt=""></div>
                  <br>
                  <div class="cuadroTexto">
                    <a style="text-decoration:none " href="detalleObra.php?id='. $lista->get($i)->getIdObra().'">
                        <span><h6>Titulo</h6></span>
                        <div class="detalles">
                            <span style="color:black" >  Autor:'.$usuario->getNombre().' '.$usuario->getApellido().'</span>
                            <br>
                            <span style="color:black">  categoria'.$lista->get($i)->getCategoria().'</span>    
                        </div>
                        <div class="precio"><h6>$'.$lista->get($i)->getPrecio().'</h6></span></div>
                    </div>
                    </a>
                </div>
                </div>
            ';    
            //$lista->get($a)->__toString().'<br>';
            $a++;
        }
    }



 }
 
 


?>