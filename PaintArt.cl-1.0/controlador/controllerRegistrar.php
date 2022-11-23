<?php 
 include_once '../modelo/imagen.php';
 include_once '../modelo/usuarioRegistrado.php';

 $nombre=$_POST["NOMBRE"];
 $apellido=$_POST["APELLIDO"];
 $rut=$_POST["RUT"];
 $email=$_POST["EMAIL"];
 $numtelfono=$_POST["NUMTELEFONO"];
 $fechanam=$_POST["FECHANAM"];
 $password=$_POST["PASSWORD"];
 $password2=$_POST["PASSWORD2"];
 $urlimagen="imagenes/avatar.png";
 $imagen= new imagen($urlimagen);

if($password==$password2){

 $resp=$imagen->subirImagen($imagen);
 if ($resp==true) 
 {
    $usuarioRegistrado=new usuarioRegistrado();
    $idImagen=$imagen->ulltimaIdImagen();
    $usuarioRegistrado->setNombre($nombre);
    $usuarioRegistrado->setApellido($apellido);
    $usuarioRegistrado->setRut($rut);
    $usuarioRegistrado->setCorreo($email);
    $usuarioRegistrado->setNumeroTel($numtelfono);
    $usuarioRegistrado->setFechaNac($fechanam);
    $usuarioRegistrado->setContraseña($password);
    $usuarioRegistrado->setIdImagen($idImagen->getIdImagen());

 // echo    $usuarioRegistrado->__toString();
   $nuevo=$usuarioRegistrado->crearUser($usuarioRegistrado);
   if ($nuevo==true) {
      # code...
      session_start();
      $_SESSION["online"]=true;
      header("Location: ../Vista/index.php");
   }
   else {
      echo "fallo";
   }

}else{
   session_start();
   $_SESSION["error"]="las contraeñas no coinciden";
   header("Location:../Vista/registrar.php");
}

} 




?>