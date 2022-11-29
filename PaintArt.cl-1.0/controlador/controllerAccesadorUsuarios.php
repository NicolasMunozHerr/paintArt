<?php 
session_start();

include_once '../modelo/usuarioRegistrado.php';

$online = $_SESSION['online'];
$user = new usuarioRegistrado();
$resp = $user->buscarUusuarioId($online);

if($resp== false){
    header('Location: ../Vista/iniciarSesion.php');
}else{
    $permisos= $resp->getPermisos();
    switch ($permisos) {
        case 1:
            header('Location: ../Vista/perfilUsuario.php');
            break;
        case 2:
            header('Location: ../Vista/perfilArtista.php');
            break;
        case 3:
            header('Location: ../Vista/perfilAdmin.php');
            break;
          
            break;
        case 4:
            header('Location: ../Vista/perfilAdmin.php');
            break;
        case 5: 
        $_SESSION['informacion']="No se puede acceder al perfil por inclumplimiento de las normas comunitarias";

            header('Location: ../Vista/Index.php');
            break;      
                
       
        
        
    }

}



?>