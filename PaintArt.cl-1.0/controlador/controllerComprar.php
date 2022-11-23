<?php 

include_once '../modelo/obra.php';
include_once '../modelo/imagen.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/artista.php';
include_once '../modelo/compra.php';
include_once '../modelo/direccion.php';

include_once '../modelo/usuarioRegistrado.php';
session_start();



$idUser= 1;
$metodo=$_POST['metodoPago'];
$region=$_POST['region'];
$ciudad=$_POST['Ciudad'];
$comuna=$_POST['comuna'];
$calle=$_POST['calle'];
$numeracion=$_POST['numeracion'];
$tipoHogar=$_POST['tipoHogar'];

date_default_timezone_set("America/Santiago");
$fecha= date("Y-m-d");

$idObra= $_SESSION['idCompra'];
$ob =new obra($idObra,null, null,null, null,null, null,null, null);
$obra= $ob->buscarObraId($idObra);
if($obra== false){
    $_SESSION['errorCompra']= 'hemos tenido problemas al buscar su obra';
    header("Location: ../Vista/detalleObra.php");
}else{
    $compra= new compra(null,$fecha, $metodo, $idObra,null, $obra->getIdArtista());
       echo $compra->mostrarCompra();
    $validaCompra= new Compra(null, null, null , null, null,null);
    $resp=$validaCompra->crearCompra($compra);
    if($resp == false){
        $_SESSION['errorCompra']= 'hemos tenido problemas registrar su obra';
        header("Location: ../Vista/detalleObra.php");
       
    }else{
        $compra= $validaCompra->ultimaCompra();
        $ultimaPosicion= $compra->size()-1;
        $idCompra= $compra->get($ultimaPosicion);
        $dir= new direccion(null,$region,$ciudad,$comuna,$calle,$tipoHogar,$numeracion,$idCompra);
        $validaDireccion= new direccion(null, null, null, null, null, null, null, null);
        $resp=$validaDireccion->crearDireccion($dir);
        if($resp==false){
            
            $_SESSION['errorCompra']= 'hemos tenido problemas registrar su direccion';

            $resp=$validaCompra->eliminarCompra($idCompra);
            if($resp==true){
                header("Location: ../Vista/detalleObra.php");
            }else{
                $_SESSION['errorCompra']= 'hemos tenido problemas de quitar su orden, por favor contactenos';
                header("Location: ../Vista/detalleObra.php");
            }
            
        }else{

            header("Location: ../Vista/index.php");  
        }
    }
   
       
    

}



        













?>