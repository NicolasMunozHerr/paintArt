<?php
include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/artista.php';

$newBiografia = $_POST['biografia'];

session_start();
$idUser=0;
if (empty($_SESSION['online'])) {
    header('Location: ../Vista/iniciarSesion.php');
}else{
    $idUser= $_SESSION['online'];
    $artista= new artista(null, null, null, null);
    $resp= $artista->buscarArtistaIdUser($idUser);
    if($resp==false){
        echo 'Ops ocurrio algo mientras actualizabamos su biogrfia..';
    }else{
        $resp->setBiografia($newBiografia);
        $resp= $artista->actualizarBiografiaArtista($resp);
        if($resp==false){
            echo 'algo salio al intentar actualizar';
        }else{  
            header('Location: ../Vista/perfilArtista.php');
        }

    }

}



?>
