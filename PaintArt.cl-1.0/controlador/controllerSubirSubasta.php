<?php 
session_start();
include_once "../modelo/subastas.php";
//declarar zona horaria en php
date_default_timezone_set("America/Santiago");
//tomamos la variable del formulario
$horas= $_POST['txtDuracion'];

//Mostramos las horas seleccionadas
//echo $horas.'<br>';
 
//Jugammos con los formatos
$diaA= date('d');
$mesA= date('m');
$añoA=date('y');

$horaA=date('H');
$minutosA=date('i');
$segundosA=date('s');
$amPmA=date('a');



$fechaActual= $diaA.'-'.$mesA.'-'.$añoA.'  '.$horaA.':'.$minutosA.':'.$segundosA.' '.$amPmA;
$fechaDespues= strtotime('+'.$horas.' hours');


/*echo $fechaActual.'<br>';
echo 'El formato utilizable';
echo date(' M d Y H:i:s ',$fechaDespues);

echo '<br> el formato para mysql';
echo (date('d-m-Y H:i:s', $fechaDespues));*/




include_once '../modelo/obra.php';
include_once '../modelo/imagen.php';
include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/artista.php';
$idUsuarioRegistrado= $_SESSION['online'];
$user= new usuarioRegistrado ();
$respUser= $user->buscarUusuarioId($idUsuarioRegistrado);
if($respUser==false){
    header('Location: ../Vista/Index.php');
}else{
    $per= $respUser->getPermisos();
    if($per==5){
        $_SESSION['informacion']="No puede subir la obra por que inclumpio las normas de la comunidad";
        header('Location: ../Vista/Index.php');
    }else{
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
                        
                        $respImg=$img->subirImagen($img);
                        if($respImg!=1){
                            echo 'Oopss problemas al subir su imagen';
                        }else{                  
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
                                echo 'bien';
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
                                    $precio= $_POST['precioInicial'];
                                    $sobreObra=$_POST['sobreObra'];
                                   
                                    $dimensiones=$altura.'X'.$ancho;
                                    $stock= 1;
                                    $idImagen= $img->ulltimaIdImagen();
                                        $ob =new obra(null,$categoria,$detalles,$dimensiones,$precio, $sobreObra,$tecnica,$titulo,$idImagen->getIdImagen());
                                        $ob->setReacciones(2);
                                    $ob->setStock($stock);
                                    $ob->setIdArtista($idArtista);
                                    $resp= $ob->subirObra($ob);
                                    if($resp==true){
                                        $ob= $ob->buscarUltimaObra();
                                        if($ob==true){
                                            $subasta= new Subasta();
                                            $fechaDespues= strtotime('+'.$horas.' hours');
                                            $subasta->__setFechaLimite(date('Y-m-d H:i:s', $fechaDespues));
                                            $subasta->__setPrecioPuja($precio);
                                            $subasta->__setIdObra($ob->getIdObra());
                                            $subasta->__setIdArtista($ob->getIdArtista());
                                            $subasta->__setPrecioMinimo($precio);
                                             $subasta->mostrarSubasta();
                                            $resp=$subasta->agregarSubasta($subasta);
                                            
                                            //echo $resp;
                                            if($resp==true){
                                                header('Location: ../controlador/controllerAccesadorUsuarios.php');
                                                
                                            }else{
                                                echo 'Algo salio mal en la insercion de datos';
                                            }
                                        }
                                        
        
                                    }else{
                                       echo 'hola';
                                      
                                    }
                                }   
                            }
                        }
                    
                    }else {
                        //Si no se ha podido subir la imagen, mostramos un mensaje de error
                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                    } 
                }
            }
        }else{
            echo 'Oppps problemas al tomar valores en el formulario';
        }
    }
}
?>