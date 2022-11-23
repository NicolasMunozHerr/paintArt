<?php
include_once '../modelo/notaInformativa.php';
include_once '../modelo/imagen.php';

class detalleNota{
    public function mostrarNota($idNota){
        $nota= new notaInformativa(null, null, null, null, null, null);
        $nota = $nota->buscarNota($idNota);
        if($nota==false){
            echo '<h5>Upsss, no encontramos la nota informativa</h5>';
        }else{
            $idImagen= $nota->getIdMagen();
            $imagen= new imagen(null);
            $imagen= $imagen->buscarImagenID($idImagen);
            if($imagen==false){
                echo '<h5>Upsss, no encontramos la imagen asociada</h5>';

            }else{
                $url= $imagen->getUrlImagen();

                echo'
                <br>
                <h1>'.$nota->getTitular().'</h1>
                <figcaption class="blockquote-footer">
                    <cite style="font-size: large ;" title="Source Title">'.$nota->getEpigrafe().'</cite>
                </figcaption>
                <br>
                <div style="margin:auto ;width:90% ;">
                <h6 style="text-align:center;">'.$nota->getCuerpo().'</h6></div>
                
                <br>
                <div class="noticia"> <img style="width: 30% ;max-width: 30%; height: 30%; max-height: 30%; margin-bottom: 20px;" src="'.$url.'" alt=""></div>
                    <a href="listaNoticias.php"><button class="btn btn-lg btn-dark" type="button">Volver a la seccion informativa</button></a>
                      <br>
                <br>
                ';
            }
        }        


    }

}
?>

