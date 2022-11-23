<?php 
include_once '../modelo/notaInformativa.php';
include_once '../modelo/imagen.php';

class listaNotas{

    public   function listarNoticias($sum){
        if($sum==0){
            $sum=12;
        }
        $nota= new notaInformativa(null, null, null, null, null, null);
        $lista= $nota->listarNotas();
        $a=0;
        if($lista!=false){
            $size= $lista->size();
            if($size==0){
                echo '<h3>No se han agregado notas informativas hasta el momento</h3>';
            }else{
                for ($i=0; $i <$size ; $i++) { 
                    if($i<$sum){
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
                        $a++;
                    }
                    
                   
                }
                if( $a<$size){
                    echo '
                    <table style="width:100%"> 
                        <td>      
                            <button type="button" onClick="sumar()"   id="cuenta" data-id="'.$sum.'" class="btn btn-warning btn-lg">Cargar mas obras</button>
                        </td> 
                    </table>';
                }else{
                    echo'
                   
                    <table style="width:100%;">
                        <td>   

                            <p><h4> ha llegado al final de la lista de noticias </h4></p>
                        </td> 
                    </table>';
                }
            }
        }else{
            echo '<h3>No se ha podido conseguir las ultimas noticias</h3>';
        }



    }


}

$sum= $_POST['suma'];
$listaNota= new listaNotas();

echo $listaNota->listarNoticias($sum);




?>
