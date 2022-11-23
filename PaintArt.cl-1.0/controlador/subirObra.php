<?php 
    include_once '../modelo/obra.php';
    include_once '../modelo/imagen.php';
  


    if (isset($_POST['subir'])) {
        //Recogemos el archivo enviado por el formulario
        $archivo = $_FILES['imagenObra']['name'];
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
             if (move_uploaded_file($temp, '../Vista/imagenesObra/'.$archivo)) {
                 //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                 //chmod('./Vista/imagenesObra/'.$archivo, 0777);
                 //Mostramos el mensaje de que se ha subido co éxito
                 //echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                 //Mostramos la imagen subida
                // echo '<p><img src="../Vista/imagenesObra/'.$archivo.'"></p>';
                 $urlImagen= 'imagenesObra/'.$archivo;
                 $img= new imagen($urlImagen);
                 
                 $respImg=$img->subirImagen($img);
                 if($respImg!=1){
                    echo 'Oopss problemas al subir su imagen';
                 }else{
                    $titulo= $_POST['titulo'];
                    $categoria= $_POST['categoria'];
                    $detalles= $_POST['detalles'];
                    $tecnica= $_POST['tecnica'];
                    $altura= $_POST['altura'];
                    $ancho= $_POST['ancho'];
                    $precio= $_POST['precio'];
                    $sobreObra=$_POST['sobreObra'];
                    $dimensiones=$altura.'X'.$ancho;
                    $idImagen= $img->buscarImagen($img);
                     $ob =new obra(null,$categoria,$detalles,$dimensiones,$precio, $sobreObra,$tecnica,$titulo,$idImagen->getIdImagen());
                    if($ob->subirObra($ob)==1){
                        header('Location: ../Vista/index.php');
                                                
                    }else{
                        echo 'oops problemas al subir su imagen';
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