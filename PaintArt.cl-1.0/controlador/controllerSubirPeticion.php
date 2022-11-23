<?php 
 include_once '../modelo/peticion.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/direccion.php';
 include_once '../modelo/arraylist.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/artista.php';
 include_once '../modelo/usuarioRegistrado.php';
$Asunto= $_POST['Asunto'];
$descripcion= $_POST['descripcion'];
$precio= $_POST['precio'];
$region= $_POST['region'];
$ciudad= $_POST['Ciudad'];
$comuna= $_POST['comuna'];
$calle= $_POST['calle'];
$numeracion= $_POST['numeracion'];
$tipoHogar= $_POST['tipoHogar'];
session_start();
if(empty($_SESSION['online'])){
    header("Location: ../Vista/iniciarSesion.php");
}else{
    $idUser= $_SESSION["online"];
    $user= new usuarioRegistrado();
    $user= $user->buscarUusuarioId($idUser);
    if($user==false)
    {
        header("Location: ../Vista/iniciarSesion.php");

    }else{
        if($user->getPermisos()==5){
            $_SESSION['informacion']="No puede acceder a su perfil por incumplir normas comunitarias, muchas gracias";
            header("Location: ../Vista/index.php");
        }else{
            $idArtista= $_SESSION['idArtista'];
            $idUsuario= $_SESSION['online'];
            date_default_timezone_set("America/Santiago");
            $fecha= date("Y-m-d");
            $direccion =new direccion(null, $region, $ciudad,$comuna, $calle, $tipoHogar, $numeracion);
            $resp=$direccion->crearDireccion($direccion);

            if ($resp==false) {
                echo 'Upsss, salio mal';
            }else{

                $infoDireccion= $direccion->ultimaDireccion();
                $peticion =new peticion (null,$Asunto, $descripcion, 0, $fecha, $precio, $idUsuario,$idArtista,$infoDireccion->getIdDireccion());
                $resp= $peticion->subirPeticion($peticion);
            
                
                if($resp==false){

                    echo 'Uppsss, salio mal';

                }else{
                    unset($_SESSION['idArtista']);
                    header('Location: ../Vista/index.php');
                }
            }
        }
       

    }
}






?>