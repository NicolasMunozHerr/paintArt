<?php 
include_once '../modelo/subastas.php';
include_once '../modelo/obra.php';
include_once '../modelo/compra.php';
include_once '../modelo/arraylist.php';


class controllerSubasta{

    public function mostrarPujaAcTual($idObra){
        $ob = new obra(null, null, null, null, null,null, null, null, null);
        $sb= new subasta();
        $resp= $sb->validaAsociacionObra($idObra);
        if ($resp==false) {
            echo "fallo";
        }else{
           return $resp->__getPrecioPuja();
        }
    }

    public function mostrarPrecioMinimo($idObra){
        $ob = new obra(null, null, null, null, null,null, null, null, null);
        $sb= new subasta();
        $resp= $sb->validaAsociacionObra($idObra);
        if ($resp==false) {
            echo "fallo";
        }else{
           return $resp->__getPrecioMinimo();
        }
    }



}




?>