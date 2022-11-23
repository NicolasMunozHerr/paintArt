<?php 
include_once '../modelo/notaInformativa.php';
include_once '../modelo/imagen.php';

class listaNotas{

    public   function listarNoticias(){

        $nota= new notaInformativa(null, null, null, null, null, null);
        $lista= $nota->listarNotas();
        if($lista!=false){
            $size= $lista->size();
            if($size==0){
                echo '<h3>No se han agregado notas informativas hasta el momento</h3>';
            }else{
                for ($i=0; $i <$size ; $i++) { 
                    $idImagen= $lista->get($i)->getIdMagen();
                    $imagen= new imagen(null);
                    $imagen= $imagen->buscarImagenID($idImagen);
                    if($imagen==false){
                        echo '<h3>No se han encontrado la imagen</h3>';
                    }else{
                        $url = $imagen->getUrlImagen();
                        echo '
                        <div class="cajaArtista">
                                <div style="text-align: center;" class="cuadro">
                                <a style="text-decoration:none " href="detalleNota.php?id='. $lista->get($i)->getIdNotainformativa().'">
                                    <div class="fotoArtista"> <img src="'.$url.'" alt=""></div>
                                    <br>
                                    <div class="cuadroTexto">
                                        <span style= "text-align:center">
                                        <h5>'.$lista->get($i)->getTitular().'</h5></span>
                                        </div>
                                    </div>
                                    </a>
                                    </div>
                        ';
                    }

                }
            }
        }else{
            echo '<h3>No se ha podido conseguir las ultimas noticias</h3>';
        }



    }


}





?>
