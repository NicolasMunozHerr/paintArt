<?php 
include_once '../modelo/obra.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/imagen.php';
include_once '../modelo/artista.php';
include_once '../modelo/peticion.php';
include_once '../modelo/usuarioRegistrado.php';

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
                                            <p>descripcion:'.$listaPeticiones->get($i)->getDescripcion().'</p>
                                            
                                        </div>
                                        <div style="float: right; " class="botoneraEstado">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" id="iniciando" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-warning btn-sm">Iniciando</button>
                                            <button type="button" id="terminando" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-dark btn-sm">terminado</button>
                                            <button type="button" id="enviado" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-dark btn-sm">enviado</button>
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
                                            <p>descripcion:'.$listaPeticiones->get($i)->getDescripcion().'</p>
                                            
                                        </div>
                                        <div style="float: right; " class="botoneraEstado">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" id="iniciando" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-dark btn-sm">Iniciando</button>
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
                                            <p>descripcion:'.$listaPeticiones->get($i)->getDescripcion().'</p>
                                            
                                        </div>
                                        <div style="float: right; " class="botoneraEstado">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" id="iniciando" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-dark btn-sm">Iniciando</button>
                                            <button type="button" id="terminando" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-dark btn-sm">terminado</button>
                                            <button type="button" id="enviado" data-id="'.$listaPeticiones->get($i)->getIdPeticion().'" class="btn btn-warning btn-sm">enviado</button>
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
    public function rechazarPeticion($id){
        $peticiones=  new peticion(null, null, null, null, null, null, null, null ,null);
        $resp= $peticiones->rechazaPeticion($id);
        if ($resp== false) {
            echo 'No se pudo rechazar la peticion';
        }else{
            echo 'Rechazado exitosamente';
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
    public function estadoEnviado($id){
        $peticiones=  new peticion(null, null, null, null, null, null, null, null ,null);
        $resp= $peticiones->enviadoPeticion($id);
        if ($resp==false) {
            echo 'No se pudo cambiar el estado de la peticion';
        }else{
            echo 'Ahora encontraras la peticion en TERMINANDO';
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
                    $user= new usuarioRegistrado();
                    $infoUser= $user->buscarUusuarioId($listaPeticiones->get($i)->getIdUsuarioRegistrado())  ; 
                    $estado = $listaPeticiones->get($i)->getEstado();
                    $resultado='';
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
                            break;
                        case 4:
                            $resultado = 'no fue aceptado';
                            break;            
                    }
                    echo'
                            <div class="contenedorPetcion">
                                <div style="width: 100%; height: auto;" class="listaPeticiones">
                                    <div style="text-align:left " class="peticionAprobado">
                                        <h5>Peticion de:'.$infoUser->getNombreYApellido().'</h6>
                                        <p></p><p></p>
                                        <h6>asunto: '.$listaPeticiones->get($i)->getAsunto().'</h6>
                                        <b>precio:'.$listaPeticiones->get($i)->getPrecio().'</b>
                                        <p>descripcion:'.$listaPeticiones->get($i)->getDescripcion().'</p>
                                        
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
    $lista= new mostrarPeticion();
    echo $lista->rechazarPeticion($id);

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
    $lista= new mostrarPeticion();
    echo $lista->estadoEnviado($id);
}elseif($parametros==8){
    session_start();
    $idUsuario=$_SESSION['online'];
    $lista = new mostrarPeticion();
    echo $lista->mostrarPeticionUser($idUsuario);
}



?>