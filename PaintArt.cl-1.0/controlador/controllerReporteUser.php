<?php
include_once '../modelo/obra.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/critica.php';
include_once '../modelo/artista.php';
include_once '../modelo/reportesUser.php';

include_once '../modelo/usuarioRegistrado.php';
$parametros= $_POST['parametros'];

class controllerReporte{
    public function listarReporte(){
        $reportes= new reporteUser(null, null, null, null, null);
       
        $lista = $reportes->listarReporteUser();
        if($lista->size()==0){
            echo  '<h2>No hay reportes actuales</h2>';
        }else{
            for ($i=0; $i <$lista->size(); $i++) { 
            
                $idUsuario=$lista->get($i)->getIdUsuarioRegistrado();
                $user=new usuarioRegistrado();
                $busquedaUser=$user->buscarUusuarioId($idUsuario);
                $nombre= $busquedaUser->getNombre()." ".$busquedaUser->getApellido();
                if($busquedaUser== false){
                    echo '<h5>ups no hay nada que mostrar</h5>';
                }else{
                    $critica = new critica(null, null, null, null,null ,null ,null );
                    $infoCri= $critica->buscarCritica($lista->get($i)->getIdCriticas());
                    echo'<div class="contenedorPetcion">
                    <div style="width: 100%; height: auto;" class="listaPeticiones">
                        <div style="text-align:left " class="peticion">
                            <h5>Reporte de: '.$nombre.'</h6>
                            <br>
                            <h6>Razon: '.$lista->get($i)->getRazon().'</h6>
                            <p>descripcion: '.$lista->get($i)->getExplicacion().'</p>
                            <b>Enunciado de la critica en cuestion: "'.$infoCri->getCritica().'"<b>
                        </div>
                        <div style="float: right; " class="botoneraApruebaRechazo">
                        <div class="apruebo"><button style="width: 100% ; height: 100%; border: none;" type="submit" id="apruebo" data-id="'.$lista->get($i)->getIdReporteUser().'"><img style="width: 100% ;max-width: 100%; height: 100%; max-height: 100%;" src="../Vista/imagenes/like.png" alt=""></button></div>
                        <div class="rechazo"><button style="width: 100% ; height: 100%; border: none;" type="submit" id="rechazo" data-id="'.$lista->get($i)->getIdReporteUser().'"><img style="width: 100% ;max-width: 100%; height: 100%; max-height: 100%;" src="../Vista/imagenes/dislike.png"  alt=""></button></div>
                        </div>
                    </div>
                    </div>';
                }
               
            }
        }
       
    }
    
    public function  apruebaReporte($id){
        $reporte= new reporteUser(null, null, null, null, null);
        $resp= $reporte->buscarReporteUserId($id);
        if ($resp==false) {
            echo 'Upsss... No se encontro el reporte';
        }else{
           $IdCritica= $resp->getIdCriticas();
           $critica= new critica(null, null, null ,null, null);
           $infoCritica=$critica->buscarCritica($IdCritica);
           
           if($infoCritica==false){
                echo 'ups no pudimos encontrar la critica';
           }else{
                $resp= $reporte->bajarReporteUser($id);
                if($resp==false){

                    echo 'ups no podemimos bajar el reporte';
                }else{
                    $resp= $critica->bajarCritica($IdCritica);
                    if($resp== false){
                        echo 'ups no podemimos bajar la critica';
                    }else{
                        $user= new usuarioRegistrado();
                        $resp= $user->cambiarPermiso(5, $infoCritica->getIdUsuarioRegistrado());
                        if($resp==false){
                            echo 'Upsss, no pudimos banera al sujeto';
                        }else{
                            echo 'Todo en orden, se bajo satifactoriamente la critica y el usuario ha sido baneado';
                        }
                    }
                }
                
           }
           
            
            
           
           
        }
            
    }
    public function rechazoReporte($id){
        $reporte= new reporteUser(null, null, null, null, null);
        $resp= $reporte->buscarReporteUserId($id);
        if ($resp== false) {
            echo 'Uppss, no econtramos el reporte solicitado en la bd';
        }else{
            $resp= $reporte->bajarReporteUser($resp->getIdReporteUser());
            if($resp==false){
                echo 'Uppss, no podimos quitar el reporte';
            }else{
                echo 'Rerporte quitado con exito';
            }
        }
       
    }
}

if($parametros== 1){
$listar= new controllerReporte();
  echo $listar->listarReporte();
 
     
  }elseif($parametros==2){
    $id= $_POST["id"];
    $reportes= new controllerReporte();
    echo $reportes->apruebaReporte($id);
  
  }elseif($parametros==3){

        $id= $_POST["id"];
        $reportes= new controllerReporte();
        echo $reportes->rechazoReporte($id);
    
  }


?>