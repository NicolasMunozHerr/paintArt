<?php 
 include_once '../modelo/peticion.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/direccion.php';
 include_once '../modelo/arraylist.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/artista.php';
 include_once '../modelo/usuarioRegistrado.php';
 include_once '../modelo/tarjetaUser.php';

$Asunto= $_POST['Asunto'];
$descripcion= $_POST['descripcion'];
$precio= $_POST['precio'];
$region= $_POST['region'];
$ciudad= $_POST['Ciudad'];
$comuna= $_POST['comuna'];
$calle= $_POST['calle'];
$numeracion= $_POST['numeracion'];
$tipoHogar= $_POST['tipoHogar'];
$estadoTarjet= 0;
if($tipoHogar=="departamento"){
    $tipoHogar=2;
}else{
        $tipoHogar=1;

}

if(empty($_POST["numTarjeta"])||empty($_POST["mesC"])|| empty($_POST["Año"])|| empty($_POST["codigoV"]|| empty($_POST["tipoTarjeta"])))
{
    echo 'no hay na'; 
}else{
    $numTarjet= $_POST["numTarjeta"];
    $mesC= $_POST["mesC"];
    $año= $_POST["Año"];
    $codigoV= $_POST["codigoV"];
    $tipoTarjeta= $_POST["tipoTarjeta"];
    $estadoTarjet= 1;

}
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
            header("Location: ../Vista/Index.php");
        }else{
            $idArtista= $_SESSION['idArtista'];
            $idUsuario= $_SESSION['online'];
            date_default_timezone_set("America/Santiago");
            $fecha= date("Y-m-d");
            $direccion =new direccion(null, $region, $ciudad,$comuna, $calle, $tipoHogar, $numeracion);
            $resp=$direccion->crearDireccion($direccion);

            if ($resp==false) {
                echo 'Upsss, salio mal en la creacion de la direccion';
            }else{

                $infoDireccion= $direccion->ultimaDireccion();
                $peticion =new peticion (null,$Asunto, $descripcion, 0, $fecha, $precio, $idUsuario,$idArtista,$infoDireccion->getIdDireccion());
                $resp= $peticion->subirPeticion($peticion);
            
                
                if($resp==false){

                    echo 'Uppsss, salio mal en la creacion de la peticion';

                }else{
                    if($estadoTarjet==0){
                        unset($_SESSION['idArtista']);
                        header('Location: ../Vista/Index.php');
                    }elseif($estadoTarjet==1){
                        $resp= 0;
                        $tajertaUser= new tarjetaUser();
                      /*
                        echo 'numTarjet = '.$numTarjet;
                        echo ' mesc=  '.$mesC;
                        echo ' año= '.$año;
                        echo ' codigoV= '. $codigoV;
                        echo 'IdUsuario= '.$idUsuario;*/
                        $resp= $tajertaUser->agregarTarjeta($numTarjet, $mesC, $año, $codigoV, $idUsuario,$tipoTarjeta);
                        
                        if($resp==true){
                            unset($_SESSION['idArtista']);
                            header('Location: ../Vista/Index.php');
                            

                        }else{
                            echo 'upsssm salio mal en la adesion de tarjeta de pago';
                            echo $resp;
                        }
                       
                    }
                    
                }
            }
        }
       

    }
}






?>