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
include_once '../modelo/subastas.php';
include_once '../modelo/click.php';
include_once '../modelo/registroPujadores.php';
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
                    <span style= "width:100%"><a style="text-decoration: none ;" href="medioPago.php"><button type="submit"  class="btn btn-success">Medio de Pago </button></a></span>
                    <br>
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
                    <span><a style="text-decoration: none;" href="subirSubasta.php"><h6>[SUBIR UNA subasta]</h6></a></span>
                    <p></p>
                    <span><a style="text-decoration: none;" href="listarVentas.php"><h6>[Mis ventas]</h6></a></span>
                    <p></p>
                    
                  <span style= "width:100%"><a style="text-decoration: none ;" href="cambiarFotoPerfil.php"><button type="submit"  class="btn btn-success">Cambiar Mi foto </button></a></span>
                    <p></p>
                  <span style= "width:100%"><a style="text-decoration: none ;" href="medioPago.php"><button type="submit"  class="btn btn-success">Medio de Pago </button></a></span>

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
                        echo '<h6 style="margin-left:20px ">No se cargo la imagen</h6>';
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
            echo 'Error no se encontro la obra';
        }else{
            $subasta= new subasta();
            $subasta = $subasta->validaAsociacionObra($obra->getIdObra());
            if ($subasta==false) {
                # code...
            }else{
                $registroPujadores= new registroPujadores();
                $registroPujadores= $registroPujadores->eliminarRegistroIdSubasta($subasta->__getidSubasta());
                if($registroPujadores==false){
                    echo 'Error no se pudo borrar los registros de subastas adyacentes';
                }else{
                    $subasta= $subasta->eliminarSubastaIdSubasta($subasta->__getidSubasta());
                    if($subasta==false){
                    echo 'Error no se pudo borrar la informacion de la subasta';
                    
                    }else{
                       
                    }
                }
            }
            $critica = new critica(null, null, null, null, null, null, null);
            $critica= $critica->bajarCriticaIDObra($obra->getIdObra());
            if($critica==false){
                echo 'No se pudo bajar la obra';
            }
            $compra = new compra(null, null, null, null, null, null, null,null);
            $compra= $compra->eliminarCompraidObra($obra->getIdObra());
            if($compra==false){
                echo 'No se pudo bajar la compra';
            }
            $reportes= new reportes(null, null, null, null, null, null, null,null);
            $reportes= $reportes->eliminarReporteAdyacentes($obra->getIdObra());
            if($reportes==false){
                echo 'No se pudo de bajar los reportes de la obra';
            }
            $click= new click();
            
            $click= $click->buscarClickObras($obra->getIdObra());
            if($click==false){
                echo 'No se encontraron todas las visitias a las obras';
            }else{
                $largo= $click->size();
                $eliminacionClick= new click();
                $eliminacionClick->eliminarClickObra($obra->getIdObra());

                for ($i=0; $i < $largo; $i++) { 
                    $eliminacionClick= new click();

                    $eliminacionClick->eliminarClic($click->get($i)->__getIdClick());
                }
            }


            $compra= new compra(null , null, null, null, null, null, null);
            $compra = $compra->eliminarCompraidObra($obra->getIdObra());
            if ($compra==false) {
                echo 'No se pudo bajar las compras asociadas a la obra';
            }
            $idImagen= $obra->getIdImagen();
            $imagen = new imagen(null,null);
            $imagen=  $imagen->buscarImagenID($idImagen);
            if($imagen==false){
                echo 'No se puedo encontrar la informacion de la imagen asociada';
            }else{
                if(unlink('../Vista/'.$imagen->getUrlImagen())){
                    $obra= $obra->eliminarObra($obra->getIdObra());
                    if($obra==false){
                        echo 'No se pudo bajar la obra';
                    }else{
                        $imagen = new imagen(null);
                        $imagen= $imagen->eliminarImagen($idImagen);
                        if ($imagen==false) {
                            echo 'No se pudo bajar la imagen asociada';
                        }else{
                        
                        }
                    }
                }else{
                    echo 'No se pudo eliminar el archivo de imagen';
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

    public function listarSubastas($idUser){
        $artista= new artista(null, null, null,null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            echo "<h6 style='margin-left:20px '>No pudimos cargar las obras relacionadas con el artista</h6>";
          
        }else{
            $idArtista= $artista->getIdArtista();
            $obra = new obra(null ,null ,null, null, null, null, null, null, null);
            $lista= $obra->listarSubastaIdArtista($idArtista);
            if($lista==false){
                echo "<h6 style='margin-left:20px '>No pudimos cargar las obras relacionadas con el artista</h6>";

            }else{
                
                $largo= $lista->size();
                if($largo==0){
                    echo "<h6 style='margin-left:20px '>No hay subastas por el momento </h6>";
                }else{
                    $imagen = new imagen(null);
                    for ($i=0; $i < $largo; $i++) { 
                        $idImagen= $lista->get($i)->getIdImagen();
                        $imagen= $imagen->buscarImagenID($idImagen);
                        if($imagen==false){
                            echo "No se encontro imagen";
                        }else{
                            $urlImagen= $imagen->getUrlImagen();
                            echo' <a style="text-decoration:none;color: black;" href="detalleObra.php?id='.$lista->get($i)->getIdObra().'"><div class="cuadroArtista">
                            <img style="height: 100%;
                            object-fit: cover;
                            object-position: center center; " class="imagenObraArista" src="'.$urlImagen.'" alt="">
                            <h6 >'.$lista->get($i)->getTitulo().'<a  href="">✏️</a> <button type="button" style="border:0px; background-color:transparent" id="eliminar" data-id="'.$lista->get($i)->getIdObra(). '" >❌</button> </h6>
                            </div></a>';
                        }
                    }
                }
            }
        }
        
    }
    public function listarSubastaArtista($idArtista){
        $obra = new obra(null ,null ,null, null, null, null, null, null, null);
            $lista= $obra->listarSubastaIdArtista($idArtista);
            if($lista==false){
                echo "<h6 style='margin-left:20px '>No pudimos cargar las obras relacionadas con el artista</h6>";

            }else{
                
                $largo= $lista->size();
                if($largo==0){
                    echo "<h6 style='margin-left:20px '>No hay subastas por el momento </h6>";
                }else{
                    $imagen = new imagen(null);
                    for ($i=0; $i < $largo; $i++) { 
                        $idImagen= $lista->get($i)->getIdImagen();
                        $imagen= $imagen->buscarImagenID($idImagen);
                        if($imagen==false){
                            echo "<h6 style='margin-left:20px '>No se encontro imagen</h6>";
                        }else{
                            $urlImagen= $imagen->getUrlImagen();
                            echo' <a style="text-decoration:none;color: black;" href="detalleObra.php?id='.$lista->get($i)->getIdObra().'"><div class="cuadroArtista">
                            <img style="height: 100%;
                            object-fit: cover;
                            object-position: center center; " class="imagenObraArista" src="'.$urlImagen.'" alt="">
                            <h6 >'.$lista->get($i)->getTitulo().' </h6>
                            </div></a>';
                        }
                    }
                }
            }
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

$subasta= 0;
if(empty($_POST["subasta"])){

}else{
    $subasta = $_POST["subasta"];
    
    if($subasta==1)
    {
        $idUser= $_POST["idUser"];
        $perfil = new perfilUusarioRegistrado();
        echo $perfil->listarSubastas($idUser);
    }elseif($subasta==2){
       $idUser= $_POST['idUser'];
       $perfil= new perfilUusarioRegistrado();
       echo $perfil->listarObra($idUser);
    }elseif($subasta==3){
        $idUser= $_POST['idUser'];
        $perfil= new perfilUusarioRegistrado();
        echo $perfil->listarObrasArtista($idUser);
    }elseif($subasta==4){
        $idUser= $_POST['idUser'];
        $perfil= new perfilUusarioRegistrado();
        echo $perfil->listarSubastaArtista($idUser);
     }
}



?>

