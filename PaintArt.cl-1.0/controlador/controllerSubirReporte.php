<?php 
 include_once '../modelo/obra.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/arraylist.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/reportes.php';
 include_once '../modelo/artista.php';
 include_once '../modelo/usuarioRegistrado.php';

 $explicacion= $_POST['explicacion'];
 $razon= $_POST['razon'];
 session_start();
 if(empty($_SESSION["online"])){
  header('Location: ../Vista/iniciarSesion.php');


 }else{

  $idUser=$_SESSION['online'];
  $user= new usuarioRegistrado();
  $user= $user->buscarUusuarioId($idUser);
  if($user==false)
  {

  }else{
    if($user->getPermisos()==5){
      $_SESSION['informacion']= "Usted tiene bloqueado el acceso por incumplimiento de la norma";
      header('Location: ../Vista/Index.php');
    }else{
      if(empty($_SESSION['idReporte'])){
        $_SESSION["informacion"]="Algo salio mal con la id de la obra";
      }else{
        
        $id=$_SESSION['idReporte'];
        
        $reportes=new reportes(null, $explicacion, $razon,$idUser, $id);
    
        $resp= $reportes->subirRepor($reportes);
    
        if($resp==true){
            $_GET['id']= $id;
            header('Location: ../Vista/detalleObra.php?id='.$id);
        }else{
          echo 'algo salio mal';
        }
      }
    }
  }
  
  
  
 }
 





?>