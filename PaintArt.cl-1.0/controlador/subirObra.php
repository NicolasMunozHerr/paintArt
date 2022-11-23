<?php 
    include_once '../modelo/obra.php';
    include_once '../modelo/imagen.php';
    include_once '../modelo/usuarioRegistrado.php';
    include_once '../modelo/artista.php';
  
    if (isset($_POST['subir'])) {
        //Recogemos el archivo enviado por el formulario
        $archivo = $_FILES['imagenObra']['name'];
        //conseguimos la fecha y hora
        date_default_timezone_set("America/Santiago");
        setlocale(LC_ALL, "es_ES");
        $fecha_imagen= date("d/m/Y h:i A");
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
             echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
             - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
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
                  
                  $respImg=$img->subirImagen($img);
                  if($respImg!=1){
                     echo 'Oopss problemas al subir su imagen';
                  }else{
                     session_start();
                     $idUsuarioRegistrado= $_SESSION['online'];
                     $user= new usuarioRegistrado ();
                     $respUser= $user->buscarUusuarioId($idUsuarioRegistrado);
                     if($respUser==false){

                        echo 'Upsss, no encontramos al usuario';
                     }else{
                        $permiso= $respUser->getPermisos();
                        if ($permiso==1){
                           $resCambio= $user->cambiarPermiso(2, $idUsuarioRegistrado);
                           $artista= new artista(null, "" ,$idUsuarioRegistrado );
                           $artista->crearArtista($artista);
                        }
                        $artista= new artista(null, null, null);
                        $artista= $artista->buscarArtistaIdUser($idUsuarioRegistrado);
                        if($artista== false){
                           echo 'No se encontro al artista';
                        }else{
                           $idArtista= $artista->getIdArtista();
                           $titulo= $_POST['titulo'];
                           $categoria= $_POST['categoria'];
                           $detalles= $_POST['detalles'];
                           $tecnica= $_POST['tecnica'];
                           $altura= $_POST['altura'];
                           $ancho= $_POST['ancho'];
                           $precio= $_POST['precio'];
                           $sobreObra=$_POST['sobreObra'];
                           $dimensiones=$altura.'X'.$ancho;
                           $stock= $_POST['stock'];
                           $idImagen= $img->ulltimaIdImagen();
                            $ob =new obra(null,$categoria,$detalles,$dimensiones,$precio, $sobreObra,$tecnica,$titulo,$idImagen->getIdImagen());
                           $ob->setStock($stock);
                           $ob->setIdArtista($idArtista);
                           if($ob->subirObra($ob)==true){
                              header('Location: ../Vista/perfilArtista.php');
                                                      
                           }else{
                              echo 'oops problemas al subir su imagen';
                           }

                        }
                        
                     }


                     
                  
                  }
                  
            }
            else {
               //Si no se ha podido subir la imagen, mostramos un mensaje de error
               echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
            }
             

             
           }
        }
     }



?>