<?php 
include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/artista.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/obra.php';
include_once '../modelo/imagen.php';

$busqueda= $_POST["buscador"];
$modo = $_POST["modo"];


session_start();
if($modo=="artista"){
    $_SESSION["artista"]=$busqueda;
    header("Location: ..\Vista\pestañaArtistas.php");

}elseif($modo=="obra"){
    
    $_SESSION["obra"]= $busqueda;
    header("Location: ..\Vista\listaObras.php?cat=0");
}



?>