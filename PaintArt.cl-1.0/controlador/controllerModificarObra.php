<?php 
    session_start();
    include_once '../modelo/obra.php';
    include_once '../modelo/imagen.php';

class controllerModificarObra{
    public function insertarValues($idObra){
        $obra= new obra(null ,null ,null, null, null, null, null, null, null, null);
        $resp = $obra->buscarObraId($idObra);
        if($resp==false){
            echo 0;
        }else{
            $dimension= $resp->getDimensiones();
            $separador= "X";
            $separadara= explode($separador, $dimension);
            $altura= $separadara[0];
            $ancho= $separadara[1];
            
            $arr= array();
            $arr["titulo"]=$resp->getTitulo(); 
            $arr["categoria"]=$resp->getCategoria(); 
            $arr["detalles"]=$resp->getDetalles(); 
            $arr["tecnica"]=$resp->getTecnica();
            $arr[ "altura"]= $altura; 
            $arr["ancho"]=$ancho; 
            $arr["precio"]=$resp->getPrecio();
            $arr[ "stock"]=$resp->getStock();
            $arr[ "sobreObra"]=$resp->getSobreObra();
            echo json_encode($arr);
        }

    }
    public function modificarObra($idObra){
        $obra =new obra($idObra,$_POST['categoria'], $_POST['detalles'], $_POST['altura'].'X'.$_POST['ancho'],$_POST['precio'],$_POST["sobreObra"], $_POST['tecnica'],$_POST['titulo'],null);
        $resp=  $obra->modficarObra($obra);
        if ($resp==false) {
            $_SESSION["informacion"]= 'algo salio mal';
        }else{
           
            if ($_FILES['imagenObra']['name']==null||$_FILES['imagenObra']['name']=="") {
                $_SESSION["informacion"]= "se guardo los cambios";
                header('location: ../Vista/perfilArtista.php');
            }else{
                 $img= new imagen(null);
                 $respObra= $obra->buscarObraId($idObra);
                 if($resp==false){
                    $_SESSION["informacion"]= 'No se encontro la imagen';
                 }else{
                    $idimagen =$respObra->getIdImagen();
                    $respImg= $img->buscarImagenID($idimagen);
                    if($respImg==false){
                        $_SESSION["informacion"]= 'No se encontro la imagen';

                    }else{
                        $urlEliminar= '../Vista/'.$respImg->getUrlImagen();
                        //Recogemos el archivo enviado por el formulario
                        $archivo = $_FILES['imagenObra']['name'];
                        //conseguimos la fecha y hora
                        date_default_timezone_set("America/Santiago");
                        setlocale(LC_ALL, "es_ES");
                        //tratar de crear un String aleatorio
                        $logitudPass=10;
                        $newNameFoto= substr(md5(microtime()), 1, $logitudPass);
                        //Si el archivo contiene algo y es diferente de vacio
                        if (isset($archivo) && $archivo != "") {
                        //Obtenemos algunos datos necesarios sobre el archivo
                        $tipo = $_FILES['imagenObra']['type'];
                        $tamano = $_FILES['imagenObra']['size'];
                        $temp = $_FILES['imagenObra']['tmp_name'];
                        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000000))) {
                            /*echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                            - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';*/
                        $_SESSION["informacion"]= "Error. La extensión o el tamaño de los archivos no es correcta, Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.";
                                header('Location: ../Vista/Index.php');

                        }
                        else {
                            //Si la imagen es correcta en tamaño y tipo
                            
                            //Se intenta subir al servidor
                            if (move_uploaded_file($temp, '../Vista/imagenesObra/'.$newNameFoto.$archivo)) {
                                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                                //chmod('./Vista/imagenesObra/'.$archivo, 0777);
                                //Mostramos el mensaje de que se ha subido co éxito
                                //echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                //Mostramos la imagen subida
                            // echo '<p><img src="../Vista/imagenesObra/'.$archivo.'"></p>';
                                $urlImagen= 'imagenesObra/'.$newNameFoto.$archivo;
                                $img= new imagen($urlImagen);
                                $img->setIdImagen($idimagen);
                                $cambio= $img->cambiarUrl($img);
                                if($cambio==false){
                                    $_SESSION["informacion"]='error en cambiar la imagen';
                                }else{
                                    $outPut= unlink($urlEliminar);
                                    $_SESSION["informacion"]= "se guardo los cambios";
                                    header('location: ../Vista/perfilArtista.php');
                                }
                            }
                    }}}
                    }
                 }
                
        }

    }

}

if(empty($_POST['parametros'])){
    header('location: ../Vista/iniciarSesion.php');
}else{
    $parametros= $_POST['parametros'];
   
    if($parametros==1){
       
        if(empty($_POST['id'])||empty($_POST['iduser']))
        {
            header('location: ../Vista/iniciarSesion.php');
        }else{
            $controller= new controllerModificarObra;
           $idObra= $_POST["id"];
            echo $controller->insertarValues($idObra);
        }
    }elseif ($parametros==2) {
       $idObra= $_POST['idobra'];
       $controller= new controllerModificarObra;
       $controller->modificarObra($idObra);
    }

}



?>