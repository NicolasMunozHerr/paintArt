<?php session_start();
include_once '../modelo/obra.php';
include_once '../modelo/critica.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/usuarioRegistrado.php';

$parametros = $_POST['parametros'];

$idObra= $_SESSION['idCompra'];
class controllerCritica{

    public function listarCritica($idObra){
        $criticas= new critica(null, null, null, null, null);
        $lista=$criticas->listarCritica($idObra);
        if($lista==false){
            echo "<p><h6> Todavia no hay comentario, Se el primero en comentar!!!</h6>
            <br>";
        }else{
            $size= $lista->size();
            if($size==0){
                echo "<p><h6> Todavia no hay comentario, Se el primero en comentar!!!</h6>
                <br>";
            }else{
                for ($i=0; $i < $size; $i++) { 
                    $usuarioRegistrado= new usuarioRegistrado();
                    $idUser =$lista->get($i)->getIdUsuarioRegistrado();
                    $nombreyapellido= $usuarioRegistrado->buscarUusuarioId($idUser);
                    $putuacion=$lista->get($i)->getValoracion();
                    $estrellitas="a";
                    switch ($putuacion) {
                        case 1:
                            $estrellitas='★';
                            break;
                        case 2:
                            $estrellitas='★★';
                            break;
                        case 3:
                            $estrellitas='★★★';  
                            break;
                        case 4:
                            $estrellitas='★★★★';
                            break;
                        case 5:
                            $estrellitas='★★★★★';  
                            break;      
                        default:
                            
                            break;
                    }
                    if ($nombreyapellido==false) {
                        echo "<h6> Hemos tenido problemas para encontrar comentarios </h6>";
                    }else{
                        echo '
                        <div class="itemComentario">
                            <b>'.$nombreyapellido->getNombreYApellido().'</b>
                            <p>'.$lista->get($i)->getCritica().'</p>
                            <div id="estrellas" class="valoracion">'.$estrellitas.'</div>
                            <div class="reportar"> <a style="text-decoration: none;color: black;" href="subirReporteUsuario.php?idUserReporte='.$idUser.'&idReporte='.$lista->get($i)->getIdCritica().'"><b>REPORTAR</b> </a></div>
                        </div>
                        ';    
                    }   
                }
            }
        }
        
    }

    public function criticar($idObra,$critica, $estrellitas, $idUsuarioRegistrdo){
        $user= new usuarioRegistrado();
        $resp= $user->buscarUusuarioId($idUsuarioRegistrdo);
        if($resp==false){
            echo 'upsss algo salio mal comprobando al usuario';
        }else{
            if($resp->getPermisos()=='5'){
                echo 'Usted no tiene permitido criticar por malas conductas en el sitio';
            }else{
                $critica= new critica(null, $estrellitas, $critica, $idObra, $idUsuarioRegistrdo);
                $resp= $critica->insertarCritica($critica);
                
                if($resp==false){
                    echo 'ups, algo salio mal al intentar comentar';
                }else{
                    echo 'Se ha registrado con exito su critica';
                }
                
                
            }
        }
       


    }


}

if($parametros==1){
    $controller= new controllerCritica();
    echo $controller->listarCritica($idObra);
}elseif($parametros==2){
   
    $criticas= $_POST['critica'];
    $estrella= $_POST['estrella'];
    $estrellitas=5;
    switch ($estrella) {
        case '★':
            $estrellitas=1;
            break;
        case '★★':
            $estrellitas=2;
            break;
        case '★★★':
            $estrellitas=3;  
            break;
        case '★★★★':
            $estrellitas=4;
            break;
        case '★★★★★':
            $estrellitas=5;  
            break;      
        default:
            # code...
            break;
    }
    if(empty($_SESSION["online"]))
    {
       echo 'No puede opinar, inicie sesion primeramente';
    }else{
         $idUsuarioRegistrdo= $_SESSION["online"];
        $controller= new controllerCritica();
     
        $idObra= $_SESSION['idCompra'];
        echo $controller->criticar($idObra, $criticas,$estrellitas, $idUsuarioRegistrdo );
    }
   

}



?>

