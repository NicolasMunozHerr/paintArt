<?php 
session_start();

include_once '../modelo/obra.php';
include_once '../modelo/imagen.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/artista.php';
include_once '../modelo/compra.php';
include_once '../modelo/direccion.php';

include_once '../modelo/usuarioRegistrado.php';
if(empty($_SESSION['online'])){
    header("Location: ../Vista/iniciarSesion.php");
}else{
    $idUser= $_SESSION["online"];
    $user= new usuarioRegistrado();
    $user= $user->buscarUusuarioId($idUser);
    if($user==false)
    {
        header("Location: ../Vista/iniciarSesion.php");

    }else{
        if($user->getPermisos()==5){
            $_SESSION['informacion']="No puede acceder a su perfil por incumplir normas comunitarias, muchas gracias";
            header("Location: ../Vista/Index.php");
        }else{
            $idUser= $_SESSION['online'];
            $metodo=$_POST['metodoPago'];
            $region=$_POST['region'];
            $ciudad=$_POST['Ciudad'];
            $comuna=$_POST['comuna'];
            $calle=$_POST['calle'];
            $numeracion=$_POST['numeracion'];
            $tipoHogar=$_POST['tipoHogar'];
            if($tipoHogar=='casa'){
                $tipoHogar=1;
            }elseif ($tipoHogar=='departamento') {
                $tipoHogar=2;    
            }

            date_default_timezone_set("America/Santiago");
            $fecha= date("Y-m-d");

            $idObra= $_SESSION['idCompra'];
            $ob =new obra($idObra,null, null,null, null,null, null,null, null);
            $obra= $ob->buscarObraId($idObra);
            if($obra== false){
                $_SESSION['errorCompra']= 'hemos tenido problemas al buscar su obra';
                header("Location: ../Vista/detalleObra.php");
            }else{
                $direccion= new direccion(null,$region,$ciudad, $comuna, $calle,$tipoHogar,$numeracion);
                $resp= $direccion->crearDireccion($direccion);
                if($resp== false){
                    $_SESSION['errorCompra']= 'hemos tenido problemas introducir su direccion';
                    header("Location: ../Vista/detalleObra.php");
                
                }else{
                    $direccion=$direccion->ultimaDireccion();
                    if($direccion==false){
                    $_SESSION['errorCompra']= 'hemos tenido problemas busar la direccion';
                    header("Location: ../Vista/detalleObra.php");
                    }else{
                        $compra= new compra(null, $fecha, $metodo,$idObra,$idUser,$obra->getIdArtista(), $direccion->getIdDireccion(), $obra->getPrecio());
                        $stock=$obra->getStock();
                        $newStock=intval($stock)-1;
                        $ob->descontarStock($newStock,$idObra);
                        $resp= $compra->crearCompra($compra);
                        unset($_SESSION['idCompra']);
                        if ($resp==false) {
                            $_SESSION['errorCompra']= 'hemos tenido problemas procesar su compra';
                            header("Location: ../Vista/detalleObra.php");
                        
                        }else{
                            $_SESSION['errorCompra']= 'compra exitosa';
                            header("Location: ../Vista/Index.php");   
                        }
                    }
                }
                    }
                    

                }
}



   
    
    

}



        













?>