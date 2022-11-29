<?php
include_once '../modelo/obra.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/imagen.php';
include_once '../modelo/artista.php';
include_once '../modelo/reportes.php';
include_once '../modelo/subastas.php';
include_once '../modelo/registroPujadores.php';
include_once '../modelo/critica.php';
include_once '../modelo/direccion.php';
include_once '../modelo/reportesUser.php';
include_once '../modelo/notaInformativa.php';
include_once '../modelo/click.php';
include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/compra.php';
$parametros= $_POST['parametros'];

class controllerReporte{
    public function listarReporte(){
        $reportes= new reportes(null, null, null, null, null);
       
        $lista = $reportes->listarReporte();
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
                    echo'<div class="contenedorPetcion">
                    <div style="width: 100%; height: auto;" class="listaPeticiones">
                        <div style="text-align:left " class="peticion">
                            <h5>Reporte de: '.$nombre.'</h6>
                            <br>
                            <h6>Razon: '.$lista->get($i)->getRazon().'</h6>
                            <p>descripcion: '.$lista->get($i)->getExplicacion().'</p>
                            <a style="text-decoration: none; margin-bottom: 5px;" href="detalleObra.php?id='.$lista->get($i)->getidObra().'">CLICK AQUI PARA VER OBRA</a>
                        </div>
                        <div style="float: right; " class="botoneraApruebaRechazo">
                        <div class="apruebo"><button style="width: 100% ; height: 100%; border: none;" type="submit" id="apruebo" data-id="'.$lista->get($i)->getIdReporte().'"><img style="width: 100% ;max-width: 100%; height: 100%; max-height: 100%;" src="../Vista/imagenes/like.png" alt=""></button></div>
                        <div class="rechazo"><button style="width: 100% ; height: 100%; border: none;" type="submit" id="rechazo" data-id="'.$lista->get($i)->getIdReporte().'"><img style="width: 100% ;max-width: 100%; height: 100%; max-height: 100%;" src="../Vista/imagenes/dislike.png"  alt=""></button></div>
                        </div>
                    </div>
                    </div>';
                }
               
            }
        }
       
    }
    
    public function  apruebaReporte($idReporte){
        $reporte= new reportes(null, null, null, null, null);
        $resp=$reporte->buscarReporteId($idReporte);
        if ($resp==false) {
            echo 'Upsss... No se encontro el reporte';
        }else{
            $infoRepor= $resp;
            $idObra= $infoRepor->getidObra();
            
            $ob= new obra(null,null,null,null,null,null,null,null,null);
            $resp= $ob->shadowBan($idObra);
            if($resp==false){
                echo 'No se pudo de dar de baja';
            }else{

                $resp= $reporte->eliminarReporteAdyacentes($idObra);
         
            if($resp==false){
                echo 'Uppss, no podimos quitar el reporte';
            }else{
                
                echo 'Ahora se dejara de listar en el sitio web';
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


            $compra= new compra(null , null, null, null, null, null, null,null);
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
                            echo ', Se elimino exitosamente';
                        }
                    }
                }else{
                    echo 'No se pudo eliminar el archivo de imagen';
                }
                
            }
            
            

            
            
        }

            }/*
               
            $obra= $ob->buscarObraId($idObra);
            $img= new imagen(null);
            $idImagen= $obra->getIdImagen();
            $imagen= $img->buscarImagenID($idImagen);
            $resp=$reporte->eliminarReporteAdyacentes($idObra);
            if($resp== false){
                echo 'Upsss... No se pudo Borrar el reporte';
            }else{
                $resp= $ob->eliminarObra($idObra);
                if($resp==false){
                    echo 'Upsss... No se pudo borrar la obra';
                }else{
                    if ($imagen==false) {
                        echo 'Upsss... No se encontro la imagen';  
                    }else{
                        If (unlink('../Vista/'.$imagen->getUrlImagen())) {
                            $resp= $img->eliminarImagen($idImagen);
                            if ($resp==false) {
                                echo 'Upsss... No se pudo borrar la imagen';  
                            }else{
                              echo 'eliminado con exito';
                            }
                          } else {
                            echo 'Upsss... el archivo de imagen no se borro';
                          }
                    }
                }
           */
               
            
            
           
            }
        }
            
    }
    public function rechazoReporte($id){
        $reporte= new reportes(null, null, null, null, null);
        $resp= $reporte->buscarReporteId($id);
        $reporte= $reporte->buscarReporteId($id);
        if ($resp== false) {
            echo 'Uppss, no econtramos el reporte solicitado en la bd';
        }else{
            $resp= $reporte->eliminarReporte($resp->getIdReporte());
         
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