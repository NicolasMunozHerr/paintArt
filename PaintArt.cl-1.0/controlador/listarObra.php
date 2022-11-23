<?php 
 include_once '../modelo/obra.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/arraylist.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/artista.php';
 include_once '../modelo/usuarioRegistrado.php';
 include_once '../modelo/compra.php';
 include_once '../modelo/subastas.php';
 class listObra{
    function listarObrasDefault($reacciones, $contador){
        if ($contador==0) {
            $contador=12;
        }
        $listaObras= new obra(null, null,null, null,null, null,null, null,null);
        $a=0;
        $ar= new artista(null, null ,null);
        $us= new usuarioRegistrado();
        $lista= $listaObras->listarObras($reacciones);
        $img=new imagen(null);
        for ($i=0; $i <$listaObras->listarObras($reacciones)->size() ; $i++) { 
            if($i<$contador){
                $idImg=$lista->get($i)->getIdImagen();
                $precio=0;
                if($reacciones==2){
                    $subasta= new subasta();
                    $subasta= $subasta->validaAsociacionObra($lista->get($i)->getIdObra());
                    if($subasta==false){
                        echo 'error';
                    }else{
                        $precio= '$'.$subasta->__getPrecioPuja();
                    }
                }else {
                    $precio='$'.$lista->get($i)->getPrecio();
                }
            
                $artista= $ar->buscarIdArtista($lista->get($i)->getIdArtista());
                $usuario= $us->buscarUusuarioId($artista->getIdUsuarioRegistrado());
            
                $imagen=$img->buscarImagenID($idImg);
                $url=$imagen->getUrlImagen();
                echo '
                <div class="cajaArtista">
                <div style="text-align: center;" class="cuadro">
                    <div class="fotoArtista"> <img style="width: 100%;max-width: 100%;height: 100%;max-height: 100%; object-fit: cover; object-position: center center; " src="'.$url.'" alt=""></div>
                    <br>
                    <div class="cuadroTexto">
                        <a style="text-decoration:none " href="detalleObra.php?id='. $lista->get($i)->getIdObra().'">
                            <span><h6>'.$lista->get($i)->getTitulo().'</h6></span>
                            <div class="detalles">
                                <span style="color:black" >  Autor:'.$usuario->getNombre().' '.$usuario->getApellido().'</span>
                                <br>
                                <span style="color:black"> categoria: '.$lista->get($i)->getCategoria().'</span>    
                            </div>
                            <div class="precio" ><h6>'.$precio.'</h6></span></div>
                        </div>
                        </a>
                    </div>
                    </div>
                ';    
                //$lista->get($a)->__toString().'<br>';
                $a++;
            }
            
        }
        if( $a<$lista->size()){
            echo '
            <table style="width:100%"> 
                <td>      
                    <button type="button" onClick="sumar()"   id="cuenta" data-id="'.$contador.'" class="btn btn-warning btn-lg">Cargar mas obras</button>
                </td> 
            </table>';
        }else{
            if($reacciones==0){
                echo'
                <table style="width:100%;">
                    <td>   
                        <p><h4> No hay mas obras por mostrar </h4></p>
                    </td> 
                </table>';
            }else{
                echo'
                <table style="width:100%;">
                    <td>   
                        <p><h4> No hay mas subastas por mostrar </h4></p>
                    </td> 
                </table>';
            }
           
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
                case 100:
                    $cat= "Mas populares";
            }
            echo ': '.$cat;
        }    
    }

    function listarObCat($categoria,$reacciones, $contador){
        if ($categoria==0) {
            $lista= new listObra();
            
            echo $lista->listarObrasDefault($reacciones,$contador);
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
                    if($reacciones==2){
                        echo "<h6> No hay Subastas todavia<h6>";
                    }else{
                        echo "<h6> No hay Obras todavia<h6>";
                    }
                    
                }else{
                    $a=0;
                    for ($i=0; $i < $size; $i++) { 
                        if($i<$contador){
                            //echo ' idObra'.$listaObra->get($i)->getIdObra().' total'.$listaObra->get($i)->getStock();
                            $infoObra=$obra->buscarObraId( $listaObra->get($i)->getIdObra());
                            if($infoObra==false)
                            {
                                echo "<h6> Obra no encontrada<h6>";
                            }else{
                                if($infoObra->getReacciones()==0){
                                    $idImg=$infoObra->getIdImagen();
                                    $precio=0;
                                    if($reacciones==2){
                                        $subasta= new subasta();
                                        $subasta= $subasta->validaAsociacionObra($listaObra->get($i)->getIdObra());
                                        if($subasta==false){
                                            echo 'error';
                                        }else{
                                            $precio= '$'.$subasta->__getPrecioPuja();
                                        }
                                    }else {
                                        $precio='$'.$listaObra->get($i)->getPrecio();
                                    }
                        
                                    $artista= $ar->buscarIdArtista($infoObra->getIdArtista());
                                    $usuario= $us->buscarUusuarioId($artista->getIdUsuarioRegistrado());
                                
                                    $imagen=$img->buscarImagenID($idImg);
                                    $url=$imagen->getUrlImagen();
                                    echo '
                                    <div class="cajaArtista">
                                    <div style="text-align: center;" class="cuadro">
                                        <div class="fotoArtista"> <img style="width: 100%;max-width: 100%;height: 100%;max-height: 100%; object-fit: cover; object-position: center center; " src="'.$url.'" alt=""></div>
                                        <br>
                                        <div class="cuadroTexto">
                                            <a style="text-decoration:none " href="detalleObra.php?id='. $listaObra->get($i)->getIdObra().'">
                                                <span><h6>'.$infoObra->getTitulo().'</h6></span>
                                                <div class="detalles">
                                                    <span style="color:black" >  Autor:'.$usuario->getNombreYApellido().'</span>
                                                    <br>
                                                    <span style="color:black">  categoria: '.$infoObra->getCategoria().'</span>    
                                                </div>
                                                <div class="precio"><h6>'.$precio.'</h6></span></div>
                                            </div>
                                            </a>
                                        </div>
                                        </div>
                                    ';    
                                }
                            
                            }
                        }
                        
                        $a++;
                    }
                    if( $a<$size){
                        echo '
                        <table style="width:100%"> 
                            <td>      
                                <button type="button" onClick="sumar()"   id="cuenta" data-id="'.$contador.'" class="btn btn-warning btn-lg">Cargar mas obras</button>
                            </td> 
                        </table>';
                    }else{
                        echo'
                       
                        <table style="width:100%;">
                            <td>   

                                <p><h4> No hay mas Obras por mostrar</h4></p>
                            </td> 
                        </table>';
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
               
                $lista= $listaObras->listarObrasCat( $reacciones,$cat);
                
                $img=new imagen(null);
                $size= $lista->size();
                if($size==0){
                    if ($reacciones==2) {
                        echo "<h2> No hay subastas hasta el momento con la categoria: ".$cat."</h2>";

                    }else{
                        echo "<h2> No hay obras hasta el momento con la categoria: ".$cat."</h2>";
                    }
                    
                }else{
                    for ($i=0; $i <$size ; $i++) { 
                        if($i<$contador){
                            $idImg=$lista->get($i)->getIdImagen();
                            $precio=0;
                            if($reacciones==2){
                                $subasta= new subasta();
                                $subasta= $subasta->validaAsociacionObra($lista->get($i)->getIdObra());
                                if($subasta==false){
                                    echo 'error';
                                }else{
                                    $precio= '$'.$subasta->__getPrecioPuja();
                                }
                            }else {
                                $precio='$'.$lista->get($i)->getPrecio();
                            }
                        
                            $artista= $ar->buscarIdArtista($lista->get($i)->getIdArtista());
                            $usuario= $us->buscarUusuarioId($artista->getIdUsuarioRegistrado());
                        
                            $imagen=$img->buscarImagenID($idImg);
                            $url=$imagen->getUrlImagen();
                            
                            echo '
                            <div class="cajaArtista">
                            <div style="text-align: center;" class="cuadro">
                                <div class="fotoArtista"> <img style="width: 100%;max-width: 100%;height: 100%;max-height: 100%; object-fit: cover; object-position: center center; " src="'.$url.'" alt=""></div>
                                <br>
                                <div class="cuadroTexto">
                                    <a style="text-decoration:none " href="detalleObra.php?id='. $lista->get($i)->getIdObra().'">
                                        <span><h6>'.$lista->get($i)->getTitulo().'</h6></span>
                                        <div class="detalles">
                                            <span style="color:black" >Autor: '.$usuario->getNombre().' '.$usuario->getApellido().'</span>
                                            <br>
                                            <span style="color:black">  Categoria: '.$lista->get($i)->getCategoria().'</span>    
                                        </div>
                                        <div class="precio"><h6>'.$precio.'</h6></span></div>
                                    </div>
                                    </a>
                                </div>
                                </div>
                            ';    
                            //$lista->get($a)->__toString().'<br>';
                            $a++;
                        }
                        
                    }
                   
                    if( $a<$size){
                        echo '
                        <table style="width:100%"> 
                            <td>      
                                <button type="button" onClick="sumar()"   id="cuenta" data-id="'.$contador.'" class="btn btn-warning btn-lg">Cargar mas obras</button>
                            </td> 
                        </table>';
                    }else{
                        echo'
                       
                        <table style="width:100%;">
                            <td>   

                                <p><h4> ha llegado al final de la lista de obras tipo '.$cat.' </h4></p>
                            </td> 
                        </table>';
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
                                    <div class="fotoArtista"> <img style="width: 100%;max-width: 100%;height: 100%;max-height: 100%; object-fit: cover; object-position: center center; " src="'.$url.'" alt=""></div>
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

$reacciones= $_POST['reacciones'];
$cat=$_POST['cat'];
$busqueda=$_POST['busqueda'];
if($busqueda==""){
    $contador= $_POST['suma'];
    $lista= new listObra();
    //echo 'categoria: '.$cat." reacciones: ".$reacciones;
    echo $lista->listarObCat($cat,$reacciones, $contador);
    
}else{
    $lista=new listObra();
    
    echo $lista->listarObrasBusqueda($busqueda);
}




?>