<?php 
 include_once '../modelo/obra.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/arraylist.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/artista.php';
 include_once '../modelo/usuarioRegistrado.php';
 include_once '../modelo/compra.php';
 class listObra{
    function listarObrasDefault(){
        $listaObras= new obra(null, null,null, null,null, null,null, null,null);
        $a=0;
        $ar= new artista(null, null ,null);
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
                        <span><h6>'.$lista->get($i)->getTitulo().'</h6></span>
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
    function mostraCate($categoria){
        if ($categoria==0) {
            
            echo "";
        }else{
            $cat="Arte urbano";
            switch ($categoria) {
                case 1:
                    $cat="Arte urbano";
                    break;
                case 2:
                    $cat="Arte optico";
                    break;
                case 3:
                    $cat="Arte cinetico";
                    break;
                case 4:
                    $cat="Surrealismo";
                    break;
                case 5:
                    $cat="Neoplasticismo";
                    break;
                case 6:
                    $cat="Dadaismo";
                    break;
                case 7:
                    $cat="Suprematismo";
                    break;
                case 8:
                    $cat="Contructivismo";
                    break;
                case 9:
                    $cat="Minimalismo";
                    break;
                case 10:
                    $cat="Rayonismo";
                    break;
                case 11:
                    $cat="Abstraccion lirica";
                    break;
                case 12:
                    $cat="Expresionismo";
                    break;
            }
            echo ': '.$cat;
        }    
    }

    function listarObrasCat($categoria){
        if ($categoria==0) {
            $lista= new listObra();
            echo $lista->listarObrasDefault();
        }else{
            if ($categoria==100) {
                $listaObras= new obra(null, null,null, null,null, null,null, null,null);
                $a=0;
                $ar= new artista(null, null ,null);
                $us= new usuarioRegistrado();      
                $img=new imagen(null);          
                $obra= new obra(null, null ,null, null, null, null, null, null, null, null);
                $listaObra= $obra->masContado();
                $size= $listaObra->size();
                if($size==0){
                    echo "<h6> No hay Obras todavia<h6>";
                }else{
                    for ($i=0; $i < $size; $i++) { 
                        //echo ' idObra'.$listaObra->get($i)->getIdObra().' total'.$listaObra->get($i)->getStock();
                        $infoObra=$obra->buscarObraId( $listaObra->get($i)->getIdObra());
                        if($infoObra==false)
                        {}else{
                            $idImg=$infoObra->getIdImagen();
                        
                    
                            $artista= $ar->buscarIdArtista($infoObra->getIdArtista());
                            $usuario= $us->buscarUusuarioId($artista->getIdUsuarioRegistrado());
                            
                                $imagen=$img->buscarImagenID($idImg);
                                $url=$imagen->getUrlImagen();
                                echo '
                                <div class="cajaArtista">
                                <div style="text-align: center;" class="cuadro">
                                    <div class="fotoArtista"> <img src="'.$url.'" alt=""></div>
                                    <br>
                                    <div class="cuadroTexto">
                                        <a style="text-decoration:none " href="detalleObra.php?id='. $listaObra->get($i)->getIdObra().'">
                                            <span><h6>'.$infoObra->getTitulo().'</h6></span>
                                            <div class="detalles">
                                                <span style="color:black" >  Autor:'.$usuario->getNombreYApellido().'</span>
                                                <br>
                                                <span style="color:black">  categoria: '.$infoObra->getCategoria().'</span>    
                                            </div>
                                            <div class="precio"><h6>$'.$infoObra->getPrecio().'</h6></span></div>
                                        </div>
                                        </a>
                                    </div>
                                    </div>
                                ';    
                        }
                        

                    }
                }
            }else{
                $cat="Arte urbano";
                switch ($categoria) {
                    case 1:
                        $cat="Arte urbano";
                        break;
                    case 2:
                        $cat="Arte optico";
                        break;
                    case 3:
                        $cat="Arte cinetico";
                        break;
                    case 4:
                        $cat="Surrealismo";
                        break;
                    case 5:
                        $cat="Neoplasticismo";
                        break;
                    case 6:
                        $cat="Dadaismo";
                        break;
                    case 7:
                        $cat="Suprematismo";
                        break;
                    case 8:
                        $cat="Contructivismo";
                        break;
                    case 9:
                        $cat="Minimalismo";
                        break;
                    case 10:
                        $cat="Rayonismo";
                        break;
                    case 11:
                        $cat="Abstraccion lirica";
                        break;
                    case 12:
                        $cat="Expresionismo";
                        break;
                }
                
                $listaObras= new obra(null, null,null, null,null, null,null, null,null);
                $a=0;
                $ar= new artista(null, null ,null);
                $us= new usuarioRegistrado();
                $lista= $listaObras->listarObrasCat($cat);
                $img=new imagen(null);
                $size= $lista->size();
                if($size==0){
                    echo "<h2> No hay obras hasta el momento con la categoria: ".$cat."</h2>";
                }else{
                    for ($i=0; $i <$size ; $i++) { 
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
                                    <span><h6>'.$lista->get($i)->getTitulo().'</h6></span>
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
            
        
        
        }
    
    
    }

    function listarObrasBusqueda($busqueda){
        $obra = new obra(null, null, null, null, null, null, null, null, null);
        $listaObras= $obra->buscarObraTitulo($busqueda);
        if($listaObras==false){
            echo "<h2> No hay obras con ese nomber</h2>"; 
        }else{
            $size= $listaObras->size();
            for ($i=0; $i <$size ; $i++) { 
                $idImagen= $listaObras->get($i)->getIdImagen();
                $idArtista= $listaObras->get($i)->getIdArtista();
                $imagen = new imagen(null);
                $imagen= $imagen->buscarImagenID($idImagen);
                if($imagen==false){
                    echo "<h2>No se encontro la imagen asociada</h2>";
                }else{
                    $artista= new artista(null, null, null);
                    $artista= $artista->buscarIdArtista($idArtista);
                    if($artista==false){
                        echo '<h2>No se econtro al artista asociado</h2>';
                    }else{
                        $idUser= $artista->getIdUsuarioRegistrado();
                        $usuario= new usuarioRegistrado();
                        $usuario= $usuario->buscarUusuarioId($idUser);
                        if($usuario==false){
                            echo '<h2>No se encontro al usuario asociado</h2>';
                        }else{
                            $nombre= $usuario->getNombreYApellido();
                            $url= $imagen->getUrlImagen();
                            echo'
                            <div class="cajaArtista">
                                <div style="text-align: center;" class="cuadro">
                                    <div class="fotoArtista"> <img src="'.$url.'" alt=""></div>
                                    <br>
                                    <div class="cuadroTexto">
                                        <a style="text-decoration:none " href="detalleObra.php?id='. $listaObras->get($i)->getIdObra().'">
                                            <span><h6>'.$listaObras->get($i)->getTitulo().'</h6></span>
                                            <div class="detalles">
                                                <span style="color:black" >  Autor:'.$usuario->getNombre().' '.$usuario->getApellido().'</span>
                                                <br>
                                                <span style="color:black">  categoria'.$listaObras->get($i)->getCategoria().'</span>    
                                            </div>
                                            <div class="precio"><h6>$'.$listaObras->get($i)->getPrecio().'</h6></span></div>
                                        </div>
                                        </a>
                                    </div>
                            </div>';
                        }
                    }
                }

            }
        }
    }

}
 

?>