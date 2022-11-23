<?php
session_start();

include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/controlContrasennas.php';

require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


if(empty($_POST['EMAIL'])){
    $_SESSION['error']='No ha ingresado un email';
    header('Location: ../Vista/formularioCorreo.php');
}else{
    $user= new usuarioRegistrado();
    $correo = $_POST['EMAIL'];
    $resp= $user->buscarCorreo($correo);
    if($resp== false){
        $_SESSION['error']='No existe ese email';
        header('Location: ../Vista/formularioCorreo.php');
    }else{
        $estadoEnvio= false;
        $idUser= $resp->getId();
        $bytes= random_bytes(5);
        $token= bin2hex($bytes);
        
        date_default_timezone_set('America/Santiago');
        $codigo = date('H');
        $fecha = date('Y-m-d') ;

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'paintartcl@gmail.com';                     //SMTP username
            $mail->Password   = 'arrjygzguqbgdbrd';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            //Recipients
            $mail->setFrom('paintartcl@gmail.com', 'Equipo de soporte PaintArt');
            $mail->addAddress($correo);     //Add a recipient
        

            /*//Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name*/

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Restablecimiento de password';
            $mail->Body    = '
            <div style="margin:auto; width: 50%; height:auto ;height: auto;background-color: #f8f9fa!important;
            border: 1px solid #dee2e6; ">
             <br>
             <div style="margin: auto; width: 500px; text-align: center;">
              <img src="https://paintartcl.000webhostapp.com/PaintArt.cl/Vista/imagenes/logoGiganPaintArt.jpg" style=" margin: auto; width: 50%;height: 100px;" alt="">
              </div>
              <h3> </h3>
                <div style="text-align: center;">
                  <b style="font-family:  Arial;"> Utilize el siguiente link para restablecer su password</b>
                  <p style="font-family:  Arial; ">Hemos recibido una solicitud de cambios de contraseña, esperemos que sea usted, ante manos declaramos que este link solo funcionara durante las primeras 24 hrs de la emision de dicha solicitud</p>
                  <br>
                  <br>
                  <a style="font-family:  Arial;" href="http://localhost/crono/PaintArt.cl/Vista/reset.php?email='.$correo.'&token='.$token.'">  <button type="button" onmouseover="this.backgroundColor=#ffc107" style=" cursor: pointer;color: #000;background-color: #ffc107;border-color: #ffc107;border: 14px solid transparent; border-radius: 0.25rem; height:45PX ; width: 150PX; "> CLICK AQUI</button></a>     
                
                </div>
                          <br>
            
                <p style="font-family: Arial; text-align: center;"> [Si no ha sido usted por favor evitar este correo electronico] </p>
            
            </div>
            ';

            $mail->send();
            echo 'El mensaje se envio correctamente';
            $estadoEnvio=true;
        } catch (Exception $e) {
            echo "Hubo un error al enviar el correo: {$mail->ErrorInfo}";
        }           
           $contra= new contraseñas(null,$correo, $token, $fecha, $codigo, $idUser);
           echo $contra->__toString();
            if($estadoEnvio== true){
                $resp= $contra->crearContraseña($contra);
                
                
                if($resp ==false){
                    $_SESSION['error']='Algo ocurrio en la carga de informacion';
                    header('Location: ../Vista/formularioCorreo.php');
                }else{
                    $_SESSION['error']='Revise la bandeja de su correo por favor';
                    header('Location: ../Vista/iniciarSesion.php');
                }
            }
        
    }



    
}




?>

