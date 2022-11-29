<?php 
include_once '../modelo/obra.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/imagen.php';
include_once '../modelo/artista.php';
include_once '../modelo/peticion.php';
include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/direccion.php';

$parametros= $_POST['parametros'];

class mostrarPeticion{


    public function listarAprobacion($idUsuario){
        $peticiones=  new peticion(null, null, null, null, null, null, null, null ,null);
        $artista=new artista(null, null, null);
        $resp =$artista->buscarArtistaIdUser($idUsuario);
        if($resp==false){
            echo '<h6> No encontramos las peticiones del artista</h6>';
        }else{
            $listaPeticiones= $peticiones->listarPeticionAprobacion($resp->getIdArtista());
            $size= $listaPeticiones->size();
            
            if ($size==0) {
                echo '<h6> No hay peticiones por el momento </h6>';
            }else{
    
                for ($i=0; $i < $size; $i++) { 
                    $user= new usuarioRegistrado();
                    $infoUser= $user->buscarUusuarioId($listaPeticiones->get($i)->getIdUsuarioRegistrado())  ; 
                   
                    echo'
                    <div class="contenedorPetcion">
                        <div style="width: 100%; height: auto;" class="listaPeticiones">
                            <div style="text-align:left " class="peticion">
                                <h5>Peticion de:'.$infoUser->getNombreYApellido().'</h6>
                                <p></p><p></p>
                                <h6>asunto: '.$listaPeticiones->get($i)->getAsunto().'</h6>
                                <b>precio:'.$listaPeticiones->get($i)->getPrecio().'</b>
                                <p>descripcion:'.$listaPeticiones->get($i)->getDescripcion().'</p>
                                
                            </div>
                            <div style="float: right; " class="botoneraApruebaRechazo">
                                <div class="apruebo"><button style="width: 100% ; height: 100%; border: none;" type="submit" id="apruebo" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'"><img style="width: 100% ;max-width: 100%; height: 100%; max-height: 100%;" src="../Vista/imagenes/like.png" alt=""></button></div>
                                <div class="rechazo"><button style="width: 100% ; height: 100%; border: none;" type="submit"id="rechazo" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'"><img style="width: 100% ;max-width: 100%; height: 100%; max-height: 100%;" src="../Vista/imagenes/dislike.png" alt=""></button></div>
                            </div>
                        </div>
                    </div> 
                    ';
                }
            }
        
        }
    }

    public function listarPeticionAprobada($idUsuario){

            $peticiones=  new peticion(null, null, null, null, null, null, null, null ,null);
            $artista=new artista(null, null, null);
            $resp =$artista->buscarArtistaIdUser($idUsuario);
            if($resp==false){
                echo '<h6> No encontramos sus lista de trabajo de peticiones </h6>';
            }else{
                $listaPeticiones= $peticiones->listaPeticionTrabajadas($resp->getIdArtista());
                $size= $listaPeticiones->size();
                
                if ($size==0) {
                    echo '<h6> No hay peticiones por el momento </h6>';
                }else{

                    for ($i=0; $i < $size; $i++) { 
                        $user= new usuarioRegistrado();
                        $infoUser= $user->buscarUusuarioId($listaPeticiones->get($i)->getIdUsuarioRegistrado())  ; 
                        $estado = $listaPeticiones->get($i)->getEstado();
                        $idDireccion = $listaPeticiones->get($i)->getIdDireccion();
                        $direccion= new direccion(null, null, null, null, null, null,null);
                        $respDireccion= $direccion->buscarDireccionID($idDireccion);
                        $detalleDireccion= "";
                        if ($respDireccion==false) {
                            $detalleDireccion="Direccion no encontrada";
                        }else{
                            $detalleDireccion= "direccion del cliente: <br>".$respDireccion->__toString();
                        }
                        switch ($estado) {
                            case 1:
                                echo'
                                <div class="contenedorPetcion">
                                    <div style="width: 100%; height: auto;" class="listaPeticiones">
                                        <div style="text-align:left " class="peticionAprobado">
                                            <h5>Peticion de:'.$infoUser->getNombreYApellido().'</h6>
                                            <p></p><p></p>
                                            <h6>asunto: '.$listaPeticiones->get($i)->getAsunto().'</h6>
                                            <b>precio:'.$listaPeticiones->get($i)->getPrecio().'</b>
                                            <b>'.$detalleDireccion.'</b>
                                            <p>descripcion:'.$listaPeticiones->get($i)->getDescripcion().'</p>
                                            
                                        </div>
                                        <div style="float: right; " class="botoneraEstado">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" id="iniciando" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-warning btn-sm">Iniciando</button>
                                            <button type="button" id="terminando" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-dark btn-sm">terminado</button>
                                            <button type="button" id="enviado" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-dark btn-sm disabled">enviado</button>
                                        </div>
                                        </div>
                                    </div>
                                </div> 
                                ';
                                break;
                            
                            case 2:
                                echo'
                                <div class="contenedorPetcion">
                                    <div style="width: 100%; height: auto;" class="listaPeticiones">
                                        <div style="text-align:left " class="peticionAprobado">
                                            <h5>Peticion de:'.$infoUser->getNombreYApellido().'</h6>
                                            <p></p><p></p>
                                            <h6>asunto: '.$listaPeticiones->get($i)->getAsunto().'</h6>
                                            <b>precio:'.$listaPeticiones->get($i)->getPrecio().'</b>
                                            <b>'.$detalleDireccion.'</b>

                                            <p>descripcion:'.$listaPeticiones->get($i)->getDescripcion().'</p>
                                            
                                        </div>
                                        <div style="float: right; " class="botoneraEstado">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" id="iniciando" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-dark btn-sm disabled">Iniciando</button>
                                            <button type="button" id="terminando" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-warning btn-sm">terminado</button>
                                            <button type="button" id="enviado" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-dark btn-sm">enviado</button>
                                        </div>
                                        </div>
                                    </div>
                                </div> 
                                ';
                                break;
                            case 3:
                                echo'
                                <div class="contenedorPetcion">
                                    <div style="width: 100%; height: auto;" class="listaPeticiones">
                                        <div style="text-align:left " class="peticionAprobado">
                                            <h5>Peticion de:'.$infoUser->getNombreYApellido().'</h6>
                                            <p></p><p></p>
                                            <h6>asunto: '.$listaPeticiones->get($i)->getAsunto().'</h6>
                                            <b>precio:'.$listaPeticiones->get($i)->getPrecio().'</b>
                                            <b>'.$detalleDireccion.'</b>

                                            <p>descripcion:'.$listaPeticiones->get($i)->getDescripcion().'</p>
                                            
                                        </div>
                                        <div style="float: right; " class="botoneraEstado">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" id="iniciando" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-dark btn-sm disabled">Iniciando</button>
                                            <button type="button" id="terminando" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-dark btn-sm disabled">terminado</button>
                                            <button type="button" id="enviado" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-warning btn-sm ">enviado</button>
                                        </div>
                                        </div>
                                    </div>
                                </div> 
                                ';
                                break;    
                        }
                    
                    }
                }
            }
            
    }
    public function quitarPeticion($id){
        $peticiones=  new peticion(null, null, null, null, null, null, null, null ,null);
        $resp= $peticiones->eliminarPeticion($id);
        if ($resp==false) {
           echo 'No se ha podido eliminar la peticion';
        }else{
            echo 'Se ha elimando exitosamente';
        }

    }
    public function rechazarPeticion($desc,$id){
        $peticiones=  new peticion(null, null, null, null, null, null, null, null ,null);
        $resp= $peticiones->rechazaPeticion($desc,$id);
        if ($resp== false) {
            echo 'No se pudo rechazar la peticion';
        }else{
            echo 'Fue rechazado exitosamente';
        }

    }

    public function aprobaraPeticion ($id){
        $peticiones=  new peticion(null, null, null, null, null, null, null, null ,null);
        $resp= $peticiones->apruebaPeticion($id);
        if ($resp==false) {
            echo 'No se pudo aprobar la peticion';
        }else{
            echo 'Ahora encontraras la peticion en tu LISTA DE TRABAJOS A PEDIDO';
        }

    }

    public function estadoIniciando($id){
        $peticiones=  new peticion(null, null, null, null, null, null, null, null ,null);
        $resp= $peticiones->apruebaPeticion($id);
        if ($resp==false) {
            echo 'No se pudo cambiar el estado de la peticion';
        }else{
            echo 'Ahora encontraras la peticion en INICIANDO';
        }
    }
    public function estadoTerminando($id){
        $peticiones=  new peticion(null, null, null, null, null, null, null, null ,null);
        $resp= $peticiones->terminandoPeticion($id);
        if ($resp==false) {
            echo 'No se pudo cambiar el estado de la peticion';
        }else{
            echo 'Ahora encontraras la peticion en TERMINANDO';
        }

    }
    public function estadoEnviado($id, $estado){
        $peticiones=  new peticion(null, null, null, null, null, null, null, null ,null);
        $resp= $peticiones->enviadoPeticion($id, $estado);
        if ($resp==false) {
            echo 'No se pudo cambiar el estado de la peticion';
        }else{
            echo 'Ahora encontraras la peticion en ENVIADO';
        }

    }

    public function mostrarPeticionUser($idUsuario){
        $peticiones=  new peticion(null, null, null, null, null, null, null, null ,null);
            $listaPeticiones= $peticiones->listarPeticionUser($idUsuario);
            $size= $listaPeticiones->size();
            
            if ($size==0) {
                echo '<h6> No hay peticiones por el momento </h6>';
            }else{

                for ($i=0; $i < $size; $i++) { 
                    $artista= new artista(null,null, null);
                    $infoArtista= $artista->buscarIdArtista($listaPeticiones->get($i)->getIdArtista());
                    if($infoArtista==false){
                        echo '<h6> No se encontro al artista en el momento </h6>';
                    }else{
                        $user= new usuarioRegistrado();
                        $infoUser= $user->buscarUusuarioId($infoArtista->getIdUsuarioRegistrado())  ; 
                        $estado = $listaPeticiones->get($i)->getEstado();

                        $resultado='';
                        $estadoEnvio="";
                        switch ($estado){
                            case 0:
                                $resultado = 'Por revisar';
                                break;
                            case 1:
                                $resultado= 'iniciando';
                                break;
                            case 2:
                                $resultado = 'terminando';
                                break;
                            case 3:
                                $resultado = 'enviado';
                                $estadoEnvio = $listaPeticiones->get($i)->getEstadoEnvio();
                                $estadoEnvio= " <h6> Estado de la peticion: <b>cod. de seguimiento ".$estadoEnvio." </b></h6>";
                                break;
                            case 4:
                                $resultado = 'no fue aceptado';
                                break;            
                        }
                        if($estado==4){

                            echo'
                                <div class="contenedorPetcion">
                                    <div style="width: 100%; height: auto;" class="listaPeticiones">
                                        <div style="text-align:left " class="peticionAprobado">
                                            <h4>Peticion para:'.$infoUser->getNombreYApellido().'</h4>
                                            <p></p><p></p>
                                            <h6>Razon de rechazo: </h6>
                                            <b> " '.$listaPeticiones->get($i)->getDescripcion().' " </b>
                                            <div style="text-align: right; width:90%; margin:auto;"> <button    id="rechazo" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" type="button" class="btn btn-warning">Eliminar </button></div>
                                            <p></p>
                                            <p><b> <a style="text-decoration: none; margin-bottom: 5px;" href="verArtista.php?idArtista='.$infoArtista->getIdArtista().'">CLICK AQUI PARA VER LA ARTISTA</a></b></p>

                                        </div>
                                        <div style="float: right; " class="botoneraEstado">
                                            <h6>Estado: '.$resultado.'
                                        </div>
                                        </div>
                                    </div>
                                </div> ';
                        }else{
                            
                            echo'
                                <div class="contenedorPetcion">
                                    <div style="width: 100%; height: auto;" class="listaPeticiones">
                                        <div style="text-align:left " class="peticionAprobado">
                                            <h4>Peticion para:'.$infoUser->getNombreYApellido().'</h4>
                                            <p></p><p></p>
                                            '.$estadoEnvio.'
                                            <h6>asunto: '.$listaPeticiones->get($i)->getAsunto().'</h6>
                                            <b>precio: '.$listaPeticiones->get($i)->getPrecio().'</b>
                                            <p>descripcion: '.$listaPeticiones->get($i)->getDescripcion().'</p>
                                            <p><b> <a style="text-decoration: none; margin-bottom: 5px;" href="verArtista.php?idArtista='.$infoArtista->getIdArtista().'">CLICK AQUI PARA VER LA ARTISTA</a></b></p>
                                        </div>
                                        <div style="float: right; " class="botoneraEstado">
                                            <h6>Estado: '.$resultado.'
                                        </div>
                                        </div>
                                    </div>
                                </div> ';
                        }
                    }
                    
                    
                }
            }
    }



}

if ($parametros==1) {
    session_start();
    $idUsuario=$_SESSION['online'];
    $lista= new mostrarPeticion();
    echo $lista->listarAprobacion($idUsuario);
}elseif ($parametros==2) {
    $id= $_POST['id'];
    $lista= new mostrarPeticion();
    echo $lista->aprobaraPeticion($id);
}elseif($parametros==3){
    $id= $_POST['id'];
    $desc= $_POST['descripcion'];
    $lista= new mostrarPeticion();
    echo $lista->rechazarPeticion($desc,$id);

}elseif ($parametros==4) {
    $lista= new mostrarPeticion();
    session_start();
    $idUsuario=$_SESSION['online'];
    echo $lista->listarPeticionAprobada($idUsuario);
}elseif ($parametros==5) {
    $id= $_POST['id'];
    $lista= new mostrarPeticion();
    echo $lista->estadoIniciando($id);
}elseif ($parametros==6) {
    $id= $_POST['id'];
    $lista= new mostrarPeticion();
    echo $lista->estadoTerminando($id);
}elseif ($parametros==7) {
    $id= $_POST['id'];
    $estado= $_POST['estadoEnvio'];
    $lista= new mostrarPeticion();
    echo $lista->estadoEnviado($id, $estado);
}elseif($parametros==8){
    session_start();
    $idUsuario=$_SESSION['online'];
    $lista = new mostrarPeticion();
    echo $lista->mostrarPeticionUser($idUsuario);
}elseif ($parametros==9) {
    $id=$_POST['id'];
    $lista= new mostrarPeticion();
    echo $lista->quitarPeticion($id);
}



?>