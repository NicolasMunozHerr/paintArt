<?php 
 include_once '../modelo/reportesUser.php';
 include_once '../modelo/arraylist.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/reportes.php';
 include_once '../modelo/usuarioRegistrado.php';

 session_start();

if(empty($_SESSION['idUserReporte'])||empty($_SESSION['idCritica']) ){
   header('Location: ../Vista/index.php');
}else{
   $idUser=$_SESSION['idUserReporte'];
   $idCritica= $_SESSION['idCritica'];
   $explicacion= $_POST['explicacion'];
   $razon= $_POST['razon'];

   $critica =new reporteUser(null, $explicacion, $razon, $idUser, $idCritica);

   $resp = $critica->subirReporUser($critica);
   if($resp== false){
      echo 'upss algo salio mal';

   }else{
      unset($_SESSION['idUserReporte']);
      unset($_SESSION['idCritica']);
     
      header('Location: ../Vista/Index.php');


   }

}



 




?>