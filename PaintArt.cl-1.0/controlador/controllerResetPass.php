<?php 
include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/controlContrasennas.php';
session_start();
date_default_timezone_set('America/Santiago');

if(empty($_POST['email']) || empty($_POST['token'])|| empty($_POST['password'])|| empty($_POST['password2'])){
    $_SESSION['error']='Faltan campos';
   
    
    header('Location: ../Vista/formularioCorreo.php');
}else{
    $email = $_POST['email'];
    $token= $_POST['token'];
    $password= $_POST['password'];
    $password2= $_POST['password2'];
    echo $password. $password2; 
    if($password== $password2){
        $contra= new contraseñas(null, null, null, null, null,null);
        $resp = $contra->buscarConstraseña($email, $token);
        if($resp==false){
            $_SESSION['error']='Algo ocurrio al busacar en los registros de la solicitud de cambio de contraseña';
            header('Location: ../Vista/reset.php?email='.$email.'&token='.$token.'');
        }else{
            $contra= $resp;
            $fecha= $contra->__getFecha();
            if(date('Y-m-d')==$fecha){
                $hora= $contra->__getCodigo();
                if(date('H')==$hora){
                    $user= new usuarioRegistrado();
                    $resp = $user->cambiarContra($password, $email);
                    if($resp==false){
                        $_SESSION['error']='Error al cambiar de contrseña';
                        header('Location: ../Vista/reset.php?email='.$email.'&token='.$token.'');
                    }else{
                        $resp= $contra->eliminarSolicitud($email);
                        if($resp==false){
                            $_SESSION['error']='Error al eliminar la solicitud de cambio de contraseña';
                            header('Location: ../Vista/reset.php?email='.$email.'&token='.$token.'');
                        }else{
                            $_SESSION['error']='Contraseña cambiada con exito';
                            header('Location: ../Vista/iniciarSesion.php');
                        }

                        
                    }
                }else{
                    $_SESSION['error']='Solicitud de cambio de contraseña vencida por mas de una hora';
                    header('Location: ../Vista/reset.php?email='.$email.'&token='.$token.'');
                }
            }else{
                $_SESSION['error']='Solicitud de cambio de contraseña vencida por mas de un dia';
                header('Location: ../Vista/reset.php?email='.$email.'&token='.$token.'');
            }
        }
    }else{
        $_SESSION['error']='Las contraseñas no son iguales';
        header('Location: ../Vista/reset.php?email='.$email.'&token='.$token.'');
    }
}






?>