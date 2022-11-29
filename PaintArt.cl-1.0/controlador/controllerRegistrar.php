<?php 
session_start();
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

 class Helper {
	/**
	 *	Función de validación de un rut basado en el algoritmo chileno
	 *	el formato de entrada es ########-# en donde deben ser sólo
	 *	números en la parte izquierda al guión y número o k en el
	 *	dígito verificador
	 */
	static function validaRut ( $rutCompleto ) {
	if ( !preg_match("/^[0-9]+-[0-9kK]{1}/",$rutCompleto)) return false;
		$rut = explode('-', $rutCompleto);
		return strtolower($rut[1]) == Helper::dv($rut[0]);
	}
	static function dv ( $T ) {
		$M=0;$S=1;
		for(;$T;$T=floor($T/10))
			$S=($S+$T%10*(9-$M++%6))%11;
		return $S?$S-1:'k';
	}
}




if($password==$password2){
    $hel= new Helper();
   $resp= $hel->validaRut($rut);
   if($resp==true){
      $usuarioRegistrado=new usuarioRegistrado();
      $rep= $usuarioRegistrado->buscarCorreo($email);
      
      if($rep==false){
         $resp=$imagen->subirImagen($imagen);
         if ($resp==true) 
         {       
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
               
               header("Location: ../Vista/iniciarSesion.php");
            }
            else {
               $_SESSION["error"]="no se pudo crear el nuevo usuario";
            header("Location:../Vista/registrar.php");
            }

        
         }else{

            $_SESSION["error"]="No se pudo enlazar una fotografia a su perfil";
            header("Location:../Vista/registrar.php");
         }
      }else{
         $_SESSION["error"]="El correo ya ha sido utilizado";
          header("Location:../Vista/registrar.php");
      }
         
   }else{
      $_SESSION["error"]="El rut ingresado esta erroneo, reingrese nuevamente y con guion";
      header("Location:../Vista/registrar.php");
   }
   

}else{
   $_SESSION['error']="Las contraseñas no coinciden";
   header('Location: ../Vista/registrar.php');

}




?>