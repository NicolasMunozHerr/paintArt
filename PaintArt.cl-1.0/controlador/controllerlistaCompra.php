<?php 
include_once '../modelo/obra.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/imagen.php';
include_once '../modelo/artista.php';
include_once '../modelo/reportes.php';
include_once '../modelo/compra.php';

include_once '../modelo/usuarioRegistrado.php';

class historialCompras{

    public function listarComprasUser($idUsuario){
        $compra = new compra(null, null, null, null, null, null, null);
        $listaCompra= $compra->listarCompraIdUser($idUsuario);

        if($listaCompra== false){
            echo '<h6>No se accedio a la lista de compras</h6>';

        }else{
            $size= $listaCompra->size();
            $artista = new artista(null, null, null, null, null);
            $usuario= new usuarioRegistrado();
            $obra = new obra(null, null, null, null, null, null, null, null, null, null);
            $imagen= new imagen(null);
            if($size==0){
                echo '<h6>El usuario todavia no tiene compras</h6>';
            }else{
                for ($i=0; $i <$size ; $i++) { 
                    $infoArtista= $artista->buscarIdArtista($listaCompra->get($i)->getIdArtista());
                    if ($infoArtista==false) {
                        echo '<h6>No se  pudo encontrar al artista</h6>';
                    }else{
                        $idUsuarioArtista= $infoArtista->getIdUsuarioRegistrado();
                        $infoUsuario= $usuario->buscarUusuarioId($idUsuarioArtista);
                        if($infoUsuario==false ){
                            echo '<h6>No se  pudo encontrar el usuario asociado al artista</h6>';
                        }else{
    
                            $nombre= $infoUsuario->getNombreYApellido();
                            $infoObra= $obra->buscarObraId($listaCompra->get($i)->getIdObra());
                            if ($infoObra==false) {
                                echo '<h6>No se  pudo encontrar a la obra asociada</h6>';
                            }else{
                                $coste= $infoObra->getPrecio();
                                $infoImagen= $imagen->buscarImagenID($infoObra->getIdImagen());
                                if($infoImagen==false){
                                    echo '<h6>No se  pudo encontrar la imagen asociada</h6>';
                                }else{
                                    echo'<div class="contenedorPetcion">
                                            <div style="width: 100%; height: auto;" class="listaPeticiones">
                                            
                                                <div style="text-align:left; width:95% " class="peticion">
                                                    <h5>Obra de: '.$nombre.'</h5>
                                                    
                                                    <H6>Titulo de la Obra: '.$infoObra->getTitulo().'</H6>
                                                    <P>
                                                    <P>
                                                    <label>Fecha de compra: '.$listaCompra->get($i)->getFechaCompra().'</label>
                                                    <P>
                                                    <label>Monto de la compra: '.$coste.'</label>
                                                    <P>
                                                    <a style="text-decoration: none; margin-bottom: 5px;" href="verArtista.php?idArtista='.$listaCompra->get($i)->getIdArtista().'">CLICK AQUI PARA VER LA OBRA</a>
                                                    <p>
                                                    <a style="text-decoration: none; margin-bottom: 5px;" href="detalleObra.php?id='.$listaCompra->get($i)->getidObra().'">CLICK AQUI PARA VER AL ARTISTA</a>
                                                    <img style="float:right;width: 120px;; max-width: 120px;height: 120px;max-height: 120px;margin-top:-110px; margin-right:10px" src="'.$infoImagen->getUrlImagen().'" alt="">
                                                </div>
                                               
                                                    
                                               
                                            </div>
                                        </div>';
                                }
                                
                            }
                           
                        }
                      
    
                    }
                   
    
                }
            }
            

        }



    }


}

$parametros= $_POST['parametros'];
if($parametros==1){
    $lista= new historialCompras();
    session_start();
    $idUsuario= $_SESSION['online'];
    
    echo $lista->listarComprasUser($idUsuario);
    
}
?>


