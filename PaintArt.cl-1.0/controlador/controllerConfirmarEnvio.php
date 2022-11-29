<?php
include_once '../modelo/obra.php';
include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/imagen.php';
include_once '../modelo/artista.php';
include_once '../modelo/compra.php';
include_once '../modelo/subastas.php';
include_once '../modelo/registroPujadores.php';
include_once '../modelo/direccion.php';
class controllerConfirmarEnvio{
    public function modificarEstadoEnvio($idCompra, $codigoEnvio){
            $compra= new compra(null, null, null, null, null,null,null, null);
            $resp= $compra->editarCompra($idCompra, $codigoEnvio);
            if($resp==false){
                echo 'algo salio mal';
            }else{
                echo 'Todo correcto';
            }

    }
    public function listarConfirmacion($idUsuario){
        $artista= new artista(null, null, null, null);
        $resp=$artista->buscarArtistaIdUser($idUsuario);
        if($resp==false){
            echo '<h3 style="margin-top: 10px;margin-left: 10px;">Historial de mis ventas</h3>
                <button id="subasta" type="button" style= "width:200px; "class="btn btn-warning ">ver Subasta</button> ';
            echo 'No se encontro al perfil del artista';
        }else{
            $idArtista= $resp->getIdArtista();
            $compra= new compra(null ,null, null,null,null,null,null,null,null,null,null,null);
            $lista= $compra->listarVentasIdArtista($idArtista);
            if($lista==false){
                echo '<h3 style="margin-top: 10px;margin-left: 10px;">Historial de mis ventas</h3>
                <button id="subasta" type="button" style= "width:200px; "class="btn btn-warning ">ver Subasta</button> ';
                echo 'no se pudo encontrar la lista de ventas del usuario';
            }else{
                echo '<h3 style="margin-top: 10px;margin-left: 10px;">Historial de mis ventas</h3>
                <button id="subasta" type="button" style= "width:200px; "class="btn btn-warning ">ver Subasta</button> ';
                $size= $lista->size();
                $infoObra="";
                for ($i=0; $i < $size; $i++) { 
                    $idCliente= new usuarioRegistrado();
                    $resp= $idCliente->buscarUusuarioId($lista->get($i)->getIdUsuarioRegistrado());
                    if($resp==false){
                        echo 'algo salio mal al buscar al cliente';
                    }else{
                        $nombre= $resp->getNombreYApellido();
                        $obra= new obra(null ,null, null, null, null, null, null, null, null,null);
                        $resp = $obra->buscarObraId($lista->get($i)->getIdObra());
                        if($resp ==false){
                            echo 'No se encontro informacion sobre la obra';
                        }else{
                            $infoObra= $resp; 
                            $compra = new compra(null, null, null, null,null, null, null, null);
                            $respCompra= $compra->buscarCompraIdObra($infoObra->getIdObra());
                            if($respCompra==false){
                                echo 'No se encontro la compra';
                            }else{
                                $direccion= new direccion(null, null, null, null, null,null,null);
                                $repDireccion= $direccion->buscarDireccionID($respCompra->getIdDireccion());
                                if($repDireccion==false){
                                    echo 'No se encontro la direccion'.$respCompra->getIdDireccion();
                                }else{

                                    $infoImagen= new imagen(null);
                                    $resp = $infoImagen->buscarImagenID($infoObra->getIdImagen());
                                    if ($resp==false) {
                                        echo 'No se encontro informacion sobre la imagen de la obra';
                                    }else{
                                        
                                        $infoImagen= $resp;
                                        $estadoEnvio="Por  confirmar";
                                            if($lista->get($i)->getEstadoEnvio()==""){
                                                $estadoEnvio= '<button id="enviar" data-id="'.$lista->get($i)->getIdCompra().'" type="submit" class="btn btn-success"> Por Confirmar Envio </button>';
                                            }else{
                                                $estadoEnvio= '
                                                
                                                CODIGO DE ENVIO: '.$lista->get($i)->getEstadoEnvio().'
                                                <p>
                                                </p>
                                                
                                                <button id="enviar" data-id="'.$lista->get($i)->getIdCompra().'" type="submit" class="btn btn-success"> Editar codigo Envio </button> <p>
                                                </p>';
                                                
                                            }
                                            echo'
                                
                                            <div style="text-align:left; width:95% " class="peticion">
                                            <h5>Comprada por: '.$nombre.'</h5>
                                            
                                            <H6>Titulo de la Obra: '.$infoObra->getTitulo().'</H6>
                                            <H6>'.$estadoEnvio.'<b/></H6>
                                            <P>
                                            <P>
                                            <label>Fecha de compra: '.$lista->get($i)->getFechaCompra().'</label>
                                            <P>
                                            <label>Monto de la compra: $'.$respCompra->getPrecioCompra().'</label>
                                            <P>
                                            <label>direccion del cliente: <br>'.$repDireccion->__toString().'</label>
                                            <P>
                                            
                                            
                                            
                                            
                                            <a style="text-decoration: none; margin-bottom: 5px;" href="detalleObra.php?id='.$lista->get($i)->getidObra().'">CLICK AQUI PARA VER AL OBRA</a>
                                            <img style="float:right;width: 120px;; max-width: 120px;height: 120px;max-height: 120px;margin-top:-110px; margin-right:10px" src="'.$infoImagen->getUrlImagen().'" alt="">
                                        </div> <br>'    ;
                                            
                                        
                                    }
                                }
                                    
                                
                            }
                            
                            
                        }
                       
                    }
                
                   
                }
            
            
            }
        }
    }

    public function listarSubConfirmacion($idUser){
        $artista= new artista(null, null, null, null);
        $resp=$artista->buscarArtistaIdUser($idUser);
        if($resp==false){
            echo '<h3 style="margin-top: 10px;margin-left: 10px;">Historial de mis ventas</h3>
                <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-warning ">ver ventas de obras</button> ';
            echo 'No se encontro al perfil del artista';
        }else{
            $subasta= new subasta();
            date_default_timezone_set("America/Santiago");
            setlocale(LC_ALL, "es_ES");
            $fechaAcual= new DateTime(date("Y-m-d H:i:00"));
            $registro= $subasta->listarSubastaTerminadas($resp->getIdArtista(), $fechaAcual->format('Y-m-d H:i:s'));
            if($registro==false){
                echo 'No se encontraron subastas asociadas al perfil';
            }else{
                $size= $registro->size();
                if($size==0){
                    echo 'No se encontraron subastas terminadas hasta el momento';
                }else{
                    echo '<h3 style="margin-top: 10px;margin-left: 10px;">Historial de mis ventas</h3>
                    <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-warning ">ver ventas de obras</button> 
                    <br><br> ';
                    for ($i=0; $i < $size; $i++) { 
                        $idSubasta=$registro->get($i)->__getidSubasta();
                        $maximoRegistro= new registroPujadores();
                        $maximoRegistro= $maximoRegistro->maximoPujador($idSubasta);
                        $direccionMax="";
                        if($maximoRegistro==false){
                            $maximoRegistro= 'No hay ninguna puja todavia en esta subastas';
                        }else{
                            $idUserMaxPujador= $maximoRegistro->__getIdUser();
                            $usuarioRegistraod= new usuarioRegistrado();
                            $direccion = new direccion(null, null, null, null, null, null, null);
                            $respDireccion= $direccion->buscarDireccionID($maximoRegistro->__getDireccion_IdDireccion());
                            if($respDireccion==false){
                                $direccionMax="No se encontro direccion";
                            }else{
                                $direccionMax= "Direccion del cliente: <br>".$respDireccion->__toString();
                            }
                            $UserMaxPujador =$usuarioRegistraod->buscarUusuarioId($idUserMaxPujador);
                            $maximoRegistro=$UserMaxPujador->getNombreYApellido();
                           
                        }
                            $subasta= new subasta();
                            $resp=$subasta->buscarSubasta($idSubasta);
                           
                            if($resp==false){
                                echo '
                                    <h3 style="margin-top: 10px;margin-left: 10px;">Historial de mis ventas</h3>
                                    <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-primary ">ver ventas de obras</button> 
                                    <br><br>
                                    No hay algun registro de subastas hasta el momento ';
                            }else{
                                $subasta= $resp;
                                $idObra= $subasta->__getIdObra();
                                $obra= new obra(null, null ,null ,null, null, null, null, null, null);
                                $resp= $obra->buscarObraId($idObra);
                                if($resp==false){
                                    echo '
                                    <h3 style="margin-top: 10px;margin-left: 10px;">Historial de mis ventas</h3>
                                    <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-primary ">ver ventas de obras</button> 
                                    <br><br>
                                    No se obtuvo la obra en este momento';
                                }else{
                                    $obra= $resp;
                                    $imagen= new imagen(null);
                                    $resp= $imagen ->buscarImagenID($obra->getIdImagen());
                                    if($resp == false){
                                        echo '
                                        <h3 style="margin-top: 10px;margin-left: 10px;">Historial de mis ventas</h3>
                                        <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-warning ">ver ventas de obras</button> 
                                        <br><br>
                                        No se obtuvo la imagen en este momento';
                                    }else{
                                        $imagen= $resp;
                                        $estado=false;
                                        if ($subasta->__getEstadoEnvio()==""&& $maximoRegistro=='No hay ninguna puja todavia en esta subastas') {
                                            
                                        }else{
                                            if ($subasta->__getEstadoEnvio()=="") {
                                                $maximoRegistro= $maximoRegistro.' <br><p></p><p><button id="enviarSub" data-id="'.$subasta->__getidSubasta().'" type="submit" class="btn btn-success"> Confirmar envio </button> </p>';

                                            }else{
                                                $maximoRegistro= $maximoRegistro.' <br><p>Codigo envio:'.$subasta->__getEstadoEnvio().'</p><p><button id="enviarSub" data-id="'.$subasta->__getidSubasta().'" type="submit" class="btn btn-success"> Editar codigo de envio </button> </p>';

                                            }
                                        }
                                       
                                        echo'          
                                            <div style="text-align:left; width:95% " class="peticion">                                                             
                                                <H5>Titulo de la Obra: '.$obra->getTitulo().'</H5>
                                                <P>

                                                <P><h6>
                                                    Mayor pujador: <br> -<b>'.$maximoRegistro.'</b></br></h6>
                                                <p>
                                                    <b>
                                                <label>Fecha de finalizacion: '.$subasta->__getFechaLimite().'</label> </b>
                                                <P>
                                                <label><b>Monto de la puja Mayor: $'.$subasta->__getPrecioPuja().'<b></label>
                                                <P>
                                                <label>'.$direccionMax.'</label>
                                                <P>
                                                
                                                <a style="text-decoration: none; margin-bottom: 5px;" href="detalleObra.php?id='.$obra->getidObra().'">CLICK AQUI PARA VER AL OBRA</a>
                                                <img style="float:right;width: 120px;; max-width: 120px;height: 120px;max-height: 120px;margin-top:-110px; margin-right:10px" src="'.$imagen->getUrlImagen().'" alt="">
                                             </div> <br>
                                                        ';
                                    
                                }
                            }
                        }
                        
                     
                    }
                }
            }
        }
    }


    public function modificarEstadoEnvioSub($id, $codigoEnvio){
        $subasta = new subasta();
        $resp =$subasta->editarestadoEnvio($codigoEnvio, $id);
        if($resp==false){
            echo 'algo salio mal';
        }else{
            echo 'Todo correcto';
        }
    }

}

if(!empty($_POST['parametros'])){
    $param = $_POST['parametros'];
    if ($param==1&& !empty($_POST['idUser'])) {
        $idUser= $_POST['idUser'];
        $controller= new controllerConfirmarEnvio();
        echo $controller->listarConfirmacion($idUser);
    }elseif($param==2&& !empty($_POST['id'])&& !empty($_POST['codigoEnvio'])){
        $idCompra= $_POST['id'];
        $codigoEnvio= $_POST['codigoEnvio'];
        $controller= new controllerConfirmarEnvio();
        
        echo $controller->modificarEstadoEnvio($idCompra,$codigoEnvio);
    }elseif($param==3 && !empty($_POST['idUser'])){
      
        $idUser =$_POST['idUser'];
        $controller = new controllerConfirmarEnvio();
        echo $controller->listarSubConfirmacion($idUser);
    }elseif($param==4&& !empty($_POST['id'])&& !empty($_POST['codigoEnvio'])) {
        $idCompra= $_POST['id'];
        $codigoEnvio= $_POST['codigoEnvio'];
        $controller= new controllerConfirmarEnvio();
        
        echo $controller->modificarEstadoEnvioSub($idCompra,$codigoEnvio);
    }
}




?>