<?php 
include_once '../modelo/tarjetaUser.php';
include_once '../modelo/usuarioRegistrado.php';
session_start();


if ($_POST["parametros"]==1) {
    
    $tarjeta= new tarjetaUser ();
    $idUser= $_SESSION["online"];
    
    $resp = $tarjeta->buscarTarjetaUserId($idUser);
    
    if ($resp==false) {
        
    }else{
        $numTarjeta = $resp->__getNumTarjeta();
        $ultNum=substr(  $numTarjeta, 8);
        echo '
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Medio de pago actual</h4>
            <h6 class="alert-heading"><p class="mb-0">   '.$resp->__getTipoTarjeta().'  </a></p></h6>
            <p class="mb-0">  N.º de tarjeta: **** **** ****  '.$ultNum.' </a></p>
        </div>';
       
        
    }
}else{
    $idUser= $_SESSION["online"];
    $tipoTarjeta= $_POST["tipoTarjeta"];
    $numTarjeta = $_POST["numTarjeta"];
    $mesC = $_POST["mesC"];
    $añoC = $_POST["añoC"];
    $codigoV= $_POST["codigoV"];
    $tarjeta = new tarjetaUser();
    $resp = $tarjeta->buscarTarjetaUserId($idUser);
    if($resp==false){
    $resp = $tarjeta->agregarTarjeta($numTarjeta,$mesC, $añoC, $codigoV, $idUser, $tipoTarjeta);
    if($resp==false){
        echo "Oops obtuvimos un problema al agregar la tarjeta";
    }else{
        header("location: controllerAccesadorUsuarios.php");
    }
    }else{
        $resp = $tarjeta->modificarTarjeta($numTarjeta, $mesC, $añoC, $codigoV, $tipoTarjeta ,$idUser);
        if($resp==false){
            echo "Opps obtuvimos un problema al modificar el metodo de pago";
        }else{
            header("location: controllerAccesadorUsuarios.php");

        }
    }
}









?>