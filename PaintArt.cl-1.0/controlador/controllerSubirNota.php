<?php session_start();
 include_once '../modelo/notaInformativa.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/usuarioRegistrado.php';

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
         $_SESSION['informacion']= ' Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.';
         header('Location: controllerAccesadorUsuarios.php');
      }
      else {
         //Si la imagen es correcta en tamaño y tipo
         
           //Se intenta subir al servidor
           if (move_uploaded_file($temp, '../Vista/imagenesNota/'.$newNameFoto.$archivo)) {
              //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
              //chmod('./Vista/imagenesObra/'.$archivo, 0777);
              //Mostramos el mensaje de que se ha subido co éxito
              //echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
              //Mostramos la imagen subida
           // echo '<p><img src="../Vista/imagenesObra/'.$archivo.'"></p>';
              $urlImagen= 'imagenesNota/'.$newNameFoto.$archivo;
              $img= new imagen($urlImagen);
              
              $respImg=$img->subirImagen($img);
              if($respImg!=1){
                 echo 'Oopss problemas al subir su imagen';
              }else{
                 $idUsuarioRegistrado= $_SESSION['online'];
                 $user= new usuarioRegistrado ();
                 $respUser= $user->buscarUusuarioId($idUsuarioRegistrado);
                 if($respUser==false){
                    header('Location: ../Vista/iniciarSesion.php');
                   
                 }else{
                    $permiso= $respUser->getPermisos();
                    if ($permiso<3 ||$permiso >4){
                        echo 'No debieras estar aca jeje';
                    }else{
                       
                       $idnota= null;
                       $titular= $_POST["titular"];
                       $cuerpo= $_POST["cuerpo"];
                       $epigrafe= $_POST["epigrafe"];
                       $idImagen= $img->ulltimaIdImagen();
                        $nota =new notaInformativa($idnota,$titular,$cuerpo,$epigrafe, $respUser->getId(), $idImagen->getIdImagen());
                        $nota->setidUsuarioRegistrado($idUsuarioRegistrado);
                        $resp=$nota->crearNota($nota);
                       if($resp==true){
                          header('Location: ../Vista/perfilAdmin.php');
                                                  
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