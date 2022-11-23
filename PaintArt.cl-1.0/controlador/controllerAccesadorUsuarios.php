<?php 

include_once '../modelo/usuarioRegistrado.php';
session_start();

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
            header('Location: ../Vista/perfilUsuario.php');
            break;      
                
       
        
        
    }

}



?>