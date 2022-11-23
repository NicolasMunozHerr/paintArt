<?php 
include_once '../modelo/usuarioRegistrado.php';

$email=$_POST["EMAIL"];
$password=$_POST["PASSWORD"];
$user= new usuarioRegistrado();
if ($email=="" && $password=="") {
    session_start();
   $_SESSION["error"]="Se solicita que llenen los campos por favor";
   header("Location:../Vista/iniciarSesion.php");
}else
{
    $user->setCorreo($email);
    $user->setContraseña($password);
    $resp=$user->iniciarSesion($user);
    if ($resp==false) {
       
        session_start();
        $_SESSION["error"]="No se encontro el correo o la contraseña es invalida";
        header("Location:../Vista/iniciarSesion.php");
      
    }else
    {
        session_start();
        
      $_SESSION["online"]=$resp->getId();
      header("Location:../Vista/Index.php");
    }
}
?>