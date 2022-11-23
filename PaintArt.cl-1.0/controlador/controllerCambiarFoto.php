<?php
include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/imagen.php';

session_start();
$idUsuario= $_SESSION['online'];

if (isset($_POST['subir'])) {
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['imagenUser']['name'];
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
       $tipo = $_FILES['imagenUser']['type'];
       $tamano = $_FILES['imagenUser']['size'];
       $temp = $_FILES['imagenUser']['tmp_name'];
       //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000000))) {
            echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
            - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
        }
        else {
         //Si la imagen es correcta en tamaño y tipo
         
           //Se intenta subir al servidor
           if (move_uploaded_file($temp, '../Vista/imagenesUser/'.$newNameFoto.$archivo)) {
              //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
              //chmod('./Vista/imagenesObra/'.$archivo, 0777);
              //Mostramos el mensaje de que se ha subido co éxito
              //echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
              //Mostramos la imagen subida
              // echo '<p><img src="../Vista/imagenesObra/'.$archivo.'"></p>';
              $urlImagen= 'imagenesUser/'.$newNameFoto.$archivo;
              $img= new imagen($urlImagen);
              $user= new usuarioRegistrado ();
              $respUser= $user->buscarUusuarioId($idUsuario);
              if($respUser==false)
              {
                echo 'no encontramos al usuario';
              }else{
                $img->setIdImagen($respUser->getIdImagen());
                $respImg=$img->cambiarUrl($img);
                if($respImg!=1){
                   echo 'Oopss problemas al subir su imagen';
                }else{
                   header('Location: controllerAccesadorUsuarios.php');
                  
                }
              }
             
            } 
        }
    }

}    

?>