<?php
include_once '../modelo/obra.php';
include_once '../modelo/compra.php';
include_once '../modelo/subastas.php';
include_once '../modelo/peticion.php';
include_once '../modelo/artista.php';
include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/click.php';
include_once '../modelo/critica.php';
class controllerVentas{
    function mostrarMayorComentado($idUser){
        $artista= new artista(null, null, null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            echo "ERROR al buscar al artista";
        }else{
            $critica= new critica(null , null, null, null, null);
            $critica= $critica->buscarElMasComentado($artista->getIdArtista());
            if($critica==false){
                return 0;
            }else{
                return $critica->getIdObra();
            }
        }
    }

    function mostrarCantidadDevisitasPerfilEsteMes($idUser){
        $artista= new artista(null, null, null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            echo "ERROR al buscar al artista";
        }else{
            $click = new click();
            $resp =$click->cantidadClickArtista($artista->getIdArtista());
            if($resp==false){
                return 0;
            }else{
                return $resp;

            }
        }
    }
    function mostrarCantidadDevisitasObrasEsteMes($idUser){
        $artista= new artista(null, null, null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            echo "ERROR al buscar al artista";
        }else{
            $click = new click();
            $resp =$click->cantidadClickObra($artista->getIdArtista());
            echo $resp;
        }
    }

    function mostrarObraMasVisitada($idUser){
        $artista= new artista(null, null, null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            return 0;
        }else{
            $click = new click();
            $resp =$click->obraMasVisitada($artista->getIdArtista());
            
            return $resp;
        }
    }

    function mostrarVentasObras($idUser){
        $artista= new artista(null, null, null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            echo "ERROR al buscar al artista";
        }else{
            $ventas= new compra(null,null, null, null, null, null, null,null);
            $lista= $ventas->listarVentasIdArtista($artista->getIdArtista());
            if ($lista==false) {
                echo "ERROR al buscar las ventas del artista";
            }else{
                $largo= $lista->size();
                $acumuladorObra=0;
                for ($i=0; $i < $largo; $i++) { 
                    
                        $acumuladorObra=$lista->get($i)->getPrecioCompra()+$acumuladorObra;
                    
                }
                return $acumuladorObra;
            }
            
        }

    }

    function mostrarVentasObrasUltimosSeisMeses($idUser){
        $artista= new artista(null, null, null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            echo 'Error al buscar al artista';
        }else{
            $venta= new compra(null ,null ,null, null, null, null ,null,null);
            $venta= $venta->montoVentasUltimosSeisMese($artista->getIdArtista());
            if($venta==false){
                return 0;
                //echo 'Error al buscar las ventas totales';
            }else{
                return $venta;
            }
        }
    }

    function mostrarVentasPeticiones($idUser){
        $artista= new artista(null, null, null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            echo "ERROR al buscar al artista";
        }else{
            $peticion= new peticion(null, null, null,null, null, null, null,null,null);
            $lista= $peticion->listarPeticionesEnviadas($artista->getIdArtista());
            if($lista==false){
                echo "ERROR al buscar las peticiones del artista";
            }else{
                $largo= $lista->size();
                $acumuladorPet=0;
                for ($i=0; $i <$largo ; $i++) { 
                    $acumuladorPet= $acumuladorPet+$lista->get($i)->getPrecio();
                }
                return $acumuladorPet;
            
            }
            
        }

    }
    function mostrarVentasPeticionUltimoSeisMeses($idUser){
        $artista= new artista(null, null, null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            echo "ERROR al buscar al artista";
        }else{
            $peticion= new peticion(null, null, null,null, null, null, null,null,null);
            $peticion= $peticion->peticionesEnviadaUltimosSeisMeses($artista->getIdArtista());
            if($peticion==false){
                echo "ERROR al buscar las peticiones del artista";
            }else{
                return $peticion;
            }
            
        }
    }

    function mostraVentasSubasta($idUser){
        $artista= new artista(null,null,null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            echo "Error al buscar al artista";
        }else{
            $subasta= new subasta();
            $lista= $subasta->listarSubastaIdArtista($artista->getIdArtista()); 
            if ($lista==false) {
                return 0;
                //echo "Error al cargar las listas con la id de los artistas";
            }else{
                $largo= $lista->size();
                $acumuladorSub= 0 ;
                for ($i=0; $i < $largo; $i++) { 
                    $acumuladorSub= $acumuladorSub+ $lista->get($i)->__getPrecioPuja();
                }
                return $acumuladorSub;
            }
        }
    }

    function mostrarVentasSubasUltimosSeisMeses($idUser){
        $artista= new artista(null,null,null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            echo "Error al buscar al artista";
        }else{
            $subasta= new subasta();
            $subasta= $subasta->subastasUltimosSeisMeses($artista->getIdArtista()); 
            if ($subasta==false) {
                return 0;
                //echo "Error al cargar las listas con la id de los artistas";
            }else{
                return $subasta;
            }
        }
    }
    


    function mostrarVentasMesGeneral($idUser){
        $control = new controllerVentas();
        $ventasObras= $control->mostrarVentasObras( $idUser);
        $vetnasPeticiones=  $control->mostrarVentasPeticiones( $idUser);
        $venSubastas= $control->mostraVentasSubasta($idUser);
        $total = $ventasObras+$vetnasPeticiones+$venSubastas;
        echo "
        <h4> Monto total de ventas : $".$total."</h4>
        <h5>Montos de ventas por peticion: $".$vetnasPeticiones. "</h5>
        <h5>Cantidad de ventas por subastas: $".$venSubastas."</h5>
        <h5>cantidad de ventas por obras: $".$ventasObras."</h5>
        
        ";
    }

    function mostrarVentasGeneralUltimosSeisMeses($idUser){
        $control = new controllerVentas();
        $ventaObras= $control->mostrarVentasObrasUltimosSeisMeses($idUser);
        $vetnasPeticiones= $control->mostrarVentasPeticionUltimoSeisMeses($idUser);
        $venSubastas= $control->mostrarVentasSubasUltimosSeisMeses($idUser);
        $total = $ventaObras+$vetnasPeticiones+$venSubastas;
        echo "
        <h4> Monto total de ventas : $".$total."</h4>
        <h5>Montos de ventas por peticion: $".$vetnasPeticiones. "</h5>
        <h5>Cantidad de ventas por subastas: $".$venSubastas."</h5>
        <h5>cantidad de ventas por obras: $".$ventaObras."</h5>
        ";
    }

   function mostrarTipoIngresosUltimosSeisMeses($idUser){
        $control = new controllerVentas();
        $ventaObras= $control->mostrarVentasObrasUltimosSeisMeses($idUser);
        $vetnasPeticiones= $control->mostrarVentasPeticionUltimoSeisMeses($idUser);
        $venSubastas= $control->mostrarVentasSubasUltimosSeisMeses($idUser);
        
        $arr=  array(
            array("label"=>"Ventas de obras", "y"=> $ventaObras),
            array("label"=>"Peticiones", "y"=> $vetnasPeticiones),
            array("label"=>"Subastas", "y"=> $venSubastas),
        );
       
        return $arr;

   }


    function ordenarCat($idUser){
        $artista= new artista(null, null, null);
        $artista= $artista->buscarArtistaIdUser($idUser);
        if($artista==false){
            echo "ERROR al buscar al artista";
        }else{
            $ventas= new compra(null,null, null, null, null, null, null, null);
            $lista= $ventas->listarVentasIdArtista($artista->getIdArtista());
            if ($lista==false) {
                echo "ERROR al buscar las ventas del artista";
            }else{
                $largo= $lista->size();
                $acumUrban=0;$acumOptic=0;$acumCinet=0;$acumSurrea=0;$acumNeop=0;$acumDadaismo=0;$acumSuprema=0;$acumSuprema=0;$acumContru=0; $acumMinima=0; $acumRayonism=0; $acumAbstr=0; $acumLiric=0;$acumExp=0;
                
                for ($i=0; $i < $largo; $i++) { 
                    $obra= new obra(NULL, null, null, null, null, null, null,null,null);
                    $obra= $obra->buscarObraId($lista->get($i)->getIdObra());
                    if($obra==false){
                        echo "error al buscar la obra asociada a la venta";
                    }else{
                        switch ($obra->getCategoria()) {
                            case 'Arte urbano':
                                $acumUrban= $acumUrban+$obra->getPrecio();
                               
                                break;
                            case 'Arte optico':
                                $acumOptic =  $acumOptic+$obra->getPrecio();
                                
                                break;    
                            case 'Arte cinetico':
                                $acumCinet =   $acumCinet+$obra->getPrecio();
                             
                                break;
                            case 'Surrealismo':
                                $acumSurrea= $acumSurrea+$obra->getPrecio();
                               
                                break;    
                            case 'Neoplasticismo':
                                $acumNeop= $acumNeop+$obra->getPrecio();
                               
                                break; 
                            case 'Dadaismo ':
                                $acumDadaismo= $acumDadaismo+ $obra->getPrecio();
                                
                                break;  
                            case 'Suprematismo':
                                $acumSuprema=$acumSuprema+$obra->getPrecio();
                               
                                break;   
                            case 'Contructivismo':
                                $acumContru= $acumContru+ $obra->getPrecio();
                               
                                break;
                            case 'Minimalismo':
                                $acumMinima= $acumMinima+$obra->getPrecio();
                               
                                break;  
                            case 'Rayonismo':
                                $acumRayonism=  $acumRayonism+$obra->getPrecio();
                                
                                break;  
                            case 'Abstraccion lirica':
                                $acumAbstr= $acumAbstr+ $obra->getPrecio();
                               
                                break;    
                            case 'Expresionismo':
                                $acumExp=  $acumExp+ $obra->getPrecio();
                               
                                break;    
                            
                        }
                    }
                }
                $arr= array();
                if ($acumUrban>0) {
                    array_push($arr, array("label"=>"Arte urbano", "y"=> $acumUrban));
                }
                if ($acumOptic>0) {
                    array_push($arr, array("label"=>"Arte optico", "y"=> $acumOptic));
                }
                if ($acumSurrea>0) {
                    array_push($arr, array("label"=>"Surrealismo" , "y"=>$acumSurrea));
                }
                if ($acumNeop>0) {
                    array_push($arr,array("label"=>"Neoplasticismo", "y"=>$acumNeop));
                }

                if ($acumCinet>0) {
                    array_push($arr, array("label"=>"Arte cinetico","y"=>$acumCinet));
                }
                if ($acumNeop>0) {
                    array_push($arr, array("label"=>"Neoplasticismo", "y"=>$acumNeop));
                }
                if ($acumDadaismo>0) {
                    array_push($arr,  array("label"=>"Dadaismo", "y"=> $acumDadaismo));
                }
                if ($acumDadaismo>0) {
                    array_push($arr, array("label"=>"Supremastismo","y"=> $acumDadaismo));
                }
                if ($acumContru>0) {
                    array_push($arr,  array("Contructivismo","y"=> $acumContru));
                }
                if ($acumMinima>0) {
                    array_push($arr, array("label"=>"Minimalismo", "y"=> $acumMinima));
                }
                if ($acumRayonism>0) {
                    array_push($arr,array("label"=>"Rayonismo","y"=> $acumRayonism) );
                }
                if($acumAbstr>0){
                    array_push($arr, array("label"=>"Abstraccion lirica","y"=>$acumAbstr));
                }
                if($acumExp>0){
                    array_push($arr, array("label"=>"Expresionismo","y"=>$acumExp));
                }

                return $arr;
            }
            
        }

    }

    public function visitasPorMesArtista($idUser){
        $artista = new artista(null ,null, null, null);
        $resp= $artista->buscarArtistaIdUser($idUser);
        if($resp==false){
            echo 'No se ha encontrado al artista';
        }else{
            $idArtista= $resp->getIdArtista();
            $click= new click();
            $resp= $click->cantidadClickUltimosMesesArtista($idArtista);
            if($resp==false){
                echo '<h6> sin visitas hasta el momentos </h6>';
            }else{
                $largo= $resp->size();
                $arr=  array();
                if($largo>0){
                    for ($i=0; $i <$largo ; $i++) { 
                        array_push($arr, array('label'=>$resp->get($i)->__getFecha(), 'y'=>$resp->get($i)->__getIdClick()));
                    }
                    return $arr;
                }else{
                    return 0;
                }
                

            }
        }
    }
    public function visitasPorMesObras($idUser){
        $artista = new artista(null ,null, null, null);
        $resp= $artista->buscarArtistaIdUser($idUser);
        if($resp==false){
            echo 'No se ha encontrado al artista';
        }else{
            $idArtista= $resp->getIdArtista();
            $click= new click();
            $resp= $click->cantidadClickUltimosMesesObra($idArtista);
            if($resp==false){
                echo '<h6> sin visitas hasta el momentos </h6>';
            }else{
                $largo= $resp->size();
                $arr=  array();
                if($largo>0){
                    for ($i=0; $i <$largo ; $i++) { 
                        array_push($arr, array('label'=>$resp->get($i)->__getFecha(), 'y'=>$resp->get($i)->__getIdClick()));
                    }
                    return $arr;
                }else{
                    return 0;
                }
                
                

            }
        }
    }

    public function ventasUltimosSeisMeses($idUser){
        $artista = new artista(null ,null, null, null);
        $resp=$artista->buscarArtistaIdUser($idUser);
        if($resp==false){
            echo 'No se ha encontrado al artista';
        }else{
            $idArtista= $resp->getIdArtista();
            $compra= new compra(null,null, null, null, null, null, null, null);
            $resp= $compra->listarVentasObrasSeisMeses($idArtista);
            if($resp==false){
                 echo '<h6> sin compras hasta el momentos </h6>';
            }else{
                $arr= array();
                $largo= $resp->size();
                for ($i=0; $i < $largo; $i++) { 
                    array_push($arr, array('label'=>$resp->get($i)->getFechaCompra(), 'y'=>$resp->get($i)->getIdCompra()));

                }
                return $arr;

            }
        }
    }
    public function peticionesUltimosSeisMeses($idUser){
        $artista = new artista(null ,null, null, null);
        $resp=$artista->buscarArtistaIdUser($idUser);
        if($resp==false){
            echo 'No se ha encontrado al artista';
        }else{
            $idArtista= $resp->getIdArtista();
            $pet= new peticion(null,null, null, null, null, null, null, null,null);
            $resp= $pet->detallepeticionesEnviadaUltimosSeisMeses($idArtista);
            if($resp==false){
                 echo '<h6> sin compras hasta el momentos </h6>';
            }else{
                $arr= array();
                $largo= $resp->size();
                for ($i=0; $i < $largo; $i++) { 
                    array_push($arr, array('label'=>$resp->get($i)->getFecha(), 'y'=>$resp->get($i)->getPrecio()));

                }
                return $arr;

            }
        }
    }
    public function subUltimosSeisMeses($idUser){
        $artista = new artista(null ,null, null, null);
        $resp=$artista->buscarArtistaIdUser($idUser);
        if($resp==false){
            echo 'No se ha encontrado al artista';
        }else{
            $idArtista= $resp->getIdArtista();
            $pet= new subasta();
            $resp= $pet->detalleSubastasUltimosSeisMeses($idArtista);
            if($resp==false){
                 echo '<h6> sin compras hasta el momentos </h6>';
            }else{
                $arr= array();
                $largo= $resp->size();
                for ($i=0; $i < $largo; $i++) { 
                    array_push($arr, array('label'=>$resp->get($i)->__getFechaLimite(), 'y'=>$resp->get($i)->__getPrecioPuja()));

                }
                return $arr;

            }
        }
    }
    


    


}

   





?>