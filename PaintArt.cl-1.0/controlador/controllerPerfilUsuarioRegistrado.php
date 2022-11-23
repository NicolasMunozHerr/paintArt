<?php
include_once '../modelo/obra.php';
include_once '../modelo/imagen.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/compra.php';
include_once '../modelo/artista.php';
include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/critica.php';
include_once '../modelo/direccion.php';
include_once '../modelo/reportes.php';
include_once '../modelo/reportesUser.php';
include_once '../modelo/notaInformativa.php';


class perfilUusarioRegistrado{

    public function mostrarPerfil($idUsuario){
        $user = new usuarioRegistrado();

        $resp = $user->buscarUusuarioId($idUsuario);
        if ($resp==false ){
            echo 'No deberias estar aca guiño guiño*';

        }else{
            
            $NombreYApellido= $resp->getNombreYApellido();
            $image= new imagen(null);
            $rep= $image->buscarImagenID($resp->getIdImagen());
            if($rep== false){
                echo $resp->getIdImagen().'Opps Algo ocurrio';

            }else{
                echo'
                
                <div class="imgArtista">
                <img style="width: 100%;max-width: 100%;height: 100%;max-height: 100%;object-fit: cover; object-position: center center; " src="'.$rep->getUrlImagen().'" alt="">
                    </div>
                    <p></p>
                    <span><h4>'.$NombreYApellido.'</h4></span>
                    <p></p>
                    <span><a style="text-decoration: none;" href="listarMisPeticiones.php"><h6>[Ver lista de mis peticiones]</h6></a></span>
                    <p></p>
                    <span><a style="text-decoration: none;" href="listaCompra.php"><h6>[Ver Lista de mis compras]</h6></a></span>
                    <br>
                    <span style= "width:100%"><a style="text-decoration: none ;" href="cambiarFotoPerfil.php"><button type="submit"  class="btn btn-success">Cambiar Mi foto </button></a></span>
                    <br>
                    <br>
                    <a style="text-decoration: none ;" href="../controlador/controllerCerrarSesion.php"><button type="submit" style="margin-bottom:20px"  class="btn btn-danger">Cerrar Sesion</button></a>
                    <br>
                    <p></p>
                
                </div>
                
                
                
                ';
            }

        }



    }
    public function mostrarPerfilArtista($idUsuario){
        $user = new usuarioRegistrado();

        $resp = $user->buscarUusuarioId($idUsuario);
        if ($resp==false ){
            echo 'No deberias estar aca guiño guiño*';

        }else{
            
            $NombreYApellido= $resp->getNombreYApellido();
            $image= new imagen(null);
            $rep= $image->buscarImagenID($resp->getIdImagen());
            if($rep== false){
                echo $resp->getIdImagen().'Opps Algo ocurrio';

            }else{
                $artista= new artista(null, null ,null);
                $bio= $artista ->buscarArtistaIdUser($idUsuario);
                $mostrarBio= $bio->getBiografia();
                if($mostrarBio==""){
                    $mostrarBio='Todavia no ha adjuntado una biografia ';
                }
                if($bio==false){
                    echo '<h6>No encontramos info del artista... sorry</h6>';
                }else{
                    echo'
                  <div class="imgArtista">
                    <img style="width: 100%;max-width: 100%;height: 100%;max-height: 100%;object-fit: cover; object-position: center center; " src="'.$rep->getUrlImagen().'" alt="">
                  </div>
                    <p></p>
                  <span><h4>'.$NombreYApellido.'</span>
                    <p></p>
                  <span><a style="text-decoration: none;" href="listarPeticionesAprobar.php"><h6>[Ver lista de nuevas peticiones]</h6></a></span>
                    <p></p>
                  <span><a style="text-decoration: none;" href="listaTrabajosPerso.php"><h6>[Lista de trabajo a pedido]</h6></a></span>
                  <p></p>
                  <span><a style="text-decoration: none;" href="subirObra.html"><h6>[SUBIR UNA OBRA]</h6></a></span>
                    <p></p>
                    
                  <span style= "width:100%"><a style="text-decoration: none ;" href="cambiarFotoPerfil.php"><button type="submit"  class="btn btn-success">Cambiar Mi foto </button></a></span>
                  
                    <br>
                    <br>
                  <span style= "width:100%"><a style="text-decoration: none ;" href="../controlador/controllerCerrarSesion.php"><button type="submit"  class="btn btn-danger ">Cerrar Sesion</button></a></span>
                    <br>
                    <p></p>
                  <span class="bio" ><h5>BIOGRAFIA: </h5></span>
                  <span style="margin-top: 5px;" class="bio" ><h6> <a href="cambiarBiografia.html">edita tu Biografia</a></h6></span>
                    <br>
                  
                  
                  <span  class="biografia">
                    <div  class="contenidoBiografia">
                        <p>
                           <h6 style= "margin-left: 20px; margin-rigth:20px "> '.$mostrarBio. '</h6> 
                        </p>
                   </div></span>';

                }
                
            }

        }



    }

    public function mostrarPerfilAdmin($idUsuario){
        $user = new usuarioRegistrado();

        $resp = $user->buscarUusuarioId($idUsuario);
        if ($resp==false ){
            echo 'No deberias estar aca guiño guiño*';

        }else{
            
            $NombreYApellido= $resp->getNombreYApellido();
            $image= new imagen(null);
            $rep= $image->buscarImagenID($resp->getIdImagen());
            if($rep== false){
                echo $resp->getIdImagen().'Opps Algo ocurrio';

            }else{
                echo'
                
                <div class="imgArtista">
                <img style="width: 100%;max-width: 100%;height: 100%;max-height: 100%;object-fit: cover; object-position: center center; " src="'.$rep->getUrlImagen().'" alt="">
                    </div>
                    <p></p>
                    <span><h4>'.$NombreYApellido.'</h4></span>
                    <p></p>
                    <span><a style="text-decoration: none;" href="listaReporte.php"><h6>[Ver de reportes de obras]</h6></a></span>
                    <p></p>
                    <span><a style="text-decoration: none;" href="listaReporteUser.php"><h6>[Ver de reportes de Usuarios]</h6></a></span>
                    <p></p>
                    <span><a style="text-decoration: none;" href="subirNota.php"><h6>[Subir nota Informativa]</h6></a></span>
                    <p></p>
                    <span><a style="text-decoration: none;" href="agregarModeradores.php"><h6>[Administrar Moderadores]</h6></a></span>
                    <br>
                    <span style= "width:100%"><a style="text-decoration: none ;" href="cambiarFotoPerfil.php"><button type="submit"  class="btn btn-success">Cambiar Mi foto </button></a></span>
                    <br>
                    <br>
                    <a style="text-decoration: none ;" href="../controlador/controllerCerrarSesion.php"><button type="submit" style="margin-bottom:20px"  class="btn btn-danger">Cerrar Sesion</button></a>
                    <br>
                    <p></p>
                
                </div>
                
                
                
                ';
            }

        }

    }


    public function listarObra($idUsuario){
        $artista= new artista(null, null ,null);
        $artista= $artista->buscarArtistaIdUser($idUsuario);
        if($artista==false){
            echo '<h6>No hemos encontrado al artista</h6>';
        }else{
            $obras = new obra(null, null, null ,null ,null ,null ,null ,null ,null, null);
            $listObras= $obras->listarObrasArtistas($artista->getIdArtista());
            $size= $listObras->size();
            if($size==0){
                echo '<h6 style="margin-left:20px ">No hay obras tuyas en la web</h6>';

            }else{
                for ($i=0; $i < $size; $i++) { 
                    $image= new imagen(null);
                    $image= $image->buscarImagenID($listObras->get($i)->getIdImagen());
                    if($image==false){
                        echo '<h6>No se cargo la imagen</h6>';
                    }else{
                        echo' <div class="cuadroArtista">
                                <img style="height: 100%;
                                object-fit: cover;
                                object-position: center center; " class="imagenObraArista" src="'.$image->getUrlImagen().'" alt="">
                                <h6>'.$listObras->get($i)->getTitulo().'<a  href="">✏️</a> <button type="button" style="border:0px; background-color:transparent" id="eliminar" data-id="'.$listObras->get($i)->getIdObra(). '" >❌</button> </h6>
                             </div>';
                    }

                  
                }

            }
        }

    }

    public function listarObrasArtista($idArtista){
        $obras = new obra(null, null, null, null, null, null, null, null, null);
        $listObras= $obras->listarObrasArtistas($idArtista);
            $size= $listObras->size();
            if($size==0){
                echo '<h6 style="margin-left:20px ">No hay disponibles del artista en la web</h6>';

            }else{
                for ($i=0; $i < $size; $i++) { 
                    $image= new imagen(null);
                    $image= $image->buscarImagenID($listObras->get($i)->getIdImagen());
                    if($image==false){
                        echo '<h6>No se cargo la imagen</h6>';
                    }else{
                        echo' <a style="text-decoration:none;" href="detalleObra.php?id='.$listObras->get($i)->getIdObra().'"><div class="cuadroArtista">
                                <img style="height: 100%;
                                object-fit: cover;
                                object-position: center center; " class="imagenObraArista" src="'.$image->getUrlImagen().'" alt="">
                                <h6>'.$listObras->get($i)->getTitulo().'</h6>
                             </div></a>';
                    }
                }
            }
    }
    public function listarNotas(){
        $nota= new notaInformativa(null, null, null, null, null, null);
        $lista= $nota->listarNotas();
        
        if($lista==false){
            echo '<h6 style="margin-left:20px ">Problemas al saber el la cantidad de notas</h6>';
        }else{
            $size = $lista->size();
            if($size==0){
                echo '<h6 style="margin-left:20px ">No hay Notas informativas todavia</h6>';
            }else{
                for ($i=0; $i <$size ; $i++) { 
                    $image= new imagen(null);
                    $image= $image->buscarImagenID($lista->get($i)->getIdMagen());
                    if($image==false){
                        echo  '<h6>No se cargo la imagen</h6>';
                    }else{
                        echo '
                        
                            <div class="cuadroArtista" style="">
                            <button type="button" style="border:0px; background-color:transparent; float:right" id="eliminar" data-id="'.$lista->get($i)->getIdNotainformativa(). '" >❌</button> </h6>
                            <a style="text-decoration:none;" href="detalleNota.php?id='.$lista->get($i)->getIdNotainformativa().'">
                            <img style="height: 100%;
                                object-fit: cover;
                                object-position: center center; " class="imagenObraArista" src="'.$image->getUrlImagen().'" alt="">
                                <h6>'.$lista->get($i)->getTitular().'</h6>
                                </a>    
                            </div>'
                        ;
                    }   
                }   
            }
        }
    }

    public function eliminarObra($idObra){
        $obra= new obra(null, null, null ,null, null, null ,null,null, null ,null);
        $obra = $obra->buscarObraId($idObra);
        if($obra==false){
            echo 'No se borro sory';
        }else{
            $reportObra= new reportes(null, null, null ,null, null, null);
            $reportObra->eliminarReporte($idObra);
            $compra = new compra(null, null, null, null, null, null, null,null ,null );
            $Listcompra= $compra->listarCompraIdObra($idObra);
            
            if($Listcompra->size()>0 ){
                $size= $Listcompra->size();
                $direccion= new direccion(null, null, null, null, null, null, null);
                for ($i=0; $i <$size ; $i++) { 
                    $idDireccion= $Listcompra->get($i)->getIdDireccion();
                    $direccion->eliminarDireccion($idDireccion);
                }
            }
            
            $resp= $compra->eliminarCompraidObra($idObra);
            if($resp== false){
                echo "nose borro la compra";
            }else{
                $reportUser= new reporteUser(null, null, null, null, null);
               
                $critica= new critica(null, null ,null ,null ,null ,null);
                
                $listaCritica= $critica->listarCriticaSegunObra($idObra);
                if($listaCritica==false){

                }else{
                    $size= $listaCritica->size();
                    if($size>0){
                        for ($i=0; $i < $size; $i++) { 
                            $idCritica= $listaCritica->get($i)->getIdCritica();
                            $reportUser->bajarReporteUser($idCritica);
                        }
                    }
                }
                
                $respC= $critica->bajarCriticaIDObra($idObra);

                if($respC==false){
                    echo 'No podimos borrar la critica';
                }else{
                    $respObra=$obra->eliminarObra($idObra);
                    if($respObra==false){
                        echo 'No pudimos bajar la obra';
                    }else{
                        $idImagen=$obra ->getIdImagen();
                        $imagen = new imagen(null);
                        $infoImagen= $imagen->buscarImagenID($idImagen);
                        $url="";
                        if($infoImagen==false){
                            echo 'no encontramos la imagen';
                        }else{
                            $respImg=$imagen->eliminarImagen($idImagen);
                            if($respImg==false){
                                echo 'No pudimos borrar la imagen';
                            }else{
                                if(unlink('../Vista/'.$infoImagen->getUrlImagen()));
                                
                            }
                        }
                       
                    }
                }
            }
        }

    }


    public function eliminarNota($id){
        $nota= new notaInformativa(null, null,null, null, null, null);
        $infonota= $nota->buscarNota($id);
        if($infonota==false){
            echo 'No se encontro la nota';
        }else{
            $idImagen= $infonota->getIdMagen();
            $imagen= new imagen(null);
            $resp=$imagen->buscarImagenID($idImagen);
            if($resp==false)
            {
                echo 'No pudimos encontrar la imagen afiliada';
            }else{
                $infoImagen= $resp;
                $resp= $nota->eliminarNota($id);
                if($resp==false){
                    echo 'No pudimos borrar la nota';
                }else{
                    $resp= $imagen->eliminarImagen($idImagen);
                    if($resp=- false){
                        echo 'No pudimos borrar la imagen';
                    }else{
                        if(unlink('../Vista/'.$infoImagen->getUrlImagen()));
                    }
                }
              
            }
           
        }
    }

    public function listarNoticias(){
        $nota = new notaInformativa(null, null, null, null, null, null, null);
       
    }
   


}
$id=0;
if(empty($_POST['id'])&& empty($_POST['parametros'])){

}else{
    $id= $_POST['id'];
    $perfi= new perfilUusarioRegistrado();
    echo $perfi->eliminarObra($id);
    $idUser=$_POST['parametros'];
    echo $perfi->listarObra($idUser);
}

$param= 0;
if( empty($_POST['idNotas'])){

}else{
    
    $id= $_POST['idNotas'];
    
    $perfil= new perfilUusarioRegistrado();
    $perfil->eliminarNota($id);
    echo $perfil->listarNotas();
}




?>

