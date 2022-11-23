<?php 
include_once '../modelo/obra.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/imagen.php';
include_once '../modelo/artista.php';
include_once '../modelo/reportes.php';
include_once '../modelo/compra.php';
include_once '../modelo/subastas.php';
include_once '../modelo/registroPujadores.php';
include_once '../modelo/usuarioRegistrado.php';

class historialCompras{

    public function listarComprasUser($idUsuario){
        $compra = new compra(null, null, null, null, null, null, null, null);
        $listaCompra= $compra->listarCompraIdUser($idUsuario);

        if($listaCompra== false){
            echo '<h6>No se accedio a la lista de compras</h6>';

        }else{
            $size= $listaCompra->size();
            $artista = new artista(null, null, null, null, null);
            $usuario= new usuarioRegistrado();
            $obra = new obra(null, null, null, null, null, null, null, null, null, null);
            $imagen= new imagen(null);
            if($size==0){
                echo '
                <h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
                <button id="subasta" type="button" style= "width:200px; "class="btn btn-warning ">ver Subasta</button> 
                <p>
                <p>
                <h6>El usuario todavia no tiene compras en este momento</h6>';
            }else{
                echo '<h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
                <button id="subasta" type="button" style= "width:200px; "class="btn btn-warning ">ver subastas</button> 
                <div class="contenedorPetcion">
                <div style="width: 100%; height: auto;" class="listaPeticiones">
                ';
                for ($i=0; $i <$size ; $i++) { 
                    $infoArtista= $artista->buscarIdArtista($listaCompra->get($i)->getIdArtista());
                    if ($infoArtista==false) {
                        echo '
                        <h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
                        <button id="subasta" type="button" style= "width:200px; "class="btn btn-primary btn-lg">ver Subasta</button> 
                        <h6>No se  pudo encontrar al artista</h6>';
                    }else{
                        $idUsuarioArtista= $infoArtista->getIdUsuarioRegistrado();
                        $infoUsuario= $usuario->buscarUusuarioId($idUsuarioArtista);
                        if($infoUsuario==false ){
                            echo '
                            <h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
                            <button id="subasta" type="button" style= "width:200px; "class="btn btn-primary btn-lg">ver Subasta</button> 
                            <h6>No se  pudo encontrar el usuario asociado al artista</h6>';
                        }else{ 
    
                            $nombre= $infoUsuario->getNombreYApellido();
                            $infoObra= $obra->buscarObraId($listaCompra->get($i)->getIdObra());
                            if ($infoObra==false) {
                                echo '
                                <h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
                                <button id="subasta" type="button" style= "width:200px; "class="btn btn-primary btn-lg">ver Subasta</button> 
                                <h6>No se  pudo encontrar a la obra asociada</h6>';
                            }else{
                                $coste= $listaCompra->get($i)->getPrecioCompra();
                                $infoImagen= $imagen->buscarImagenID($infoObra->getIdImagen());
                                if($infoImagen==false){
                                    echo '
                                    <h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
                                    <button id="subasta" type="button" style= "width:200px; "class="btn btn-primary btn-lg">ver Subasta</button> 
                                    <h6>No se  pudo encontrar la imagen asociada</h6>';
                                }else{
                                    $estadoEnvio= $listaCompra->get($i)->getEstadoEnvio();
                                    if($estadoEnvio==""){
                                        $estadoEnvio= 'Por confirmar';
                                    }else{
                                        $estadoEnvio= ' cod. seguimiento '.$estadoEnvio;
                                    }
                                    echo'
                                    
                                  
                                            
                                                <div style="text-align:left; width:95% " class="peticion">
                                                    <h5>Obra de: '.$nombre.'</h5>
                                                    
                                                    <H6>Titulo de la Obra: '.$infoObra->getTitulo().'</H6>
                                                    <H6>Estado de la compra:<b>'.$estadoEnvio.'<b/></H6>
                                                    <P>
                                                    <P>
                                                    <label>Fecha de compra: '.$listaCompra->get($i)->getFechaCompra().'</label>
                                                    <P>
                                                    <label>Monto de la compra: '.$coste.'</label>
                                                    <P>
                                                    
                                                    <a style="text-decoration: none; margin-bottom: 5px;" href="verArtista.php?idArtista='.$listaCompra->get($i)->getIdArtista().'">CLICK AQUI PARA VER LA ARTISTA</a>
                                                    <p>
                                                    <a style="text-decoration: none; margin-bottom: 5px;" href="detalleObra.php?id='.$listaCompra->get($i)->getidObra().'">CLICK AQUI PARA VER AL OBRA</a>
                                                    <img style="float:right;width: 120px;; max-width: 120px;height: 120px;max-height: 120px;margin-top:-110px; margin-right:10px" src="'.$infoImagen->getUrlImagen().'" alt="">
                                                </div> <br>'                                                 
                                               
                                           ;
                                }
                                
                            }
                           
                        }
                        
                    }
                }echo ' </div>
                </div> ';
            }
            
        }

    }


    public function mostrarSubastaParticipante($idUsuario){
        $registro = new registroPujadores();
        $registro = $registro->listarRegistroIdUser($idUsuario);
        if ($registro==false) {
            echo '
            <h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
            <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-warning ">ver Compras Obras</button> 
            <br><br>
            <h6>El usuario todavia no tiene subastas en este momento</h6';
        }else{
            
            $largo=$registro->size() ;
            if($largo<=0){
                echo '
                <h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
                <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-warning ">ver Compras Obras</button> 
                <br><br>
                <h6>El usuario todavia no tiene subastas en este momento</h6>';
            }else{
                echo '<h3 style="margin-top: 10px;margin-left: 10px;">Historial de Pujas  subasta</h3>
                <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-warning ">ver obras </button>
                <div class="contenedorPetcion">
                <div style="width: 100%; height: auto;" class="listaPeticiones">';
                for ($i=0; $i <$largo; $i++) { 
                
                    $idSubasta=$registro->get($i)->__getSubasta_idSubasta();
                    $maximoRegistro= new registroPujadores();
                    $maximoRegistro= $maximoRegistro->maximoPujador($registro->get($i)->__getSubasta_idSubasta());
                    if($maximoRegistro==false){
                        echo '
                        <h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
                        <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-primary btn-lg">ver Subasta</button> 
                        <br><br>
                        No se puede ver el maximo pujador de subastas hasta el momento';
                    }else{
                        $subasta= new subasta();
                        $resp=$subasta->buscarSubasta($idSubasta);
                        $idUserMaxPujador= $maximoRegistro->__getIdUser();
                        $usuarioRegistraod= new usuarioRegistrado();
                        $UserMaxPujador =$usuarioRegistraod->buscarUusuarioId($idUserMaxPujador);
                        if($resp==false){
                            echo '
                                <h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
                                <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-primary btn-lg">ver Subasta</button> 
                                <br><br>
                                No hay algun registro de subastas hasta el momento ';
                        }else{
                            $subasta= $resp;
                            $idObra= $subasta->__getIdObra();
                            $obra= new obra(null, null ,null ,null, null, null, null, null, null);
                            $resp= $obra->buscarObraId($idObra);
                            if($resp==false){
                                echo '
                                <h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
                                <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-primary btn-lg">ver Subasta</button> 
                                <br><br>
                                No se obtuvo la obra en este momento';
                            }else{
                                $obra= $resp;
                                $imagen= new imagen(null);
                                $resp= $imagen ->buscarImagenID($obra->getIdImagen());
                                if($resp == false){
                                    echo '
                                    <h3 style="margin-top: 10px;margin-left: 10px;">Historial de Compras</h3>
                                    <button id="comprasobras" type="button" style= "width:200px; "class="btn btn-primary btn-lg">ver Subasta</button> 
                                    <br><br>
                                    No se obtuvo la imagen en este momento';
                                }else{
                                    $imagen= $resp;
                                    $estado= "";
                                    if($idUsuario== $UserMaxPujador->getId()){
                                        $estado= '<b class= "text-success">Eres el pujador maximo </b>';
                                    }else{
                                        $estado= '<b class= "text-warning">Puja nuevamente para ganar la subasta  </b>';
                                    }
                                    $estadoEnvio=null;
                                    if($subasta->__getEstadoEnvio()==""){
                                        $estadoEnvio="Procesando compra";
                                    }else{
                                        $estadoEnvio= "Codigo de seguimiento: ". $subasta->__getEstadoEnvio(); 
                                    }
                                    echo'
                                            
                                           
                                                    
                                                        <div style="text-align:left; width:95% " class="peticion">
                                                            <h5>Estado: '.$estado.'</h5> <p></p>
                                                            <h6>'.$estadoEnvio.'</h6>
                                                            <H6>Titulo de la Obra: '.$obra->getTitulo().'</H6>
                                                            <P>
                                                            <P>
                                                            <label>Fecha de finalizacion: '.$subasta->__getFechaLimite().'</label>
                                                            <P>
                                                            <label>Monto de la puja suya: '.$registro->get($i)->__getValor().'</label>
                                                            
                                                            <p>
                                                            <label>Usuario con la puja Mayor: '.$UserMaxPujador->getNombreYApellido().'</label>
                                                            <p>
                                                            <label>Monto de la puja Mayor: '.$subasta->__getPrecioPuja().'</label>
                                                            <P>
                                                            <a style="text-decoration: none; margin-bottom: 5px;" href="verArtista.php?idArtista='.$subasta->__getIdArtista().'">CLICK AQUI PARA VER LA ARTISTA</a>
                                                            <p>
                                                            <a style="text-decoration: none; margin-bottom: 5px;" href="detalleObra.php?id='.$obra->getidObra().'">CLICK AQUI PARA VER AL OBRA</a>
                                                            <img style="float:right;width: 120px;; max-width: 120px;height: 120px;max-height: 120px;margin-top:-110px; margin-right:10px" src="'.$imagen->getUrlImagen().'" alt="">
                                                        </div> <br>
                                                    ';
                                }
                            }
                        }
                    }
                    
                }
                echo '</div>
                </div>';
            }
            
        }
    }


}

$parametros= $_POST['parametros'];
if($parametros==1){
    $lista= new historialCompras();
    session_start();
    $idUsuario= $_SESSION['online'];
    
    echo $lista->listarComprasUser($idUsuario);
    
}elseif ($parametros== 2) {
    $lista = new historialCompras();
    $idUsuario= $_POST["idUser"];
    echo $lista->mostrarSubastaParticipante($idUsuario);
}
?>


